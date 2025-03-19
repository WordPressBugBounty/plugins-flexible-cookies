<?php

namespace WPDesk\FlexibleCookies\Cookies\Categories;

use WPDesk\FlexibleCookies\Settings\Settings;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
abstract class Template {

	/**
	 * @var Settings
	 */
	protected $settings;

	/**
	 * @var string
	 */
	protected $settings_slug;

	/**
	 * @var bool
	 */
	protected $is_necessary;

	/**
	 * @var bool
	 */
	protected $is_enabled;

	/**
	 * @var array
	 */
	protected $user_cookies;

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var string
	 */
	protected $description;

	/**
	 * @var string
	 */
	protected $default_description;

	public function __construct() {
		$this->settings = new Settings();
		$this->settings->set_default_values( $this->get_default_values() );
		$this->is_necessary = $this->settings->get_boolean( 'require_' . $this->settings_slug );
		$this->is_enabled   = $this->settings->get_boolean( 'category_' . $this->settings_slug . '_enabled' );
		$this->user_cookies = $this->settings->get( $this->settings_slug . '_cookies' ) ?? [];
		$this->description  = $this->settings->get( 'category_' . $this->settings_slug . '_description' );
	}

	private function get_default_values(): array {
		return [
			'require_' . $this->settings_slug                   => false, //phpcs:ignore
			'category_' . $this->settings_slug . '_enabled'     => true, //phpcs:ignore
			$this->settings_slug . '_cookies'                   => [], //phpcs:ignore
			'category_' . $this->settings_slug . '_description' => $this->default_description, //phpcs:ignore
		];
	}

	public function is_necessary(): bool {
		return filter_var( $this->is_necessary, FILTER_VALIDATE_BOOLEAN );
	}

	public function is_enabled(): bool {
		return filter_var( $this->is_enabled, FILTER_VALIDATE_BOOLEAN );
	}

	public function get_title(): string {
		return $this->title;
	}

	public function get_description(): string {
		return $this->description;
	}

	public function add_cookie( string $new_cookie ): void {
		if ( ! in_array( $new_cookie, $this->user_cookies, true ) ) {
			$this->user_cookies[] = $new_cookie;
		}
		$this->settings->set( $this->settings_slug . '_cookies', $this->user_cookies );
	}

	public function get_cookies_array(): array {
		return $this->user_cookies;
	}

	public function get_slug(): string {
		return $this->settings_slug;
	}
}
