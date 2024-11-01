<?php

abstract class Vkontakte_Frontend_Shortcode_Abstract {
	const BOOLEAN_DISABLED = 0;
	const BOOLEAN_ENABLED = 1;

	/**
	 * @var array
	 */
	protected $attrs;

	/**
	 * @param array $attrs
	 */
	protected function __construct( $attrs ) {
		$this->attrs = (array) $attrs;
	}

	/**
	 * @param $attrs
	 *
	 * @return $this
	 */
	public static function create( $attrs ) {
		return new static( $attrs );
	}

	/**
	 * @return string
	 */
	public static function get_code() {
		throw new Exception( 'Method "get_code" should be implemented' );
	}

	/**
	 * @return array
	 */
	public static function get_attributes() {
		return array();
	}

	/**
	 * @return array
	 */
	public static function get_boolean_labels() {
		return array(
			__( 'disabled', 'vkontakte' ),
			__( 'enabled', 'vkontakte' ),
		);
	}

	/**
	 * @param array $options
	 *
	 * @return string
	 */
	public static function stringify_options( $options ) {
		$options_strings = array();

		foreach ( $options as $value => $label ) {
			$options_strings[] = sprintf( '<b>%s</b> - %s', $value, $label );
		}

		return implode( ', ', $options_strings );
	}

	/**
	 * @return string
	 */
	public abstract function to_html();

	/**
	 * @param string $name
	 * @param mixed $default
	 *
	 * @return mixed|null
	 */
	protected function get_attr( $name, $default = null ) {
		return isset( $this->attrs[ $name ] ) ? $this->attrs[ $name ] : $default;
	}

	/**
	 * @param string $name
	 * @param mixed $default
	 *
	 * @return mixed|null
	 */
	protected function get_non_empty_attr( $name, $default = null ) {
		return ! empty( $this->attrs[ $name ] ) ? $this->attrs[ $name ] : $default;
	}
}
