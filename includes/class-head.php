<?php

abstract class Vkontakte_Head {
	/**
	 * @var Vkontakte_Settings
	 */
	protected $settings;

	/**
	 * @param Vkontakte_Settings $settings
	 */
	public function __construct( $settings ) {
		$this->settings = $settings;

		$this->add_actions();
	}

	protected function add_action( $callback ) {
		add_action( 'wp_head', $callback );
	}

	protected function add_actions() {
		if ( $this->settings->is_api_ready() ) {
			$this->add_action( array( $this, 'output_vk_app_init_script' ) );
		}
	}

	public function output_vk_app_init_script() {
		$app_id = $this->settings->get_app_id();

		require __DIR__ . '/view/head/vk-app-init-script.php';
	}
}
