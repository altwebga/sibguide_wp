<?php

namespace Voxel\Product_Types\Payment_Methods;

if ( ! defined('ABSPATH') ) {
	exit;
}

class CloudPayments_Transfer_Platform extends Base_Payment_Method {

	public function get_type(): string {
		return 'cloudpayments_transfer_platform';
	}

	public function get_label(): string {
		return _x( 'CloudPayments platform transfer', 'payment methods', 'voxel' );
	}

	public function process_payment() {
		throw new \Exception( 'This payment method cannot be used in checkout' );
	}

	public function should_sync(): bool {
		return false;
	}

	public function sync(): void {
		//
	}

	public function get_customer_details(): array {
		$parent_order = $this->order->get_parent_order();
		if ( ! $parent_order ) {
			return [];
		}

		$payment_method = $parent_order->get_payment_method();
		if ( $payment_method === null || $payment_method->get_type() !== 'cloudpayments_payment' ) {
			return [];
		}

		return $payment_method->get_customer_details();
	}

	public function get_shipping_details(): array {
		$parent_order = $this->order->get_parent_order();
		if ( ! $parent_order ) {
			return [];
		}

		$payment_method = $parent_order->get_payment_method();
		if ( $payment_method === null || $payment_method->get_type() !== 'cloudpayments_payment' ) {
			return [];
		}

		return $payment_method->get_shipping_details();
	}
}
