<?php

namespace WPDesk\FlexibleCookies\Cookies\Categories;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class Necessary extends Template {
	/**
	 * @var string
	 */
	private const COOKIE_BAR_AGREEMENT_COOKIE = 'flexible_cookies_accepted';
	/**
	 * @var string
	 */
	private const ACCEPTED_CATEGORIES_COOKIE = 'flexible_cookies_accepted_categories';
	/**
	 * @var string
	 */
	private const ACCEPTED_ALL_COOKIES = 'flexible_cookies_accepted_all';

	/**
	 * @var string
	 */
	private const SCANNER_COOKIE = 'flexible_cookies_scanner_running';

	/**
	 * @var string
	 */
	protected $settings_slug = 'necessary';

	/**
	 * @var string[]
	 */
	protected $strictly_necessary_cookies = [
		'woocommerce_cart_hash',
		'woocommerce_items_in_cart',
		'wp_woocommerce_session_',
		'woocommerce_recently_viewed',
		'tk_ai',
		'wp-settings-time-1',
		'wp-settings-1',
	];

	/**
	 * @var string[]
	 */
	private $plugin_cookies = [
		'bar'                  => self::COOKIE_BAR_AGREEMENT_COOKIE,
		'accepted_categories'  => self::ACCEPTED_CATEGORIES_COOKIE,
		'accepted_all_cookies' => self::ACCEPTED_ALL_COOKIES,
		'scanner_running'      => self::SCANNER_COOKIE,
	];

	public function __construct() {
		$this->title               = esc_html__( 'Necessary', 'flexible-cookies' );
		$this->default_description = esc_html__( 'Necessary cookies are absolutely essential for the website to function properly. These cookies ensure basic functionalities and security features of the website, anonymously.', 'flexible-cookies' );
		parent::__construct();
	}

	public function get_cookies_array(): array {
		return array_merge( $this->strictly_necessary_cookies, $this->get_plugin_cookies(), $this->user_cookies );
	}

	public function get_plugin_cookies(): array {
		return $this->plugin_cookies;
	}

	public function is_necessary(): bool {
		return true;
	}

	public function is_enabled(): bool {
		return true;
	}
}
