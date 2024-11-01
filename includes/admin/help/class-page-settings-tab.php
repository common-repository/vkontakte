<?php

class Vkontakte_Admin_Help_Page_Settings_Tab extends Vkontakte_Admin_Page_Tab {
	/**
	 * @inerhitDoc
	 */
	protected function init() {
		$this->label = __( 'Settings', 'vkontakte' );
	}

	/**
	 * @inerhitDoc
	 */
	protected function get_own_sections() {
		return array(
			static::SECTION_DEFAULT => __( 'API Integration', 'vkontakte' ),
		);
	}

	/**
	 * @inerhitDoc
	 */
	protected function get_template( $current_section_id ) {
		switch ( $current_section_id ) {
			default:
				return __DIR__ . '/views/html-settings-api-integration.php';
		}
	}
}
