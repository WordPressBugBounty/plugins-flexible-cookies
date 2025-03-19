<?php

namespace WPDesk\FlexibleCookies\Google\ConsentMode;

use WPDesk\FlexibleCookies\Helpers\PathHelper;

class BasicCM implements ConsentMode {
	private const GTM_SCRIPT_HANDLE = 'flexible-cookies-basic-consent-mode';

	protected string $gtm_id;

	protected array $default_values;

	protected string $plugin_version;

	public function __construct( string $gtm_id, string $plugin_version ) {
		$this->gtm_id         = $gtm_id;
		$this->plugin_version = $plugin_version;
	}

	private function enqueue_gtm_script() {
		//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NotInFooter
		wp_enqueue_script( self::GTM_SCRIPT_HANDLE, PathHelper::get_assets_url( 'js/google/basic/basicConsentInit.js' ), [], $this->plugin_version );
		wp_localize_script( self::GTM_SCRIPT_HANDLE, 'basicCMSettings', [ 'gtmId' => $this->gtm_id ] );
	}

	public function enqueue_scripts() {
		$this->enqueue_gtm_script();
	}

	public function set_default_values( array $default_values ): void {
		$this->default_values = $default_values;
	}
}
