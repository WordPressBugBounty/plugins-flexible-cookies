<?php

namespace WPDesk\FlexibleCookies\Settings;

use FlexibleCookiesVendor\WPDesk\Persistence\Adapter\WordPress\WordpressOptionsContainer;
use FlexibleCookiesVendor\WPDesk\Persistence\PersistentContainer;
use WPDesk\FlexibleCookies\Settings\Tabs\SubTabs\Styles\BarSubTabFields;
use WPDesk\FlexibleCookies\Settings\Tabs\SubTabs\Styles\ButtonsSubTabFields;
use WPDesk\FlexibleCookies\Settings\Tabs\SubTabs\Styles\SettingsSubTabFields;

/**
 * @package WPDesk\FlexibleCookies
 * @author  Eryk Mika <eryk.mika@wpdesk.eu>
 * @since   1.0.0
 */
class Settings implements PersistentContainer {
	public const SETTINGS_PREFIX = 'flexibleCookies_';

	/**
	 * @var WordpressOptionsContainer
	 */
	protected $persistance;

	/**
	 * @var array
	 */
	protected $default_values;

	public function __construct() {
		$this->persistance = new WordpressOptionsContainer( self::SETTINGS_PREFIX );
	}

	public function get_settings(): PersistentContainer {
		return $this->persistance;
	}

	public function set( string $id, $value ): void {
		$this->persistance->set( $id, $value );
	}

	public function get( $id ) {
		$default = $this->default_values[ $id ] ?? null;

		return $this->persistance->get_fallback( $id, $default );
	}

	public function get_boolean( string $name ): bool {
		return filter_var( $this->get( $name ), FILTER_VALIDATE_BOOLEAN );
	}

	public function set_default_values( array $default_values ): void {
		$this->default_values = $default_values;
	}

	public function get_fallback( string $id, $fallback = null ) {
		return $this->persistance->get_fallback( $id, $fallback );
	}

	public function delete( string $id ) {
		$this->persistance->delete( $id );
	}

	public function has( $id ): bool {
		return $this->persistance->has( $id );
	}

	public function get_default_custom_css(): string { //phpcs:ignore Generic.Metrics.CyclomaticComplexity.TooHigh
		$styles = [
			'button'   => [
				'background'     => $this->get( 'buttons_background' ) ?? ButtonsSubTabFields::DEFAULT_BACKGROUND_COLOR,
				'color'          => $this->get( 'buttons_color' ) ?? ButtonsSubTabFields::DEFAULT_TEXT_COLOR,
				'teritary_color' => $this->get( 'buttons_color' ) ?? '#222',
				'hover'          => $this->get( 'buttons_background_hover' ) ?? ButtonsSubTabFields::DEFAULT_BACKGROUND_HOVER_COLOR,
			],
			'bar'      => [
				'background' => $this->get( 'bar_background' ) ?? BarSubTabFields::DEFAULT_BACKGROUND_COLOR,
				'color'      => $this->get( 'bar_color' ) ?? BarSubTabFields::DEFAULT_TEXT_COLOR,
				'width'      => $this->get( 'bar_width' ) ?? BarSubTabFields::DEFAULT_WIDTH,
				'position'   => $this->get( 'bar_position' ) ?? BarSubTabFields::DEFAULT_POSITION,
				'fullwidth'  => ( $this->get( 'bar_fullwidth' ) ?? BarSubTabFields::DEFAULT_FULLWIDTH ) === 'yes',
			],
			'settings' => [
				'header_color'      => $this->get( 'settings_window_header_color' ) ?? SettingsSubTabFields::DEFAULT_HEADER_COLOR,
				'header_background' => $this->get( 'settings_window_header_background' ) ?? SettingsSubTabFields::DEFAULT_BACKGROUND_COLOR,
				'description_color' => $this->get( 'settings_window_description_color' ) ?? SettingsSubTabFields::DEFAULT_DESCRIPTION_COLOR,
			],
		];

		return '#flexiblecookies_container div#flexiblecookies_cookie_banner{
	bottom:40px;
	flex-wrap: wrap;
	left: ' . ( $styles['bar']['fullwidth'] ? '40px;' : ( $styles['bar']['position'] === 'left' ? '40px' : 'unset' ) ) . ';
	right: ' . ( $styles['bar']['fullwidth'] ? '40px;' : ( $styles['bar']['position'] === 'right' ? '40px' : 'unset' ) ) . ';
	color:' . $styles['bar']['color'] . ';
	background:' . $styles['bar']['background'] . ';
	width:' . ( $styles['bar']['fullwidth'] ? 'auto' : $styles['bar']['width'] ) . ';
}
.flexible-cookies-reopen-settings, #flexiblecookies_settings_container, #flexiblecookies_container div#flexiblecookies_cookie_banner{
	box-shadow:0 0 50px #00000030;
}
div#flexiblecookies_cookie_banner span.flexiblecookies_cookie_text{
	margin-bottom:15px;
	margin-right:0;
}
div#flexiblecookies_cookie_banner button:hover{
	transform:translatey(-2px);
}

div#flexiblecookies_cookie_banner button, button#flexiblecookies_accept_settings_cookies{
	width:auto;
	padding:5px 10px;
	transition:0.3s;
}

button#flexiblecookies_accept_cookies, button#flexiblecookies_accept_settings_cookies{
	background:' . $styles['button']['background'] . ';
	border:2px solid ' . $styles['button']['background'] . ';
	color:' . $styles['button']['color'] . ';
}
button#flexiblecookies_accept_cookies:hover, button#flexiblecookies_accept_settings_cookies:hover{
	background:' . $styles['button']['hover'] . ';
	border:2px solid ' . $styles['button']['hover'] . ';
}

button#flexiblecookies_deny_cookies{
	background:transparent;
	border:2px solid ' . $styles['button']['background'] . ';
	color:' . $styles['button']['background'] . ';
}
button#flexiblecookies_deny_cookies:hover{
	border-color:' . $styles['button']['hover'] . ';
}

button#flexiblecookies_open_settings{
	padding:0;
	padding-bottom:5px;
	background:transparent;
	color:' . $styles['button']['teritary_color'] . ';
	border-bottom:2px solid ' . $styles['button']['background'] . ';
}
button#flexiblecookies_open_settings:hover{
	border-color:' . $styles['button']['hover'] . ';
}

#flexiblecookies_settings_container, #flexiblecookies_container div#flexiblecookies_cookie_banner{
	flex-wrap: wrap;
	border-radius:10px;
	padding:20px 26px;
}

#flexiblecookies_settings_container{
	color:' . $styles['settings']['description_color'] . ';
	background:' . $styles['settings']['description_color'] . ';
}

@media (max-width:768px){
	#flexiblecookies_container div#flexiblecookies_cookie_banner{
		width:auto;
		left:10px;
		right:10px;
		bottom:10px;
	}
	div#flexiblecookies_settings_container{
		width:auto;
		top:10px;
		left:10px;
		right:10px;
		transform:none;
		overflow-y:auto;
		bottom:10px;
	}
	span#flexiblecookies_settings{
		height:auto;
	}
}';
	}
}
