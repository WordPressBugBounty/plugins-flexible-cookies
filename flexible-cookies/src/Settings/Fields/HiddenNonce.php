<?php

namespace WPDesk\FlexibleCookies\Settings\Fields;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class HiddenNonce extends \FlexibleCookiesVendor\WPDesk\Forms\Field\NoOnceField {
	public function should_override_form_template(): bool {
		return true;
	}
}
