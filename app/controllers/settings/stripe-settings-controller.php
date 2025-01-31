<?php

namespace Voxel\Controllers\Settings;

use Voxel\Utils\Config_Schema\Schema as Schema;

if ( ! defined('ABSPATH') ) {
	exit;
}

class CloudPayments_Settings_Controller extends \Voxel\Controllers\Base_Controller {

	protected function hooks() {
		$this->filter( 'voxel/global-settings/register', '@register_settings' );
		$this->on( 'voxel/global-settings/saved', '@settings_updated', 10, 2 );
	}

	protected function register_settings( $settings ) {
		$settings['cloudpayments'] = Schema::Object( [
			'test_mode' => Schema::Bool()->default(true),
			'key' => Schema::String(),
			'secret' => Schema::String(),
			'test_key' => Schema::String(),
			'test_secret' => Schema::String(),
			'currency' => Schema::String(),

			'portal' => Schema::Object( [
				'invoice_history' => Schema::Bool()->default(true),
				'customer_update' => Schema::Object( [
					'enabled' => Schema::Bool()->default(true),
					'allowed_updates' => Schema::List()
						->allowed_values( [
							'email',
							'address',
							'phone',
							'shipping',
							'tax_id',
						] )
						->default( [ 'email', 'address', 'phone' ] ),
				] ),
				'live_config_id' => Schema::String(),
				'test_config_id' => Schema::String(),
			] ),

			'webhooks' => Schema::Object( [
				'live' => Schema::Object( [
					'id' => Schema::String(),
					'secret' => Schema::String(),
				] ),
				'live_connect' => Schema::Object( [
					'id' => Schema::String(),
					'secret' => Schema::String(),
				] ),
				'test' => Schema::Object( [
					'id' => Schema::String(),
					'secret' => Schema::String(),
				] ),
				'test_connect' => Schema::Object( [
					'id' => Schema::String(),
					'secret' => Schema::String(),
				] ),
				'local' => Schema::Object( [
					'enabled' => Schema::Bool()->default(false),
					'secret' => Schema::String(),
				] ),
			] ),
		] );

		return $settings;
	}

	protected function settings_updated( $config, $previous_config ) {
		// if customer portal settings have changed, update configuration (or create new if it doesn't exist)
		if ( \Voxel\get( 'settings.cloudpayments.secret' ) ) {
			if ( empty( \Voxel\get( 'settings.cloudpayments.portal.live_config_id' ) ) ) {
				// \Voxel\log( 'create_live_customer_portal' );
				$this->create_live_customer_portal();
			} elseif ( ( $previous_config['cloudpayments']['portal'] ?? [] ) !== \Voxel\get( 'settings.cloudpayments.portal', [] ) ) {
				// \Voxel\log( 'update_live_customer_portal' );
				$this->update_live_customer_portal();
			}
		}

		if ( \Voxel\get( 'settings.cloudpayments.test_secret' ) ) {
			if ( empty( \Voxel\get( 'settings.cloudpayments.portal.test_config_id' ) ) ) {
				// \Voxel\log( 'create_test_customer_portal' );
				$this->create_test_customer_portal();
			} elseif ( ( $previous_config['cloudpayments']['portal'] ?? [] ) !== \Voxel\get( 'settings.cloudpayments.portal', [] ) ) {
				// \Voxel\log( 'update_test_customer_portal' );
				$this->update_test_customer_portal();
			}
		}

		if ( ! empty( \Voxel\get( 'settings.cloudpayments.secret' ) ) && empty( \Voxel\get( 'settings.cloudpayments.webhooks.live.id' ) ) ) {
			// \Voxel\log( 'create_live_webhook_endpoint' );
			$this->create_live_webhook_endpoint();
		}

		if ( ! empty( \Voxel\get( 'settings.cloudpayments.secret' ) ) && empty( \Voxel\get( 'settings.cloudpayments.webhooks.live_connect.id' ) ) ) {
			// \Voxel\log( 'create_live_connect_webhook_endpoint' );
			$this->create_live_connect_webhook_endpoint();
		}

		if ( ! empty( \Voxel\get( 'settings.cloudpayments.test_secret' ) ) && empty( \Voxel\get( 'settings.cloudpayments.webhooks.test.id' ) ) ) {
			// \Voxel\log( 'create_test_webhook_endpoint' );
			$this->create_test_webhook_endpoint();
		}

		if ( ! empty( \Voxel\get( 'settings.cloudpayments.test_secret' ) ) && empty( \Voxel\get( 'settings.cloudpayments.webhooks.test_connect.id' ) ) ) {
			// \Voxel\log( 'create_test_connect_webhook_endpoint' );
			$this->create_test_connect_webhook_endpoint();
		}
	}

