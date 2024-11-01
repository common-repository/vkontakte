<?php

class Vkontakte_Frontend_Shortcodes {
	/**
	 * @var Vkontakte_Settings
	 */
	protected $settings;

	/**
	 * @param Vkontakte_Settings $settings
	 */
	public function __construct( $settings ) {
		$this->settings = $settings;

		add_shortcode( Vkontakte_Frontend_Shortcode_Group::get_code(), array( $this, 'get_group_html' ) );
		add_shortcode( Vkontakte_Frontend_Shortcode_Poll::get_code(), array( $this, 'get_poll_html' ) );
		add_shortcode( Vkontakte_Frontend_Shortcode_Recommendations::get_code(), array( $this, 'get_recommendations_html' ) );
	}

	/**
	 * @param array $attrs
	 *
	 * @return string
	 */
	public function get_group_html( $attrs ) {
		if ( ! $this->settings->is_api_ready() ) {
			return '';
		}

		return Vkontakte_Frontend_Shortcode_Group::create( $attrs )->to_html();
	}

	/**
	 * @param array $attrs
	 *
	 * @return string
	 */
	public function get_poll_html( $attrs ) {
		if ( ! $this->settings->is_api_ready() ) {
			return '';
		}

		return Vkontakte_Frontend_Shortcode_Poll::create( $attrs )->to_html();
	}

	/**
	 * @param array $attrs
	 *
	 * @return string
	 */
	public function get_recommendations_html( $attrs ) {
		if ( ! $this->settings->is_api_ready() ) {
			return '';
		}

		return Vkontakte_Frontend_Shortcode_Recommendations::create( $attrs )->to_html();
	}
}
