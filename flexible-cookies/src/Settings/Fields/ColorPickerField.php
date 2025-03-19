<?php

namespace WPDesk\FlexibleCookies\Settings\Fields;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class ColorPickerField extends \FlexibleCookiesVendor\WPDesk\Forms\Field\BasicField {

	public function __construct() {
		$this->add_class( 'cookie-color-field' );
	}

	public static function wp_enqueue_scripts(): void {
		add_action(
			'admin_enqueue_scripts',
			function () {
				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_script( 'wp-color-picker' );
			}
		);
		add_action(
			'admin_footer',
			function () {
				?>
			<script>
				(function ($) {
					$(function () {
						$('.cookie-color-field').wpColorPicker();
					});
				})(jQuery);
			</script>
				<?php
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
