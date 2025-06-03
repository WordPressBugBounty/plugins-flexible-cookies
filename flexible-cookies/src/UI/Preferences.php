<?php

namespace WPDesk\FlexibleCookies\UI;

use WPDesk\FlexibleCookies\Cookies\Categories\Necessary;
use WPDesk\FlexibleCookies\Cookies\CookieCategories;

/**
 * @package WPDesk\FlexibleCookies
 * @author  Eryk Mika <eryk.mika@wpdesk.eu>
 * @since   1.0.0
 */
class Preferences extends UIElement {

	protected string $template = 'cookies_settings';
	public const TEMPLATE      = 'cookies_settings';

	protected function get_default_params(): array {
		return [];
	}

	public function get_params(): array {
		$plugin_cookies = ( new Necessary() )->get_plugin_cookies();

		return [
			'cookies_categories'   => new CookieCategories(),
			'plugin_cookies'       => $plugin_cookies,
			'accepted_cookies'     => ! empty( $_COOKIE[ $plugin_cookies['accepted_categories'] ] ) ? \WPDesk\FlexibleCookies\Helpers\StringToArrayConverter::convert_string_to_array( esc_html( sanitize_text_field( wp_unslash( $_COOKIE[ $plugin_cookies['accepted_categories'] ] ) ) ) ) : [],
			'accepted_all_cookies' => ! empty( $_COOKIE[ $plugin_cookies['accepted_all_cookies'] ] ),
			// Returns boolean. No need to sanitize.
		];
	}
}
