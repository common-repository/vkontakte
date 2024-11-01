<?php
/**
 * @var string $type
 * @var string $name
 * @var string $label
 * @var string $id
 * @var string $class
 * @var string $css
 * @var string $description
 * @var string $placeholder
 * @var mixed $value
 * @var array $attributes
 */

if ( empty( $options ) || ! is_array( $options ) ) {
	$options = array();
}
?>

<fieldset>
	<?php if ( $description ): ?>
		<p class="description">
			<?php echo wp_kses_post( $description ); ?>
		</p>
	<?php endif; ?>

	<ul>
		<?php foreach ( $options as $key => $val ): ?>
			<li>
				<label>
					<input type="radio"
						   name="<?php echo esc_attr( $name ); ?>"
						   value="<?php echo esc_attr( $key ); ?>"
						   <?php if ( $css ): ?>style="<?php echo esc_attr( $css ); ?>"<?php endif; ?>
						   <?php if ( $class ): ?>class="<?php echo esc_attr( $class ); ?>"<?php endif; ?>
							<?php if ( $attributes ): ?><?php echo implode( ' ', $attributes ); ?><?php endif; ?>
							<?php checked( $key, $value ); ?>
					/> <?php echo esc_html( $val ); ?></label>
			</li>
		<?php endforeach; ?>
	</ul>
</fieldset>
