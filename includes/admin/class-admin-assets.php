<?php

class Vkontakte_Admin_Assets extends Vkontakte_Assets {
	const STYLES = 'vkontakte-admin-styles';
	const SCRIPTS = 'vkontakte-admin-scripts';

	/**
	 * @inerhitDoc
	 */
	public function __construct( $settings ) {
		parent::__construct( $settings );

		$this->register_style( $this->url( 'css/admin.css' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}
}
