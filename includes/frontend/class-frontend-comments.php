<?php

class Vkontakte_Frontend_Comments {
	/**
	 * @var Vkontakte_Settings
	 */
	private $settings;

	/**
	 * @param Vkontakte_Settings $settings
	 */
	public function __construct( $settings ) {
		$this->settings = $settings;

		if ( $this->settings->are_comments_enabled() ) {
			add_filter( 'comments_template', array( $this, 'replace_comments_template' ) );
		}
	}

	/**
	 * @param string $comment_template
	 *
	 * @return string
	 */
	public function replace_comments_template( $comment_template ) {
		global $vkontakte_original_comments_template;

		$vkontakte_original_comments_template = $comment_template;

		return __DIR__ . '/views/comments.php';
	}

	public static function output_native_comments( $template_path ) {
		if ( file_exists( $template_path ) ) {
			require $template_path;
		} elseif ( file_exists( TEMPLATEPATH . $template_path ) ) {
			require TEMPLATEPATH . $template_path;
		} else { // Backward compat code will be removed in a future release.
			require ABSPATH . WPINC . '/theme-compat/comments.php';
		}
	}

	public static function build_form( $post ) {
		$settings = Vkontakte_Settings::instance();

		$enabled_attachments = array(
			'video' => $settings->is_comments_video_enabled(),
			'audio' => $settings->is_comments_audio_enabled(),
			'photo' => $settings->is_comments_photo_enabled(),
			'link' => $settings->is_comments_link_enabled(),
			'graffiti' => $settings->is_comments_graffiti_enabled(),
		);

		$attachments = array();

		foreach ( $enabled_attachments as $attachment_code => $is_enabled ) {
			if ( $is_enabled ) {
				$attachments[] = $attachment_code;
			}
		}

		if ( 5 === count( $attachments ) ) {
			$attachments = '*';
		} elseif ( count( $attachments ) > 0 ) {
			$attachments = implode( ',', $attachments );
		} else {
			$attachments = false;
		}

		$widget_params = array(
			'height'      => $settings->get_comments_form_height(),
			'limit'       => $settings->get_comments_limit(),
			'attach'      => $attachments,
			'autoPublish' => $settings->is_comments_auto_publish_enabled() ? 1 : 0,
			'norealtime'  => $settings->is_comments_realtime_disabled() ? 1 : 0,
		);

		$width = $settings->get_comments_form_width();

		if ( $width > 0 ) {
			$widget_params['width'] = $width;
		}

		$html = file_get_contents( __DIR__ . '/views/comments/form.html' );

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
}
