<?php

class Vkontakte_Api_Widget_Recommendations extends Vkontakte_Api_Widget {
	const ATTR_ELEMENT_ID = 'element_id';
	const ATTR_LIMIT = 'limit';
	const ATTR_MAX = 'max';
	const ATTR_PERIOD = 'period';
	const ATTR_VERB = 'verb';
	const ATTR_SORT = 'sort';
	const ATTR_TARGET = 'target';

	const PERIOD_DAY = 'day';
	const PERIOD_WEEK = 'week';
	const PERIOD_MONTH = 'month';
	const PERIODS = [
		self::PERIOD_DAY,
		self::PERIOD_WEEK,
		self::PERIOD_MONTH,
	];

	const API_VERB_LIKE = 0;
	const API_VERB_INTERESTING = 1;
	const VERB_LIKE = 'liked';
	const VERB_INTERESTING = 'interesting';
	const VERBS_MAPPING = [
		self::VERB_LIKE        => self::API_VERB_LIKE,
		self::VERB_INTERESTING => self::API_VERB_INTERESTING,
	];

	const SORT_FRIEND_LIKES = 'friend_likes';
	const SORT_LIKES = 'likes';
	const SORTS = [
		self::SORT_FRIEND_LIKES,
		self::SORT_LIKES,
	];

	const TARGET_BLANK = 'blank';
	const TARGET_PARENT = 'parent';
	const TARGETS = [
		self::TARGET_BLANK,
		self::TARGET_PARENT,
	];

	const DEFAULT_LIMIT = 4;
	const DEFAULT_MAX = 20;
	const DEFAULT_PERIOD = self::PERIOD_WEEK;
	const DEFAULT_VERB = self::VERB_LIKE;
	const DEFAULT_SORT = self::SORT_FRIEND_LIKES;
	const DEFAULT_TARGET = self::TARGET_PARENT;

	/**
	 * @var string
	 */
	private $element_id;

	/**
	 * @var int
	 */
	private $limit;

	/**
	 * @var int
	 */
	private $max;

	/**
	 * @var string
	 */
	private $period;

	/**
	 * @var int
	 */
	private $verb;

	/**
	 * @var string
	 */
	private $sort;

	/**
	 * @var string
	 */
	private $target;

	/**
	 * @param string $element_id
	 * @param int $limit
	 * @param int $max
	 * @param string $period
	 * @param int $verb
	 * @param string $sort
	 * @param string $target
	 */
	public function __construct(
		$element_id,
		$limit = self::DEFAULT_LIMIT,
		$max = self::DEFAULT_MAX,
		$period = self::DEFAULT_PERIOD,
		$verb = self::DEFAULT_VERB,
		$sort = self::DEFAULT_SORT,
		$target = self::DEFAULT_TARGET
	) {
		$limit = $this->get_int( $limit, self::DEFAULT_LIMIT );
		$max   = $this->get_int( $max, self::DEFAULT_MAX );

		$this->element_id = $this->get_non_empty_string( $element_id, 'vkontakte-poll' );
		$this->limit      = $limit > 0 ? $limit : self::DEFAULT_LIMIT;
		$this->max        = $max > 0 ? $max : self::DEFAULT_MAX;
		$this->period     = $this->get_value_from_allowed_list(
			$this->get_non_empty_string( $period ),
			self::PERIODS,
			self::DEFAULT_PERIOD
		);
		$this->verb       = $this->get_value_from_allowed_list(
			$this->get_non_empty_string( $verb ),
			array_keys( self::VERBS_MAPPING ),
			self::DEFAULT_VERB
		);
		$this->sort       = $this->get_value_from_allowed_list(
			$this->get_non_empty_string( $sort ),
			self::SORTS,
			self::DEFAULT_SORT
		);
		$this->target     = $this->get_value_from_allowed_list(
			$this->get_non_empty_string( $target ),
			self::TARGETS,
			self::DEFAULT_TARGET
		);
	}

	/**
	 * @return array
	 */
	public static function get_period_labels() {
		return array(
			self::PERIOD_MONTH => __( 'month', 'vkontakte' ),
			self::PERIOD_WEEK  => __( 'week', 'vkontakte' ),
			self::PERIOD_DAY   => __( 'day', 'vkontakte' ),
		);
	}


