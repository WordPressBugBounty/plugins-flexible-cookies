<?php

namespace WPDesk\FlexibleCookies\Cookies;

use WPDesk\FlexibleCookies\Cookies\Categories\Advertising;
use WPDesk\FlexibleCookies\Cookies\Categories\Analytics;
use WPDesk\FlexibleCookies\Cookies\Categories\Functional;
use WPDesk\FlexibleCookies\Cookies\Categories\Necessary;
use WPDesk\FlexibleCookies\Cookies\Categories\Other;
use WPDesk\FlexibleCookies\Cookies\Categories\Performance;
use WPDesk\FlexibleCookies\Cookies\Categories\Template;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class CookieCategories extends \ArrayObject {

	private const NECESSARY   = 'necessary';
	private const ADVERTISING = 'advertising';
	private const ANALYTICS   = 'analytics';
	private const FUNCTIONAL  = 'functional';
	private const OTHER       = 'other';
	private const PERFORMANCE = 'performance';

	public function __construct() {
		parent::__construct(
			[
				self::OTHER       => new Other(),
				self::NECESSARY   => new Necessary(),
				self::ADVERTISING => new Advertising(),
				self::ANALYTICS   => new Analytics(),
				self::FUNCTIONAL  => new Functional(),
				self::PERFORMANCE => new Performance(),
			]
		);
	}

	public function get_cookie_categories_names(): array {
		$names = [];
		foreach ( $this as $category ) {
			$names[ $category->get_slug() ] = $category->get_title();
		}
		return $names;
	}

	public function get_categories_with_slug_and_title_array(): array {
		$categories = [];
		foreach ( $this as $category ) {
			$categories[ $category->get_slug() ] = $category->get_title();
		}
		return $categories;
	}

	public function get_necessary_categories_slugs(): array {
		$categories = [];
		foreach ( $this as $category ) {
			if ( $category->is_necessary() ) {
				$categories[] = $category->get_slug();
			}
		}
		return $categories;
	}

	public function get_categories_required_first(): array {
		$necessary = [];
		$other     = [];

		foreach ( $this as $category ) {
			if ( $category->is_necessary() ) {
				$necessary[] = $category;
			} else {
				$other[] = $category;
			}
		}
		return array_merge( $necessary, $other );
	}

	public function get_not_empty_categories(): array {
		$categories = [];

		foreach ( $this as $category ) {
			if ( empty( $category->get_cookies_array() ) || ( empty( $category->get_cookies_array()[0] ) && empty( $category->get_cookies_array()[1] ) ) ) {
				continue;
			}
			$categories[] = $category;
		}
		return $categories;
	}

	public function get_assigned_cookies() {
		$cookies = [];
		foreach ( $this as $category ) {
			foreach ( $category->get_cookies_array() as $cookie ) {
				$cookies[ $cookie ] = $category->get_slug();
			}
		}
		return $cookies;
	}
}
