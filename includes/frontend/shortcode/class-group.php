<?php

class Vkontakte_Frontend_Shortcode_Group extends Vkontakte_Frontend_Shortcode_Abstract {
	const ID = Vkontakte_Api_Widget_Group::ATTR_ID;
	const ELEMENT_ID = Vkontakte_Api_Widget_Group::ATTR_ELEMENT_ID;
	const MODE = Vkontakte_Api_Widget_Group::ATTR_MODE;
	const COVER = Vkontakte_Api_Widget_Group::ATTR_COVER;
	const WIDE = Vkontakte_Api_Widget_Group::ATTR_WIDE;
	const WIDTH = Vkontakte_Api_Widget_Group::ATTR_WIDTH;
	const HEIGHT = Vkontakte_Api_Widget_Group::ATTR_HEIGHT;

	/**
	 * @inerhitDoc
	 */
	public static function get_code() {
		return 'vkgroup';
	}

	/**
	 * @inerhitDoc
	 */
	public static function get_attributes() {
		$attributes = Vkontakte_Api_Widget_Group::get_attributes();

		$mode_options    = self::stringify_options( Vkontakte_Api_Widget_Group::get_mode_labels() );
		$boolean_options = self::stringify_options( self::get_boolean_labels() );

		$attributes[ self::MODE ]['description'] = sprintf(
			__( '%s <b>%s</b> by default, available options: %s.', 'vkontakte' ),
			$attributes[ self::MODE ]['description'],
			Vkontakte_Api_Widget_Group::DEFAULT_MODE,
			$mode_options
		);

		$attributes[ self::WIDTH ]['description'] = sprintf(
			__( '%s <b>%s</b> by default.', 'vkontakte' ),
			$attributes[ self::WIDTH ]['description'],
			0
		);

		$attributes[ self::HEIGHT ]['description'] = sprintf(
			__( '%s <b>%s</b> by default.', 'vkontakte' ),
			$attributes[ self::HEIGHT ]['description'],
			0
		);

		$attributes[ self::COVER ]['description'] = sprintf(
			__( '%s <b>%s</b> by default, available options: %s.', 'vkontakte' ),
			$attributes[ self::COVER ]['description'],
			self::BOOLEAN_DISABLED,
			$boolean_options
		);

		$attributes[ self::WIDE ]['description'] = sprintf(
			__( '%s <b>%s</b> by default, available options: %s.', 'vkontakte' ),
			$attributes[ self::WIDE ]['description'],
			self::BOOLEAN_DISABLED,
			$boolean_options
		);

		return $attributes;
	}

	/**
	 * @inerhitDoc
	 */
	public function to_html() {
		$group_id   = $this->get_non_empty_attr( self::ID );
		$element_id = $this->get_non_empty_attr( self::ELEMENT_ID, 'vkontakte-shortcode-group-' . $group_id );
		$mode       = $this->get_non_empty_attr( self::MODE, Vkontakte_Api_Widget_Group::MODE_NAME );
		$cover      = $this->get_attr( self::COVER, false );
		$wide       = $this->get_attr( self::WIDE, false );

		$widget = new Vkontakte_Api_Widget_Group( $group_id, $element_id, $mode, $cover, $wide );

		$width  = $this->get_non_empty_attr( self::WIDTH );
		$height = $this->get_non_empty_attr( self::HEIGHT );

		if ( $width ) {
			$widget->set_width( $width );
		}

		if ( $height ) {
			$widget->set_height( $height );
		}

		return $widget->to_html();
	}
}
