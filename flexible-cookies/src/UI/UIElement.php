<?php

namespace WPDesk\FlexibleCookies\UI;

use WPDesk\FlexibleCookies\Settings\Settings;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
abstract class UIElement implements UIElementsInterface {

	/**
	 * @var string
	 */
	protected $template;

	/**
	 * @var Settings
	 */
	protected $settings;

	public function __construct() {
		$this->settings = new Settings();
		$this->settings->set_default_values( $this->get_default_params() );
	}

	public function get_template(): string {
		return $this->template;
	}
	abstract protected function get_default_params(): array;

	abstract public function get_params(): array;
}
