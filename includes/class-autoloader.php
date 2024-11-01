<?php

class Vkontakte_Autoloader {
	/**
	 * @var string
	 */
	private $include_path;

	public function __construct() {
		spl_autoload_register( array( $this, 'autoload' ) );

		$this->include_path = untrailingslashit( plugin_dir_path( VKONTAKTE_PLUGIN_FILE ) ) . '/includes/';
	}

	/**
	 * @param string $class
	 *
	 * @return string
	 */
	private function get_file_name_from_class( $class ) {
		$class = str_replace( 'vkontakte_admin_help_', 'class-', $class );
		$class = str_replace( 'vkontakte_frontend_shortcode_', 'class-', $class );
		$class = str_replace( 'vkontakte_api_widget_', 'class-', $class );
		$class = str_replace( 'vkontakte_api_', 'class-', $class );
		$class = str_replace( 'vkontakte_', 'class-', $class );

		return str_replace( '_', '-', $class ) . '.php';
	}

	/**
	 * @param $path
	 *
	 * @return bool
	 */
	private function load_file( $path ) {
		if ( $path && is_readable( $path ) ) {
			require_once $path;

			return true;
		}

		return false;
	}

	/**
	 * @param $class
	 *
	 * @return void
	 */
	public function autoload( $class ) {
		$class = strtolower( $class );

		if ( 0 !== strpos( $class, 'vkontakte_' ) ) {
			return;
		}

		$file = $this->get_file_name_from_class( $class );
		$path = $this->include_path;

		if ( 0 === strpos( $class, 'vkontakte_admin_page' ) ) {
			$path = $this->include_path . 'admin/page/';
		} elseif ( 0 === strpos( $class, 'vkontakte_admin_settings_' ) ) {
			$path = $this->include_path . 'admin/settings/';
		} elseif ( 0 === strpos( $class, 'vkontakte_admin_help_' ) ) {
			$path = $this->include_path . 'admin/help/';
		} elseif ( 0 === strpos( $class, 'vkontakte_admin_comments_' ) ) {
			$path = $this->include_path . 'admin/comments/';
		} elseif ( 0 === strpos( $class, 'vkontakte_admin' ) ) {
			$path = $this->include_path . 'admin/';
		} elseif ( 0 === strpos( $class, 'vkontakte_frontend_shortcode_' ) ) {
			$path = $this->include_path . 'frontend/shortcode/';
		} elseif ( 0 === strpos( $class, 'vkontakte_frontend' ) ) {
			$path = $this->include_path . 'frontend/';
		} elseif ( 0 === strpos( $class, 'vkontakte_widget' ) ) {
			$path = $this->include_path . 'widgets/';
		} elseif ( 0 === strpos( $class, 'vkontakte_api_widget' ) ) {
			$path = $this->include_path . 'api/widget/';
		} elseif ( 0 === strpos( $class, 'vkontakte_api' ) ) {
			$path = $this->include_path . 'api/';
		}

		if ( empty( $path ) || ! $this->load_file( $path . $file ) ) {
			$this->load_file( $file );
		}
	}
}

new Vkontakte_Autoloader();
