<?php

abstract class Vkontakte_Api_Widget {
	/**
	 * @return array
	 */
	public static function get_attributes() {
		return array();
	}

	/**
	 * @return string
	 */
	protected abstract function get_template_path();

	/**
	 * @return array
	 */
	protected abstract function get_placeholders();

	/**
	 * @return array
	 */
	protected abstract function get_values();

	/**
	 * @return string
	 */
	public function to_html() {
		$html = file_get_contents( $this->get_template_path() );

		$placeholders = $this->get_placeholders();

		if ( count( $placeholders ) > 0 ) {
			$html = str_replace( $placeholders, $this->get_values(), $html );
		}

		return $html;
	}

	/**
	 * @param string|mixed $value
	 * @param string $default
	 *
	 * @return string
	 */
	protected function get_non_empty_string( $value, $default = null ) {
		if ( is_string( $value ) ) {
			$value = trim( $value );
		}

		return ! empty( $value ) ? (string) $value : $default;
	}

	/**
	 * @param string|mixed $value
	 * @param string $default
	 *
	 * @return string
	 */
	protected function get_int( $value, $default = null ) {
		if ( is_string( $value ) ) {
			$value = trim( $value );
		}

		return is_numeric( $value ) ? (int) ( $value ) : $default;
	}

	/**
	 * @param mixed $value
	 * @param array $list
	 * @param mixed $default
	 *
	 * @return mixed
	 */
	protected function get_value_from_allowed_list( $value, $list, $default = '' ) {
		if ( is_string( $value ) ) {
			$value = trim( $value );
		}

		return ( ! empty( $value ) && in_array( $value, $list, true ) ) ? $value : $default;
	}

	/**
	 * @param mixed $value
	 * @param bool $default
	 *
	 * @return bool
	 */
	protected function get_boolean_value( $value, $default = false ) {
		return (bool) $this->get_value_from_allowed_list( $value, [ 0, 1, '0', '1', false, true ], $default );
	}
}
