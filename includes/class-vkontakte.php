<?php

final class Vkontakte {
	/**
	 * @var string
	 */
	private $version = '3.2.0';

	/**
	 * @var Vkontakte
	 */
	private static $_instance = null;

	/**
	 * @var Vkontakte_Settings
	 */
	private $settings;

	/**
	 * @var Vkontakte_Admin|null
	 */
	private $admin;

	/**
	 * @var Vkontakte_Frontend|null
	 */
	private $frontend;

	/**
	 * @return Vkontakte
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * @return string
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * @return Vkontakte_Admin|null
	 */
	public function get_admin() {
		return $this->admin;
	}

	/**
	 * @return Vkontakte_Frontend|null
	 */
	public function get_frontend() {
		return $this->frontend;
	}

	private function __construct() {
		$this->define_constants();
		$this->includes();

		$this->settings = new Vkontakte_Settings();

		$this->init_hooks();

		if ( $this->is_admin_request() ) {
			$this->admin = new Vkontakte_Admin($this->settings);
		} else {
			$this->frontend = new Vkontakte_Frontend($this->settings);
		}
	}

	/**
	 * @return void
	 */
	private function define_constants() {
		if ( ! defined( 'VKONTAKTE_VERSION' ) ) {
			define( 'VKONTAKTE_VERSION', $this->version );
		}
	}

	private function includes() {
		require_once __DIR__ . '/class-autoloader.php';
		require_once __DIR__ . '/class-install.php';
	}

	private function init_hooks() {
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
	}

	public function init() {
		load_plugin_textdomain( 'vkontakte', false, plugin_basename( dirname( VKONTAKTE_PLUGIN_FILE ) ) . '/i18n' );
	}

	public function widgets_init() {
		register_widget( 'Vkontakte_Widget_Group' );
		register_widget( 'Vkontakte_Widget_Poll' );
		register_widget( 'Vkontakte_Widget_Recommendations' );
	}

	/**
	 * @return bool
	 */
	private function is_admin_request() {
		return is_admin();
	}
}
