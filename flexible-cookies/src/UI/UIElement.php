<?php

namespace WPDesk\FlexibleCookies\UI;

use WPDesk\FlexibleCookies\Settings\PreviewSettings;
use WPDesk\FlexibleCookies\Settings\Settings;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
abstract class UIElement implements UIElementsInterface {

	protected string $template;

	/**
	 * @var Settings
	 */
	protected $settings;

	public function __construct() {
		if ( isset( $_GET['fc_preview_id'] ) ) { //phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$preview_id     = wp_unslash( sanitize_key( $_GET['fc_preview_id'] ) ); //phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$this->settings = new PreviewSettings( get_transient( "flexible_cookies_preview_{$preview_id}" ) );
		} else {
			$this->settings = new Settings();
		}
		$this->settings->set_default_values( $this->get_default_params() );
	}

	public function get_template(): string {
		return $this->template;
	}
	abstract protected function get_default_params(): array;

	abstract public function get_params(): array;
}
