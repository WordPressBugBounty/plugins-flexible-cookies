<?php
/**
 * Plugin main class.
 */

namespace WPDesk\FlexibleCookies;

use FlexibleCookiesVendor\WPDesk\Dashboard\DashboardWidget;
use FlexibleCookiesVendor\WPDesk\Forms\Resolver\DefaultFormFieldResolver;
use FlexibleCookiesVendor\WPDesk\PluginBuilder\Plugin\AbstractPlugin;
use FlexibleCookiesVendor\WPDesk\PluginBuilder\Plugin\HookableCollection;
use FlexibleCookiesVendor\WPDesk\PluginBuilder\Plugin\HookableParent;
use FlexibleCookiesVendor\WPDesk\View\Renderer\Renderer;
use FlexibleCookiesVendor\WPDesk\View\Renderer\SimplePhpRenderer;
use FlexibleCookiesVendor\WPDesk\View\Resolver\ChainResolver;
use FlexibleCookiesVendor\WPDesk\View\Resolver\DirResolver;
use FlexibleCookiesVendor\Psr\Log\LoggerAwareInterface;
use FlexibleCookiesVendor\Psr\Log\LoggerAwareTrait;
use WPDesk\FlexibleCookies\Cookies\Categories\Necessary;
use WPDesk\FlexibleCookies\Cookies\CookieBlocker;
use WPDesk\FlexibleCookies\Cookies\CookieCategories;
use WPDesk\FlexibleCookies\Cookies\NecessaryPatterns;
use WPDesk\FlexibleCookies\Google\ConsentMode\AdvancedCM;
use WPDesk\FlexibleCookies\Google\ConsentMode\BasicCM;
use WPDesk\FlexibleCookies\Google\ConsentMode\ConsentMode;
use WPDesk\FlexibleCookies\Google\GoogleIntegration;
use WPDesk\FlexibleCookies\Helpers\CSVReader;
use WPDesk\FlexibleCookies\Helpers\PathHelper;
use WPDesk\FlexibleCookies\Scanner\Scanner;
use WPDesk\FlexibleCookies\Settings\Settings;
use WPDesk\FlexibleCookies\Settings\SettingsPage;
use WPDesk\FlexibleCookies\UI\UI;
use WPDesk\FlexibleCookies\UI\UIRenderer;

/**
 * Main plugin class. The most important flow decisions are made here.
 *
 * @codeCoverageIgnore
 */
class Plugin extends AbstractPlugin implements LoggerAwareInterface, HookableCollection {

	use LoggerAwareTrait;
	use HookableParent;

	/**
	 * @var bool
	 */
	private $simple_bar;

	/**
	 * @var bool
	 */
	private $block_until_accepted;

	/**
	 * @var bool
	 */
	private $admin_mode;

	/**
	 * @var Settings
	 */
	private $settings;

	/**
	 * @var Necessary
	 */
	private $necessary_category;

	/**
	 * @var NecessaryPatterns
	 */
	private $necessary_patterns;

	/**
	 * @var CookieCategories
	 */
	private $cookie_categories;

	/**
	 * @var CookieBlocker
	 */
	private $cookie_blocker;

	/**
	 * @var Cookies
	 */
	private $cookies;

	private string $plugin_version;

	/**
	 * Init hooks.
	 *
	 * @return void
	 */

	public function __construct( $plugin_info ) {
		parent::__construct( $plugin_info );
		$this->settings           = new Settings();
		$this->necessary_patterns = new NecessaryPatterns();
		$this->plugin_version     = $plugin_info->get_version();

		$this->simple_bar           = $this->settings->get_boolean( 'simple_cookie_bar' );
		$this->block_until_accepted = $this->settings->get_boolean( 'block_cookies_until_accepted' );
		$this->admin_mode           = $this->settings->get_boolean( 'admin_mode' );
		$this->support_url          = get_locale() === 'pl_PL' ? 'https://www.wpdesk.pl/sk/flexible-cookies-support-pl/' : 'https://wpdesk.net/sk/flexible-cookies-support-en/';
	}

	public function hooks(): void {
		parent::hooks();

		$banner_enabled = (bool) apply_filters( 'flexible_cookies_option_banner_enabled', $this->settings->get_boolean( 'banner_enabled' ) );
		$gcm_enabled    = (bool) apply_filters( 'flexible_cookies_option_gcm_enabled', $this->settings->get_boolean( 'gcm_enabled' ) );
		$gtm_tag_id     = $this->settings->get( 'gcm_id' );

		add_action( 'init', [ $this, 'maybe_block_cookies' ], 9999 );
		add_action( 'init', [ $this, 'register_scripts' ] );
		add_action( 'init', [ $this, 'register_scanner_scripts' ] );

		add_action(
			'init',
			function () use ( $banner_enabled, $gcm_enabled, $gtm_tag_id ) {
				$this->cookie_categories  = new CookieCategories();
				$this->necessary_category = new Necessary();
				$this->cookies            = new Cookies( $this->cookie_categories );
				$this->cookie_blocker     = new CookieBlocker( $this->necessary_category, $this->necessary_patterns, $this->cookies->get_allowed_cookies() );

				$scanner = new Scanner();
				$this->add_hookable( $scanner );

				$this->add_hookable( new SettingsPage( $this->settings, $this->get_form_renderer(), $this->cookie_categories, $this->get_plugin_assets_url() ) );

				if ( $gcm_enabled && ! empty( $gtm_tag_id ) ) {
					$this->add_hookable( new GoogleIntegration( $this->settings, $this->get_selected_consent_mode(), $this->cookie_categories, $this->plugin_version ) );
				}

				if ( apply_filters( 'flexible_cookies_banner_visible', ( $banner_enabled && ! Scanner::is_needed() ) ) ) {
					$this->add_hookable( new UI( new UIRenderer( $this->get_renderer( 'Front' ) ), $this->simple_bar, $this->settings ) );
				}

				( new DashboardWidget() )->hooks();

				$this->hooks_on_hookable_objects();
			}
		);
	}

