<?php

class Vkontakte_Frontend_Buttons {
	/**
	 * @var Vkontakte_Settings
	 */
	private $settings;

	/**
	 * @var Vkontakte_Frontend_Head
	 */
	private $head;

	/**
	 * @var Vkontakte_Frontend_Assets
	 */
	private $assets;

	/**
	 * @param Vkontakte_Settings $settings
	 * @param Vkontakte_Frontend_Head $head
	 * @param Vkontakte_Frontend_Assets $assets
	 */
	public function __construct( $settings, $head, $assets ) {
		$this->settings = $settings;
		$this->head     = $head;
		$this->assets   = $assets;

		$is_like_button_enabled  = $this->settings->is_like_button_enabled();
		$is_share_button_enabled = $this->settings->is_share_button_enabled();

		if ( $is_share_button_enabled ) {
			$this->assets->register_script( 'https://vk.com/js/api/share.js' );
		}

		if ( $is_like_button_enabled || $is_share_button_enabled ) {
			$this->head->add_buttons_styles();
			add_filter( 'the_content', array( $this, 'add_buttons_to_content' ) );
		}
	}

	public function add_buttons_to_content( $content ) {
		$is_like_button_enabled        = $this->settings->is_like_button_enabled();
		$is_like_button_before_content = $is_like_button_enabled && $this->is_like_button_before_content();
		$is_like_button_after_content  = $is_like_button_enabled && $this->is_like_button_after_content();

		$is_share_button_enabled        = $this->settings->is_share_button_enabled();
		$is_share_button_before_content = $is_share_button_enabled && $this->is_share_button_before_content();
		$is_share_button_after_content  = $is_share_button_enabled && $this->is_share_button_after_content();

		if ( $is_share_button_before_content || $is_like_button_before_content ) {
			$html = '<div class="vk-btns-container">';

			if ( $is_share_button_before_content ) {
				$html .= '<div class="vk-btn-div vk-share-div">' . $this->build_share_button() . '</div>';
			}

			if ( $is_like_button_before_content ) {
				$html .= '<div class="vk-btn-div vk-like-div">' . $this->build_like_button() . '</div>';
			}

			$html    .= '</div>';
			$content = $html . $content;
		}

		if ( $is_share_button_after_content || $is_like_button_after_content ) {
			$html = '<div class="vk-btns-container">';

			if ( $is_share_button_after_content ) {
				$html .= '<div class="vk-btn-div vk-share-div">' . $this->build_share_button() . '</div>';
			}

			if ( $is_like_button_after_content ) {
				$html .= '<div class="vk-btn-div vk-like-div">' . $this->build_like_button() . '</div>';
			}

			$html    .= '</div>';
			$content .= $html;
		}

		return $content;
	}

	/**
	 * @return bool
	 */
	private function is_like_button_before_content() {
		return Vkontakte_Settings::BUTTON_DISPLAY_OPTION_BEFORE_CONTENT === (
			is_single()
				? $this->settings->display_like_button_in_posts()
				: $this->settings->display_like_button_on_pages()
			);
	}

	/**
	 * @return bool
	 */
	private function is_like_button_after_content() {
		return Vkontakte_Settings::BUTTON_DISPLAY_OPTION_AFTER_CONTENT === (
			is_single()
				? $this->settings->display_like_button_in_posts()
				: $this->settings->display_like_button_on_pages()
			);
	}

	/**
	 * @return string
	 */
	private function build_like_button() {
		global $post;

		$widget_params = array(
			'type'  => $this->settings->get_like_button_type(),
			'width' => $this->settings->get_like_button_width(),
			'verb'  => $this->settings->get_like_button_verb(),
		);

		$html = file_get_contents( __DIR__ . '/views/buttons/like.html' );

		return str_replace(
			array(
				'{POST_ID}',
				'{WIDGET_PARAMS}',
			),
			array(
				$post->ID,
				json_encode( $widget_params ),
			),
			$html
		);
	}

	/**
	 * @return bool
	 */
	private function is_share_button_before_content() {
		return Vkontakte_Settings::BUTTON_DISPLAY_OPTION_BEFORE_CONTENT === (
			is_single()
				? $this->settings->display_share_button_in_posts()
				: $this->settings->display_share_button_on_pages()
			);
	}

	/**
	 * @return bool
	 */
	private function is_share_button_after_content() {
		return Vkontakte_Settings::BUTTON_DISPLAY_OPTION_AFTER_CONTENT === (
			is_single()
				? $this->settings->display_share_button_in_posts()
				: $this->settings->display_share_button_on_pages()
			);
	}

	/**
	 * @return string
	 */
	private function build_share_button() {
		global $post;

		$button_options = array(
			'type' => $this->settings->get_share_button_type(),
			'text' => $this->settings->get_share_button_text(),
		);

		$html = file_get_contents( __DIR__ . '/views/buttons/share.html' );

		return str_replace(
			array(
				'{POST_ID}',
				'{SHARE_OPTIONS}',
				'{BUTTON_OPTIONS}',
			),
			array(
				$post->ID,
				'false',
				json_encode( $button_options ),
			),
			$html
		);
	}
}
