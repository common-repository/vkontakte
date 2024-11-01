<?php

class Vkontakte_Frontend_Head extends Vkontakte_Head {
	public function add_buttons_styles() {
		$this->add_action( array( $this, 'output_buttons_styles' ) );
	}

	public function output_buttons_styles() {
		$like_button_width = $this->settings->get_like_button_width();
		$buttons_css       = $this->settings->get_buttons_styles();

		require __DIR__ . '/views/styles/buttons.php';
	}
}
