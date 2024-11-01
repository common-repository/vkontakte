<?php

class Vkontakte_Frontend_Shortcode_Recommendations extends Vkontakte_Frontend_Shortcode_Abstract {
	const ELEMENT_ID = Vkontakte_Api_Widget_Recommendations::ATTR_ELEMENT_ID;
	const LIMIT = Vkontakte_Api_Widget_Recommendations::ATTR_LIMIT;
	const MAX = Vkontakte_Api_Widget_Recommendations::ATTR_MAX;
	const PERIOD = Vkontakte_Api_Widget_Recommendations::ATTR_PERIOD;
	const VERB = Vkontakte_Api_Widget_Recommendations::ATTR_VERB;
	const SORT = Vkontakte_Api_Widget_Recommendations::ATTR_SORT;
	const TARGET = Vkontakte_Api_Widget_Recommendations::ATTR_TARGET;

	/**
	 * @inerhitDoc
	 */
	public static function get_code() {
		return 'vkrecommendations';
	}

	/**
	 * @inerhitDoc
	 */
	public static function get_attributes() {
		$attributes = Vkontakte_Api_Widget_Recommendations::get_attributes();

		$attributes[ self::LIMIT ]['description'] = sprintf(
			__( '%s <b>%s</b> by default.', 'vkontakte' ),
			$attributes[ self::LIMIT ]['description'],
			Vkontakte_Api_Widget_Recommendations::DEFAULT_LIMIT
		);

		$attributes[ self::MAX ]['description'] = sprintf(
			__( '%s <b>%s</b> by default.', 'vkontakte' ),
			$attributes[ self::MAX ]['description'],
			Vkontakte_Api_Widget_Recommendations::DEFAULT_MAX
		);

		$attributes[ self::PERIOD ]['description'] = sprintf(
			__( '%s <b>%s</b> by default, available options: %s.', 'vkontakte' ),
			$attributes[ self::PERIOD ]['description'],
			Vkontakte_Api_Widget_Recommendations::DEFAULT_PERIOD,
			self::stringify_options( Vkontakte_Api_Widget_Recommendations::get_period_labels() )
		);

		$attributes[ self::VERB ]['description'] = sprintf(
			__( '%s <b>%s</b> by default, available options: %s.', 'vkontakte' ),
			$attributes[ self::VERB ]['description'],
			Vkontakte_Api_Widget_Recommendations::DEFAULT_VERB,
			self::stringify_options( Vkontakte_Api_Widget_Recommendations::get_verb_labels() )
		);

		$attributes[ self::SORT ]['description'] = sprintf(
			__( '%s <b>%s</b> by default, available options: %s.', 'vkontakte' ),
			$attributes[ self::SORT ]['description'],
			Vkontakte_Api_Widget_Recommendations::DEFAULT_SORT,
			self::stringify_options( Vkontakte_Api_Widget_Recommendations::get_sort_labels() )
		);

		$attributes[ self::TARGET ]['description'] = sprintf(
			__( '%s <b>%s</b> by default, available options: %s.', 'vkontakte' ),
			$attributes[ self::TARGET ]['description'],
			Vkontakte_Api_Widget_Recommendations::DEFAULT_TARGET,
			self::stringify_options( Vkontakte_Api_Widget_Recommendations::get_target_labels() )
		);

		return $attributes;
	}

	/**
	 * @inerhitDoc
	 */
	public function to_html() {
		$element_id = $this->get_non_empty_attr( self::ELEMENT_ID, 'vkontakte-shortcode-recommendations' );
		$limit      = $this->get_non_empty_attr( self::LIMIT, 4 );
		$max        = $this->get_non_empty_attr( self::MAX, 20 );
		$period     = $this->get_non_empty_attr( self::PERIOD, Vkontakte_Api_Widget_Recommendations::PERIOD_WEEK );
		$verb       = $this->get_non_empty_attr( self::VERB, Vkontakte_Api_Widget_Recommendations::VERB_LIKE );
		$sort       = $this->get_non_empty_attr( self::SORT, Vkontakte_Api_Widget_Recommendations::SORT_FRIEND_LIKES );
		$target     = $this->get_non_empty_attr( self::TARGET, Vkontakte_Api_Widget_Recommendations::TARGET_PARENT );

		$widget = new Vkontakte_Api_Widget_Recommendations(
			$element_id,
			$limit,
			$max,
			$period,
			$verb,
			$sort,
			$target
		);

		return $widget->to_html();
	}
}
