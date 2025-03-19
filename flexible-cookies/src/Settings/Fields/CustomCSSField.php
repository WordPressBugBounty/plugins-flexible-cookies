<?php

namespace WPDesk\FlexibleCookies\Settings\Fields;

use FlexibleCookiesVendor\WPDesk\Forms\Field\TextAreaField;

/**
 * @package WPDesk\FlexibleCookies
 * @author  Eryk Mika <eryk.mika@wpdesk.eu>
 * @since   1.0.0
 */
class CustomCSSField extends TextAreaField {
	public function get_template_name(): string {
		return 'customcss';
	}
}
