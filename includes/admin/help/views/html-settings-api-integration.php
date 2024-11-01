<?php
/**
 * @var Vkontakte_Admin_Page_Tab $current_tab
 */
?>
<h2><?php _e( 'Basic integration settings', 'vkontakte' ); ?></h2>
<p>
	<?php _e( 'To interact with the Vkontakte API, you need only an <strong>application ID</strong>.', 'vkontakte' ); ?>
</p>

<p>
	<?php _e( '<strong>Application ID</strong> - ID of VKontakte application. Since the application was created, this value never changes.', 'vkontakte' ); ?>
</p>

<h2><?php _e( 'Configuration process', 'vkontakte' ); ?></h2>
<ol>
	<li>
		<?php _e( 'Create a new (or edit existing) VKontakte application with next parameters:', 'vkontakte' ); ?><br/><br/>
		<ul>
			<li><?php echo sprintf( __( 'Website address: <strong>%s</strong>', 'vkontakte' ), esc_url( site_url() ) ); ?></li>
			<li><?php echo sprintf( __( 'Base domain: <strong>%s</strong>', 'vkontakte' ), parse_url( esc_url( site_url() ), PHP_URL_HOST ) ); ?></li>
		</ul>
		<br/>
	</li>
	<li><?php _e( 'Enter the <strong>application ID</strong> and save settings.', 'vkontakte' ); ?></li>
</ol>
