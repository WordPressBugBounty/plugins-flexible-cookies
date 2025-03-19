<?php

namespace WPDesk\FlexibleCookies\UI;

use FlexibleCookiesVendor\WPDesk\PluginBuilder\Plugin\Hookable;
use WPDesk\FlexibleCookies\Settings\Settings;
use WPDesk\FlexibleCookies\UI\Styles\CustomCSS;
use WPDesk\FlexibleCookies\UI\Styles\PresetStyles;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 *
 * Class hooks rendered HTML of frontend UI elements to WordPress hooks
 */
class UI implements Hookable {

	/**
	 * @var UIRenderer
	 */
	private $renderer;

	/**
	 * @var boolean
	 */
	private $simple_bar;

	/**
	 * @var Settings
	 */
	private Settings $settings;


	public function __construct( UIRenderer $renderer, bool $simple_bar, Settings $settings ) {
		$this->renderer   = $renderer;
		$this->simple_bar = $simple_bar;
		$this->settings   = $settings;
	}

	public function hooks() {

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

		add_action( 'wp_head', [ $this, 'render_custom_css' ] );
		add_action( 'wp_head', [ $this, 'render_styles' ] );
		if ( ! $this->simple_bar ) {
			add_action( 'wp_footer', [ $this, 'render_preferences' ] );
			add_action( 'wp_footer', [ $this, 'render_bar' ] );
		} else {
			add_action( 'wp_footer', [ $this, 'render_simple_bar' ] );
		}
	}

	public function render_preferences(): void {
		$this->renderer->output( new Preferences() );
		$this->renderer->output( new PreferencesButton() );
	}

	public function render_bar(): void {
		$this->renderer->output( new Bar() );
	}

	public function render_simple_bar(): void {
		$this->renderer->output( new SimpleBar() );
	}

	public function render_custom_css(): void {
		$this->renderer->output( new CustomCSS( $this->settings ) );
	}

	public function render_styles(): void {
		$this->renderer->output( new PresetStyles() );
	}

	public function enqueue_scripts(): void {
		wp_enqueue_script( 'flexible_cookies_blocker' );
		wp_enqueue_script( 'flexible_cookies_functions' );
		wp_enqueue_script( 'flexible_cookies_banner' );
	}
}
