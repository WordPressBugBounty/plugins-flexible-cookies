<?php

namespace WPDesk\FlexibleCookies\Settings\Tabs;

use FlexibleCookiesVendor\WPDesk\Forms\Field\NoOnceField;
use FlexibleCookiesVendor\WPDesk\Persistence\PersistentContainer;
use FlexibleCookiesVendor\WPDesk\View\Renderer\Renderer;
use WPDesk\FlexibleCookies\Settings\Fields\HiddenNonce;
use WPDesk\FlexibleCookies\Settings\Fields\HiddenTabField;
use WPDesk\FlexibleCookies\Settings\Fields\WPAction;
use WPDesk\FlexibleCookies\Settings\Settings;
use WPDesk\FlexibleCookies\Settings\Tabs\SubTabs\Styles\BarSubTabFields;
use WPDesk\FlexibleCookies\Settings\Tabs\SubTabs\Styles\ButtonsSubTabFields;
use WPDesk\FlexibleCookies\Settings\Tabs\SubTabs\Styles\CustomCSSSubTabFields;
use WPDesk\FlexibleCookies\Settings\Tabs\SubTabs\Styles\SettingsSubTabFields;

class StylesTab extends TabWithFields {

	private const SUBTAB_BAR_SLUG      = 'bar';
	private const SUBTAB_BUTTONS_SLUG  = 'buttons';
	private const SUBTAB_OTHER_SLUG    = 'other';
	private const SUBTAB_SETTINGS_SLUG = 'settings';
	private const SUBTAB_KEY           = 'subtab';

	/**
	 * @var Renderer
	 */
	protected $renderer;

	/**
	 * @var Settings
	 */
	protected $settings;

	public function get_fields(): array {
		$subtab = isset( $_REQUEST[ self::SUBTAB_KEY ] ) ? sanitize_key( $_REQUEST[ self::SUBTAB_KEY ] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		$fields = [];

		switch ( $subtab ) {
			case self::SUBTAB_BUTTONS_SLUG:
				$fields = ( new ButtonsSubTabFields() )->get_fields();
				break;
			case self::SUBTAB_SETTINGS_SLUG:
				$fields = ( new SettingsSubTabFields() )->get_fields();
				break;
			case self::SUBTAB_OTHER_SLUG:
				$fields = ( new CustomCSSSubTabFields( $this->settings ) )->get_fields();
				break;
			default:
				$fields = ( new BarSubTabFields() )->get_fields();
				break;
		}

		$fields = array_merge( $this->get_tab_fields( $subtab ), $fields );

		return $fields;
	}

	private function get_tab_fields( $subtab_slug ): array {
		return [
			( new WPAction() )
				->set_action_name( 'flexible_cookies_save_settings' ),

			( new HiddenTabField() )
				->set_name( 'tab' )
				->set_default_value( 'styles' ),

			( new HiddenTabField() )
				->set_name( 'subtab' )
				->set_default_value( $subtab_slug ),
			( new HiddenNonce( 'save_flxblcks_settings' ) )
				->set_name( '_wpnonce' ),
		];
	}

	public function get_subtabs(): array {
		return [
			self::SUBTAB_BAR_SLUG      => esc_html__( 'Cookie Bar', 'flexible-cookies' ),
			self::SUBTAB_BUTTONS_SLUG  => esc_html__( 'Buttons', 'flexible-cookies' ),
			self::SUBTAB_SETTINGS_SLUG => esc_html__( 'Preferences window', 'flexible-cookies' ),
			self::SUBTAB_OTHER_SLUG    => esc_html__( 'Custom CSS', 'flexible-cookies' ),
		];
	}
}
