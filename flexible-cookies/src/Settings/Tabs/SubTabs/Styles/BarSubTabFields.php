<?php


namespace WPDesk\FlexibleCookies\Settings\Tabs\SubTabs\Styles;

use FlexibleCookiesVendor\WPDesk\Forms\Field\InputTextField;
use FlexibleCookiesVendor\WPDesk\Forms\Field\SelectField;
use FlexibleCookiesVendor\WPDesk\Forms\Field\SubmitField;
use FlexibleCookiesVendor\WPDesk\Forms\Field\ToggleField;
use WPDesk\FlexibleCookies\Settings\Fields\ColorPickerField;
use WPDesk\FlexibleCookies\Settings\Tabs\SubTabs\SubTabsFields;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class BarSubTabFields implements SubTabsFields {

	public const DEFAULT_TEXT_COLOR       = '#222';
	public const DEFAULT_BACKGROUND_COLOR = '#FFF';
	public const DEFAULT_FULLWIDTH        = 'no';
	public const DEFAULT_WIDTH            = '450px';
	public const DEFAULT_POSITION         = 'left';

	public function get_fields(): array {
		return [

			( new ColorPickerField() )
				->set_label( esc_html__( 'Text color', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Select the color of the text on the cookie bar.', 'flexible-cookies' ) )
				->set_default_value( self::DEFAULT_TEXT_COLOR )
				->set_name( 'bar_color' ),

			( new ColorPickerField() )
				->set_label( esc_html__( 'Background color', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Select the background color of the cookie bar.', 'flexible-cookies' ) )
				->set_default_value( self::DEFAULT_BACKGROUND_COLOR )
				->set_name( 'bar_background' ),

			( new ToggleField() )
				->set_label( esc_html__( 'Full width', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Disable this option if you want to set the bar in the corner of the screen.', 'flexible-cookies' ) )
				->set_default_value( self::DEFAULT_FULLWIDTH )
				->add_class( 'mgr_hide_if_checked' )
				->set_name( 'bar_fullwidth' ),

			( new InputTextField() )
				->set_label( esc_html__( 'Width', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Enter the width of the cookie bar.', 'flexible-cookies' ) )
				->set_placeholder( self::DEFAULT_WIDTH )
				->add_class( 'hide_if_checked' )
				->set_name( 'bar_width' ),

			/** @phpstan-ignore-next-line */
			( new SelectField() )
				->set_label( esc_html__( 'Position', 'flexible-cookies' ) )
				->set_description( esc_html__( 'Select the position of the cookie bar.', 'flexible-cookies' ) )
				->set_name( 'bar_position' )
				->set_options(
					[
						'left'  => esc_html__( 'Left', 'flexible-cookies' ),
						'right' => esc_html__( 'Right', 'flexible-cookies' ),
					]
				)
				->set_default_value( self::DEFAULT_POSITION )
				->add_class( 'hide_if_checked' ),

			( new SubmitField() )
				->set_label( esc_html__( 'Save', 'flexible-cookies' ) )
				->add_class( 'button-primary' )
				->set_name( 'cookies_save_changes' ),
		];
	}
}
