<?php

namespace WPDesk\FlexibleCookies\Settings\Tabs;

use FlexibleCookiesVendor\WPDesk\Forms\Field\CheckboxField;
use FlexibleCookiesVendor\WPDesk\Forms\Field\InputNumberField;
use FlexibleCookiesVendor\WPDesk\Forms\Field\InputTextField;
use FlexibleCookiesVendor\WPDesk\Forms\Field\SubmitField;
use WPDesk\FlexibleCookies\Settings\Fields\HiddenNonce;
use WPDesk\FlexibleCookies\Settings\Fields\HiddenTabField;
use WPDesk\FlexibleCookies\Settings\Fields\WPAction;
use WPDesk\FlexibleCookies\Settings\Fields\WPEditorField;

class GeneralTab extends TabWithFields {

	public function get_subtabs(): array {
		return [];
	}

	public function get_fields(): array {
		return [
			( new WPAction() )
				->set_action_name( 'flexible_cookies_save_settings' ),

			( new HiddenTabField() )
				->set_name( 'tab' )
				->set_default_value( 'general' ),

			( new HiddenNonce( 'save_flxblcks_settings' ) )
				->set_name( '_wpnonce' ),

			( new CheckboxField() )
				->set_label( esc_html__( 'Show cookie bar on page', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Check if you want to display a banner with information about cookies for visitors.', 'flexible-cookies' ) )
				->set_name( 'banner_enabled' ),

			( new CheckboxField() )
				->set_label( esc_html__( 'Simple cookie bar', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Check if you want the bar to be used only to inform about the use of cookies on the site. Enabling this option will prevent visitors from being able to manage their cookie preferences.', 'flexible-cookies' ) )
				->set_name( 'simple_cookie_bar' )
				->add_class( 'mgr_hide_if_checked' ),

			( new CheckboxField() )
				->set_label( esc_html__( 'Block cookies before accepting', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Check if you want cookies to be blocked before the visitor makes a choice.', 'flexible-cookies' ) )
				->set_name( 'block_cookies_until_accepted' )
				->set_default_value( 'yes' )
				->add_class( 'hide_if_checked' ),

			( new CheckboxField() )
				->set_label( esc_html__( 'Admin mode', 'flexible-cookies' ) )
				->set_description( esc_html__( 'If enabled, cookies will not be blocked for users with admin permissions', 'flexible-cookies' ) )
				->set_name( 'admin_mode' )
				->set_default_value( 'yes' ),

			( new InputTextField() )
				->set_label( esc_html__( 'Title', 'flexible-cookies' ) )
				->set_name( 'banner_title' )
				->set_default_value( esc_html__( 'We value your privacy', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Enter the title that will be displayed in the banner informing about the use of cookies on the site.', 'flexible-cookies' ) ),

			( new WPEditorField() )
				->set_label( esc_html__( 'Message about cookies', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Enter the message that will be displayed in the banner informing about the use of cookies on the site.', 'flexible-cookies' ) )
				->set_name( 'banner_message' )
				->set_default_value(
					esc_html__( 'This website uses cookies to improve your experience while you navigate through the website. Out of these, the cookies that are categorized as necessary are stored on your browser as they are essential for the working of basic functionalities of the website. We also use third-party cookies that help us analyze and understand how you use this website. These cookies will be stored in your browser only with your consent. You also have the option to opt-out of these cookies.', 'flexible-cookies' )
				),

			( new CheckboxField() )
				->set_label( esc_html__( 'Automatically accept cookies', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Automatically accept cookies after selected time.', 'flexible-cookies' ) )
				->set_name( 'auto_accept_cookies_time' )
				->set_default_value( 'no' )
				->add_class( 'mgr_hide_if_not_checked' ),

			( new InputNumberField() )
				->set_label( esc_html__( 'Time to automatically accept cookies', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Enter the time after which cookies will be automatically accepted (in seconds).', 'flexible-cookies' ) )
				->set_name( 'auto_accept_cookies_after_seconds' )
				->set_default_value( '5' )
				->add_class( 'hide_if_not_checked' ),

			( new CheckboxField() )
				->set_label( esc_html__( 'Automatically accept cookies on scroll', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Automatically accept cookies if user scrolls down.', 'flexible-cookies' ) )
				->set_name( 'auto_accept_cookies_scroll' )
				->set_default_value( 'no' ),

			( new SubmitField() )
				->set_label( esc_html__( 'Save', 'flexible-cookies' ) )
				->add_class( 'button-primary' )
				->set_name( 'cookies_save_changes' ),
		];
	}
}
