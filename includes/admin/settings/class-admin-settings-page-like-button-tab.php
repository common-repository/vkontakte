<?php

class Vkontakte_Admin_Settings_Page_Like_Button_Tab extends Vkontakte_Admin_Settings_Page_Form_Tab {
	/**
	 * @var string
	 */
	protected $id = 'like-button';

	/**
	 * @inerhitDoc
	 */
	protected function init() {
		$this->label = __( 'Like Button', 'vkontakte' );
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
				'name'      => Vkontakte_Settings::LIKE_BUTTON_STATUS,
				'label'     => __( 'Enable Like button', 'vkontakte' ),
				'id'        => 'like-btn-enable',
				'label_for' => 'like-btn-enable',
			),
		);
	}

	public function get_settings_for_display_section() {
		return array(
			array(
				'type'      => Vkontakte_Admin_Form::FIELD_SELECT,
				'name'      => Vkontakte_Settings::LIKE_BUTTON_DISPLAY_IN_POSTS,
				'label'     => __( 'Display button in posts', 'vkontakte' ),
				'options'   => array(
					Vkontakte_Settings::BUTTON_DISPLAY_OPTION_NONE           => __( 'not display', 'vkontakte' ),
					Vkontakte_Settings::BUTTON_DISPLAY_OPTION_BEFORE_CONTENT => __( 'before content', 'vkontakte' ),
					Vkontakte_Settings::BUTTON_DISPLAY_OPTION_AFTER_CONTENT  => __( 'after content', 'vkontakte' ),
				),
				'id'        => 'like-btn-display-in-posts',
				'label_for' => 'like-btn-display-in-posts',
			),
			array(
				'type'      => Vkontakte_Admin_Form::FIELD_SELECT,
				'name'      => Vkontakte_Settings::LIKE_BUTTON_DISPLAY_ON_PAGES,
				'label'     => __( 'Display button on pages', 'vkontakte' ),
				'options'   => array(
					Vkontakte_Settings::BUTTON_DISPLAY_OPTION_NONE           => __( 'not display', 'vkontakte' ),
					Vkontakte_Settings::BUTTON_DISPLAY_OPTION_BEFORE_CONTENT => __( 'before content', 'vkontakte' ),
					Vkontakte_Settings::BUTTON_DISPLAY_OPTION_AFTER_CONTENT  => __( 'after content', 'vkontakte' ),
				),
				'id'        => 'like-btn-display-on-pages',
				'label_for' => 'like-btn-display-on-pages',
			),
			array(
				'type'      => Vkontakte_Admin_Form::FIELD_SELECT,
				'name'      => Vkontakte_Settings::LIKE_BUTTON_TYPE,
				'label'     => __( 'Button type', 'vkontakte' ),
				'options'   => array(
					Vkontakte_Settings::LIKE_BUTTON_TYPE_OPTION_FULL     => __( 'button with a text counter', 'vkontakte' ),
					Vkontakte_Settings::LIKE_BUTTON_TYPE_OPTION_BUTTON   => __( 'button with a miniature counter', 'vkontakte' ),
					Vkontakte_Settings::LIKE_BUTTON_TYPE_OPTION_MINI     => __( 'miniature button', 'vkontakte' ),
					Vkontakte_Settings::LIKE_BUTTON_TYPE_OPTION_VERTICAL => __( 'miniature button, counter on top', 'vkontakte' ),
				),
				'id'        => 'like-btn-type',
				'label_for' => 'like-btn-type',
			),
			array(
				'type'      => Vkontakte_Admin_Form::FIELD_SELECT,
				'name'      => Vkontakte_Settings::LIKE_BUTTON_VERB,
				'label'     => __( 'Button label text', 'vkontakte' ),
				'options'   => array(
					Vkontakte_Settings::LIKE_BUTTON_VERB_OPTION_ILIKE          => __( 'Like', 'vkontakte' ),
					Vkontakte_Settings::LIKE_BUTTON_VERB_OPTION_ITSINTERESTING => __( 'This is interesting', 'vkontakte' ),
				),
				'id'        => 'like-btn-verb',
				'label_for' => 'like-btn-verb',
			),
			array(
				'type'        => Vkontakte_Admin_Form::FIELD_TEXT,
				'name'        => Vkontakte_Settings::LIKE_BUTTON_WIDTH,
				'label'       => __( 'Button width', 'vkontakte' ),
				'id'          => 'like-btn-width',
				'label_for'   => 'like-btn-width',
				'description' => __( 'Minimum value: 200 Default: 350. The parameter is taken into account only for a button with a text counter.', 'vkontakte' ),
			),
		);
	}
}
