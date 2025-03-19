<?php

namespace WPDesk\FlexibleCookies\Settings\Tabs;

use FlexibleCookiesVendor\WPDesk\View\Renderer\SimplePhpRenderer;
use FlexibleCookiesVendor\WPDesk\View\Resolver\DirResolver;
use WPDesk\FlexibleCookies\Cookies\ExternalCookies;
use WPDesk\FlexibleCookies\Helpers\PathHelper;
use WPDesk\FlexibleCookies\Settings\Fields\HiddenTabField;
use WPDesk\FlexibleCookies\Settings\Fields\WPAction;

class ScannerTab implements TabInterface {

	/**
	 * @var ExternalCookies
	 */
	private $external_cookies;
	private const SCANNER_TEMPLATE_SLUG   = 'scanner';
	private const SCANNER_TEMPLATE_FOLDER = 'Scanner';
	private const NONCE_NAME              = '_wpnonce';

	/**
	 * @var string
	 */
	private const NONCE_ACTION = 'save_flxblcks_settings';


	public function __construct( ExternalCookies $external_cookies ) {
		$this->external_cookies = $external_cookies;
	}

	public function get_content(): string {
		return $this->render_page();
	}

	public function get_subtabs(): array {
		return [];
	}

	public function render_page(): string {
		return $this->render();
	}

	private function render(): string {
		$renderer = new SimplePhpRenderer( new DirResolver( PathHelper::get_templates_path() . self::SCANNER_TEMPLATE_FOLDER ) );

		return $renderer->render( self::SCANNER_TEMPLATE_SLUG );
	}

	public function save_data(): void {
		if ( isset( $_POST['save'] ) && current_user_can( 'manage_options' ) ) {//phpcs:ignore WordPress.Security.NonceVerification.Missing

			$this->verify_nonce();

			$cookie_table = [];

			if ( ! empty( $_POST['cookie_name'] ) ) { //phpcs:ignore WordPress.Security.NonceVerification.Missing
				foreach ( $_POST['cookie_name'] as $cookie_name ) { // phpcs:ignore
					$cookie_table[ sanitize_text_field( wp_unslash( $cookie_name ) ) ] = sanitize_text_field( wp_unslash( $_POST[ $cookie_name ] ) ); // phpcs:ignore
				}

				$this->external_cookies->add_cookies_to_category( $cookie_table );

				( new \FlexibleCookiesVendor\WPDesk\Notice\Notice( esc_html__( 'Saved.', 'flexible-cookies' ), 'success' ) );
			} else {
				( new \FlexibleCookiesVendor\WPDesk\Notice\Notice( esc_html__( 'Select one or more cookies to save.', 'flexible-cookies' ), 'error' ) );
			}
		}
		wp_safe_redirect( wp_get_referer() );
		exit;
	}

	private function verify_nonce(): void {
		if ( ! isset( $_POST[ self::NONCE_NAME ] ) ) {
			wp_die( esc_html__( 'An error occurred during form verification. Changes were not saved.', 'flexible-cookies' ) );
		}

		if ( isset( $_POST[ self::NONCE_NAME ] ) && ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ self::NONCE_NAME ] ) ), self::NONCE_ACTION ) ) {
			wp_die( esc_html__( 'This form has expired. Try again later.', 'flexible-cookies' ) );
		}
	}
}
