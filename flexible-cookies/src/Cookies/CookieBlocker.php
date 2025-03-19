<?php

namespace WPDesk\FlexibleCookies\Cookies;

use WPDesk\FlexibleCookies\Cookies\Categories\Necessary;

/**
 * @package WPDesk\FlexibleCookies
 * @author  Eryk Mika <eryk.mika@wpdesk.eu>
 * @since   1.0.0
 */
class CookieBlocker {

	/**
	 * @var array
	 */
	private $accepted_cookies;

	/**
	 * @var NecessaryPatterns
	 */
	private $necessary_patterns;

	/**
	 * @var array
	 */
	private $plugin_cookies;

	public function __construct( Necessary $necessary, NecessaryPatterns $necessary_patterns, array $allowed_cookies ) {
		$this->plugin_cookies     = $necessary->get_plugin_cookies();
		$this->necessary_patterns = $necessary_patterns;
		$this->accepted_cookies   = $allowed_cookies;
	}

	public function block_cookies(): void {
		if ( isset( $_COOKIE[ $this->plugin_cookies['accepted_all_cookies'] ] ) ) {
			return;
		}

		foreach ( $_COOKIE as $cname ) {
			$cname = sanitize_text_field( $cname );
			if ( ! $this->is_cookie_allowed( $cname ) && ! $this->necessary_patterns->pattern_occurs( $cname ) ) {
				$this->block_cookie_from_global_variable( $cname );
			}
		}
	}

	private function block_cookie_from_global_variable( string $cname ): void {
		if ( isset( $_COOKIE[ $cname ] ) ) {
			setcookie( $cname, '', ( time() - 8640000 ), '/' );
		}
	}

	private function is_cookie_allowed( string $cookie_name ): bool {
		return in_array( $cookie_name, $this->accepted_cookies, true );
	}
}
