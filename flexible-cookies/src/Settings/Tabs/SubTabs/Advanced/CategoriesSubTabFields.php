<?php

namespace WPDesk\FlexibleCookies\Settings\Tabs\SubTabs\Advanced;

use FlexibleCookiesVendor\WPDesk\Forms\Field\CheckboxField;
use FlexibleCookiesVendor\WPDesk\Forms\Field\MultipleInputTextField;
use FlexibleCookiesVendor\WPDesk\Forms\Field\NoOnceField;
use FlexibleCookiesVendor\WPDesk\Forms\Field\SubmitField;
use WPDesk\FlexibleCookies\Settings\Fields\HiddenNonce;
use WPDesk\FlexibleCookies\Settings\Fields\HiddenTabField;
use WPDesk\FlexibleCookies\Settings\Fields\WPAction;
use WPDesk\FlexibleCookies\Settings\Fields\WPEditorField;
use WPDesk\FlexibleCookies\Settings\Tabs\SubTabs\SubTabsFields;

/**
 * @package WPDesk\FlexibleCookies
 * @author  Eryk Mika <eryk.mika@wpdesk.eu>
 * @since   1.0.0
 */
class CategoriesSubTabFields implements SubTabsFields {

	private const NECESSARY_TAB_SLUG   = 'necessary';
	private const ADVERTISING_TAB_SLUG = 'advertising';

	public function get_fields( string $slug = self::ADVERTISING_TAB_SLUG, string $description = '' ): array {
		if ( empty( $slug ) ) {
			$slug = self::ADVERTISING_TAB_SLUG;
		}
		$fields = [];
		if ( $slug !== self::NECESSARY_TAB_SLUG ) {
			$fields = [
				( new CheckboxField() )
					->set_label( esc_html__( 'Necessary category', 'flexible-cookies' ) )
					->set_description( esc_html__( 'Do not allow the use of this category of cookies to be disabled.', 'flexible-cookies' ) )
					->set_name( 'require_' . $slug )
					->set_default_value( 'no' ),
			];
		}

		$fields = array_merge(
			$fields,
			[
				( new HiddenNonce( 'save_flxblcks_settings' ) )
					->set_name( '_wpnonce' ),

				( new WPAction() )
					->set_action_name( 'flexible_cookies_save_settings' ),

				( new HiddenTabField() )
					->set_name( 'tab' )
					->set_default_value( 'advanced' ),

				( new HiddenTabField() )
					->set_name( 'subtab' )
					->set_default_value( $slug ),

				( new WPEditorField() )
					->set_label( esc_html__( 'Category description', 'flexible-cookies' ) )
					->set_description( esc_html__( 'Edit the description of the cookie category, visible in the preferences window.', 'flexible-cookies' ) )
					->set_name( 'category_' . $slug . '_description' )
					->set_default_value( $description ),

				( new MultipleInputTextField() )
					->set_label( esc_html__( 'Additional cookies', 'flexible-cookies' ) )
					->set_description( esc_html__( 'Manually add the names of additional cookies in this category.', 'flexible-cookies' ) )
					->set_name( $slug . '_cookies' ),

				( new WPAction() )
					->set_action_name( 'flexible_cookies_save_settings' ),
			]
		);

		if ( $slug !== self::NECESSARY_TAB_SLUG ) {
			$fields = array_merge(
				$fields,
				[
					( new CheckboxField() )
						->set_label( esc_html__( 'Enable/disable category', 'flexible-cookies' ) )
						->set_description( esc_html__( 'When the option Disable is selected, the category will not be visible to the user and cookies will be automatically blocked (not recommended).', 'flexible-cookies' ) )
						->set_name( 'category_' . $slug . '_enabled' )
						->set_default_value( 'yes' ),
				]
			);

		}
		$fields[] = ( new SubmitField() )
			->set_label( esc_html__( 'Save', 'flexible-cookies' ) )
			->add_class( 'button-primary' )
			->set_name( 'cookies_save_changes' );

		return $fields;
	}
}
