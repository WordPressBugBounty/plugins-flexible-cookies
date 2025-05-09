<?php

namespace WPDesk\FlexibleCookies;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @var \WPDesk\Forms\Field $field
 * @var string              $name_prefix
 * @var string              $value
 */
\wp_print_styles( 'media-views' );
$default_settings = [
	'textarea_name' => \esc_attr( $name_prefix ) . '[' . \esc_attr( $field->get_name() ) . ']',
	'tinymce'       => [
		'toolbar1' => 'bold,italic,underline,separator,alignleft,aligncenter,alignright,separator,link,unlink',
		'toolbar2' => '',
		'toolbar3' => '',
	],
	'media_buttons' => \false,
	'quicktags'     => \true,
	'teeny'         => \false,
];
$editor_settings  = \wp_parse_args( $field->get_attributes(), $default_settings );
$editor_id        = \uniqid( 'wyswig_' );
\wp_editor( \wp_kses_post( $value ), $editor_id, $editor_settings );
