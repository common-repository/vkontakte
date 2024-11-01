<?php

class Vkontakte_Api_Widget_Poll extends Vkontakte_Api_Widget {
	const ATTR_ID = 'id';
	const ATTR_ELEMENT_ID = 'element_id';
	const ATTR_WIDTH = 'width';
	const ATTR_PAGE_URL = 'page_url';

	const MIN_WIDTH = 300;

	/**
	 * @var string
	 */
	private $poll_id;

	/**
	 * @var string
	 */
	private $element_id;

	/**
	 * @var int|null
	 */
	private $width;

	/**
	 * @var string|null
	 */
	private $page_url;

	/**
	 * @param string|mixed $poll_id
	 * @param string|mixed $element_id
	 */
	public function __construct( $poll_id, $element_id ) {
		$this->poll_id    = $this->get_non_empty_string( $poll_id );
		$this->element_id = $this->get_non_empty_string( $element_id, 'vkontakte-poll' );
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
	 * @param string|mixed $page_url
	 */
	public function set_page_url( $page_url ) {
		$this->page_url = $this->get_non_empty_string( $page_url );
	}

	/**
	 * @inerhitDoc
	 */
	public static function get_attributes() {
		return array(
			self::ATTR_ID         => array(
				'label'              => __( 'Poll ID', 'vkontakte' ),
				'description'       => __( 'ID of VKontakte poll.', 'vkontakte' ),
				'extra_description' => sprintf( __( 'First, you need to create a poll by clicking on <a href="%s" target="_blank">the link</a>. Then, click the "Получить код" button to see the Poll ID.', 'vkontakte' ), 'https://dev.vk.com/widgets/poll' ),
				'required'          => true,
			),
			self::ATTR_ELEMENT_ID => array(
				'label'       => __( 'Element ID', 'vkontakte' ),
				'description' => __( 'ID of html element, required in case if a few poll widgets are added on the same page.', 'vkontakte' ),
			),
			self::ATTR_WIDTH      => array(
				'label'       => __( 'Width', 'vkontakte' ),
				'description' => __( 'The widget width, minimal value is 300, 0 - maximal available width.', 'vkontakte' ),
			),
			self::ATTR_PAGE_URL   => array(
				'label'       => __( 'Page URL', 'vkontakte' ),
				'description' => __( 'The page URL to display in the preview of posts on the VKontakte wall.', 'vkontakte' ),
			),
		);
	}

	/**
	 * @inerhitDoc
	 */
	protected function get_template_path() {
		return __DIR__ . '/views/poll.html';
	}

	/**
	 * @inerhitDoc
	 */
	protected function get_placeholders() {
		return array(
			'{ELEMENT_ID}',
			'{WIDGET_OPTIONS}',
			'{POLL_ID}',
		);
	}

	/**
	 * @inerhitDoc
	 */
	protected function get_values() {
		$widget_options = $this->build_widget_options();

		return array(
			$this->element_id,
			! empty( $widget_options ) ? json_encode( $widget_options ) : '{}',
			$this->poll_id,
		);
	}

	/**
	 * @return array
	 */
	private function build_widget_options() {
		$widget_options = array();

		if ( $this->width ) {
			$widget_options['width'] = $this->width;
		}

		if ( $this->page_url ) {
			$widget_options['pageUrl'] = $this->page_url;
		}

		return $widget_options;
	}
}
