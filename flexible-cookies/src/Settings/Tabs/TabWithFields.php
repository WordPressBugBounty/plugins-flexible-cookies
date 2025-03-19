<?php

namespace WPDesk\FlexibleCookies\Settings\Tabs;

use FlexibleCookiesVendor\WPDesk\Forms\Form\FormWithFields;
use FlexibleCookiesVendor\WPDesk\Persistence\PersistentContainer;
use FlexibleCookiesVendor\WPDesk\View\Renderer\Renderer;

abstract class TabWithFields implements TabInterface {

	/**
	 * @var string
	 */
	protected $form_id = 'FlexibleCookies_settings';

	/**
	 * @var PersistentContainer
	 */
	protected $settings;

	/**
	 * @var Renderer
	 */
	protected $renderer;

	/**
	 * @var FormWithFields
	 */
	protected $form_with_fields;

	/**
	 * @var string
	 */
	private const NONCE_ACTION = 'save_flxblcks_settings';
	private const NONCE_NAME   = '_wpnonce';


	/**
	 * @param PersistentContainer $settings
	 * @param Renderer            $renderer
	 */
	public function __construct( PersistentContainer $settings, Renderer $renderer ) {
		$this->settings         = $settings;
		$this->renderer         = $renderer;
		$this->form_with_fields = new FormWithFields( $this->get_fields(), $this->form_id );
		$this->form_with_fields->set_action( admin_url( 'admin-post.php' ) );
	}

	public function get_content(): string {
		return $this->render_content();
	}

	protected function render_content(): string {
		$this->form_with_fields->set_data( $this->settings );

		return $this->form_with_fields->render_form( $this->renderer );
	}

	public function save_data(): void {

		if ( isset( $_POST[ $this->form_id ] ) ) {  //phpcs:ignore WordPress.Security.NonceVerification.Missing

			$this->verify_nonce();

			if ( isset( $_POST[ $this->form_id ]['custom_css_reset'] ) ) { //phpcs:ignore WordPress.Security.NonceVerification.Missing
				$this->settings->delete( 'custom_css' );
				wp_safe_redirect( wp_get_referer() );
				exit;
			}

			$form_data = $_POST[ $this->form_id ]; // phpcs:ignore
			// Sanitized in form_with_fields->handle_request.

			$this->form_with_fields->handle_request( $form_data );
			$this->form_with_fields->put_data( $this->settings );
		}
		wp_safe_redirect( wp_get_referer() );
	}

	private function verify_nonce(): void {
		if ( ! isset( $_POST[ $this->form_id ][ self::NONCE_NAME ] ) ) {
			wp_die( esc_html__( 'An error occurred during form verification. Changes were not saved.', 'flexible-cookies' ) );
		}

		if ( isset( $_POST[ $this->form_id ][ self::NONCE_NAME ] ) && ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST[ $this->form_id ][ self::NONCE_NAME ] ) ), self::NONCE_ACTION ) ) {
			wp_die( esc_html__( 'This form has expired. Try again later.', 'flexible-cookies' ) );
		}
	}

	abstract public function get_fields(): array;
}
