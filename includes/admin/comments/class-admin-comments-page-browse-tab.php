<?php

class Vkontakte_Admin_Comments_Page_Browse_Tab extends Vkontakte_Admin_Page_Tab {
	/**
	 * @inerhitDoc
	 */
	protected function init() {
		$this->label = __( 'Comments', 'vkontakte' );
	}

	/**
	 * @inerhitDoc
	 */
	protected function get_own_sections() {
		return array(
			static::SECTION_DEFAULT => __( 'Comments', 'vkontakte' ),
		);
	}

	/**
	 * @inerhitDoc
	 */
	protected function get_template( $current_section_id ) {
		return __DIR__ . '/views/html-browse.php';
	}
}
