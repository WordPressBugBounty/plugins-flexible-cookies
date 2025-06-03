<?php

namespace WPDesk\FlexibleCookies\Settings\Fields;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class ColorPickerField extends \FlexibleCookiesVendor\WPDesk\Forms\Field\BasicField {

	public function __construct() {
		$this->add_class( 'cookie-color-field color-picker' );
		$this->set_attribute( 'data-alpha-enabled', 'true' );
	}

	public static function wp_enqueue_scripts( string $assets_url ): void {
		add_action(
			'admin_enqueue_scripts',
			function () use ( $assets_url ) {
				wp_enqueue_style( 'wp-color-picker' );
				wp_register_script( 'wp-color-picker-alpha', $assets_url . 'js/admin/wp-color-picker-with-alpha.js', [ 'wp-color-picker' ], '1.2.0', true );
				wp_add_inline_script(
					'wp-color-picker-alpha',
					'jQuery( function() { jQuery( ".color-picker" ).wpColorPicker(); } );'
				);
				wp_enqueue_script( 'wp-color-picker-alpha' );
			}
		);
		add_action(
			'admin_footer',
			function () {
				wp_add_inline_script(
					'wp-color-picker-alpha',
					'jQuery( function() { jQuery( ".color-picker" ).wpColorPicker(); } );'
				);
			}
		);
	}

	public function get_template_name(): string {
		return 'colorpicker';
	}

	public function get_type(): string {
		return 'text';
	}
}
