<?php


namespace WPDesk\FlexibleCookies\Settings\Tabs\SubTabs\Styles;

use FlexibleCookiesVendor\WPDesk\Forms\Field\SubmitField;
use WPDesk\FlexibleCookies\Settings\Fields\CustomCSSField;
use WPDesk\FlexibleCookies\Settings\Settings;
use WPDesk\FlexibleCookies\Settings\Tabs\SubTabs\SubTabsFields;

/**
 * @package WPDesk\FlexibleCookies
 * @author  Eryk Mika <eryk.mika@wpdesk.eu>
 * @since   1.0.0
 */
class CustomCSSSubTabFields implements SubTabsFields {

	private const PL_DOCS_URL  = 'https://www.wpdesk.pl/sk/flexible-cookies-settings-docs-pl/';
	private const ENG_DOCS_URL = 'https://wpdesk.net/sk/flexible-cookies-settings-docs-en/';

	private Settings $settings;

	public function __construct( Settings $settings ) {
		$this->settings = $settings;
	}

	public function get_fields(): array {
		$custom_css_url = self::ENG_DOCS_URL;
		if ( get_locale() === 'pl_PL' ) {
			$custom_css_url = self::PL_DOCS_URL;
		}

		$custom_css_description = sprintf(
		/* translators: %1$s and %2$s are replaced by opening and closing anchor tag respectively. */
			esc_html__(
				'Enter custom CSS code. You can find instructions for this field in the %1$splugin\'s documentation%2$s.',
				'flexible-cookies'
			),
			'<a href="' . $custom_css_url . '" target="_blank">',
			'</a>'
		);

		return [
			( new CustomCSSField() )
				->set_name( 'custom_css' )
				->set_label( esc_html__( 'Custom CSS', 'flexible-cookies' ) )
				->set_description( $custom_css_description )
				->set_default_value( $this->settings->get_default_custom_css() )
				->add_class( 'large-text code' )
				->set_attribute( 'rows', '35' ),

			( new SubmitField() )
				->set_label( esc_html__( 'Save', 'flexible-cookies' ) )
				->add_class( 'button-primary' )
				->set_name( 'cookies_save_changes' ),
		];
	}
}
