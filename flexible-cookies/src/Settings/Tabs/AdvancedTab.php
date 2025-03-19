<?php

namespace WPDesk\FlexibleCookies\Settings\Tabs;

use FlexibleCookiesVendor\WPDesk\Persistence\PersistentContainer;
use FlexibleCookiesVendor\WPDesk\View\Renderer\Renderer;
use WPDesk\FlexibleCookies\Cookies\CookieCategories;
use WPDesk\FlexibleCookies\Settings\Tabs\SubTabs\Advanced\CategoriesSubTabFields;

class AdvancedTab extends TabWithFields {
	private const ADVANCED_SUBTAB_SLUG_ADVERTISING = 'advertising';
	private const ADVANCED_SUBTAB_SLUG_ANALYTICS   = 'analytics';
	private const ADVANCED_SUBTAB_SLUG_FUNCTIONAL  = 'functional';
	private const ADVANCED_SUBTAB_SLUG_OTHER       = 'other';
	private const ADVANCED_SUBTAB_SLUG_PERFORMANCE = 'performance';
	private const ADVANCED_SUBTAB_SLUG_NECESSARY   = 'necessary';
	private const SUBTAB_KEY                       = 'subtab';

	/**
	 * @var CookieCategories
	 */
	private $cookie_categories;

	/**
	 * @var CategoriesSubTabFields
	 */
	private $categories_subtab_fields;

	public function __construct( Renderer $renderer, PersistentContainer $settings, CookieCategories $categories, CategoriesSubTabFields $categories_subtab_fields ) {
		$this->cookie_categories        = $categories;
		$this->categories_subtab_fields = $categories_subtab_fields;
		parent::__construct( $settings, $renderer );
	}

	public function get_fields(): array {
		$subtab = isset( $_REQUEST[ self::SUBTAB_KEY ] ) ? sanitize_key( $_REQUEST[ self::SUBTAB_KEY ] ) : self::ADVANCED_SUBTAB_SLUG_ADVERTISING; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		return $this->categories_subtab_fields->get_fields( $subtab, $this->cookie_categories[ $subtab ]->get_description() );
	}

	public function get_subtabs(): array {
		return [
			self::ADVANCED_SUBTAB_SLUG_ADVERTISING => esc_html__( 'Advertisement', 'flexible-cookies' ),
			self::ADVANCED_SUBTAB_SLUG_ANALYTICS   => esc_html__( 'Analytics', 'flexible-cookies' ),
			self::ADVANCED_SUBTAB_SLUG_FUNCTIONAL  => esc_html__( 'Functional', 'flexible-cookies' ),
			self::ADVANCED_SUBTAB_SLUG_NECESSARY   => esc_html__( 'Necessary', 'flexible-cookies' ),
			self::ADVANCED_SUBTAB_SLUG_OTHER       => esc_html__( 'Others', 'flexible-cookies' ),
			self::ADVANCED_SUBTAB_SLUG_PERFORMANCE => esc_html__( 'Performance', 'flexible-cookies' ),
		];
	}
}
