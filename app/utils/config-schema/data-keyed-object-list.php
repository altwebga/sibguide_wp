<?php

namespace Voxel\Utils\Config_Schema;

if ( ! defined('ABSPATH') ) {
	exit;
}

class Data_Keyed_Object_List extends Base_Data_Type {

	protected
		$props,
		$custom_validator,
		$custom_transformer;

	public function __construct( array $props ) {
		$this->props = $props;
	}

	public function set_value( $value ) {
		if ( ! is_array( $value ) ) {
			return;
		}

		$valid_values = [];
		foreach ( $value as $key => $item ) {
			if ( $this->custom_validator !== null && ! ($this->custom_validator)( $item, $key ) ) {
				continue;
			}

			if ( $this->custom_transformer !== null ) {
				list( $item, $key ) = ($this->custom_transformer)( $item, $key );
			}

			$object = Data_Object::new( array_map( function( $prop ) {
				return clone $prop;
			}, $this->props ) );

			$object->set_value( $item );
			$valid_values[ $key ] = $object;
		}

		$this->value = $valid_values;
	}

	public function validator( $cb ): self {
		$this->custom_validator = $cb;
		return $this;
	}

	public function transformer( $cb ): self {
		$this->custom_transformer = $cb;
		return $this;
	}

	public function export() {
		if ( $this->value === null ) {
			return $this->get_default_value();
		}

		return array_map( function( $data ) {
			return $data->export();
		}, $this->value );
	}

	public function __clone() {
		foreach ( $this->props as $key => $prop ) {
			$this->props[ $key ] = clone $prop;
		}
	}
}
