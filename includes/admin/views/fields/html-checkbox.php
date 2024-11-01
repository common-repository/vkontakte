<?php
/**
 * @var string $type
 * @var string $name
 * @var string $label
 * @var string $inline_label
 * @var string $id
 * @var string $class
 * @var string $css
 * @var string $description
 * @var string $placeholder
 * @var mixed $value
 * @var array $attributes
 * @var string $visibility_class
 */
?>

<label<?php if ( $id ): ?> for="<?php echo esc_attr( $id ); ?>"<?php endif; ?>>
	<input type="checkbox"
		   name="<?php echo esc_attr( $name ); ?>"
		   <?php if ( $id ): ?>id="<?php echo esc_attr( $id ); ?>"<?php endif; ?>
		   <?php if ( $class ): ?>class="<?php echo esc_attr( $class ); ?>"<?php endif; ?>
		   value="1"
		<?php checked( $value ); ?>
		<?php if ( $attributes ): ?><?php echo implode( ' ', $attributes ); ?><?php endif; ?>
	/>
	<?php if ( $inline_label && $label ): ?>
		<?php echo esc_html( $label ); ?>
	<?php endif; ?>
	<?php if ( $description ): ?>
		<p class="description">
			<?php echo esc_html( $description ); ?>
		</p>
	<?php endif; ?>
</label>
