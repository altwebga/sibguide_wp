<?php

namespace Voxel\Post_Types\Fields;

use \Voxel\Form_Models;
use \Voxel\Dynamic_Data\Tag as Tag;

if ( ! defined('ABSPATH') ) {
	exit;
}

class Switcher_Field extends Base_Post_Field {

	protected $supported_conditions = ['switcher'];

	protected $props = [
		'type' => 'switcher',
		'label' => 'Switcher',
	];

	public function get_models(): array {
		return [
			'label' => $this->get_model( 'label', [ 'classes' => 'x-col-6' ]),
			'key' => $this->get_model( 'key', [ 'classes' => 'x-col-6' ]),
			'description' => $this->get_description_model(),
			'required' => $this->get_required_model(),
			'css_class' => $this->get_css_class_model(),
		];
	}

	public function sanitize( $value ) {
		return !! $value;
	}

	public function update( $value ): void {
		if ( ! $value ) {
			delete_post_meta( $this->post->get_id(), $this->get_key() );
		} else {
			update_post_meta( $this->post->get_id(), $this->get_key(), true );
		}
	}

	public function get_value_from_post() {
		return !! get_post_meta( $this->post->get_id(), $this->get_key(), true );
	}

	public function dynamic_data() {
		return Tag::Bool( $this->get_label() )->render( function() {
			return $this->get_value() ? '1' : '';
		} );
	}

	public function export_to_personal_data() {
		return $this->get_value() ? 'Yes' : 'No';
	}
}
