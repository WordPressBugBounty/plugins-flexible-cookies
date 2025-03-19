<?php

namespace WPDesk\FlexibleCookies;

use WPDesk\FlexibleCookies\Cookies\CookieCategories;
use WPDesk\FlexibleCookies\Helpers\StringToArrayConverter;

/**
 * @package WPDesk\FlexibleCookies
 * @author  Eryk Mika <eryk.mika@wpdesk.eu>
 * @since   1.0.0
 */
class Cookies {
	private const NECESSARY_CATEGORY_SLUG = 'necessary';
	private const ACCEPTED_CATEGORIES     = 'accepted_categories';

	/**
	 * @var CookieCategories
	 */
	private $cookie_categories;


	public function __construct( CookieCategories $cookie_categories ) {
		$this->cookie_categories = $cookie_categories;
	}

	public function get_allowed_cookies(): array {

		$allowed_cookies = $this->cookie_categories[ self::NECESSARY_CATEGORY_SLUG ]->get_cookies_array();

		$necessary_cookies = $this->get_necessary_cookies();

		$accepted_cookies = $this->get_user_accepted_cookies();

		return array_unique( array_merge( $allowed_cookies, $necessary_cookies, $accepted_cookies ) );
	}

	private function get_user_accepted_cookies(): array {
		$accepted_cookies = [];

		$user_accepted_categories = StringToArrayConverter::convert_string_to_array( $this->get_user_accepted_categories() );

		foreach ( $this->cookie_categories as $category ) {
			$category_name = $category->get_slug();
			if ( in_array( $category_name, $user_accepted_categories, true ) ) {
				$accepted_cookies = array_merge( $accepted_cookies, $category->get_cookies_array() );
			}
		}

		return $accepted_cookies;
	}

	private function get_necessary_cookies(): array {

		$necessary_cookies = [];

		foreach ( $this->cookie_categories as $category ) {
			if ( $category->is_necessary() ) {
				$necessary_cookies = array_merge( $necessary_cookies, $category->get_cookies_array() );
			}
		}

		return $necessary_cookies;
	}

	private function has_user_accepted_cookies(): bool {
		return ! empty( $_COOKIE[ $this->cookie_categories[ self::NECESSARY_CATEGORY_SLUG ]->get_plugin_cookies()[ self::ACCEPTED_CATEGORIES ] ] );
	}

	private function get_user_accepted_categories(): string {

		return $this->has_user_accepted_cookies() ? sanitize_text_field( $_COOKIE[ $this->cookie_categories[ self::NECESSARY_CATEGORY_SLUG ]->get_plugin_cookies()[ self::ACCEPTED_CATEGORIES ] ] ) : ''; //phpcs:ignore
	}
}
