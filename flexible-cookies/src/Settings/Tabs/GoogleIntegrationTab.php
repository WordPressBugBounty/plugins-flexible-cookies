<?php

namespace WPDesk\FlexibleCookies\Settings\Tabs;

use FlexibleCookiesVendor\WPDesk\Forms\Field\InputTextField;
use FlexibleCookiesVendor\WPDesk\Forms\Field\SelectField;
use FlexibleCookiesVendor\WPDesk\Forms\Field\SubmitField;
use FlexibleCookiesVendor\WPDesk\Forms\Field\ToggleField;
use FlexibleCookiesVendor\WPDesk\Persistence\PersistentContainer;
use FlexibleCookiesVendor\WPDesk\View\Renderer\Renderer;
use WPDesk\FlexibleCookies\Cookies\CookieCategories;
use WPDesk\FlexibleCookies\Settings\Fields\HiddenNonce;
use WPDesk\FlexibleCookies\Settings\Fields\HiddenTabField;
use WPDesk\FlexibleCookies\Settings\Fields\SectionHeader;
use WPDesk\FlexibleCookies\Settings\Fields\WPAction;

class GoogleIntegrationTab extends TabWithFields {

	private CookieCategories $cookie_categories;

	public function __construct( PersistentContainer $settings, Renderer $renderer, CookieCategories $cookie_categories ) {
		$this->cookie_categories = $cookie_categories;
		parent::__construct( $settings, $renderer );
	}

	public function get_subtabs(): array {
		return [];
	}

	public function get_fields(): array {
		return [
			( new WPAction() )
				->set_action_name( 'flexible_cookies_save_settings' ),

			( new HiddenTabField() )
				->set_name( 'tab' )
				->set_default_value( 'google' ),

			( new HiddenNonce( 'save_flxblcks_settings' ) )
				->set_name( '_wpnonce' ),

			( new ToggleField() )
				->set_label( esc_html__( 'Enable GCM', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Enable Google Consent Mode.', 'flexible-cookies' ) )
				->set_name( 'gcm_enabled' )
				->set_default_value( 'false' ),

			/** @phpstan-ignore-next-line */
			( new SelectField() )
				->set_label( esc_html__( 'Consent mode', 'flexible-cookies' ) )
				->set_name( 'gcm_mode' )
				->set_description(
				/* translators: %1$s and %2$s are replaced by opening and closing anchor tag respectively. */
					sprintf( esc_html__( 'Select consent mode, you can learn more about it in %1$sGoogle Privacy Policy%2$s.', 'flexible-cookies' ), '<a href="https://www.google.com/policies/privacy" target="_blank">', '</a>.' )
				)
				->set_default_value( 'basic' )
				->set_options(
					[
						'basic'    => esc_html__( 'Basic', 'flexible-cookies' ),
						'advanced' => esc_html__( 'Advanced', 'flexible-cookies' ),
					]
				),

			( new InputTextField() )
				->set_label( esc_html__( 'Google Tag Manager Container ID', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Enter your GTM ID. In Tag Manager, click Workspace. Near the top of the window, find your container ID, formatted as "GTM-XXXXXX".', 'flexible-cookies' ) )
				->set_name( 'gcm_id' ),

			( new SectionHeader() )
				->set_label( esc_html__( 'Mapping of cookie categories', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Select the cookie category to which you want to assign the google parameter.', 'flexible-cookies' ) ),

			/** @phpstan-ignore-next-line */
			( new SelectField() )
				->set_label( esc_html( 'ad_storage' ) )
				->set_name( 'gcm_param_ad_storage' )
				->set_description( esc_html__( ' Select cookie category for ad_storage parameter.', 'flexible-cookies' ) )
				->set_options( $this->cookie_categories->get_categories_with_slug_and_title_array() ),

			/** @phpstan-ignore-next-line */
			( new SelectField() )
				->set_label( esc_html( 'analytics_storage' ) )
				->set_name( 'gcm_param_analytics_storage' )
				->set_description( esc_html__( ' Select cookie category for analytics_storage parameter.', 'flexible-cookies' ) )
				->set_options( $this->cookie_categories->get_categories_with_slug_and_title_array() ),

			/** @phpstan-ignore-next-line */
			( new SelectField() )
				->set_label( esc_html( 'ad_user_data' ) )
				->set_name( 'gcm_param_ad_user_data' )
				->set_description( esc_html__( ' Select cookie category for ad_user_data parameter.', 'flexible-cookies' ) )
				->set_options( $this->cookie_categories->get_categories_with_slug_and_title_array() ),

			/** @phpstan-ignore-next-line */
			( new SelectField() )
				->set_label( esc_html( 'ad_personalization' ) )
				->set_name( 'gcm_param_ad_personalization' )
				->set_description( esc_html__( ' Select cookie category for ad_personalization parameter.', 'flexible-cookies' ) )
				->set_options( $this->cookie_categories->get_categories_with_slug_and_title_array() ),

			( new SectionHeader() )
				->set_label( esc_html__( 'Default consent values', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Select default value for google parameter. This value will be used if the user has not interacted with the consent banner.', 'flexible-cookies' ) ),

			/** @phpstan-ignore-next-line */
			( new SelectField() )
				->set_label( esc_html( 'ad_storage' ) )
				->set_name( 'gcm_param_ad_storage_default_value' )
				->set_description( esc_html__( 'Select default value for ad_storage parameter.', 'flexible-cookies' ) )
				->set_options(
					[
						'denied'  => esc_html__( 'Denied', 'flexible-cookies' ),
						'granted' => esc_html__( 'Granted', 'flexible-cookies' ),
					]
				)
				->set_default_value( 'denied' ),

			/** @phpstan-ignore-next-line */
			( new SelectField() )
				->set_label( esc_html( 'analytics_storage' ) )
				->set_name( 'gcm_param_analytics_storage_default_value' )
				->set_description( esc_html__( 'Select default value for analytics_storage parameter.', 'flexible-cookies' ) )
				->set_options(
					[
						'denied'  => esc_html__( 'Denied', 'flexible-cookies' ),
						'granted' => esc_html__( 'Granted', 'flexible-cookies' ),
					]
				)
				->set_default_value( 'denied' ),

			/** @phpstan-ignore-next-line */
			( new SelectField() )
				->set_label( esc_html( 'ad_user_data' ) )
				->set_name( 'gcm_param_ad_user_data_default_value' )
				->set_description( esc_html__( 'Select default value for ad_user_data parameter.', 'flexible-cookies' ) )
				->set_options(
					[
						'denied'  => esc_html__( 'Denied', 'flexible-cookies' ),
						'granted' => esc_html__( 'Granted', 'flexible-cookies' ),
					]
				)
				->set_default_value( 'denied' ),

			/** @phpstan-ignore-next-line */
			( new SelectField() )
				->set_label( esc_html( 'ad_personalization' ) )
				->set_name( 'gcm_param_ad_personalization_default_value' )
				->set_description( esc_html__( 'Select default value for ad_personalization parameter.', 'flexible-cookies' ) )
				->set_options(
					[
						'denied'  => esc_html__( 'Denied', 'flexible-cookies' ),
						'granted' => esc_html__( 'Granted', 'flexible-cookies' ),
					]
				)
				->set_default_value( 'denied' ),

			( new SubmitField() )
				->set_label( esc_html__( 'Save', 'flexible-cookies' ) )
				->add_class( 'button-primary' )
				->set_name( 'cookies_save_changes' ),
		];
	}
}
