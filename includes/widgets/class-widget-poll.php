<?php

class Vkontakte_Widget_Poll extends Vkontakte_Widget {
	const POLL_ID = Vkontakte_Api_Widget_Poll::ATTR_ID;
	const ELEMENT_ID = Vkontakte_Api_Widget_Poll::ATTR_ELEMENT_ID;
	const WIDTH = Vkontakte_Api_Widget_Poll::ATTR_WIDTH;
	const PAGE_URL = Vkontakte_Api_Widget_Poll::ATTR_PAGE_URL;

	/**
	 * @inerhitDoc
	 */
	public function __construct() {
		parent::__construct(
			'vkontakte_poll_widget',
			__( 'VKontakte Poll', 'vkontakte' ),
			array(
				'description' => __( 'The widget displays a VKontakte poll.', 'vkontakte' )
			)
		);
	}

	/**
	 * @inerhitDoc
	 */
	function widget( $args, $instance ) {
		if ( ! empty( $_GET['legacy-widget-preview'] ) ) {
			_e( 'VKontakte Poll', 'vkontakte' );

			return;
		}

		$poll_id = $instance[ self::POLL_ID ];

		if ( empty( $poll_id ) ) {
			return;
		}

		$element_id = $instance[ self::ELEMENT_ID ] ?: 'vkontakte-widget-poll-' . $poll_id;
		$widget     = new Vkontakte_Api_Widget_Poll( $poll_id, $element_id );

		if ( ! empty( $instance[ self::WIDTH ] ) ) {
			$widget->set_width( $instance[ self::WIDTH ] );
		}

		if ( ! empty( $instance[ self::PAGE_URL ] ) ) {
			$widget->set_page_url( $instance[ self::PAGE_URL ] );
		}

		$this->render_widget(
			array(
				'before_widget_html' => $args['before_widget'],
				'widget_html'        => $widget->to_html(),
				'after_widget_html'  => $args['after_widget'],
			)
		);
	}

	/**
	 * @inerhitDoc
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();

		$width = ! isset( $new_instance[ self::WIDTH ] ) ? 0 : (int) trim( $new_instance[ self::WIDTH ] );
		if ( 0 !== $width ) {
			$width = max( $width, 300 );
		}

		$instance[ self::POLL_ID ]    = trim( $new_instance[ self::POLL_ID ] );
		$instance[ self::ELEMENT_ID ] = trim( $new_instance[ self::ELEMENT_ID ] );
		$instance[ self::WIDTH ]      = (int) $width;
		$instance[ self::PAGE_URL ]   = trim( $new_instance[ self::PAGE_URL ] );

		return $instance;
	}

	/**
	 * @inerhitDoc
	 */
	function form( $instance ) {
		$defaults   = array(
			self::WIDTH => 0,
		);
		$instance   = wp_parse_args( (array) $instance, $defaults );
		$attributes = Vkontakte_Api_Widget_Poll::get_attributes();

		$fields = array(
			array(
				'type'        => Vkontakte_Admin_Form::FIELD_TEXT,
				'label'       => $attributes[ self::POLL_ID ]['label'],
				'id'          => $this->get_field_id( self::POLL_ID ),
				'name'        => $this->get_field_name( self::POLL_ID ),
				'value'       => $instance[ self::POLL_ID ],
				'description' => $attributes[ self::POLL_ID ]['description'],
			),
			array(
				'type'        => Vkontakte_Admin_Form::FIELD_TEXT,
				'label'       => $attributes[ self::ELEMENT_ID ]['label'],
				'id'          => $this->get_field_id( self::ELEMENT_ID ),
				'name'        => $this->get_field_name( self::ELEMENT_ID ),
				'value'       => $instance[ self::ELEMENT_ID ],
				'description' => $attributes[ self::ELEMENT_ID ]['description'],
			),
			array(
				'type'        => Vkontakte_Admin_Form::FIELD_TEXT,
				'label'       => $attributes[ self::WIDTH ]['label'],
				'id'          => $this->get_field_id( self::WIDTH ),
				'name'        => $this->get_field_name( self::WIDTH ),
				'value'       => $instance[ self::WIDTH ],
				'description' => $attributes[ self::WIDTH ]['description'],
			),
			array(
				'type'        => Vkontakte_Admin_Form::FIELD_TEXT,
				'label'       => $attributes[ self::PAGE_URL ]['label'],
				'id'          => $this->get_field_id( self::PAGE_URL ),
				'name'        => $this->get_field_name( self::PAGE_URL ),
				'value'       => $instance[ self::PAGE_URL ],
				'description' => $attributes[ self::PAGE_URL ]['description'],
			),
		);

		$this->renderForm( $instance, $fields );
	}
}
