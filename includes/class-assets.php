<?php

abstract class Vkontakte_Assets {
	const STYLES = 'vkontakte-styles';
	const SCRIPTS = 'vkontakte-scripts';
	const VK_OPENAPI_SCRIPTS = 'vkontakte-vk-openapi-scripts';

	/**
	 * @var Vkontakte_Settings
	 */
	protected $settings;

	/**
	 * @var array
	 */
	protected $styles = array();

	/**
	 * @var array
	 */
	protected $scripts = array();

	/**
	 * @var array
	 */
	protected $page_styles = array();

	/**
	 * @var array
	 */
	protected $page_scripts = array();

	/**
	 * @param Vkontakte_Settings $settings
	 */
	public function __construct( $settings ) {
		$this->settings = $settings;

		$this->add_style_handle( static::STYLES );
		$this->add_script_handle( static::SCRIPTS );

		if ( $this->settings->is_api_ready() ) {
			$this->register_script( 'https://vk.com/js/api/openapi.js', static::VK_OPENAPI_SCRIPTS );
		}
	}

	/**
	 * @param string $handle
	 *
	 * @return void
	 */
	public function add_style_handle( $handle ) {
		$this->styles[ $handle ] = $handle;
	}

	/**
	 * @param string $handle
	 *
	 * @return void
	 */
	public function add_script_handle( $handle ) {
		$this->scripts[ $handle ] = $handle;
	}

	/**
	 * @param string $page
	 * @param string $handle
	 *
	 * @return void
	 */
	public function add_page_style_handle( $page, $handle ) {
		$this->page_styles[ $page ][ $handle ] = $handle;
	}

	/**
	 * @param string $page
	 * @param string $handle
	 *
	 * @return void
	 */
	public function add_page_script_handle( $page, $handle ) {
		$this->page_scripts[ $page ][ $handle ] = $handle;
	}

	/**
	 * @param string $src
	 * @param string|null $handle
	 * @param array $deps
	 *
	 * @return void
	 */
	public function register_style( $src, $handle = null, $deps = array() ) {
		if ( ! $handle ) {
			$handle = static::STYLES;
		}

		wp_register_style( $handle, $src, $deps );
	}

	/**
	 * @param string $src
	 * @param string|null $handle
	 * @param array $deps
	 *
	 * @return void
	 */
	public function register_script( $src, $handle = null, $deps = array() ) {
		if ( ! $handle ) {
			$handle = static::SCRIPTS;
		}

		wp_register_script( $handle, $src, $deps );
	}

	public function enqueue_styles( $page ) {
		foreach ( $this->styles as $handle ) {
			wp_enqueue_style( $handle );
		}

		if ( array_key_exists( $page, $this->page_styles ) ) {
			foreach ( $this->page_styles as $handle ) {
				wp_enqueue_style( $handle );
			}
		}
	}

	public function enqueue_scripts( $page ) {
		foreach ( $this->scripts as $handle ) {
			wp_enqueue_script( $handle );
		}

		if ( array_key_exists( $page, $this->page_scripts ) ) {
			foreach ( $this->page_scripts as $handle ) {
				wp_enqueue_script( $handle );
			}
		}
	}

	/**
	 * @param string $file
	 *
	 * @return string
	 */
	public function url( $file ) {
		$file = trim( $file, '/' );

		return plugins_url( '/assets/' . $file, VKONTAKTE_PLUGIN_FILE );
	}
}
