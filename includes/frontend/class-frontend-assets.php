<?php

class Vkontakte_Frontend_Assets extends Vkontakte_Assets {
	const STYLES = 'vkontakte-frontend-styles';

	/**
	 * @inerhitDoc
	 */
	public function __construct( $settings ) {
		parent::__construct( $settings );

		if ( $this->settings->is_api_ready() ) {
			$this->add_script_handle( static::VK_OPENAPI_SCRIPTS );
		}

		$this->register_style( $this->url( 'css/vkontakte.css' ) );

		add_action( 'init', array( $this, 'enqueue_styles' ) );
		add_action( 'init', array( $this, 'enqueue_scripts' ) );
	}
}
