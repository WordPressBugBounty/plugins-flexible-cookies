<?php

namespace WPDesk\FlexibleCookies\Settings\Fields;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class WPEditorField extends \FlexibleCookiesVendor\WPDesk\Forms\Field\BasicField {
	public function get_template_name(): string {
		return 'wpeditor';
	}
}
