<?php

namespace WPDesk\FlexibleCookies\UI\Styles;

use WPDesk\FlexibleCookies\UI\UIElement;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class PresetStyles extends UIElement {

	/**
	 * @var string
	 */
	protected $template = 'styles';

	protected function get_default_params(): array {
		return [
			'bar_color'                         => '#222',
			'bar_background'                    => '#fff',
			'bar_fullwidth'                     => false,
			'bar_width'                         => '450px',
			'bar_position'                      => 'left',

			'settings_window_header_color'      => '#222',
			'settings_window_description_color' => '#444',
			'settings_window_background'        => '#ffffff',

			'buttons_custom_styling'            => true,
			'buttons_color'                     => '#ffffff',
			'buttons_background'                => '#FFAA00',
			'buttons_background_hover'          => '#EE9900',
		];
	}

	public function get_params(): array {
		$params = [
			'bar'         => [
				'color'      => $this->settings->get( 'bar_color' ),
				'background' => $this->settings->get( 'bar_background' ),
				'fullwidth'  => $this->settings->get_boolean( 'bar_fullwidth' ),
				'width'      => $this->settings->get( 'bar_width' ),
				'position'   => $this->settings->get( 'bar_position' ),
			],
			'preferences' => [
				'header_color'      => $this->settings->get( 'settings_window_header_color' ),
				'description_color' => $this->settings->get( 'settings_window_description_color' ),
				'background'        => $this->settings->get( 'settings_window_background' ),
			],
			'buttons'     => [
				'custom_styling'   => $this->settings->get_boolean( 'buttons_custom_styling' ),
				'color'            => $this->settings->get( 'buttons_color' ),
				'background'       => $this->settings->get( 'buttons_background' ),
				'background_hover' => $this->settings->get( 'buttons_background_hover' ),
			],
		];

		return $params;
	}
}