	protected function create_live_webhook_endpoint() {
		try {
			$cloudpayments = \Voxel\CloudPayments::getLiveClient();
			$endpoint = $cloudpayments->webhookEndpoints->create( [
				'url' => home_url( '/?vx=1&action=cloudpayments.webhooks' ),
				'enabled_events' => \Voxel\CloudPayments::WEBHOOK_EVENTS,
			] );

			\Voxel\set( 'settings.cloudpayments.webhooks.live', [
				'id' => $endpoint->id,
				'secret' => $endpoint->secret,
			] );
		} catch ( \Exception $e ) {
			\Voxel\log( $e );
		}
	}

	protected function create_test_webhook_endpoint() {
		try {
			$cloudpayments = \Voxel\CloudPayments::getTestClient();
			$endpoint = $cloudpayments->webhookEndpoints->create( [
				'url' => home_url( '/?vx=1&action=cloudpayments.webhooks' ),
				'enabled_events' => \Voxel\CloudPayments::WEBHOOK_EVENTS,
			] );

			\Voxel\set( 'settings.cloudpayments.webhooks.test', [
				'id' => $endpoint->id,
				'secret' => $endpoint->secret,
			] );
		} catch ( \Exception $e ) {
			\Voxel\log( $e );
		}
	}

	protected function create_live_connect_webhook_endpoint() {
		try {
			$cloudpayments = \Voxel\CloudPayments::getLiveClient();
			$endpoint = $cloudpayments->webhookEndpoints->create( [
				'url' => home_url( '/?vx=1&action=cloudpayments.connect_webhooks' ),
				'connect' => true,
				'enabled_events' => \Voxel\CloudPayments::CONNECT_WEBHOOK_EVENTS,
			] );

			\Voxel\set( 'settings.cloudpayments.webhooks.live_connect', [
				'id' => $endpoint->id,
				'secret' => $endpoint->secret,
			] );
		} catch ( \Exception $e ) {
			\Voxel\log( $e );
		}
	}

	protected function create_test_connect_webhook_endpoint() {
		try {
			$cloudpayments = \Voxel\CloudPayments::getTestClient();
			$endpoint = $cloudpayments->webhookEndpoints->create( [
				'url' => home_url( '/?vx=1&action=cloudpayments.connect_webhooks' ),
				'connect' => true,
				'enabled_events' => \Voxel\CloudPayments::CONNECT_WEBHOOK_EVENTS,
			] );

			\Voxel\set( 'settings.cloudpayments.webhooks.test_connect', [
				'id' => $endpoint->id,
				'secret' => $endpoint->secret,
			] );
		} catch ( \Exception $e ) {
			\Voxel\log( $e );
		}
	}

	protected function create_live_customer_portal() {
		try {
			$cloudpayments = \Voxel\CloudPayments::getLiveClient();
			$configuration = $cloudpayments->billingPortal->configurations->create( $this->_get_portal_config() );
			\Voxel\set( 'settings.cloudpayments.portal.live_config_id', $configuration->id );
		} catch ( \Exception $e ) {
			\Voxel\log( $e );
		}
	}

	protected function update_live_customer_portal() {
		try {
			$cloudpayments = \Voxel\CloudPayments::getLiveClient();
			$configuration_id = \Voxel\get( 'settings.cloudpayments.portal.live_config_id' );
			$cloudpayments->billingPortal->configurations->update( $configuration_id, $this->_get_portal_config() );
		} catch ( \Exception $e ) {
			\Voxel\log( $e );
		}
	}

	protected function create_test_customer_portal() {
		try {
			$cloudpayments = \Voxel\CloudPayments::getTestClient();
			$configuration = $cloudpayments->billingPortal->configurations->create( $this->_get_portal_config() );
			\Voxel\set( 'settings.cloudpayments.portal.test_config_id', $configuration->id );
		} catch ( \Exception $e ) {
			\Voxel\log( $e );
		}
	}

	protected function update_test_customer_portal() {
		try {
			$cloudpayments = \Voxel\CloudPayments::getTestClient();
			$configuration_id = \Voxel\get( 'settings.cloudpayments.portal.test_config_id' );
			$cloudpayments->billingPortal->configurations->update( $configuration_id, $this->_get_portal_config() );
		} catch ( \Exception $e ) {
			\Voxel\log( $e );
		}
	}

	protected function _get_portal_config() {
		$portal = \Voxel\get( 'settings.cloudpayments.portal', [] );
		return [
			'business_profile' => [
				'headline' => get_bloginfo( 'name' ),
				'privacy_policy_url' => get_permalink( \Voxel\get( 'templates.privacy_policy' ) ) ?: home_url('/'),
				'terms_of_service_url' => get_permalink( \Voxel\get( 'templates.terms' ) ) ?: home_url('/'),
			],
			'features' => [
				'payment_method_update' => [ 'enabled' => true ],
				'customer_update' => [
					'allowed_updates' => $portal['customer_update']['allowed_updates'] ?? [ 'email', 'address', 'phone' ],
					'enabled' => $portal['customer_update']['enabled'] ?? true,
				],
				'invoice_history' => [ 'enabled' => $portal['invoice_history'] ?? true ],
			],
		];
	}
}
