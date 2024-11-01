<?php
/**
 * @var Vkontakte_Admin_Page_Tab $current_tab
 */
?>
<h2><?php _e( 'What is a VKontakte widget?', 'vkontakte' ); ?></h2>
<p>
	<?php _e( 'A VKontakte widget is a functional block that allows you to embed VKontakte features on your website pages.', 'vkontakte' ); ?>
	<?php _e( 'The widget can allow both viewing information and interacting with it.', 'vkontakte' ); ?>
</p>

<h2><?php _e( 'Usage', 'vkontakte' ); ?></h2>
<p>
	<?php _e( 'Almost all the functionality of VKontakte for third-party sites is implemented as widgets.', 'vkontakte' ); ?>
	<?php _e( 'But, do not confuse VKontakte widgets with WordPress widgets.', 'vkontakte' ); ?>
</p>
<p>
	<?php _e( 'There are 3 available ways to use a VK widget.', 'vkontakte' ); ?>
</p>
<ul>
    <li>
		<?php _e( '<b>hard integration</b> - widget is integrated on WP pages, you can only configure it.', 'vkontakte' ); ?>
    </li>
    <li>
		<?php _e( '<b>WP widget</b> - VK widget can we added as WP widget (depends on the theme).', 'vkontakte' ); ?>
    </li>
    <li>
		<?php _e( '<b>WP shortcode</b> - VK widget can we added as WP shortcode in the post content.', 'vkontakte' ); ?>
    </li>
</ul>
<p>
	<?php _e( 'See the links below for details on using a specific widget.', 'vkontakte' ); ?>
</p>

<h2><?php _e( 'Supported widgets', 'vkontakte' ); ?></h2>
<ul>
    <li>
        <a href="<?php echo $current_tab->get_url( array( 'section' => Vkontakte_Admin_Help_Page_Widgets_Tab::SECTION_COMMENTS ) ); ?>">
			<?php _e( 'Comments', 'vkontakte' ); ?>
        </a>
    </li>
    <li>
        <a href="<?php echo $current_tab->get_url( array( 'section' => Vkontakte_Admin_Help_Page_Widgets_Tab::SECTION_LIKE_BUTTON ) ); ?>">
			<?php _e( 'Like button', 'vkontakte' ); ?>
        </a>
    </li>
    <li>
        <a href="<?php echo $current_tab->get_url( array( 'section' => Vkontakte_Admin_Help_Page_Widgets_Tab::SECTION_SHARE_BUTTON ) ); ?>">
			<?php _e( 'Share button', 'vkontakte' ); ?>
        </a>
    </li>
    <li>
        <a href="<?php echo $current_tab->get_url( array( 'section' => Vkontakte_Admin_Help_Page_Widgets_Tab::SECTION_GROUP ) ); ?>">
			<?php _e( 'Group', 'vkontakte' ); ?>
        </a>
    </li>
    <li>
        <a href="<?php echo $current_tab->get_url( array( 'section' => Vkontakte_Admin_Help_Page_Widgets_Tab::SECTION_POLL ) ); ?>">
			<?php _e( 'Poll', 'vkontakte' ); ?>
        </a>
    </li>
    <li>
        <a href="<?php echo $current_tab->get_url( array( 'section' => Vkontakte_Admin_Help_Page_Widgets_Tab::SECTION_RECOMMENDATIONS ) ); ?>">
			<?php _e( 'Recommendations', 'vkontakte' ); ?>
        </a>
    </li>
</ul>