	private function get_renderer( string $folder = '' ): Renderer {
		return new SimplePhpRenderer( new DirResolver( $this->plugin_info->get_plugin_dir() . '/src/Views/' . $folder ) );
	}

	private function get_form_renderer(): Renderer {
		$resolver = new ChainResolver();
		$resolver->appendResolver( new DirResolver( $this->plugin_info->get_plugin_dir() . '/src/Views/Dashboard' ) );
		$resolver->appendResolver( new DefaultFormFieldResolver() );

		return new SimplePhpRenderer( $resolver );
	}

	public function maybe_block_cookies(): void {
		if ( $this->can_block_cookies() ) {
			$this->cookie_blocker->block_cookies();
		}
	}

	private function can_block_cookies(): bool {
		return (bool) apply_filters( 'flexible_cookies_can_block_cookies', ( ! $this->simple_bar && $this->block_until_accepted && ! $this->is_in_admin_mode() && ! Scanner::is_needed() ) );
	}

	private function is_in_admin_mode(): bool {
		return $this->admin_mode && $this->is_user_admin();
	}

	private function is_user_admin(): bool {
		return current_user_can( 'manage_options' );
	}

	public function links_filter( $links ) {
		$custom_links = [
			'<a href="' . esc_url( admin_url( 'options-general.php?page=cookies-settings-page' ) ) . '">' . esc_html__( 'Settings', 'flexible-cookies' ) . '</a>',
			'<a href="' . esc_url( __( 'https://wpdesk.net/sk/flexible-cookies-docs-en/', 'flexible-cookies' ) ) . '">' . esc_html__( 'Docs', 'flexible-cookies' ) . '</a>',
		];

		return array_merge( $custom_links, $links );
	}

	private function get_selected_consent_mode(): ConsentMode {
		$selected_consent_mode = $this->settings->get( 'gcm_mode' );
		$gtm_id                = $this->settings->get( 'gcm_id' );

		switch ( $selected_consent_mode ) {
			case 'advanced':
				return new AdvancedCM( $gtm_id, $this->plugin_version );
			case 'basic':
			default:
				return new BasicCM( $gtm_id, $this->plugin_version );
		}
	}

	public function register_scripts(): void {
		wp_register_script( 'flexible_cookies_blocker', $this->get_plugin_assets_url() . 'js/cookie_blocker.js', [ 'jquery' ], $this->plugin_version, true );
		wp_register_script( 'flexible_cookies_functions', $this->get_plugin_assets_url() . 'js/cookie_functions.js', [ 'jquery' ], $this->plugin_version, true );
		wp_register_script( 'flexible_cookies_banner', $this->get_plugin_assets_url() . 'js/ui_functions.js', [ 'jquery' ], $this->plugin_version, true );
	}

	public function register_scanner_scripts(): void {
		wp_register_script( 'flexible_cookies_scanner_receiver', $this->get_plugin_assets_url() . 'js/scanner/scanner_receiver.js', [ 'jquery' ], $this->plugin_version, true );
		wp_register_script( 'flexible_cookies_scanner_sender', $this->get_plugin_assets_url() . 'js/scanner/scanner_sender.js', [ 'jquery' ], $this->plugin_version, true );
	}

	public function wp_enqueue_scripts() {
		wp_localize_script(
			'flexible_cookies_blocker',
			'dataObject',
			[
				'allowed_cookies'      => $this->cookies->get_allowed_cookies(),
				'block_until_accepted' => $this->simple_bar ? false : $this->block_until_accepted,
				'plugin_cookies'       => $this->necessary_category->get_plugin_cookies(),
				'accept_after_time'    => $this->settings->get_boolean( 'auto_accept_cookies_time' ),
				'accept_after'         => $this->settings->get( 'auto_accept_cookies_after_seconds' ),
				'accept_on_scroll'     => $this->settings->get_boolean( 'auto_accept_cookies_scroll' ),
				'necessary_patterns'   => ( $this->necessary_patterns )->get_patterns(),
				'simple_cookie_bar'    => $this->simple_bar,
			]
		);
	}

	public function admin_enqueue_scripts() {
		wp_enqueue_style( 'flexible_cookies_fields_styles', $this->get_plugin_assets_url() . 'css/admin/fields.css' ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_enqueue_script( 'flexible_cookies_dashboard_manager', $this->get_plugin_assets_url() . 'js/admin/fields_manager.js', [ 'jquery' ], $this->plugin_version, true );
		wp_enqueue_script( 'flexible_cookies_scanner_receiver' );
		wp_enqueue_style( 'flexible_cookies_scanner_styles', $this->get_plugin_assets_url() . 'css/admin/scanner.css' ); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_localize_script(
			'flexible_cookies_scanner_receiver',
			'data',
			[
				'categories'            => ( $this->cookie_categories )->get_cookie_categories_names(),
				'preset_categories'     => ( new CSVReader() )->get_data( PathHelper::get_assets_path( 'csv/cookies.csv' ) ),
				'assigned_categories'   => $this->cookie_categories->get_assigned_cookies(),
				'hide_assigned_cookies' => apply_filters( 'flexible_cookies_scanner_hide_assigned_cookies', false ),
			]
		);
	}
}
