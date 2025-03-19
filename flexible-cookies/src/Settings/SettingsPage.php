<?php

namespace WPDesk\FlexibleCookies\Settings;

use FlexibleCookiesVendor\WPDesk\PluginBuilder\Plugin\Hookable;
use FlexibleCookiesVendor\WPDesk\View\Renderer\Renderer;
use WPDesk\FlexibleCookies\Cookies\CookieCategories;
use WPDesk\FlexibleCookies\Cookies\ExternalCookies;
use WPDesk\FlexibleCookies\Settings\Fields\ColorPickerField;
use WPDesk\FlexibleCookies\Settings\SettingsTabs\Scanner;
use WPDesk\FlexibleCookies\Settings\Tabs\AdvancedTab;
use WPDesk\FlexibleCookies\Settings\Tabs\GeneralTab;
use WPDesk\FlexibleCookies\Settings\Tabs\GoogleIntegrationTab;
use WPDesk\FlexibleCookies\Settings\Tabs\ScannerTab;
use WPDesk\FlexibleCookies\Settings\Tabs\StylesTab;
use WPDesk\FlexibleCookies\Settings\Tabs\SubTabs\Advanced\CategoriesSubTabFields;
use WPDesk\FlexibleCookies\Settings\Tabs\TabInterface;

/**
 * @package WPDesk\FlexibleCookies
 * @author  Eryk Mika <eryk.mika@wpdesk.eu>
 * @since   1.0.0
 */
class SettingsPage implements Hookable {

	private const PAGE_ID           = 'cookies-settings-page';
	private const ADVANCED_TAB_SLUG = 'advanced';
	private const GENERAL_TAB_SLUG  = 'general';
	private const STYLES_TAB_SLUG   = 'styles';
	private const SCANNER_TAB_SLUG  = 'scanner';
	private const GOOGLE_TAB_SLUG   = 'google';
	private const TAB_GLOBAL_NAME   = 'tab';

	/**
	 * @var Settings
	 */
	private $settings;

	/**
	 * @var Renderer
	 */
	private $form_renderer;

	private CookieCategories $cookie_categories;

	public function __construct( Settings $settings, Renderer $form_renderer, CookieCategories $cookie_categories ) {
		$this->settings          = $settings;
		$this->form_renderer     = $form_renderer;
		$this->cookie_categories = $cookie_categories;
	}

	public function hooks() {
		add_action( 'admin_menu', [ $this, 'add_admin_menu' ] );
		add_action( 'admin_post_flexible_cookies_save_settings', [ $this, 'save_tab_settings' ] );
		ColorPickerField::wp_enqueue_scripts();
	}

	public function add_admin_menu(): void {
		add_submenu_page(
			'options-general.php',
			esc_html__( 'Flexible Cookies', 'flexible-cookies' ),
			esc_html__( 'Flexible Cookies', 'flexible-cookies' ),
			'manage_options',
			self::PAGE_ID,
			[ $this, 'render' ]
		);
	}

	public function render(): void {
		$page_renderer = new PageRenderer( $this->form_renderer );

		$page_renderer->render(
			$this->get_active_tab(),
			[ 'tabs' => $this->get_settings_tabs() ]
		);
	}

	public function save_tab_settings(): void {
		if ( current_user_can( 'manage_options' ) ) {
			$active_tab = $this->get_active_tab();
			$active_tab->save_data();
		}
	}

	private function get_active_tab_slug(): string {
		return sanitize_key( wp_unslash( $_REQUEST[ self::TAB_GLOBAL_NAME ] ?? self::GENERAL_TAB_SLUG ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	}

	private function get_active_tab(): TabInterface {
		$tab_slug = $this->get_active_tab_slug();
		switch ( $tab_slug ) {
			case self::ADVANCED_TAB_SLUG:
				return ( new AdvancedTab( $this->form_renderer, $this->settings, $this->cookie_categories, new CategoriesSubTabFields() ) );
			case self::STYLES_TAB_SLUG:
				return ( new StylesTab( $this->settings, $this->form_renderer ) );
			case self::SCANNER_TAB_SLUG:
				return new ScannerTab( new ExternalCookies() );
			case self::GOOGLE_TAB_SLUG:
				return new GoogleIntegrationTab( $this->settings, $this->form_renderer, $this->cookie_categories );
			default:
				return ( new GeneralTab( $this->settings, $this->form_renderer ) );
		}
	}

	private function get_settings_tabs(): array {
		return [
			self::GENERAL_TAB_SLUG  => esc_html__( 'General', 'flexible-cookies' ),
			self::STYLES_TAB_SLUG   => esc_html__( 'Appearance', 'flexible-cookies' ),
			self::ADVANCED_TAB_SLUG => esc_html__( 'Categories', 'flexible-cookies' ),
			self::SCANNER_TAB_SLUG  => esc_html__( 'Scanner', 'flexible-cookies' ),
			self::GOOGLE_TAB_SLUG   => esc_html__( 'Google Integration', 'flexible-cookies' ),
		];
	}
}
