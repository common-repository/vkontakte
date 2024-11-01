<?php

class Vkontakte_Admin_Menus {
	/**
	 * @var Vkontakte_Admin_Assets
	 */
	private $assets;

	/**
	 * @var Vkontakte_Head
	 */
	private $head;

	/**
	 * @param Vkontakte_Admin_Assets $assets
	 * @param Vkontakte_Head $head
	 * @param bool $is_api_ready
	 */
	public function __construct( $assets, $head, $is_api_ready = false ) {
		$this->assets = $assets;
		$this->head   = $head;

		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_menu', array( $this, 'settings_menu' ) );
		add_action( 'admin_menu', array( $this, 'help_menu' ) );

		if ( $is_api_ready ) {
			add_action( 'admin_menu', array( $this, 'comments_menu' ) );
		}
	}

	public function admin_menu() {
		add_menu_page(
			__( 'VKontakte | Settings', 'vkontakte' ),
			__( 'VKontakte', 'vkontakte' ),
			'manage_options',
			Vkontakte_Admin_Settings_Page::get_slug(),
			array( 'Vkontakte_Admin_Settings_Page', 'output' ),
			$this->assets->url( 'img/vk-icon.png' ),
			'58'
		);
	}

	public function settings_menu() {
		$page = add_submenu_page(
			Vkontakte_Admin_Settings_Page::get_slug(),
			__( 'VKontakte | Settings', 'vkontakte' ),
			__( 'Settings', 'vkontakte' ),
			'manage_options',
			Vkontakte_Admin_Settings_Page::get_slug(),
			array( 'Vkontakte_Admin_Settings_Page', 'output' )
		);

		add_action( 'load-' . $page, array( 'Vkontakte_Admin_Settings_Page', 'load' ) );
	}

	public function help_menu() {
		$help_page = add_submenu_page(
			Vkontakte_Admin_Settings_Page::get_slug(),
			__( 'Vkontakte Help', 'vkontakte' ),
			__( 'Help', 'vkontakte' ),
			'manage_options',
			Vkontakte_Admin_Help_Page::get_slug(),
			array( 'Vkontakte_Admin_Help_Page', 'output' )
		);

		add_action( 'load-' . $help_page, array( 'Vkontakte_Admin_Help_Page', 'load' ) );
	}

	public function comments_menu() {
		$page = add_comments_page(
			__( 'VKontakte | Comments', 'vkontakte' ),
			__( 'VKComments', 'vkontakte' ),
			'manage_options',
			Vkontakte_Admin_Comments_Page::get_slug(),
			array( 'Vkontakte_Admin_Comments_Page', 'output' )
		);

		add_action( 'load-' . $page, array( 'Vkontakte_Admin_Comments_Page', 'load' ) );

		$this->assets->add_page_script_handle( $page, Vkontakte_Assets::VK_OPENAPI_SCRIPTS );

		add_action( 'admin_head-' . $page, array( $this->head, 'output_vk_app_init_script' ) );
	}
}
