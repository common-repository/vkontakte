<?php

class Vkontakte_Admin_Help_Page_Widgets_Tab extends Vkontakte_Admin_Page_Tab {
	const SECTION_COMMENTS = 'comments';
	const SECTION_LIKE_BUTTON = 'like-button';
	const SECTION_SHARE_BUTTON = 'share-button';
	const SECTION_GROUP = 'group';
	const SECTION_POLL = 'poll';
	const SECTION_RECOMMENDATIONS = 'recommendations';
	/**
	 * @inerhitDoc
	 */
	protected $id = 'widgets';

	/**
	 * @inerhitDoc
	 */
	protected function init() {
		$this->label = __( 'VKontakte Widgets', 'vkontakte' );
	}

	/**
	 * @inerhitDoc
	 */
	protected function get_own_sections() {
		return array(
			static::SECTION_DEFAULT         => __( 'Overview', 'vkontakte' ),
			static::SECTION_COMMENTS        => __( 'Comments', 'vkontakte' ),
			static::SECTION_LIKE_BUTTON     => __( 'Like Button', 'vkontakte' ),
			static::SECTION_SHARE_BUTTON    => __( 'Share Button', 'vkontakte' ),
			static::SECTION_GROUP           => __( 'Group', 'vkontakte' ),
			static::SECTION_POLL            => __( 'Poll', 'vkontakte' ),
			static::SECTION_RECOMMENDATIONS => __( 'Recommendations', 'vkontakte' ),
		);
	}

	/**
	 * @inerhitDoc
	 */
	protected function get_template( $current_section_id ) {
		switch ( $current_section_id ) {
			case static::SECTION_COMMENTS:
				return __DIR__ . '/views/html-widgets-comments.php';
			case static::SECTION_LIKE_BUTTON:
				return __DIR__ . '/views/html-widgets-like-button.php';
			case static::SECTION_SHARE_BUTTON:
				return __DIR__ . '/views/html-widgets-share-button.php';
			case static::SECTION_GROUP:
				return __DIR__ . '/views/html-widgets-group.php';
			case static::SECTION_POLL:
				return __DIR__ . '/views/html-widgets-poll.php';
			case static::SECTION_RECOMMENDATIONS:
				return __DIR__ . '/views/html-widgets-recommendations.php';
			default:
				return __DIR__ . '/views/html-widgets-overview.php';
		}
	}
}
