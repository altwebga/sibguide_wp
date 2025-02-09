<?php

namespace Voxel\Post_Types\Fields;

use \Voxel\Form_Models;
use \Voxel\Dynamic_Data\Tag as Tag;

if ( ! defined('ABSPATH') ) {
	exit;
}

class Email_Field extends Base_Post_Field {

	protected $supported_conditions = ['text'];

	protected $props = [
		'type' => 'email',
		'label' => 'Email',
		'placeholder' => '',
	];

	public function get_models(): array {
		return [
			'label' => $this->get_label_model(),
			'key' => $this->get_key_model(),
			'placeholder' => $this->get_placeholder_model(),
			'description' => $this->get_description_model(),
			'required' => $this->get_required_model(),
			'css_class' => $this->get_css_class_model(),
		];
	}

	public function sanitize( $value ) {
		return sanitize_email( $value );
	}

	public function validate( $value ): void {
		$this->validate_email( $value );
	}

	public function update( $value ): void {
		if ( $this->is_empty( $value ) ) {
			delete_post_meta( $this->post->get_id(), $this->get_key() );
		} else {
			update_post_meta( $this->post->get_id(), $this->get_key(), $value );
		}
	}

	public function get_value_from_post() {
		return get_post_meta( $this->post->get_id(), $this->get_key(), true );
	}

	protected function frontend_props() {
		return [
			'placeholder' => $this->props['placeholder'] ?: $this->props['label'],
		];
	}

	public function dynamic_data() {
		return Tag::Email( $this->get_label() )->render( function() {
			return $this->get_value();
		} );
	}

	public function export_to_personal_data() {
		return $this->get_value();
	}
}
