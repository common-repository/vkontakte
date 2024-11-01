<?php

class Vkontakte_Widget_Group extends Vkontakte_Widget {
	const GROUP_ID = Vkontakte_Api_Widget_Group::ATTR_ID;
	const ELEMENT_ID = Vkontakte_Api_Widget_Group::ATTR_ELEMENT_ID;
	const MODE = Vkontakte_Api_Widget_Group::ATTR_MODE;
	const WIDTH = Vkontakte_Api_Widget_Group::ATTR_WIDTH;
	const HEIGHT = Vkontakte_Api_Widget_Group::ATTR_HEIGHT;
	const COVER = Vkontakte_Api_Widget_Group::ATTR_COVER;
	const WIDE = Vkontakte_Api_Widget_Group::ATTR_WIDE;

	/**
	 * @inerhitDoc
	 */
	public function __construct() {
		parent::__construct(
			'vkontakte_group_widget',
			__( 'VKontakte Group', 'vkontakte' ),
			array(
				'description' => __( 'The widget displays a VKontakte group.', 'vkontakte' ),
			)
		);
	}

	/**
	 * @inerhitDoc
	 */
	public function widget( $args, $instance ) {
		if ( ! empty( $_GET['legacy-widget-preview'] ) ) {
			_e( 'VKontakte Group', 'vkontakte' );

			return;
		}

		$group_id = $instance[ self::GROUP_ID ];

		if ( empty( $group_id ) ) {
			return;
		}

		$element_id = $instance[ self::ELEMENT_ID ] ?: 'vkontakte-widget-group-' . $group_id;
		$widget     = new Vkontakte_Api_Widget_Group(
			$group_id,
			$element_id,
			$instance[ self::MODE ],
			$instance[ self::COVER ],
			$instance[ self::WIDE ]
		);

		if ( ! empty( $instance[ self::WIDTH ] ) ) {
			$widget->set_width( $instance[ self::WIDTH ] );
		}

		if ( ! empty( $instance[ self::HEIGHT ] ) ) {
			$widget->set_height( $instance[ self::HEIGHT ] );
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
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$width = ! isset( $new_instance[ self::WIDTH ] ) ? 0 : (int) trim( $new_instance[ self::WIDTH ] );
		if ( 0 !== $width ) {
			$width = max( $width, 120 );
		}

		$height = ! isset( $new_instance[ self::HEIGHT ] ) ? 0 : (int) trim( $new_instance[ self::HEIGHT ] );
		if ( 0 !== $height ) {
			$height = min( max( $height, 200 ), 1200 );
		}

		$instance[ self::GROUP_ID ]   = trim( $new_instance[ self::GROUP_ID ] );
		$instance[ self::ELEMENT_ID ] = trim( $new_instance[ self::ELEMENT_ID ] );
		$instance[ self::MODE ]       = trim( $new_instance[ self::MODE ] );
		$instance[ self::WIDTH ]      = (int) $width;
		$instance[ self::HEIGHT ]     = (int) $height;
		$instance[ self::COVER ]      = (int) $new_instance[ self::COVER ];
		$instance[ self::WIDE ]       = (int) $new_instance[ self::WIDE ];

		return $instance;
	}

	/**
	 * @inerhitDoc
	 */
	public function form( $instance ) {
		$defaults   = array(
			self::MODE   => Vkontakte_Api_Widget_Group::DEFAULT_MODE,
			self::COVER  => 0,
			self::WIDE   => 0,
			self::WIDTH  => 0,
			self::HEIGHT => 0,
		);
		$instance   = wp_parse_args( (array) $instance, $defaults );
		$attributes = Vkontakte_Api_Widget_Group::get_attributes();

		$fields = array(
			array(
				'type'        => Vkontakte_Admin_Form::FIELD_TEXT,
				'label'       => $attributes[ self::GROUP_ID ]['label'],
				'id'          => $this->get_field_id( self::GROUP_ID ),
				'name'        => $this->get_field_name( self::GROUP_ID ),
				'value'       => $instance[ self::GROUP_ID ],
				'description' => $attributes[ self::GROUP_ID ]['description'],
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
				'type'        => Vkontakte_Admin_Form::FIELD_SELECT,
				'label'       => $attributes[ self::MODE ]['label'],
				'id'          => $this->get_field_id( self::MODE ),
				'name'        => $this->get_field_name( self::MODE ),
				'value'       => $instance[ self::MODE ],
				'options'     => Vkontakte_Api_Widget_Group::get_mode_labels(),
				'description' => $attributes[ self::MODE ]['description'],
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
				'label'       => $attributes[ self::HEIGHT ]['label'],
				'id'          => $this->get_field_id( self::HEIGHT ),
				'name'        => $this->get_field_name( self::HEIGHT ),
				'value'       => $instance[ self::HEIGHT ],
				'description' => $attributes[ self::HEIGHT ]['description'],
			),
			array(
				'type'         => Vkontakte_Admin_Form::FIELD_CHECKBOX,
				'label'        => $attributes[ self::COVER ]['label'],
				'inline_label' => true,
				'id'           => $this->get_field_id( self::COVER ),
				'name'         => $this->get_field_name( self::COVER ),
				'value'        => $instance[ self::COVER ],
				'description'  => $attributes[ self::COVER ]['description'],
			),
			array(
				'type'         => Vkontakte_Admin_Form::FIELD_CHECKBOX,
				'label'        => $attributes[ self::WIDE ]['label'],
				'inline_label' => true,
				'id'           => $this->get_field_id( self::WIDE ),
				'name'         => $this->get_field_name( self::WIDE ),
				'value'        => $instance[ self::WIDE ],
				'description'  => $attributes[ self::WIDE ]['description'],
			),
		);

		$this->renderForm( $instance, $fields );
	}
}
