<?php

namespace WPDesk\FlexibleCookies\UI\Styles;

use WPDesk\FlexibleCookies\Settings\Settings;
use WPDesk\FlexibleCookies\UI\UIElement;

/**
 * @package WPDesk\FlexibleCookies
 * @author  Eryk Mika <eryk.mika@wpdesk.eu>
 * @since   1.0.0
 */
class CustomCSS extends UIElement {

	/**
	 * @var string
	 */
	protected $template = 'custom_css';

	public function __construct( Settings $settings ) {
		$this->settings = $settings;
		parent::__construct();
	}

	protected function get_default_params(): array {

		return [
			'custom_css' => $this->settings->get_default_custom_css(),
		];
	}

	public function get_params(): array {
		return [
			'css' => $this->settings->get( 'custom_css' ),
		];
	}
}
