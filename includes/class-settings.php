<?php

class Vkontakte_Settings {
	const APP_ID = 'vkfull_apiid';

	const COMMENTS_STATUS = 'vkfull_comments_status';
	const COMMENTS_LIMIT = 'vkfull_comments_limit';
	const COMMENTS_FORM_WIDTH = 'vkfull_comments_width';
	const COMMENTS_FORM_HEIGHT = 'vkfull_comments_height';
	const COMMENTS_AUTO_PUBLISH = 'vkfull_comments_autoPublish';
	const COMMENTS_NO_REALTIME = 'vkfull_comments_norealtime';
	const COMMENTS_DISPLAY_IN_POST_TYPE = 'vkfull_comments_display_in_%s';

	const COMMENTS_DISPLAY_OPTION_NONE = 'none';
	const COMMENTS_DISPLAY_OPTION_REPLACE = 'replace';
	const COMMENTS_DISPLAY_OPTION_BEFORE = 'before';
	const COMMENTS_DISPLAY_OPTION_AFTER = 'after';

	const COMMENTS_ATTACHMENT_AUDIO = 'vkfull_comments_audio';
	const COMMENTS_ATTACHMENT_VIDEO = 'vkfull_comments_video';
	const COMMENTS_ATTACHMENT_PHOTO = 'vkfull_comments_photo';
	const COMMENTS_ATTACHMENT_LINK = 'vkfull_comments_link';
	const COMMENTS_ATTACHMENT_GRAFFITI = 'vkfull_comments_graffiti';

	const BUTTON_DISPLAY_OPTION_NONE = 'none';
	const BUTTON_DISPLAY_OPTION_BEFORE_CONTENT = 'before';
	const BUTTON_DISPLAY_OPTION_AFTER_CONTENT = 'after';

	const LIKE_BUTTON_STATUS = 'vkfull_like_status';

	const LIKE_BUTTON_DISPLAY_IN_POSTS = 'vkfull_like_display_in_posts';
	const LIKE_BUTTON_DISPLAY_ON_PAGES = 'vkfull_like_display_on_pages';
	const LIKE_BUTTON_TYPE = 'vkfull_like_type';
	const LIKE_BUTTON_VERB = 'vkfull_like_verb';
	const LIKE_BUTTON_WIDTH = 'vkfull_like_width';

	const LIKE_BUTTON_TYPE_OPTION_FULL = 'full';
	const LIKE_BUTTON_TYPE_OPTION_BUTTON = 'button';
	const LIKE_BUTTON_TYPE_OPTION_MINI = 'mini';
	const LIKE_BUTTON_TYPE_OPTION_VERTICAL = 'vertical';

	const LIKE_BUTTON_VERB_OPTION_ILIKE = 0;
	const LIKE_BUTTON_VERB_OPTION_ITSINTERESTING = 1;

	const SHARE_BUTTON_STATUS = 'vkfull_share_status';

	const SHARE_BUTTON_DISPLAY_IN_POSTS = 'vkfull_share_display_in_posts';
	const SHARE_BUTTON_DISPLAY_ON_PAGES = 'vkfull_share_display_on_pages';
	const SHARE_BUTTON_TYPE = 'vkfull_share_type';
	const SHARE_BUTTON_TEXT = 'vkfull_share_text';

	const SHARE_BUTTON_TYPE_OPTION_ROUND = 'round';
	const SHARE_BUTTON_TYPE_OPTION_ROUND_NOCOUNT = 'round_nocount';
	const SHARE_BUTTON_TYPE_OPTION_BUTTON = 'button';
	const SHARE_BUTTON_TYPE_OPTION_BUTTON_NOCOUNT = 'button_nocount';
	const SHARE_BUTTON_TYPE_OPTION_LINK = 'link';
	const SHARE_BUTTON_TYPE_OPTION_LINK_NOICON = 'link_noicon';

	const STYLES_SHARE_LIKE = 'vkfull_styles_share_like';

	/**
	 * @var Vkontakte_Settings	 */
	private static $_instance = null;

	/**
	 * @return Vkontakte_Settings
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * @return string|null
	 */
	public function get_app_id() {
		return get_option( self::APP_ID, null );
	}

	/**
	 * @return bool
	 */
	public function are_comments_enabled() {
		return (bool) get_option( self::COMMENTS_STATUS, false );
	}

	/**
	 * @return int
	 */
	public function get_comments_limit() {
		return (int) get_option( self::COMMENTS_LIMIT, 5 );
	}

