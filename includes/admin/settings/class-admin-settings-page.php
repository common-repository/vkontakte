<?php

class Vkontakte_Admin_Settings_Page extends Vkontakte_Admin_Page {
	public static function get_slug() {
		return 'vkontakte-settings';
	}

	protected static function get_tabs_classes() {
		return array(
			'Vkontakte_Admin_Settings_Page_Api_Integration_Tab',
			'Vkontakte_Admin_Settings_Page_Comments_Tab',
			'Vkontakte_Admin_Settings_Page_Like_Button_Tab',
			'Vkontakte_Admin_Settings_Page_Share_Button_Tab',
			'Vkontakte_Admin_Settings_Page_Styles_Tab',
			'Vkontakte_Admin_Settings_Page_Help_Tab',
		);
	}

	public static function load() {
		parent::load();

		global $current_section_id;

		$current_tab = static::get_current_tab();

		if ( ! $current_tab instanceof Vkontakte_Admin_Settings_Page_Form_Tab ) {
			return;
		}

		$settings = $current_tab->get_settings_for_section( $current_section_id );

		if ( empty( $settings ) ) {
			return;
		}

		$settings_group = $current_tab->get_settings_group( $current_section_id );
		add_settings_section( $current_section_id, '', '', $settings_group );

		foreach ( $settings as $field_data ) {
			add_settings_field(
				empty( $field_data['id'] ) ? $field_data['name'] : $field_data['id'],
				$field_data['label'],
				! empty( $field_data['output_function'] )
					? $field_data['output_function']
					: array( 'Vkontakte_Admin_Form', 'output_field' ),
				$settings_group,
				$current_section_id,
				$field_data
			);
		}
	}

	public static function register_settings() {
		if ( empty( $_REQUEST['option_page'] ) ) {
			return;
		}

		$settings_group = sanitize_key( $_REQUEST['option_page'] );

		if ( 0 !== strpos( $settings_group, 'vkontakte_admin_settings_' ) ) {
			return;
		}

		list( $tab, $section ) = explode( '_', str_replace( 'vkontakte_admin_settings_', '', $settings_group ) );

		if ( ! static::has_tab( $tab ) ) {
			return;
		}

		$tab = static::get_tab( $tab );

		foreach ( $tab->get_settings_for_section( $section ) as $setting ) {
			if ( empty( $setting['name'] ) || ! empty( $setting['no_option'] ) ) {
				continue;
			}

			register_setting( $settings_group, $setting['name'] );
		}
	}
}
