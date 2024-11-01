<?php

class Vkontakte_Admin_Settings_Page_Comments_Tab extends Vkontakte_Admin_Settings_Page_Form_Tab {
	/**
	 * @var string
	 */
	protected $id = 'comments';

	/**
	 * @inerhitDoc
	 */
	protected function init() {
		$this->label = __( 'Comments', 'vkontakte' );
	}

	/**
	 * @inerhitDoc
	 */
	protected function get_own_sections() {
		return array(
			'default'     => __( 'General Settings', 'vkontakte' ),
			'display'     => __( 'Display Settings', 'vkontakte' ),
			'attachments' => __( 'Attachments Settings', 'vkontakte' ),
		);
	}

	public function get_settings_for_default_section() {
		return array(
			array(
				'type'      => Vkontakte_Admin_Form::FIELD_CHECKBOX,
				'name'      => Vkontakte_Settings::COMMENTS_STATUS,
				'label'     => __( 'Enable comments', 'vkontakte' ),
				'id'        => 'comments-enable',
				'label_for' => 'comments-enable',
			),
		);
	}

	public function get_settings_for_display_section() {
		$fields = array(
			array(
				'type'    => Vkontakte_Admin_Form::FIELD_SELECT,
				'name'    => Vkontakte_Settings::COMMENTS_LIMIT,
				'label'   => __( 'Number of comments', 'vkontakte' ),
				'options' => array(
					5  => 5,
					10 => 10,
					15 => 15,
					20 => 20,
				),
				'id'        => 'comments-limit',
				'label_for' => 'comments-limit',
			),
			array(
				'type'        => Vkontakte_Admin_Form::FIELD_TEXT,
				'name'        => Vkontakte_Settings::COMMENTS_FORM_WIDTH,
				'label'       => __( 'Form width', 'vkontakte' ),
				'id'        => 'comments-form-width',
				'label_for' => 'comments-form-width',
				'description' => __( '0 - max available width', 'vkontakte' ),
			),
			array(
				'type'        => Vkontakte_Admin_Form::FIELD_TEXT,
				'name'        => Vkontakte_Settings::COMMENTS_FORM_HEIGHT,
				'label'       => __( 'Form max height', 'vkontakte' ),
				'id'        => 'comments-form-height',
				'label_for' => 'comments-form-height',
				'description' => __( '0 - no max height', 'vkontakte' ),
			),
			array(
				'type'  => Vkontakte_Admin_Form::FIELD_CHECKBOX,
				'name'  => Vkontakte_Settings::COMMENTS_AUTO_PUBLISH,
				'label' => __( 'Publishing on user page', 'vkontakte' ),
				'id'        => 'comments-auto-publishing',
				'label_for' => 'comments-auto-publishing',
			),
			array(
				'type'  => Vkontakte_Admin_Form::FIELD_CHECKBOX,
				'name'  => Vkontakte_Settings::COMMENTS_NO_REALTIME,
				'label' => __( 'Disable online feed update', 'vkontakte' ),
				'id'        => 'comments-no-realtime',
				'label_for' => 'comments-no-realtime',
			),
		);

		$post_types = get_post_types_by_support( 'comments' );

		foreach ( $post_types as $post_type ) {
			$post_type_object = get_post_type_object( $post_type );

			$field_label = sprintf(
				__( 'Display comments in posts with type "%s"', 'vkontakte' ),
				$post_type_object->labels->singular_name ?: $post_type
			);
			$description = __( 'The display of comments depends on the theme.', 'vkontakte' );

			switch ( $post_type ) {
				case 'post':
					$field_label = __( 'Display comments in posts', 'vkontakte' );
					break;

				case 'page':
					$field_label = __( 'Display comments on pages', 'vkontakte' );
					break;

				case 'attachment':
					$field_label = __( 'Display comments on attachment pages', 'vkontakte' );
					$description = $description . ' ' . __( 'The site may not contain links to the attachment pages at all.', 'vkontakte' );
					break;

				default:
					$description = $description . ' ' . __( 'Pages of custom content type may not contain comments at all.', 'vkontakte' );

					break;
			}

			$field_params = array(
				'type'    => Vkontakte_Admin_Form::FIELD_SELECT,
				'name'    => sprintf( Vkontakte_Settings::COMMENTS_DISPLAY_IN_POST_TYPE, $post_type ),
				'label'   => $field_label,
				'options' => array(
					Vkontakte_Settings::COMMENTS_DISPLAY_OPTION_NONE    => __( 'not display', 'vkontakte' ),
					Vkontakte_Settings::COMMENTS_DISPLAY_OPTION_REPLACE => __( 'display instead of native comments', 'vkontakte' ),
					Vkontakte_Settings::COMMENTS_DISPLAY_OPTION_BEFORE  => __( 'display before native comments', 'vkontakte' ),
					Vkontakte_Settings::COMMENTS_DISPLAY_OPTION_AFTER   => __( 'display after native comments', 'vkontakte' ),
				),
				'id'        => sprintf('comments-display-type-%s', $post_type),
				'label_for' => sprintf('comments-display-type-%s', $post_type),
			);

			if ( $description ) {
				$field_params['description'] = $description;
			}

			$fields[] = $field_params;
		}

		return $fields;
	}

	public function get_settings_for_attachments_section() {
		return array(
			array(
				'type'  => Vkontakte_Admin_Form::FIELD_CHECKBOX,
				'name'  => Vkontakte_Settings::COMMENTS_ATTACHMENT_AUDIO,
				'label' => __( 'Audio', 'vkontakte' ),
				'id'        => 'comments-attachments-audio',
				'label_for' => 'comments-attachments-audio',
			),
			array(
				'type'  => Vkontakte_Admin_Form::FIELD_CHECKBOX,
				'name'  => Vkontakte_Settings::COMMENTS_ATTACHMENT_VIDEO,
				'label' => __( 'Video', 'vkontakte' ),
				'id'        => 'comments-attachments-video',
				'label_for' => 'comments-attachments-video',
			),
			array(
				'type'  => Vkontakte_Admin_Form::FIELD_CHECKBOX,
				'name'  => Vkontakte_Settings::COMMENTS_ATTACHMENT_PHOTO,
				'label' => __( 'Photo', 'vkontakte' ),
				'id'        => 'comments-attachments-photo',
				'label_for' => 'comments-attachments-photo',
			),
			array(
				'type'  => Vkontakte_Admin_Form::FIELD_CHECKBOX,
				'name'  => Vkontakte_Settings::COMMENTS_ATTACHMENT_LINK,
				'label' => __( 'Link', 'vkontakte' ),
				'id'        => 'comments-attachments-link',
				'label_for' => 'comments-attachments-link',
			),
			array(
				'type'  => Vkontakte_Admin_Form::FIELD_CHECKBOX,
				'name'  => Vkontakte_Settings::COMMENTS_ATTACHMENT_GRAFFITI,
				'label' => __( 'Graffiti', 'vkontakte' ),
				'id'        => 'comments-attachments-graffiti',
				'label_for' => 'comments-attachments-graffiti',
			),
		);
	}
}
