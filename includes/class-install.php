<?php

class VKontakte_Install {
	public function __construct() {
		register_activation_hook( VKONTAKTE_PLUGIN_FILE, array( $this, 'activate' ) );
	}

	public function activate() {
		$options = array(
			Vkontakte_Settings::COMMENTS_LIMIT                                   => '5',
			Vkontakte_Settings::COMMENTS_FORM_WIDTH                              => '0',
			Vkontakte_Settings::COMMENTS_FORM_HEIGHT                             => '0',
			Vkontakte_Settings::COMMENTS_AUTO_PUBLISH                            => '1',
			sprintf( Vkontakte_Settings::COMMENTS_DISPLAY_IN_POST_TYPE, 'post' ) => Vkontakte_Settings::COMMENTS_DISPLAY_OPTION_REPLACE,
			sprintf( Vkontakte_Settings::COMMENTS_DISPLAY_IN_POST_TYPE, 'page' ) => Vkontakte_Settings::COMMENTS_DISPLAY_OPTION_REPLACE,
			Vkontakte_Settings::COMMENTS_ATTACHMENT_AUDIO                        => '1',
			Vkontakte_Settings::COMMENTS_ATTACHMENT_VIDEO                        => '1',
			Vkontakte_Settings::COMMENTS_ATTACHMENT_PHOTO                        => '1',
			Vkontakte_Settings::COMMENTS_ATTACHMENT_LINK                         => '1',
			Vkontakte_Settings::COMMENTS_ATTACHMENT_GRAFFITI                     => '1',

			Vkontakte_Settings::LIKE_BUTTON_DISPLAY_IN_POSTS => Vkontakte_Settings::BUTTON_DISPLAY_OPTION_AFTER_CONTENT,
			Vkontakte_Settings::LIKE_BUTTON_DISPLAY_ON_PAGES => Vkontakte_Settings::BUTTON_DISPLAY_OPTION_AFTER_CONTENT,
			Vkontakte_Settings::LIKE_BUTTON_TYPE             => Vkontakte_Settings::LIKE_BUTTON_TYPE_OPTION_FULL,
			Vkontakte_Settings::LIKE_BUTTON_VERB             => Vkontakte_Settings::LIKE_BUTTON_VERB_OPTION_ILIKE,
			Vkontakte_Settings::LIKE_BUTTON_WIDTH            => '350',

			Vkontakte_Settings::SHARE_BUTTON_DISPLAY_IN_POSTS => Vkontakte_Settings::BUTTON_DISPLAY_OPTION_AFTER_CONTENT,
			Vkontakte_Settings::SHARE_BUTTON_DISPLAY_ON_PAGES => Vkontakte_Settings::BUTTON_DISPLAY_OPTION_AFTER_CONTENT,
			Vkontakte_Settings::SHARE_BUTTON_TYPE             => Vkontakte_Settings::SHARE_BUTTON_TYPE_OPTION_ROUND,
			Vkontakte_Settings::SHARE_BUTTON_TEXT             => 'Share',
		);

		foreach ( $options as $name => $value ) {
			add_option( $name, $value );
		}
	}
}

return new Vkontakte_Install();
