<?php

class Vkontakte_Widget_Recommendations extends Vkontakte_Widget {
	const ELEMENT_ID = Vkontakte_Api_Widget_Recommendations::ATTR_ELEMENT_ID;
	const LIMIT = Vkontakte_Api_Widget_Recommendations::ATTR_LIMIT;
	const MAX = Vkontakte_Api_Widget_Recommendations::ATTR_MAX;
	const PERIOD = Vkontakte_Api_Widget_Recommendations::ATTR_PERIOD;
	const VERB = Vkontakte_Api_Widget_Recommendations::ATTR_VERB;
	const SORT = Vkontakte_Api_Widget_Recommendations::ATTR_SORT;
	const TARGET = Vkontakte_Api_Widget_Recommendations::ATTR_TARGET;

	public function __construct() {
		parent::__construct(
			'vkontakte_recommendations_widget',
			__( 'VKontakte Recommendations', 'vkontakte' ),
			array(
				'description' => __( 'The widget displays a dynamic block with the most popular content.', 'vkontakte' ),
			)
		);
	}

	function widget( $args, $instance ) {
		if ( ! empty( $_GET['legacy-widget-preview'] ) ) {
			_e( 'VKontakte Recommendations', 'vkontakte' );

			return;
		}

		$element_id = $instance[ self::ELEMENT_ID ] ?: 'vkontakte-widget-recommendations';
		$widget     = new Vkontakte_Api_Widget_Recommendations(
			$element_id,
			$instance[ self::LIMIT ],
			$instance[ self::MAX ],
			$instance[ self::PERIOD ],
			$instance[ self::VERB ],
			$instance[ self::SORT ],
			$instance[ self::TARGET ]
		);

		$this->render_widget(
			array(
				'before_widget_html' => $args['before_widget'],
				'widget_html'        => $widget->to_html(),
				'after_widget_html'  => $args['after_widget'],
			)
		);
	}

	function update( $new_instance, $old_instance ) {
		$instance = array();

		$limit = trim( $new_instance[ self::LIMIT ] );
		$limit = ( is_numeric( $limit ) & (int) $limit > 0 )
			? (int) $limit
			: Vkontakte_Api_Widget_Recommendations::DEFAULT_LIMIT;
		$max   = trim( $new_instance[ self::MAX ] );
		$max   = ( is_numeric( $max ) & (int) $max > 0 )
			? (int) $max
			: Vkontakte_Api_Widget_Recommendations::DEFAULT_MAX;

		$instance[ self::ELEMENT_ID ] = trim( $new_instance[ self::ELEMENT_ID ] );
		$instance[ self::LIMIT ]      = $limit;
		$instance[ self::MAX ]        = $max;
		$instance[ self::PERIOD ]     = trim( $new_instance[ self::PERIOD ] );
		$instance[ self::VERB ]       = trim( $new_instance[ self::VERB ] );
		$instance[ self::SORT ]       = trim( $new_instance[ self::SORT ] );
		$instance[ self::TARGET ]     = trim( $new_instance[ self::TARGET ] );

		return $instance;
	}

	function form( $instance ) {
		$defaults   = array(
			self::LIMIT  => Vkontakte_Api_Widget_Recommendations::DEFAULT_LIMIT,
			self::MAX    => Vkontakte_Api_Widget_Recommendations::DEFAULT_MAX,
			self::PERIOD => Vkontakte_Api_Widget_Recommendations::PERIOD_WEEK,
			self::VERB   => Vkontakte_Api_Widget_Recommendations::VERB_LIKE,
			self::SORT   => Vkontakte_Api_Widget_Recommendations::SORT_FRIEND_LIKES,
			self::TARGET => Vkontakte_Api_Widget_Recommendations::TARGET_PARENT,
		);
		$instance   = wp_parse_args( (array) $instance, $defaults );
		$attributes = Vkontakte_Api_Widget_Recommendations::get_attributes();

		$fields = array(
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
				'label'       => $attributes[ self::LIMIT ]['label'],
				'id'          => $this->get_field_id( self::LIMIT ),
				'name'        => $this->get_field_name( self::LIMIT ),
				'value'       => $instance[ self::LIMIT ],
				'description' => $attributes[ self::LIMIT ]['description'],
			),
			array(
				'type'        => Vkontakte_Admin_Form::FIELD_TEXT,
				'label'       => $attributes[ self::MAX ]['label'],
				'id'          => $this->get_field_id( self::MAX ),
				'name'        => $this->get_field_name( self::MAX ),
				'value'       => $instance[ self::MAX ],
				'description' => $attributes[ self::MAX ]['description'],
			),
			array(
				'type'        => Vkontakte_Admin_Form::FIELD_SELECT,
				'label'       => $attributes[ self::PERIOD ]['label'],
				'id'          => $this->get_field_id( self::PERIOD ),
				'name'        => $this->get_field_name( self::PERIOD ),
				'value'       => $instance[ self::PERIOD ],
				'options'     => Vkontakte_Api_Widget_Recommendations::get_period_labels(),
				'description' => $attributes[ self::PERIOD ]['description'],
			),
			array(
				'type'        => Vkontakte_Admin_Form::FIELD_SELECT,
				'label'       => $attributes[ self::VERB ]['label'],
				'id'          => $this->get_field_id( self::VERB ),
				'name'        => $this->get_field_name( self::VERB ),
				'value'       => $instance[ self::VERB ],
				'options'     => Vkontakte_Api_Widget_Recommendations::get_verb_labels(),
				'description' => $attributes[ self::VERB ]['description'],
			),
			array(
				'type'        => Vkontakte_Admin_Form::FIELD_SELECT,
				'label'       => $attributes[ self::SORT ]['label'],
				'id'          => $this->get_field_id( self::SORT ),
				'name'        => $this->get_field_name( self::SORT ),
				'value'       => $instance[ self::SORT ],
				'options'     => Vkontakte_Api_Widget_Recommendations::get_sort_labels(),
				'description' => $attributes[ self::SORT ]['description'],
			),
			array(
				'type'        => Vkontakte_Admin_Form::FIELD_SELECT,
				'label'       => $attributes[ self::TARGET ]['label'],
				'id'          => $this->get_field_id( self::TARGET ),
				'name'        => $this->get_field_name( self::TARGET ),
				'value'       => $instance[ self::TARGET ],
				'options'     => Vkontakte_Api_Widget_Recommendations::get_target_labels(),
				'description' => $attributes[ self::TARGET ]['description'],
			),
		);

		$this->renderForm( $instance, $fields );
	}
}
