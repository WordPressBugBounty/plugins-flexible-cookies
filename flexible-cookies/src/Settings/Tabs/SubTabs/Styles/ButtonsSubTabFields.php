<?php


namespace WPDesk\FlexibleCookies\Settings\Tabs\SubTabs\Styles;

use FlexibleCookiesVendor\WPDesk\Forms\Field\CheckboxField;
use FlexibleCookiesVendor\WPDesk\Forms\Field\SubmitField;
use WPDesk\FlexibleCookies\Settings\Fields\ColorPickerField;
use WPDesk\FlexibleCookies\Settings\Tabs\SubTabs\SubTabsFields;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class ButtonsSubTabFields implements SubTabsFields {

	public function get_fields(): array {
		return [

			( new CheckboxField() )
				->set_label( esc_html__( 'Enable custom styling', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Enable options to customize buttons. While the option is disabled, button styles will be loaded from the default theme.', 'flexible-cookies' ) )
				->add_class( 'mgr_hide_if_not_checked' )
				->set_default_value( 'yes' )
				->set_name( 'buttons_custom_styling' ),

			( new ColorPickerField() )
				->set_label( esc_html__( 'Text color', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Select the color of the button text.', 'flexible-cookies' ) )
				->add_class( 'hide_if_not_checked' )
				->set_default_value( '#fff' )
				->set_name( 'buttons_color' ),

			( new ColorPickerField() )
				->set_label( esc_html__( 'Background color', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Select the background color of the buttons.', 'flexible-cookies' ) )
				->add_class( 'hide_if_not_checked' )
				->set_default_value( '#FFAA00' )
				->set_name( 'buttons_background' ),

			( new ColorPickerField() )
				->set_label( esc_html__( 'Hover background color', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Select the background color that will be applied if the user places the cursor over the button.', 'flexible-cookies' ) )
				->add_class( 'hide_if_not_checked' )
				->set_default_value( '#EE9900' )
				->set_name( 'buttons_background_hover' ),

			( new SubmitField() )
				->set_label( esc_html__( 'Save', 'flexible-cookies' ) )
				->add_class( 'button-primary' )
				->set_name( 'cookies_save_changes' ),
		];
	}
}
