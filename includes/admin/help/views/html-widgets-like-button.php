<?php
/**
 * @var Vkontakte_Admin_Page_Tab $current_tab
 */
$settings_url = Vkontakte_Admin_Settings_Page::get_url( array(
	'tab' => 'like-button',
) );
?>
<h2><?php _e( 'Usage', 'vkontakte' ); ?></h2>
<ul>
    <li><?php echo sprintf( __( 'Hard integration: %s', 'vkontakte' ), __( 'yes', 'vkontakte' ) ); ?></li>
    <li><?php echo sprintf( __( 'WP widget: %s', 'vkontakte' ), __( 'no', 'vkontakte' ) ); ?></li>
    <li><?php echo sprintf( __( 'WP shortcode: %s', 'vkontakte' ), __( 'no', 'vkontakte' ) ); ?></li>
</ul>
<p>
	<?php _e( 'There are no WP widgets or shortcodes for Like button at the moment.', 'vkontakte' ); ?>
	<?php echo sprintf( __( 'You can only <a href="%s">configure</a> a rendering of Like button on single post view page.', 'vkontakte' ), $settings_url ); ?>
</p>