	/**
	 * @return int
	 */
	public function get_comments_form_width() {
		return (int) get_option( self::COMMENTS_FORM_WIDTH, 0 );
	}

	/**
	 * @return int
	 */
	public function get_comments_form_height() {
		return (int) get_option( self::COMMENTS_FORM_HEIGHT, 0 );
	}

	/**
	 * @return bool
	 */
	public function is_comments_auto_publish_enabled() {
		return (bool) get_option( self::COMMENTS_AUTO_PUBLISH, false );
	}

	/**
	 * @return bool
	 */
	public function is_comments_realtime_disabled() {
		return (bool) get_option( self::COMMENTS_NO_REALTIME, false );
	}

	/**
	 * @param string $post_type
	 *
	 * @return string
	 */
	public function display_in_post_type( $post_type ) {
		return get_option(
			sprintf( self::COMMENTS_DISPLAY_IN_POST_TYPE, $post_type ),
			self::COMMENTS_DISPLAY_OPTION_NONE
		);
	}

	/**
	 * @return bool
	 */
	public function is_comments_audio_enabled() {
		return (bool) get_option( self::COMMENTS_ATTACHMENT_AUDIO, false );
	}

	/**
	 * @return bool
	 */
	public function is_comments_video_enabled() {
		return (bool) get_option( self::COMMENTS_ATTACHMENT_VIDEO, false );
	}

	/**
	 * @return bool
	 */
	public function is_comments_photo_enabled() {
		return (bool) get_option( self::COMMENTS_ATTACHMENT_PHOTO, false );
	}

	/**
	 * @return bool
	 */
	public function is_comments_link_enabled() {
		return (bool) get_option( self::COMMENTS_ATTACHMENT_LINK, false );
	}

	/**
	 * @return bool
	 */
	public function is_comments_graffiti_enabled() {
		return (bool) get_option( self::COMMENTS_ATTACHMENT_GRAFFITI, false );
	}

	/**
	 * @return bool
	 */
	public function is_like_button_enabled() {
		return (bool) get_option( self::LIKE_BUTTON_STATUS, false );
	}

	/**
	 * @return string
	 */
	public function display_like_button_in_posts() {
		return get_option( self::LIKE_BUTTON_DISPLAY_IN_POSTS, self::BUTTON_DISPLAY_OPTION_NONE );
	}

	/**
	 * @return string
	 */
	public function display_like_button_on_pages() {
		return get_option( self::LIKE_BUTTON_DISPLAY_ON_PAGES, self::BUTTON_DISPLAY_OPTION_NONE );
	}

	/**
	 * @return string
	 */
	public function get_like_button_type() {
		return get_option( self::LIKE_BUTTON_TYPE, self::LIKE_BUTTON_TYPE_OPTION_FULL );
	}

	/**
	 * @return string
	 */
	public function get_like_button_verb() {
		return get_option( self::LIKE_BUTTON_VERB, self::LIKE_BUTTON_VERB_OPTION_ILIKE );
	}

	/**
	 * @return int
	 */
	public function get_like_button_width() {
		return (int) get_option( self::LIKE_BUTTON_WIDTH, 350 );
	}

	/**
	 * @return bool
	 */
	public function is_share_button_enabled() {
		return (bool) get_option( self::SHARE_BUTTON_STATUS, false );
	}

	/**
	 * @return string
	 */
	public function display_share_button_in_posts() {
		return get_option( self::SHARE_BUTTON_DISPLAY_IN_POSTS, self::BUTTON_DISPLAY_OPTION_NONE );
	}

	/**
	 * @return string
	 */
	public function display_share_button_on_pages() {
		return get_option( self::SHARE_BUTTON_DISPLAY_ON_PAGES, self::BUTTON_DISPLAY_OPTION_NONE );
	}

	/**
	 * @return string
	 */
	public function get_share_button_type() {
		return get_option( self::SHARE_BUTTON_TYPE, self::SHARE_BUTTON_TYPE_OPTION_ROUND );
	}

	/**
	 * @return string
	 */
	public function get_share_button_text() {
		return get_option( self::SHARE_BUTTON_TEXT, 'Share' );
	}

	/**
	 * @return string
	 */
	public function get_buttons_styles() {
		return get_option( self::STYLES_SHARE_LIKE, '' );
	}

	/**
	 * @return bool
	 */
	public function is_api_ready() {
		$app_id = self::get_app_id();

		return ! empty( $app_id );
	}
}
