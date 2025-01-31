<?php

namespace Voxel\Post_Types\Fields\Taxonomy_Field;
use \Voxel\Dynamic_Data\Tag as Tag;

if ( ! defined('ABSPATH') ) {
	exit;
}

trait Exports {

	public function dynamic_data() {
		return Tag::Object_List( $this->get_label() )->items( function() {
			return (array) $this->get_value();
		} )->properties( function( $index, $item ) {
			return [
				'id' => Tag::Number('Term ID')->render( function() use ( $item ) {
					return $item ? $item->get_id() : null;
				} ),
				'name' => Tag::String('Term name')->render( function() use ( $item ) {
					return $item ? $item->get_label() : null;
				} ),
				'slug' => Tag::String('Term slug')->render( function() use ( $item ) {
					return $item ? $item->get_slug() : null;
				} ),
				'description' => Tag::String('Term description')->render( function() use ( $item ) {
					return $item ? $item->get_description() : null;
				} ),
				'link' => Tag::URL('Term link')->render( function() use ( $item ) {
					return $item ? $item->get_link() : null;
				} ),
				'icon' => Tag::String('Term icon')->render( function() use ( $item ) {
					return $item ? $item->get_icon() : null;
				} ),
				'image' => Tag::Number('Term image')->render( function() use ( $item ) {
					return $item ? $item->get_image_id() : null;
				} ),
			];
		} );
	}
}
