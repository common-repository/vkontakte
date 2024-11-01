<?php

class Vkontakte_Admin_Comments_Page extends Vkontakte_Admin_Page {
	public static function get_slug() {
		return 'vkontakte-comments';
	}

	protected static function get_tabs_classes() {
		return array(
			'Vkontakte_Admin_Comments_Page_Browse_Tab',
		);
	}
}
