<?php

class Vkontakte_Admin_Settings_Page_Api_Integration_Tab extends Vkontakte_Admin_Settings_Page_Form_Tab {
	/**
	 * @inerhitDoc
	 */
	protected function init() {
		$this->label = __( 'API Integration', 'vkontakte' );
	}

	/**
	 * @inerhitDoc
	 */
	protected function get_own_sections() {
		return array( static::SECTION_DEFAULT => __( 'API Integration', 'vkontakte' ) );
	}

	public function get_settings_for_default_section() {
		$application_id = Vkontakte_Settings::get_app_id();

		return array(
			array(
				'type'        => Vkontakte_Admin_Form::FIELD_TEXT,
				'name'        => Vkontakte_Settings::APP_ID,
				'label'       => __( 'Application ID', 'vkontakte' ),
				'id'          => 'vk-app-id',
				'label_for'   => 'vk-app-id',
				'description' => empty( $application_id )
					? __( 'Enter an <strong>application ID</strong>.', 'vkontakte' )
					: '',
			),
		);
	}
}
