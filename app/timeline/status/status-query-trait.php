<?php

namespace Voxel\Timeline\Status;

if ( ! defined('ABSPATH') ) {
	exit;
}

trait Status_Query_Trait {

	protected static $instances = [];

	/**
	 * Get a status based on its id.
	 *
	 * @since 1.0
	 */
	public static function get( $id ) {
		if ( is_array( $id ) ) {
			$data = $id;
			$id = $data['id'];
			if ( ! array_key_exists( $id, static::$instances ) ) {
				static::$instances[ $id ] = new static( $data );
			}
		} elseif ( is_numeric( $id ) ) {
			if ( ! array_key_exists( $id, static::$instances ) ) {
				$result = static::find( [
					'id' => $id,
					'limit' => 1,
					'with_user_like_status' => true,
					'with_user_repost_status' => true,
				] );

				static::$instances[ $id ] = $result ?? null;
			}
		} elseif ( $id === null ) {
			return null;
		}

		return static::$instances[ $id ];
	}

	public static function force_get( $id ) {
		unset( static::$instances[ $id ] );
		return static::get( $id );
	}

	public static function query( array $args ): array {
		return static::_query_results( $args );
	}

	public static function find( array $args ): ?self {
		$args['limit'] = 1;
		$args['offset'] = null;
		$query = static::query( $args );
		return array_shift( $query['items'] );
	}

