<?php
/**
 * @var Vkontakte_Admin_Page_Tab $current_tab
 */
$shortcode  = Vkontakte_Frontend_Shortcode_Group::get_code();
$attributes = Vkontakte_Frontend_Shortcode_Group::get_attributes();
?>
<h2><?php _e( 'Usage', 'vkontakte' ); ?></h2>
<ul>
    <li><?php echo sprintf( __( 'Hard integration: %s', 'vkontakte' ), __( 'no', 'vkontakte' ) ); ?></li>
    <li><?php echo sprintf( __( 'WP widget: %s', 'vkontakte' ), __( 'yes', 'vkontakte' ) ); ?></li>
    <li><?php echo sprintf( __( 'WP shortcode: %s', 'vkontakte' ), __( 'yes', 'vkontakte' ) ); ?></li>
</ul>
<p>
	<?php _e( 'A group can be added as WP widget (depends on the theme).', 'vkontakte' ); ?>
	<?php echo sprintf( __( 'Also you can use a shortcode %s to add the group in the content.', 'vkontakte' ), sprintf( '<b>[%s]</b>', $shortcode ) ); ?>
</p>

<h3><?php _e( 'Shortcode parameters:', 'vkontakte' ); ?></h3>
<ul>
	<?php foreach ( $attributes as $attr_id => $attr_data ): ?>
        <li>
            <b><?php echo esc_html( $attr_id ); ?></b> -
			<?php if ( ! empty( $attr_data['required'] ) ): ?>
                <i>(<?php _e( 'required parameter', 'vkontakte' ); ?>)</i>
			<?php endif; ?>
			<?php echo $attr_data['description']; ?>
			<?php if ( ! empty( $attr_data['extra_description'] ) ): ?>
				<?php echo $attr_data['extra_description']; ?>
			<?php endif; ?>
        </li>
	<?php endforeach; ?>
</ul>

<h3><?php _e( 'Example of shortcode:', 'vkontakte' ); ?></h3>
<code>
    [<?php echo $shortcode; ?> id='group_id_value' element_id='custom_element_id' mode='name' width='0' height='0' cover='0' wide='0']
</code>
