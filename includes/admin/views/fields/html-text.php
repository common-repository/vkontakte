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
?>
<input type="<?php echo esc_attr( $type ); ?>"
	   name="<?php echo esc_attr( $name ); ?>"
	   <?php if ( $id ): ?>id="<?php echo esc_attr( $id ); ?>"<?php endif; ?>
	   <?php if ( $css ): ?>style="<?php echo esc_attr( $css ); ?>"<?php endif; ?>
	   <?php if ( strlen($value) ): ?>value="<?php echo esc_attr( $value ); ?>"<?php endif; ?>
	   <?php if ( $class ): ?>class="<?php echo esc_attr( $class ); ?>"<?php endif; ?>
	   <?php if ( $placeholder ): ?>placeholder="<?php echo esc_attr( $placeholder ); ?>"<?php endif; ?>
		<?php if ( $attributes ): ?><?php echo implode( ' ', $attributes ); ?><?php endif; ?>
/>
<?php if ( $description ): ?>
	<p class="description">
		<?php echo wp_kses_post( $description ); ?>
	</p>
<?php endif; ?>
