<?php

namespace WPDesk\FlexibleCookies\Google;

use FlexibleCookiesVendor\WPDesk\PluginBuilder\Plugin\Hookable;
use WPDesk\FlexibleCookies\Cookies\CookieCategories;
use WPDesk\FlexibleCookies\Google\ConsentMode\ConsentMode;
use WPDesk\FlexibleCookies\Helpers\PathHelper;
use WPDesk\FlexibleCookies\Settings\Settings;

class GoogleIntegration implements Hookable {

	private ConsentMode $consent_mode;

	private Settings $settings;

	private const AD_USER_DATA_KEY       = 'ad_user_data';
	private const AD_PERSONALIZATION_KEY = 'ad_personalization';
	private const AD_STORAGE_KEY         = 'ad_storage';
	private const ANALYTICS_STORAGE_KEY  = 'analytics_storage';

	private CookieCategories $cookie_categories;

	private string $plugin_version;

	public function __construct( Settings $settings, ConsentMode $consent_mode, CookieCategories $cookie_categories, string $plugin_version ) {
		$this->consent_mode      = $consent_mode;
		$this->settings          = $settings;
		$this->cookie_categories = $cookie_categories;
		$this->plugin_version    = $plugin_version;

		$this->consent_mode->set_default_values( $this->get_params_with_default_value() );
	}

	public function hooks() {
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_consent_updater' ] );
		add_action( 'wp_enqueue_scripts', [ $this->consent_mode, 'enqueue_scripts' ] );
	}

	public function enqueue_consent_updater() {

		//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NotInFooter
		wp_enqueue_script( 'flexible-cookies-gtmconsent-functions', PathHelper::get_assets_url( 'js/google/consentFunctions.js' ), [], $this->plugin_version );
		//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NotInFooter
		wp_enqueue_script( 'flexible-cookies-gtmconsent-updater', PathHelper::get_assets_url( 'js/google/consentUpdater.js' ), [], $this->plugin_version );
		wp_localize_script(
			'flexible-cookies-gtmconsent-updater',
			'gtmUpdater',
			[
				'assigned_categories'  => $this->get_params_with_associated_category(),
				'necessary_categories' => $this->cookie_categories->get_necessary_categories_slugs(),
			]
		);

		//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NotInFooter
		wp_enqueue_script( 'flexible-cookies-gtmconsent-loader', PathHelper::get_assets_url( 'js/google/consentLoader.js' ), [], $this->plugin_version );
		wp_localize_script(
			'flexible-cookies-gtmconsent-loader',
			'gtmLoader',
			$this->get_params_with_default_value()
		);
	}

	private function get_params_with_associated_category(): array {
		$gcm_param_ad_user_data       = $this->settings->get( 'gcm_param_ad_user_data' );
		$gcm_param_ad_personalization = $this->settings->get( 'gcm_param_ad_personalization' );
		$gcm_param_ad_storage         = $this->settings->get( 'gcm_param_ad_storage' );
		$gcm_param_analytics_storage  = $this->settings->get( 'gcm_param_analytics_storage' );

		return [
			self::AD_USER_DATA_KEY       => $gcm_param_ad_user_data,
			self::AD_PERSONALIZATION_KEY => $gcm_param_ad_personalization,
			self::AD_STORAGE_KEY         => $gcm_param_ad_storage,
			self::ANALYTICS_STORAGE_KEY  => $gcm_param_analytics_storage,
		];
	}

	private function get_params_with_default_value(): array {
		$gcm_param_ad_user_data       = $this->settings->get( 'gcm_param_ad_user_data_default_value' );
		$gcm_param_ad_personalization = $this->settings->get( 'gcm_param_ad_personalization_default_value' );
		$gcm_param_ad_storage         = $this->settings->get( 'gcm_param_ad_storage_default_value' );
		$gcm_param_analytics_storage  = $this->settings->get( 'gcm_param_analytics_storage_default_value' );

		return [
			self::AD_USER_DATA_KEY       => $gcm_param_ad_user_data,
			self::AD_PERSONALIZATION_KEY => $gcm_param_ad_personalization,
			self::AD_STORAGE_KEY         => $gcm_param_ad_storage,
			self::ANALYTICS_STORAGE_KEY  => $gcm_param_analytics_storage,
		];
	}
}
