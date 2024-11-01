<?php
/**
 * @var WP_Post $post
 */

if ( post_password_required() ) {
	return;
}

global $vkontakte_original_comments_template;

if ( ( is_single() || is_page() ) && comments_open() ) {
	$vkontakte_form = Vkontakte_Frontend_Comments::build_form( $post );

	switch ( Vkontakte_Settings::instance()->display_in_post_type( get_post_type() ) ) {
		case Vkontakte_Settings::COMMENTS_DISPLAY_OPTION_BEFORE:
			echo $vkontakte_form;

			Vkontakte_Frontend_Comments::output_native_comments( $vkontakte_original_comments_template );

			break;

		case Vkontakte_Settings::COMMENTS_DISPLAY_OPTION_AFTER:
			Vkontakte_Frontend_Comments::output_native_comments( $vkontakte_original_comments_template );

			echo $vkontakte_form;

			break;

		case Vkontakte_Settings::COMMENTS_DISPLAY_OPTION_REPLACE:
			echo $vkontakte_form;

			break;

		default:
			Vkontakte_Frontend_Comments::output_native_comments( $vkontakte_original_comments_template );
	}
} else {
	Vkontakte_Frontend_Comments::output_native_comments( $vkontakte_original_comments_template );
}
