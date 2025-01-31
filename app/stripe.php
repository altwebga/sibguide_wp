<?php

namespace Voxel;

if ( ! defined('ABSPATH') ) {
	exit;
}

class CloudPayments {

	private static $liveClient, $testClient;

	const API_VERSION = '2024-04-10';

	const WEBHOOK_EVENTS = [
		'customer.subscription.created',
		'customer.subscription.updated',
		'customer.subscription.deleted',
		'checkout.session.completed',
		'checkout.session.async_payment_succeeded',
		'checkout.session.async_payment_failed',
		'payment_intent.amount_capturable_updated',
		'payment_intent.canceled',
		'payment_intent.succeeded',
		'charge.captured',
		'charge.refunded',
		'charge.refund.updated',
	];

	const CONNECT_WEBHOOK_EVENTS = [
		'account.updated',
	];

	public static function is_test_mode() {
		return ( !! \Voxel\get( 'settings.cloudpayments.test_mode', true ) ) === true;
	}

	public static function getClient() {
		return static::is_test_mode()
			? static::getTestClient()
			: static::getLiveClient();
	}

	public static function getLiveClient() {
		if ( is_null( static::$liveClient ) ) {
			require_once locate_template( 'app/vendor/cloudpayments/init.php' );

			\Voxel\Vendor\CloudPayments\CloudPayments::setApiKey( \Voxel\get( 'settings.cloudpayments.secret', '' ) );
			\Voxel\Vendor\CloudPayments\CloudPayments::setApiVersion( static::API_VERSION );
			static::$liveClient = new \Voxel\Vendor\CloudPayments\CloudPaymentsClient( [
				'api_key' => \Voxel\get( 'settings.cloudpayments.secret', '' ),
				'cloudpayments_version' => static::API_VERSION,
			] );
		}

		return static::$liveClient;
	}

	public static function getTestClient() {
		if ( is_null( static::$testClient ) ) {
			require_once locate_template( 'app/vendor/cloudpayments/init.php' );

			\Voxel\Vendor\CloudPayments\CloudPayments::setApiKey( \Voxel\get( 'settings.cloudpayments.test_secret', '' ) );
			\Voxel\Vendor\CloudPayments\CloudPayments::setApiVersion( static::API_VERSION );
			static::$testClient = new \Voxel\Vendor\CloudPayments\CloudPaymentsClient( [
				'api_key' => \Voxel\get( 'settings.cloudpayments.test_secret', '' ),
				'cloudpayments_version' => static::API_VERSION,
			] );
		}

		return static::$testClient;
	}

	public static function base_dashboard_url( $path = '' ) {
		$url = 'https://dashboard.cloudpayments.com/';
		$path = ltrim( $path, "/\\" );
		return $url.$path;
	}

	public static function dashboard_url( $path = '' ) {
		$url = static::base_dashboard_url();
		if ( static::is_test_mode() ) {
			$url .= 'test/';
		}

		$path = ltrim( $path, "/\\" );
		return $url.$path;
	}

	public static function get_portal_configuration_id() {
		return \Voxel\CloudPayments::is_test_mode()
			? \Voxel\get( 'settings.cloudpayments.portal.test_config_id' )
			: \Voxel\get( 'settings.cloudpayments.portal.live_config_id' );
	}

	// @link https://docs.cloudpayments.com/payments/checkout/taxes?tax-calculation=tax-rates#dynamic-tax-rates
	public static function get_supported_countries_for_dynamic_tax_rates(): array {
		return [
			'US', 'GB', 'AU', 'AT', 'BE', 'BG', 'HR', 'CY', 'CZ', 'DK',
			'EE', 'FI', 'FR', 'DE', 'GR', 'HU', 'IE', 'IT', 'LV', 'LT',
			'LU', 'MT', 'NL', 'PL', 'PT', 'RO', 'SK', 'SI', 'ES', 'SE',
		];
	}
}
