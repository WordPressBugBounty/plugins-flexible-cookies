<?php

namespace WPDesk\FlexibleCookies\Cookies;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class NecessaryPatterns {

	/**
	 * @var string[]
	 */
	private $patterns_array = [
		'PHPSESSID',
		'wordpress_sec_',
		'wp-settings-',
		'wordpress_logged_in_',
		'wp_woocommerce_session_',
		'store_notice',
		'woocommerce_snooze_suggestions__',
		'woocommerce_dismissed_suggestions__',
		'wordpress_',
	];

	public function get_patterns(): array {
		return $this->patterns_array;
	}

	public function pattern_occurs( string $cname ): bool {
		foreach ( $this->patterns_array as $pattern ) {
			if ( preg_match( '/^' . $pattern . '(|.+?)/si', $cname ) ) {
				return true;
			}
		}

		return false;
	}
}
