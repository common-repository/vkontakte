<?php

class Vkontakte_Api_Widget_Group extends Vkontakte_Api_Widget {
	const ATTR_ID = 'id';
	const ATTR_ELEMENT_ID = 'element_id';
	const ATTR_MODE = 'mode';
	const ATTR_COVER = 'cover';
	const ATTR_WIDE = 'wide';
	const ATTR_WIDTH = 'width';
	const ATTR_HEIGHT = 'height';

	const MODE_NAME = 'name';
	const MODE_MEMBERS = 'members';
	const MODE_WALL = 'wall';
	const API_MODE_NAME = 1;
	const API_MODE_MEMBERS = 3;
	const API_MODE_WALL = 4;
	const MODES_MAPPING = [
		self::MODE_NAME    => self::API_MODE_NAME,
		self::MODE_MEMBERS => self::API_MODE_MEMBERS,
		self::MODE_WALL    => self::API_MODE_WALL,
	];

	const MIN_WIDTH = 120;
	const MIN_HEIGHT = 200;
	const MAX_HEIGHT = 1200;

	const DEFAULT_MODE = self::MODE_NAME;

	/**
	 * @var string
	 */
	private $group_id;

	/**
	 * @var string
	 */
	private $element_id;

	/**
	 * @var int
	 */
	private $mode;

	/**
	 * @var bool
	 */
	private $cover;

	/**
	 * @var bool
	 */
	private $wide;

	/**
	 * @var int|null
	 */
	private $width;

	/**
	 * @var int|null
	 */
	private $height;

	/**
	 * @param string|mixed $group_id
	 * @param string|mixed $element_id
	 * @param int|mixed $mode
	 * @param bool|mixed $cover
	 * @param bool|mixed $wide
	 */
	public function __construct( $group_id, $element_id, $mode = self::DEFAULT_MODE, $cover = false, $wide = false ) {
		$this->group_id   = $this->get_non_empty_string( $group_id );
		$this->element_id = $this->get_non_empty_string( $element_id, 'vkontakte-poll' );
		$this->mode       = $this->get_value_from_allowed_list(
			$this->get_non_empty_string( $mode ),
			array_keys( self::MODES_MAPPING ),
			self::DEFAULT_MODE
		);
		$this->cover      = $this->get_boolean_value( $cover );
		$this->wide       = $this->get_boolean_value( $wide );
	}

	/**
	 * @param int|mixed $width
	 */
	public function set_width( $width ) {
		if ( is_string( $width ) ) {
			$width = trim( $width );
		}

		if ( is_numeric( $width ) ) {
			$width = (int) $width;

			if ( 0 != $width ) {
				$this->width = max( $width, self::MIN_WIDTH );
			}
		}
	}

	/**
	 * @param int|mixed $height
	 */
	public function set_height( $height ) {
		if ( is_string( $height ) ) {
			$height = trim( $height );
		}

		if ( is_numeric( $height ) ) {
			$height = (int) $height;

			if ( 0 != $height ) {
				$this->height = min( max( $height, self::MIN_HEIGHT ), self::MAX_HEIGHT );
			}
		}
	}

	/**
	 * @return array
	 */
	public static function get_mode_labels() {
		return array(
			self::MODE_NAME    => __( 'group name only', 'vkontakte' ),
			self::MODE_MEMBERS => __( 'group members', 'vkontakte' ),
			self::MODE_WALL    => __( 'group wall', 'vkontakte' ),
		);
	}

	/**
	 * @inerhitDoc
	 */
	public static function get_attributes() {
		return array(
			self::ATTR_ID         => array(
				'label'             => __( 'Group ID', 'vkontakte' ),
				'description'       => __( 'ID of VKontakte group.', 'vkontakte' ),
				'extra_description' => __( 'The group ID is the digits in the group url address. For example, for the group <i>https://vk.com/club<b>3695188</b></i> the identifier is <b>3695188</b>.', 'vkontakte' ),
				'required'          => true,
			),
			self::ATTR_ELEMENT_ID => array(
				'label'       => __( 'Element ID', 'vkontakte' ),
				'description' => __( 'ID of html element, required in case if a few group widgets are added on the same page.', 'vkontakte' ),
			),
			self::ATTR_MODE       => array(
				'label'       => __( 'Display mode', 'vkontakte' ),
				'description' => __( 'Specifies how to display the widget.', 'vkontakte' ),
			),
			self::ATTR_WIDTH      => array(
				'label'       => __( 'Width', 'vkontakte' ),
				'description' => __( 'The widget width, minimal value is 120, 0 - maximal available width.', 'vkontakte' ),
			),
			self::ATTR_HEIGHT     => array(
				'label'       => __( 'Height', 'vkontakte' ),
				'description' => __( 'The widget height, minimal value is 200, maximal value is 1200, 0 - maximal available height.', 'vkontakte' ),
			),
			self::ATTR_COVER      => array(
				'label'       => __( 'Group cover', 'vkontakte' ),
				'description' => __( 'Enables a group cover display.', 'vkontakte' ),
			),
			self::ATTR_WIDE       => array(
				'label'       => __( 'Extended mode', 'vkontakte' ),
				'description' => __( 'Enables an extended mode.', 'vkontakte' ),
			),
		);
	}

	/**
	 * @inerhitDoc
	 */
	protected function get_template_path() {
		return __DIR__ . '/views/group.html';
	}

	/**
	 * @inerhitDoc
	 */
	protected function get_placeholders() {
		return array(
			'{ELEMENT_ID}',
			'{WIDGET_OPTIONS}',
			'{GROUP_ID}',
		);
	}

	/**
	 * @inerhitDoc
	 */
	protected function get_values() {
		$widget_options = $this->build_widget_options();

		return array(
			$this->element_id,
			json_encode( $widget_options ),
			$this->group_id,
		);
	}

	/**
	 * @return array
	 */
	private function build_widget_options() {
		$widget_options = array(
			'mode'     => $this->api_mode(),
			'no_cover' => $this->cover ? 0 : 1,
			'wide'     => $this->wide ? 1 : 0,
		);

		if ( $this->width ) {
			$widget_options['width'] = $this->width;
		}

		if ( $this->height ) {
			$widget_options['height'] = $this->height;
		}

		return $widget_options;
	}

	/**
	 * @return int
	 */
	private function api_mode() {
		if ( array_key_exists( $this->mode, self::MODES_MAPPING ) ) {
			return self::MODES_MAPPING[ $this->mode ];
		}

		return self::API_MODE_NAME;
	}
}
