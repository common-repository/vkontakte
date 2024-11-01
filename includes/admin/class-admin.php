<?php

class Vkontakte_Admin {
	/**
	 * @var Vkontakte_Settings
	 */
	private $settings;

	/**
	 * @var Vkontakte_Admin_Assets
	 */
	private $assets;

	/**
	 * @var Vkontakte_Admin_Head
	 */
	private $head;

	/**
	 * @var Vkontakte_Admin_Menus
	 */
	private $menus;

	/**
	 * @param Vkontakte_Settings $settings
	 */
	public function __construct( $settings ) {
		$this->settings = $settings;

		add_action( 'init', array( $this, 'init' ) );
		add_action( 'load-options.php', array( 'Vkontakte_Admin_Settings_Page', 'register_settings' ) );
	}

	public function init() {
		$this->head   = new Vkontakte_Admin_Head( $this->settings );
		$this->assets = new Vkontakte_Admin_Assets( $this->settings );
		$this->menus  = new Vkontakte_Admin_Menus( $this->assets, $this->head, $this->settings->is_api_ready() );
//		require_once __DIR__ . '/class-admin-ajax-handler.php';
	}

	/**
	 * @return Vkontakte_Admin_Assets
	 */
	public function get_assets() {
		return $this->assets;
	}

	/**
	 * @return Vkontakte_Head
	 */
	public function get_head() {
		return $this->head;
	}

	/**
	 * @return Vkontakte_Admin_Menus
	 */
	public function get_menus() {
		return $this->menus;
	}

	/**
	 * @param string $message
	 * @param string|null $redirect_url
	 * @param string $type
	 *
	 * @return void
	 */
	public static function add_settings_message( $message, $redirect_url = null, $type = 'success' ) {
		add_settings_error(
			'vkontakte_settings',
			'vkontakte',
			$message,
			$type
		);
		set_transient( 'settings_errors', get_settings_errors(), 30 );

		if ( $redirect_url ) {
			wp_safe_redirect( $redirect_url . '&settings-updated=true' );

			exit;
		}
	}

	public static function add_settings_error( $message, $redirect_url = null ) {
		self::add_settings_message( $message, $redirect_url, 'error' );
	}
}
