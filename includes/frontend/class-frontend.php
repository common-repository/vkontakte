<?php

class Vkontakte_Frontend {
	/**
	 * @var Vkontakte_Settings
	 */
	private $settings;

	/**
	 * @var Vkontakte_Frontend_Assets
	 */
	private $assets;

	/**
	 * @var Vkontakte_Head
	 */
	private $head;

	/**
	 * @var Vkontakte_Frontend_Comments|null
	 */
	private $comments;

	/**
	 * @var Vkontakte_Frontend_Buttons|null
	 */
	private $buttons;

	/**
	 * @var Vkontakte_Frontend_Shortcodes
	 */
	private $shortcodes;

	/**
	 * @param Vkontakte_Settings $settings
	 */
	public function __construct( $settings ) {
		$this->settings = $settings;

		$this->head   = new Vkontakte_Frontend_Head( $this->settings );
		$this->assets = new Vkontakte_Frontend_Assets( $this->settings );
		$this->shortcodes  = new Vkontakte_Frontend_Shortcodes( $this->settings );

		if ( $this->settings->is_api_ready() ) {
			$this->comments = new Vkontakte_Frontend_Comments( $this->settings );
			$this->buttons  = new Vkontakte_Frontend_Buttons( $this->settings, $this->head, $this->assets );
		}
	}

	/**
	 * @return Vkontakte_Head
	 */
	public function get_head() {
		return $this->head;
	}

	/**
	 * @return Vkontakte_Frontend_Assets
	 */
	public function get_assets() {
		return $this->assets;
	}

	/**
	 * @return Vkontakte_Frontend_Comments|null
	 */
	public function get_comments() {
		return $this->comments;
	}

	/**
	 * @return Vkontakte_Frontend_Buttons|null
	 */
	public function get_buttons() {
		return $this->buttons;
	}

	/**
	 * @return Vkontakte_Frontend_Shortcodes
	 */
	public function get_shortcodes() {
		return $this->shortcodes;
	}
}
