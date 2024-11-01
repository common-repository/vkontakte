<?php

class Vkontakte_Admin_Settings_Page_Share_Button_Tab extends Vkontakte_Admin_Settings_Page_Form_Tab {
	/**
	 * @var string
	 */
	protected $id = 'share-button';

	/**
	 * @inerhitDoc
	 */
	protected function init() {
		$this->label = __( 'Share Button', 'vkontakte' );
	}

	/**
	 * @inerhitDoc
	 */
	protected function get_own_sections() {
		return array(
			'default' => __( 'General Settings', 'vkontakte' ),
			'display' => __( 'Display Settings', 'vkontakte' ),
		);
	}

	public function get_settings_for_default_section() {
		return array(
			array(
				'type'      => Vkontakte_Admin_Form::FIELD_CHECKBOX,
				'name'      => Vkontakte_Settings::SHARE_BUTTON_STATUS,
				'label'     => __( 'Enable Share button', 'vkontakte' ),
				'id'        => 'share-btn-enable',
				'label_for' => 'share-btn-enable',
			),
		);
	}

	public function get_settings_for_display_section() {
		return array(
			array(
				'type'      => Vkontakte_Admin_Form::FIELD_SELECT,
				'name'      => Vkontakte_Settings::SHARE_BUTTON_DISPLAY_IN_POSTS,
				'label'     => __( 'Display button in posts', 'vkontakte' ),
				'options'   => array(
					Vkontakte_Settings::BUTTON_DISPLAY_OPTION_NONE           => __( 'not display', 'vkontakte' ),
					Vkontakte_Settings::BUTTON_DISPLAY_OPTION_BEFORE_CONTENT => __( 'before content', 'vkontakte' ),
					Vkontakte_Settings::BUTTON_DISPLAY_OPTION_AFTER_CONTENT  => __( 'after content', 'vkontakte' ),
				),
				'id'        => 'share-btn-display-in-posts',
				'label_for' => 'share-btn-display-in-posts',
			),
			array(
				'type'      => Vkontakte_Admin_Form::FIELD_SELECT,
				'name'      => Vkontakte_Settings::SHARE_BUTTON_DISPLAY_ON_PAGES,
				'label'     => __( 'Display button on pages', 'vkontakte' ),
				'options'   => array(
					Vkontakte_Settings::BUTTON_DISPLAY_OPTION_NONE           => __( 'not display', 'vkontakte' ),
					Vkontakte_Settings::BUTTON_DISPLAY_OPTION_BEFORE_CONTENT => __( 'before content', 'vkontakte' ),
					Vkontakte_Settings::BUTTON_DISPLAY_OPTION_AFTER_CONTENT  => __( 'after content', 'vkontakte' ),
				),
				'id'        => 'share-btn-display-on-pages',
				'label_for' => 'share-btn-display-on-pages',
			),
			array(
				'type'      => Vkontakte_Admin_Form::FIELD_SELECT,
				'name'      => Vkontakte_Settings::SHARE_BUTTON_TYPE,
				'label'     => __( 'Button type', 'vkontakte' ),
				'options'   => array(
					Vkontakte_Settings::SHARE_BUTTON_TYPE_OPTION_ROUND          => __( 'button with rounded corners and counter', 'vkontakte' ),
					Vkontakte_Settings::SHARE_BUTTON_TYPE_OPTION_ROUND_NOCOUNT  => __( 'button with rounded corners without a counter', 'vkontakte' ),
					Vkontakte_Settings::SHARE_BUTTON_TYPE_OPTION_BUTTON         => __( 'button with right angles and counter', 'vkontakte' ),
					Vkontakte_Settings::SHARE_BUTTON_TYPE_OPTION_BUTTON_NOCOUNT => __( 'button with right angles without a counter', 'vkontakte' ),
					Vkontakte_Settings::SHARE_BUTTON_TYPE_OPTION_LINK           => __( 'text link with icon', 'vkontakte' ),
					Vkontakte_Settings::SHARE_BUTTON_TYPE_OPTION_LINK_NOICON    => __( 'text link without icon', 'vkontakte' ),
				),
				'id'        => 'share-btn-type',
				'label_for' => 'share-btn-type',
			),
			array(
				'type'      => Vkontakte_Admin_Form::FIELD_TEXT,
				'name'      => Vkontakte_Settings::SHARE_BUTTON_TEXT,
				'label'     => __( 'Button label text', 'vkontakte' ),
				'id'        => 'share-btn-text',
				'label_for' => 'share-btn-text',
			),
		);
	}
}
