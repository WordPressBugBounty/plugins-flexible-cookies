<?php


namespace WPDesk\FlexibleCookies\Settings\Tabs\SubTabs\Styles;

use FlexibleCookiesVendor\WPDesk\Forms\Field\NoOnceField;
use FlexibleCookiesVendor\WPDesk\Forms\Field\SubmitField;
use WPDesk\FlexibleCookies\Settings\Fields\ColorPickerField;
use WPDesk\FlexibleCookies\Settings\Fields\WPAction;
use WPDesk\FlexibleCookies\Settings\Tabs\SubTabs\SubTabsFields;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class SettingsSubTabFields implements SubTabsFields {

	public function get_fields(): array {
		return [

			( new ColorPickerField() )
				->set_label( esc_html__( 'Header color', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Choose the color of the header with the category name.', 'flexible-cookies' ) )
				->set_default_value( '#222222' )
				->set_name( 'settings_window_header_color' ),

			( new ColorPickerField() )
				->set_label( esc_html__( 'Description color', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Choose the color of the text with the category description.', 'flexible-cookies' ) )
				->set_default_value( '#444444' )
				->set_name( 'settings_window_description_color' ),

			( new ColorPickerField() )
				->set_label( esc_html__( 'Background color', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Choose the background color of the preference window.', 'flexible-cookies' ) )
				->set_default_value( '#ffffff' )
				->set_name( 'settings_window_background' ),

			( new SubmitField() )
				->set_label( esc_html__( 'Save', 'flexible-cookies' ) )
				->add_class( 'button-primary' )
				->set_name( 'cookies_save_changes' ),
		];
	}
}
