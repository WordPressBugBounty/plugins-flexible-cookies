<?php

namespace WPDesk\FlexibleCookies\UI;

use WPDesk\FlexibleCookies\Cookies\Categories\Necessary;
use WPDesk\FlexibleCookies\Cookies\CookieCategories;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class PreferencesButton extends UIElement {

	protected string $template = 'open_settings_button';
	public const TEMPLATE      = 'open_settings_button';

	protected function get_default_params(): array {
		return [];
	}

	public function get_params(): array {
		return [];
	}
}
