<?php

class Vkontakte_Admin_Settings_Page_Styles_Tab extends Vkontakte_Admin_Settings_Page_Form_Tab {
	/**
	 * @var string
	 */
	protected $id = 'styles';

	/**
	 * @inerhitDoc
	 */
	protected function init() {
		$this->label = __( 'Styles', 'vkontakte' );
	}

	/**
	 * @inerhitDoc
	 */
	protected function get_own_sections() {
		return array( 'default' => __( 'Content Elements', 'vkontakte' ) );
	}

	public function get_settings_for_default_section() {
		return array(
			array(
				'no_option'       => true,
				'label'           => __( 'Share/Like buttons template', 'vkontakte' ),
				'output_function' => array( $this, 'output_buttons_template' ),
			),
			array(
				'type'        => Vkontakte_Admin_Form::FIELD_TEXTAREA,
				'name'        => Vkontakte_Settings::STYLES_SHARE_LIKE,
				'label'    => __( 'Share/Like buttons styles', 'vkontakte' ),
				'id'          => 'buttons-styles',
				'label_for'   => 'buttons-styles',
				'css'   => 'width: 100%;min-height: 200px;',
			),
		);
	}

	public function output_buttons_template( $field ) {
		require __DIR__ . '/views/styles/html-content-buttons-template.php';
	}
}
