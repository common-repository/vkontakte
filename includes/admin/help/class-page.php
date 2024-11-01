<?php

class Vkontakte_Admin_Help_Page extends Vkontakte_Admin_Page {
	public static function get_slug() {
		return 'vkontakte-help';
	}

	protected static function get_tabs_classes() {
		return array(
			'Vkontakte_Admin_Help_Page_Settings_Tab',
			'Vkontakte_Admin_Help_Page_Widgets_Tab',
		);
	}
}
