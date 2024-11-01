<?php

abstract class Vkontakte_Widget extends WP_Widget {
	/**
	 * @param string $template
	 * @param array $args
	 *
	 * @return void
	 */
	protected function render( $template, $args = array() ) {
		extract( $args );

		$widget = $this;

		require $template;
	}

	/**
	 * @param array $args
	 *
	 * @return void
	 */
	protected function render_widget( $args = array() ) {
		$this->render(
			__DIR__ . '/views/widget.phtml',
			$args
		);
	}

	/**
	 * @param array $instance
	 * @param array $fields
	 *
	 * @return void
	 */
	protected function renderForm( $instance, $fields ) {
		$this->render(
			__DIR__ . '/views/form.phtml',
			array(
				'instance' => $instance,
				'fields'   => $fields,
			)
		);
	}
}