	public static function _query_results( array $args ): array {
		global $wpdb;
		$args = array_merge( [
			'id' => null,
			'user_id' => null, // a negative id can be provided to exclude statuses from that user
			'post_id' => null,
			'published_as' => null,
			'repost_of' => null,
			'quote_of' => null,
			'feed' => null, // post_timeline, post_wall, post_reviews, user_timeline
			'order_by' => 'created_at',
			'order' => 'desc',
			'offset' => null,
			'limit' => 10,
			'with_user_like_status' => false,
			'with_user_repost_status' => false,
			'follower_type' => null,
			'follower_id' => null,
			'created_at' => null,
			'search' => null,
			'moderation' => null,

			// if set to true, will strictly check for the moderation status provided
			// without additional checks on whether this user is an author or a moderator
			'moderation_strict' => false,
			'with_current_user_visibility_checks' => false,
			'with_annotations' => false,
			'with_no_reposts' => false,
			'_get_total_count' => false,
			'liked_by_user' => null,
		], $args );

		$join_clauses = [];
		$where_clauses = [];
		$orderby_clauses = [];
		$select_clauses = [
			'DISTINCT statuses.id AS status_id',
			'statuses.*',
		];

		if ( ! is_null( $args['id'] ) ) {
			if ( $args['id'] < 0 ) {
				$where_clauses[] = sprintf( 'NOT(statuses.id <=> %d)', absint( $args['id'] ) );
			} else {
				$where_clauses[] = sprintf( 'statuses.id = %d', absint( $args['id'] ) );
			}
		}

		if ( ! is_null( $args['user_id'] ) ) {
			if ( $args['user_id'] < 0 ) {
				$where_clauses[] = sprintf( 'NOT(statuses.user_id <=> %d)', absint( $args['user_id'] ) );
			} else {
				$where_clauses[] = sprintf( 'statuses.user_id = %d', absint( $args['user_id'] ) );
			}
		}

		if ( ! is_null( $args['post_id'] ) ) {
			if ( $args['post_id'] < 0 ) {
				$where_clauses[] = sprintf( 'NOT(statuses.post_id <=> %d)', absint( $args['post_id'] ) );
			} else {
				$where_clauses[] = sprintf( 'statuses.post_id = %d', absint( $args['post_id'] ) );
			}
		}

		if ( is_string( $args['search'] ) && ! empty( $args['search'] ) ) {
			$keywords = \Voxel\text_formatter()->prepare_for_fulltext_search( $args['search'] );
			if ( ! empty( $keywords ) ) {
				$where_clauses[] = $wpdb->prepare( 'MATCH (statuses._index) AGAINST (%s IN BOOLEAN MODE)', $keywords );
			} else {
				// if the search query becomes empty after preparation (invalid query provided), return no results
				$where_clauses[] = '1=0';
			}
		}

		if ( ! is_null( $args['published_as'] ) ) {
			if ( $args['published_as'] < 0 ) {
				$where_clauses[] = sprintf( 'NOT(statuses.published_as <=> %d)', absint( $args['published_as'] ) );
			} else {
				$where_clauses[] = sprintf( 'statuses.published_as = %d', absint( $args['published_as'] ) );
			}
		}

		if ( ! is_null( $args['repost_of'] ) ) {
			$where_clauses[] = sprintf( 'statuses.repost_of = %d', absint( $args['repost_of'] ) );
		}

		if ( ! is_null( $args['quote_of'] ) ) {
			$where_clauses[] = sprintf( 'statuses.quote_of = %d', absint( $args['quote_of'] ) );
		}

		if ( is_numeric( $args['moderation'] ) ) {
			if ( $args['moderation_strict'] ) {
				$where_clauses[] = $wpdb->prepare( "statuses.moderation = %d", (int) $args['moderation'] );
			} else {
				if ( is_user_logged_in() ) {
					$join_clauses[] = "LEFT JOIN {$wpdb->posts} AS posts ON statuses.post_id = posts.ID";
					$where_clauses[] = $wpdb->prepare( <<<SQL
						( statuses.moderation = %d OR statuses.user_id = %d OR ( statuses.feed = 'post_timeline' AND posts.post_author = %d ) )
					SQL, (int) $args['moderation'], get_current_user_id(), get_current_user_id() );
				} else {
					$where_clauses[] = $wpdb->prepare( "statuses.moderation = %d", (int) $args['moderation'] );
				}
			}
		}

		if ( $args['feed'] !== null ) {
			if ( is_array( $args['feed'] ) ) {
				$where_clauses[] = sprintf( "statuses.feed IN ('%s')", join( "','", array_map( 'esc_sql', $args['feed'] ) ) );
			} else {
				$where_clauses[] = sprintf( 'statuses.feed = \'%s\'', esc_sql( $args['feed'] ) );
			}
		}

		if ( is_numeric( $args['liked_by_user'] ) ) {
			$join_clauses[] = $wpdb->prepare( "INNER JOIN {$wpdb->prefix}voxel_timeline_status_likes AS l2
				ON ( l2.status_id = statuses.id AND l2.user_id = %d )", $args['liked_by_user'] );
		}

		if ( $args['with_user_like_status'] ) {
			$user_to_check = get_current_user_id();
			if ( $user_to_check >= 1 ) {
				$select_clauses[] = $wpdb->prepare( "( SELECT 1 FROM {$wpdb->prefix}voxel_timeline_status_likes l
					WHERE l.status_id = statuses.id AND l.user_id = %d LIMIT 1 ) AS liked_by_user", $user_to_check );
			}
		}

		if ( $args['with_user_repost_status'] ) {
			$user_to_check = get_current_user_id();
			if ( $user_to_check >= 1 ) {
				$select_clauses[] = $wpdb->prepare( "( SELECT 1 FROM {$wpdb->prefix}voxel_timeline t2
					WHERE t2.repost_of = statuses.id AND t2.user_id = %d LIMIT 1 ) AS reposted_by_user", $user_to_check );
			}
		}

		if ( ! is_null( $args['follower_type'] ) && ! is_null( $args['follower_id'] ) ) {
			$follower_type = $args['follower_type'] === 'post' ? 'post' : 'user';
			$follower_id = absint( $args['follower_id'] );
			$join_clauses[] = $wpdb->prepare( "LEFT JOIN {$wpdb->prefix}voxel_followers AS follow ON ( follow.follower_type = '%s' AND follow.follower_id = %d AND follow.status = 1 )", $follower_type, $follower_id );
			$where_clauses[] = $wpdb->prepare(
				"( ( follow.object_type = 'user' AND follow.object_id = statuses.user_id ) OR ( follow.object_type = 'post' AND follow.object_id = statuses.post_id ) OR statuses.user_id = %d )",
				$follower_id
			);
		}

		if ( $args['with_current_user_visibility_checks'] ) {
			$visibility_or_clauses = [];

			// user_timeline
			$visibility = \Voxel\get( 'settings.timeline.user_timeline.visibility', 'public' );
			if ( $visibility === 'logged_in' ) {
				if ( ! is_user_logged_in() ) {
					$visibility_or_clauses[] = "(statuses.feed = 'user_timeline' AND 1=0)";
				} else {
					$visibility_or_clauses[] = "(statuses.feed = 'user_timeline')";
				}
			} elseif ( $visibility === 'followers_only' ) {
				if ( ! is_user_logged_in() ) {
					$visibility_or_clauses[] = "(statuses.feed = 'user_timeline' AND 1=0)";
				} else {
					$join_clauses[] = $wpdb->prepare( "LEFT JOIN {$wpdb->prefix}voxel_followers AS user_follow
						ON ( user_follow.follower_type = 'user' AND user_follow.follower_id = %d AND user_follow.status = 1 )", get_current_user_id() );
					$visibility_or_clauses[] = $wpdb->prepare( "(
						statuses.feed = 'user_timeline' AND (
							statuses.user_id = %d
							OR ( user_follow.object_type = 'user' AND user_follow.object_id = statuses.user_id )
						)
					)", get_current_user_id() );
				}
			} elseif ( $visibility === 'customers_only' ) {
				if ( ! is_user_logged_in() ) {
					$visibility_or_clauses[] = "(statuses.feed = 'user_timeline' AND 1=0)";
				} else {
					$join_clauses[] = $wpdb->prepare( "LEFT JOIN {$wpdb->prefix}vx_orders AS user_order
						ON ( user_order.customer_id = %d AND user_order.status IN ('completed','sub_active') )", get_current_user_id() );
					$visibility_or_clauses[] = $wpdb->prepare( "(
						statuses.feed = 'user_timeline' AND (
							statuses.user_id = %d
							OR user_order.vendor_id = statuses.user_id
							OR ( statuses.user_id = %d AND user_order.vendor_id IS NULL )
						)
					)", get_current_user_id(), \Voxel\get_main_admin() ? \Voxel\get_main_admin()->get_id() : null );
				}
			} elseif ( $visibility === 'private' ) {
				if ( ! is_user_logged_in() ) {
					$visibility_or_clauses[] = "(statuses.feed = 'user_timeline' AND 1=0)";
				} else {
					$visibility_or_clauses[] = $wpdb->prepare( "(statuses.feed = 'user_timeline' AND statuses.user_id = %d)", get_current_user_id() );
				}
			} else /* $visibility === 'public' */ {
				$visibility_or_clauses[] = "(statuses.feed = 'user_timeline')";
			}

			// post_timeline, post_reviews, post_wall
			$visibility = [
				'post_timeline' => [],
				'post_wall' => [],
				'post_reviews' => [],
			];

			foreach ( \Voxel\Post_Type::get_voxel_types() as $post_type ) {
				$possible_values = [ 'public', 'logged_in', 'followers_only', 'customers_only', 'private' ];

				// post_timeline
				if ( $post_type->get_setting( 'timeline.enabled' ) ) {
					$post_timeline_visibility = $post_type->get_setting('timeline.visibility');
					if ( ! in_array( $post_timeline_visibility, $possible_values, true ) ) {
						$post_timeline_visibility = 'public';
					}

					if ( ! isset( $visibility['post_timeline'][ $post_timeline_visibility ] ) ) {
						$visibility['post_timeline'][ $post_timeline_visibility ] = [];
					}

					$visibility['post_timeline'][ $post_timeline_visibility ][] = $post_type->get_key();
				}

				// post_wall
				if ( $post_type->get_setting( 'timeline.wall' ) !== 'disabled' ) {
					$post_wall_visibility = $post_type->get_setting('timeline.wall_visibility');
					if ( ! in_array( $post_wall_visibility, $possible_values, true ) ) {
						$post_wall_visibility = 'public';
					}

					if ( ! isset( $visibility['post_wall'][ $post_wall_visibility ] ) ) {
						$visibility['post_wall'][ $post_wall_visibility ] = [];
					}

					$visibility['post_wall'][ $post_wall_visibility ][] = $post_type->get_key();
				}

				// post_reviews
				if ( $post_type->get_setting( 'timeline.reviews' ) !== 'disabled' ) {
					$post_reviews_visibility = $post_type->get_setting('timeline.review_visibility');
					if ( ! in_array( $post_reviews_visibility, $possible_values, true ) ) {
						$post_reviews_visibility = 'public';
					}

					if ( ! isset( $visibility['post_reviews'][ $post_reviews_visibility ] ) ) {
						$visibility['post_reviews'][ $post_reviews_visibility ] = [];
					}

					$visibility['post_reviews'][ $post_reviews_visibility ][] = $post_type->get_key();
				}
			}

			$post_feed_join_clauses = [];
			$post_feed_or_clauses = [];

			// post_timeline
			if ( ! empty( $visibility['post_timeline']['logged_in'] ) ) {
				$__post_type_in = "'".join( "','", array_map( 'esc_sql', $visibility['post_timeline']['logged_in'] ) )."'";
				if ( ! is_user_logged_in() ) {
					$post_feed_or_clauses[] = sprintf( "(statuses.feed = 'post_timeline' AND posts.post_type IN ({$__post_type_in}) AND 1=0)" );
				} else {
					$post_feed_or_clauses[] = sprintf( "(statuses.feed = 'post_timeline' AND posts.post_type IN ({$__post_type_in}))" );
				}
			}

			if ( ! empty( $visibility['post_timeline']['followers_only'] ) ) {
				$__post_type_in = "'".join( "','", array_map( 'esc_sql', $visibility['post_timeline']['followers_only'] ) )."'";
				if ( ! is_user_logged_in() ) {
					$post_feed_or_clauses[] = sprintf( "(statuses.feed = 'post_timeline' AND posts.post_type IN ({$__post_type_in}) AND 1=0)" );
				} else {
					$post_feed_join_clauses[] = $wpdb->prepare( "LEFT JOIN {$wpdb->prefix}voxel_followers AS post_follow
						ON ( post_follow.follower_type = 'user' AND post_follow.follower_id = %d AND post_follow.status = 1 )", get_current_user_id() );
					$post_feed_or_clauses[] = $wpdb->prepare( "(
						statuses.feed = 'post_timeline' AND posts.post_type IN ({$__post_type_in}) AND (
							posts.post_author = %d
							OR ( post_follow.object_type = 'post' AND post_follow.object_id = statuses.post_id )
						)
					)", get_current_user_id() );
				}
			}

			if ( ! empty( $visibility['post_timeline']['customers_only'] ) ) {
				$__post_type_in = "'".join( "','", array_map( 'esc_sql', $visibility['post_timeline']['customers_only'] ) )."'";
				if ( ! is_user_logged_in() ) {
					$post_feed_or_clauses[] = sprintf( "(statuses.feed = 'post_timeline' AND posts.post_type IN ({$__post_type_in}) AND 1=0)" );
				} else {
					$post_feed_join_clauses[] = $wpdb->prepare( "LEFT JOIN {$wpdb->prefix}vx_orders AS post_order
						ON ( post_order.customer_id = %d AND post_order.status IN ('completed','sub_active') )", get_current_user_id() );
					$post_feed_join_clauses[] = "LEFT JOIN {$wpdb->prefix}vx_order_items AS post_order_item
						ON ( post_order.id = post_order_item.order_id )";
					$post_feed_or_clauses[] = $wpdb->prepare( "(
						statuses.feed = 'post_timeline' AND posts.post_type IN ({$__post_type_in}) AND (
							posts.post_author = %d
							OR post_order_item.post_id = statuses.post_id
						)
					)", get_current_user_id() );
				}
			}

			if ( ! empty( $visibility['post_timeline']['private'] ) ) {
				$__post_type_in = "'".join( "','", array_map( 'esc_sql', $visibility['post_timeline']['private'] ) )."'";
				if ( ! is_user_logged_in() ) {
					$post_feed_or_clauses[] = sprintf( "(statuses.feed = 'post_timeline' AND posts.post_type IN ({$__post_type_in}) AND 1=0)" );
				} else {
					$post_feed_or_clauses[] = $wpdb->prepare( "(statuses.feed = 'post_timeline' AND posts.post_type IN ({$__post_type_in})
						AND posts.post_author = %d)", get_current_user_id() );
				}
			}

			if ( ! empty( $visibility['post_timeline']['public'] ) ) {
				$__post_type_in = "'".join( "','", array_map( 'esc_sql', $visibility['post_timeline']['public'] ) )."'";
				$post_feed_or_clauses[] = sprintf( "(statuses.feed = 'post_timeline' AND posts.post_type IN ({$__post_type_in}))" );
			}

			// post_wall
			if ( ! empty( $visibility['post_wall']['logged_in'] ) ) {
				$__post_type_in = "'".join( "','", array_map( 'esc_sql', $visibility['post_wall']['logged_in'] ) )."'";
				if ( ! is_user_logged_in() ) {
					$post_feed_or_clauses[] = sprintf( "(statuses.feed = 'post_wall' AND posts.post_type IN ({$__post_type_in}) AND 1=0)" );
				} else {
					$post_feed_or_clauses[] = sprintf( "(statuses.feed = 'post_wall' AND posts.post_type IN ({$__post_type_in}))" );
				}
			}

			if ( ! empty( $visibility['post_wall']['followers_only'] ) ) {
				$__post_type_in = "'".join( "','", array_map( 'esc_sql', $visibility['post_wall']['followers_only'] ) )."'";
				if ( ! is_user_logged_in() ) {
					$post_feed_or_clauses[] = sprintf( "(statuses.feed = 'post_wall' AND posts.post_type IN ({$__post_type_in}) AND 1=0)" );
				} else {
					$post_feed_join_clauses[] = $wpdb->prepare( "LEFT JOIN {$wpdb->prefix}voxel_followers AS post_follow
						ON ( post_follow.follower_type = 'user' AND post_follow.follower_id = %d AND post_follow.status = 1 )", get_current_user_id() );
					$post_feed_or_clauses[] = $wpdb->prepare( "(
						statuses.feed = 'post_wall' AND posts.post_type IN ({$__post_type_in}) AND (
							posts.post_author = %d
							OR ( post_follow.object_type = 'post' AND post_follow.object_id = statuses.post_id )
						)
					)", get_current_user_id() );
				}
			}

			if ( ! empty( $visibility['post_wall']['customers_only'] ) ) {
				$__post_type_in = "'".join( "','", array_map( 'esc_sql', $visibility['post_wall']['customers_only'] ) )."'";
				if ( ! is_user_logged_in() ) {
					$post_feed_or_clauses[] = sprintf( "(statuses.feed = 'post_wall' AND posts.post_type IN ({$__post_type_in}) AND 1=0)" );
				} else {
					$post_feed_join_clauses[] = $wpdb->prepare( "LEFT JOIN {$wpdb->prefix}vx_orders AS post_order
						ON ( post_order.customer_id = %d AND post_order.status IN ('completed','sub_active') )", get_current_user_id() );
					$post_feed_join_clauses[] = "LEFT JOIN {$wpdb->prefix}vx_order_items AS post_order_item
						ON ( post_order.id = post_order_item.order_id )";
					$post_feed_or_clauses[] = $wpdb->prepare( "(
						statuses.feed = 'post_wall' AND posts.post_type IN ({$__post_type_in}) AND (
							posts.post_author = %d
							OR post_order_item.post_id = statuses.post_id
						)
					)", get_current_user_id() );
				}
			}

			if ( ! empty( $visibility['post_wall']['private'] ) ) {
				$__post_type_in = "'".join( "','", array_map( 'esc_sql', $visibility['post_wall']['private'] ) )."'";
				if ( ! is_user_logged_in() ) {
					$post_feed_or_clauses[] = sprintf( "(statuses.feed = 'post_wall' AND posts.post_type IN ({$__post_type_in}) AND 1=0)" );
				} else {
					$post_feed_or_clauses[] = $wpdb->prepare( "(statuses.feed = 'post_wall' AND posts.post_type IN ({$__post_type_in})
						AND posts.post_author = %d)", get_current_user_id() );
				}
			}

			if ( ! empty( $visibility['post_wall']['public'] ) ) {
				$__post_type_in = "'".join( "','", array_map( 'esc_sql', $visibility['post_wall']['public'] ) )."'";
				$post_feed_or_clauses[] = sprintf( "(statuses.feed = 'post_wall' AND posts.post_type IN ({$__post_type_in}))" );
			}

			// post_reviews
			if ( ! empty( $visibility['post_reviews']['logged_in'] ) ) {
				$__post_type_in = "'".join( "','", array_map( 'esc_sql', $visibility['post_reviews']['logged_in'] ) )."'";
				if ( ! is_user_logged_in() ) {
					$post_feed_or_clauses[] = sprintf( "(statuses.feed = 'post_reviews' AND posts.post_type IN ({$__post_type_in}) AND 1=0)" );
				} else {
					$post_feed_or_clauses[] = sprintf( "(statuses.feed = 'post_reviews' AND posts.post_type IN ({$__post_type_in}))" );
				}
			}

			if ( ! empty( $visibility['post_reviews']['followers_only'] ) ) {
				$__post_type_in = "'".join( "','", array_map( 'esc_sql', $visibility['post_reviews']['followers_only'] ) )."'";
				if ( ! is_user_logged_in() ) {
					$post_feed_or_clauses[] = sprintf( "(statuses.feed = 'post_reviews' AND posts.post_type IN ({$__post_type_in}) AND 1=0)" );
				} else {
					$post_feed_join_clauses[] = $wpdb->prepare( "LEFT JOIN {$wpdb->prefix}voxel_followers AS post_follow
						ON ( post_follow.follower_type = 'user' AND post_follow.follower_id = %d AND post_follow.status = 1 )", get_current_user_id() );
					$post_feed_or_clauses[] = $wpdb->prepare( "(
						statuses.feed = 'post_reviews' AND posts.post_type IN ({$__post_type_in}) AND (
							posts.post_author = %d
							OR ( post_follow.object_type = 'post' AND post_follow.object_id = statuses.post_id )
						)
					)", get_current_user_id() );
				}
			}

			if ( ! empty( $visibility['post_reviews']['customers_only'] ) ) {
				$__post_type_in = "'".join( "','", array_map( 'esc_sql', $visibility['post_reviews']['customers_only'] ) )."'";
				if ( ! is_user_logged_in() ) {
					$post_feed_or_clauses[] = sprintf( "(statuses.feed = 'post_reviews' AND posts.post_type IN ({$__post_type_in}) AND 1=0)" );
				} else {
					$post_feed_join_clauses[] = $wpdb->prepare( "LEFT JOIN {$wpdb->prefix}vx_orders AS post_order
						ON ( post_order.customer_id = %d AND post_order.status IN ('completed','sub_active') )", get_current_user_id() );
					$post_feed_join_clauses[] = "LEFT JOIN {$wpdb->prefix}vx_order_items AS post_order_item
						ON ( post_order.id = post_order_item.order_id )";
					$post_feed_or_clauses[] = $wpdb->prepare( "(
						statuses.feed = 'post_reviews' AND posts.post_type IN ({$__post_type_in}) AND (
							posts.post_author = %d
							OR post_order_item.post_id = statuses.post_id
						)
					)", get_current_user_id() );
				}
			}

			if ( ! empty( $visibility['post_reviews']['private'] ) ) {
				$__post_type_in = "'".join( "','", array_map( 'esc_sql', $visibility['post_reviews']['private'] ) )."'";
				if ( ! is_user_logged_in() ) {
					$post_feed_or_clauses[] = sprintf( "(statuses.feed = 'post_reviews' AND posts.post_type IN ({$__post_type_in}) AND 1=0)" );
				} else {
					$post_feed_or_clauses[] = $wpdb->prepare( "(statuses.feed = 'post_reviews' AND posts.post_type IN ({$__post_type_in})
						AND posts.post_author = %d)", get_current_user_id() );
				}
			}

			if ( ! empty( $visibility['post_reviews']['public'] ) ) {
				$__post_type_in = "'".join( "','", array_map( 'esc_sql', $visibility['post_reviews']['public'] ) )."'";
				$post_feed_or_clauses[] = sprintf( "(statuses.feed = 'post_reviews' AND posts.post_type IN ({$__post_type_in}))" );
			}

			// construct final visibility rules query
			if ( ! empty( $post_feed_join_clauses ) || ! empty( $post_feed_or_clauses ) ) {
				$join_clauses[] = "LEFT JOIN {$wpdb->posts} AS posts ON statuses.post_id = posts.ID";
				array_push( $join_clauses, ...$post_feed_join_clauses );
				array_push( $visibility_or_clauses, ...$post_feed_or_clauses );
			}

			// append to main query
			if ( ! empty( $visibility_or_clauses ) ) {
				array_push( $where_clauses, '('.join( ' OR ', $visibility_or_clauses ).')' );
			}
		}

		if ( ! is_null( $args['order_by'] ) ) {
			$order = $args['order'] === 'asc' ? 'ASC' : 'DESC';

			if ( $args['order_by'] === 'created_at' ) {
				$orderby_clauses[] = "statuses.created_at {$order}";
			} elseif ( $args['order_by'] === 'like_count' ) {
				$orderby_clauses[] = "statuses.like_count {$order}";
			} elseif ( $args['order_by'] === 'reply_count' ) {
				$orderby_clauses[] = "statuses.reply_count {$order}";
			} elseif ( $args['order_by'] === 'interaction_count' ) {
				$select_clauses[] = "(statuses.like_count + statuses.reply_count) AS interaction_count";
				$orderby_clauses[] = "interaction_count {$order}";
			} elseif ( $args['order_by'] === 'rating' ) {
				$orderby_clauses[] = "statuses.review_score {$order}";
			}
		}

		if ( ! is_null( $args['created_at'] ) ) {
			$timestamp = strtotime( $args['created_at'] );
			if ( $timestamp ) {
				$where_clauses[] = $wpdb->prepare( "statuses.created_at >= %s", date( 'Y-m-d H:i:s', $timestamp ) );
			}
		}

		if ( $args['with_no_reposts'] ) {
			$where_clauses[] = 'statuses.repost_of IS NULL';
		}

		// generate sql string
		$joins = join( " \n ", array_unique( $join_clauses ) );
		$wheres = '';
		if ( ! empty( $where_clauses ) ) {
			$wheres = sprintf( 'WHERE %s', join( ' AND ', $where_clauses ) );
		}

		$orderbys = '';
		if ( ! empty( $orderby_clauses ) ) {
			$orderbys = sprintf( 'ORDER BY %s', join( ", ", $orderby_clauses ) );
		}

		$limit = '';
		if ( ! is_null( $args['limit'] ) ) {
			$limit = sprintf( 'LIMIT %d', absint( $args['limit'] ) );
		}

		$offset = '';
		if ( ! is_null( $args['offset'] ) ) {
			$offset = sprintf( 'OFFSET %d', absint( $args['offset'] ) );
		}

		$selects = join( ', ', $select_clauses );

		if ( $args['with_annotations'] ) {
			$sql = <<<SQL
				SELECT {$selects} FROM {$wpdb->prefix}voxel_timeline AS statuses
				{$joins} {$wheres}
				{$orderbys}
				{$limit} {$offset}
			SQL;

			$results = $wpdb->get_results( $sql, ARRAY_A );
			$count = count( $results );

			// dd_sql($sql);
			// dump($results);

			if ( ! is_array( $results ) ) {
				return [
					'items' => [],
					'count' => 0,
					'_total_count' => 0,
				];
			}

			$grouped_results = [];
			foreach ( $results as $result ) {
				if ( is_numeric( $result['repost_of'] ) ) {
					$grouped_results[ $result['repost_of'] ] = $result;
				} else {
					$grouped_results[ $result['id'] ] = $result;
				}
			}

			if ( ! empty( $grouped_results ) ) {
				$__result_id_in = join( ',', array_map( 'absint', array_keys( $grouped_results ) ) );

				if ( is_user_logged_in() ) {
					$friends_reposted_sql = $wpdb->prepare( <<<SQL
						WITH ranked_reposts AS (
							SELECT tl.repost_of, tl.user_id,
								ROW_NUMBER() OVER (
									PARTITION BY tl.repost_of
									-- ORDER BY tl.user_id
								) AS row_rank
							FROM {$wpdb->prefix}voxel_timeline tl
								JOIN (
									SELECT followers.object_id FROM {$wpdb->prefix}voxel_followers followers
									WHERE followers.follower_type = 'user'
										AND followers.follower_id = %d
										AND followers.object_type = 'user'
										AND followers.status = 1
									LIMIT 11
								) AS friends_reposted ON friends_reposted.object_id = tl.user_id
							WHERE tl.repost_of IN ({$__result_id_in})
						)
						SELECT repost_of, GROUP_CONCAT(DISTINCT user_id SEPARATOR ',') AS user_ids
						FROM ranked_reposts
						WHERE row_rank <= 11
						GROUP BY repost_of;
					SQL, get_current_user_id() );

					$friends_reposted = $wpdb->get_results( $friends_reposted_sql, ARRAY_A );
					foreach ( $friends_reposted as $details ) {
						if ( isset( $grouped_results[ $details['repost_of'] ] ) ) {
							$grouped_results[ $details['repost_of'] ]['friends_reposted'] = $details['user_ids'];
						}
					}

					$friends_liked_sql = $wpdb->prepare( <<<SQL
						WITH ranked_likes AS (
							SELECT likes.status_id, likes.user_id,
							ROW_NUMBER() OVER (
								PARTITION BY likes.status_id
								-- ORDER BY likes.user_id
							) AS row_rank
							FROM {$wpdb->prefix}voxel_timeline_status_likes likes
							JOIN (
								SELECT followers.object_id
								FROM {$wpdb->prefix}voxel_followers followers
								WHERE followers.follower_type = 'user'
									AND followers.follower_id = %d
									AND followers.object_type = 'user'
									AND followers.status = 1
								LIMIT 11
							) AS friends_liked ON friends_liked.object_id = likes.user_id
							WHERE likes.status_id IN ({$__result_id_in})
						)
						SELECT status_id, GROUP_CONCAT(user_id SEPARATOR ',') AS user_ids
						FROM ranked_likes
						WHERE row_rank <= 11
						GROUP BY status_id
					SQL, get_current_user_id() );

					$friends_liked = $wpdb->get_results( $friends_liked_sql, ARRAY_A );
					foreach ( $friends_liked as $details ) {
						if ( isset( $grouped_results[ $details['status_id'] ] ) ) {
							$grouped_results[ $details['status_id'] ]['friends_liked'] = $details['user_ids'];
						}
					}
				}

				$last3_liked_sql = <<<SQL
					SELECT statuses.id AS status_id, JSON_ARRAYAGG( JSON_OBJECT('user_id', l.user_id, 'post_id', l.post_id) ) AS last3_liked
					FROM {$wpdb->prefix}voxel_timeline statuses
					JOIN (
						SELECT l.status_id, l.user_id, l.post_id,
							ROW_NUMBER() OVER (
								PARTITION BY l.status_id
								ORDER BY l.id DESC
							) AS row_num
						FROM {$wpdb->prefix}voxel_timeline_status_likes l
						WHERE l.status_id IN ({$__result_id_in})
					) l ON l.status_id = statuses.id AND l.row_num <= 3
					GROUP BY statuses.id;
				SQL;

				$last3_liked = $wpdb->get_results( $last3_liked_sql, ARRAY_A );
				foreach ( $last3_liked as $details ) {
					if ( isset( $grouped_results[ $details['status_id'] ] ) ) {
						$grouped_results[ $details['status_id'] ]['last3_liked'] = $details['last3_liked'];
					}
				}

				// dd($last3_liked, $grouped_results);
			}

			$statuses = array_map( '\Voxel\Timeline\Status::get', array_values( $grouped_results ) );

			return [
				'items' => $statuses,
				'count' => $count,
				'_total_count' => 0,
			];
		} else {
			$sql = <<<SQL
				SELECT {$selects} FROM {$wpdb->prefix}voxel_timeline AS statuses
				{$joins} {$wheres}
				{$orderbys}
				{$limit} {$offset}
			SQL;

			$results = $wpdb->get_results( $sql, ARRAY_A );
			$count = count( $results );

			if ( ! is_array( $results ) ) {
				return [
					'items' => [],
					'count' => 0,
					'_total_count' => 0,
				];
			}

			$grouped_results = [];
			foreach ( $results as $result ) {
				$grouped_results[ $result['id'] ] = $result;
			}

			if ( ! empty( $grouped_results ) ) {
				$__result_id_in = join( ',', array_map( 'absint', array_keys( $grouped_results ) ) );

				$last3_liked_sql = <<<SQL
					SELECT statuses.id AS status_id, JSON_ARRAYAGG( JSON_OBJECT('user_id', l.user_id, 'post_id', l.post_id) ) AS last3_liked
					FROM {$wpdb->prefix}voxel_timeline statuses
					JOIN (
						SELECT l.status_id, l.user_id, l.post_id,
							ROW_NUMBER() OVER (
								PARTITION BY l.status_id
								ORDER BY l.id DESC
							) AS row_num
						FROM {$wpdb->prefix}voxel_timeline_status_likes l
						WHERE l.status_id IN ({$__result_id_in})
					) l ON l.status_id = statuses.id AND l.row_num <= 3
					GROUP BY statuses.id;
				SQL;

				$last3_liked = $wpdb->get_results( $last3_liked_sql, ARRAY_A );

				foreach ( $last3_liked as $details ) {
					if ( isset( $grouped_results[ $details['status_id'] ] ) ) {
						$grouped_results[ $details['status_id'] ]['last3_liked'] = $details['last3_liked'];
					}
				}
			}

			$statuses = array_map( '\Voxel\Timeline\Status::get', array_values( $grouped_results ) );

			$_total_count = null;
			if ( $args['_get_total_count'] ) {
				$_total_count = absint( $wpdb->get_var( <<<SQL
					SELECT COUNT(*) FROM {$wpdb->prefix}voxel_timeline AS statuses
					{$joins} {$wheres}
					{$orderbys}
					{$limit} {$offset}
				SQL ) );
			}

			return [
				'items' => $statuses,
				'count' => $count,
				'_total_count' => $_total_count,
			];
		}
	}
}