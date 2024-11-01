<?php

class Vkontakte_Frontend_Shortcode_Poll extends Vkontakte_Frontend_Shortcode_Abstract {
	const ID = Vkontakte_Api_Widget_Poll::ATTR_ID;
	const ELEMENT_ID = Vkontakte_Api_Widget_Poll::ATTR_ELEMENT_ID;
	const WIDTH = Vkontakte_Api_Widget_Poll::ATTR_WIDTH;
	const PAGE_URL = Vkontakte_Api_Widget_Poll::ATTR_PAGE_URL;

	/**
	 * @inerhitDoc
	 */
	public static function get_code() {
		return 'vkpoll';
	}

	/**
	 * @inerhitDoc
	 */
	public static function get_attributes() {
		$attributes = Vkontakte_Api_Widget_Poll::get_attributes();

		$attributes[ self::WIDTH ]['description'] = sprintf(
			__( '%s <b>%s</b> by default.', 'vkontakte' ),
			$attributes[ self::WIDTH ]['description'],
			0
		);

		$attributes[ self::PAGE_URL ]['description'] = sprintf(
			__( '%s Empty by default.', 'vkontakte' ),
			$attributes[ self::PAGE_URL ]['description']
		);

		return $attributes;
	}

	/**
	 * @inerhitDoc
	 */
	public function to_html() {
		$poll_id    = $this->get_non_empty_attr( self::ID );
		$element_id = $this->get_non_empty_attr( self::ELEMENT_ID, 'vkontakte-shortcode-poll-' . $poll_id );

		$widget = new Vkontakte_Api_Widget_Poll( $poll_id, $element_id );

		$width    = $this->get_non_empty_attr( self::WIDTH );
		$page_url = $this->get_non_empty_attr( self::PAGE_URL );

		if ( $width ) {
			$widget->set_width( $width );
		}

		if ( $page_url ) {
			$widget->set_page_url( $page_url );
		}

		return $widget->to_html();
	}
}
