<?php

namespace WPDesk\FlexibleCookies\Settings\Fields;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class HiddenTabField extends \FlexibleCookiesVendor\WPDesk\Forms\Field\HiddenField {
	public function should_override_form_template(): bool {
		return true;
	}
}