	/**
	 * @return array
	 */
	public static function get_verb_labels() {
		return array(
			self::VERB_LIKE        => __( 'Liked', 'vkontakte' ),
			self::VERB_INTERESTING => __( 'Interesting', 'vkontakte' ),
		);
	}


	/**
	 * @return array
	 */
	public static function get_sort_labels() {
		return array(
			self::SORT_FRIEND_LIKES => __( 'friends likes', 'vkontakte' ),
			self::SORT_LIKES        => __( 'all likes', 'vkontakte' ),
		);
	}


	/**
	 * @return array
	 */
	public static function get_target_labels() {
		return array(
			self::TARGET_PARENT => __( 'the same tab', 'vkontakte' ),
			self::TARGET_BLANK  => __( 'new tab', 'vkontakte' ),
		);
	}

	/**
	 * @inerhitDoc
	 */
	public static function get_attributes() {
		$verb_options = array();
		foreach ( self::get_verb_labels() as $value => $label ) {
			$verb_options[] = sprintf( '<b>%s</b> - %s', $value, $label );
		}
		$verb_options = implode( ', ', $verb_options );

		$sort_options = array();
		foreach ( self::get_sort_labels() as $value => $label ) {
			$sort_options[] = sprintf( '<b>%s</b> - %s', $value, $label );
		}
		$sort_options = implode( ', ', $sort_options );

		$target_options = array();
		foreach ( self::get_target_labels() as $value => $label ) {
			$target_options[] = sprintf( '<b>%s</b> - %s', $value, $label );
		}
		$target_options = implode( ', ', $target_options );

		return array(
			static::ATTR_ELEMENT_ID => array(
				'label'       => __( 'Element ID', 'vkontakte' ),
				'description' => __( 'ID of html element, required in case if a few recommendations widgets are added on the same page.', 'vkontakte' ),
			),
			static::ATTR_LIMIT      => array(
				'label'       => __( 'Initial number of recommendations', 'vkontakte' ),
				'description' => __( 'The number of recommendations to show after the widget rendering.', 'vkontakte' ),
			),
			static::ATTR_MAX        => array(
				'label'       => __( 'Maximal number of recommendations', 'vkontakte' ),
				'description' => __( 'The maximal number of recommendations to load after click on button "Show all".', 'vkontakte' ),
			),
			static::ATTR_PERIOD     => array(
				'label'       => __( 'Period', 'vkontakte' ),
				'description' => __( 'A length of reporting period for statistics.', 'vkontakte' ),
			),
			static::ATTR_VERB       => array(
				'label'       => __( 'Text inside block', 'vkontakte' ),
				'description' => __( 'The text inside a widget block.', 'vkontakte' ),
			),
			static::ATTR_SORT       => array(
				'label'       => __( 'Order by', 'vkontakte' ),
				'description' => __( 'A recommendations sorting method.', 'vkontakte' ),
			),
			static::ATTR_TARGET     => array(
				'label'       => __( 'Open recommendation in', 'vkontakte' ),
				'description' => __( 'Specifies how to open pages.', 'vkontakte' ),
			),
		);
	}

	/**
	 * @inerhitDoc
	 */
	protected function get_template_path() {
		return __DIR__ . '/views/recommendations.html';
	}

	/**
	 * @inerhitDoc
	 */
	protected function get_placeholders() {
		return array(
			'{ELEMENT_ID}',
			'{WIDGET_OPTIONS}',
		);
	}

	/**
	 * @inerhitDoc
	 */
	protected function get_values() {
		return array(
			$this->element_id,
			json_encode( array(
				'limit'  => $this->limit,
				'max'    => $this->max,
				'period' => $this->period,
				'verb'   => $this->api_verb(),
				'sort'   => $this->sort,
				'target' => $this->target,
			) ),
		);
	}


	/**
	 * @return int
	 */
	private function api_verb() {
		if ( array_key_exists( $this->verb, self::VERBS_MAPPING ) ) {
			return self::VERBS_MAPPING[ $this->verb ];
		}

		return self::API_VERB_LIKE;
	}
}
