<?php

namespace WPDesk\FlexibleCookies\Scanner;

use FlexibleCookiesVendor\WPDesk\PluginBuilder\Plugin\Conditional;
use FlexibleCookiesVendor\WPDesk\PluginBuilder\Plugin\Hookable;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class Scanner implements Hookable, Conditional {

	public const SCANNER_INIT_KEY   = 'flexible_cookies';
	public const SCANNER_INIT_VALUE = 'runScanner';
	private const SCANNER_COOKIE    = 'flexible_cookies_scanner_running';
	private const RUNNING_TIMEOUT   = 600;

	/**
	 * @var bool
	 */
	public $is_running = false;

	public static function is_needed(): bool {
		if ( self::is_scanning_request() || self::should_scan() ) {
			return true;
		}

		return false;
	}

	public function hooks() {
		add_action(
			'wp_enqueue_scripts',
			function () {
				if ( ! isset( $_COOKIE[ self::SCANNER_COOKIE ] ) ) {
					self::set_scanner_cookie();
				}
				wp_enqueue_script( 'flexible_cookies_scanner_sender' );
			}
		);
	}

	private static function is_scanning_request(): bool {
		return ( isset( $_GET[ self::SCANNER_INIT_KEY ] ) && $_GET[ self::SCANNER_INIT_KEY ] === self::SCANNER_INIT_VALUE ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	}

	private static function set_scanner_cookie(): void {
		setcookie( self::SCANNER_COOKIE, 'true', time() + self::RUNNING_TIMEOUT, '/' );
	}

	private static function should_scan(): bool {
		return isset( $_COOKIE[ self::SCANNER_COOKIE ] );
	}
}
