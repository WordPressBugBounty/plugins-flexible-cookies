<?php

namespace WPDesk\FlexibleCookies\Cookies;

use WPDesk\FlexibleCookies\Cookies\Categories\Advertising;
use WPDesk\FlexibleCookies\Cookies\Categories\Analytics;
use WPDesk\FlexibleCookies\Cookies\Categories\Functional;
use WPDesk\FlexibleCookies\Cookies\Categories\Necessary;
use WPDesk\FlexibleCookies\Cookies\Categories\Other;
use WPDesk\FlexibleCookies\Cookies\Categories\Performance;
use WPDesk\FlexibleCookies\Settings\Settings;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class ExternalCookies {

	/**
	 * @var CookieCategories
	 */
	private $cookie_categories;

	public function __construct() {
		$this->cookie_categories = new CookieCategories();
	}

	/**
	 * @param array<string, string> $table Map of cookie name and assigned category, like ['new_cookie' => 'necessary']
	 */
	public function add_cookies_to_category( array $table ): void {
		foreach ( $table as $cookie_name => $category_slug ) {
			if ( $this->cookie_categories[ $category_slug ] ) {
				$this->cookie_categories[ $category_slug ]->add_cookie( $cookie_name );
			}
		}
	}
}
