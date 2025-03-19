<?php

namespace WPDesk\FlexibleCookies\Google\ConsentMode;

use WPDesk\FlexibleCookies\Helpers\PathHelper;

class AdvancedCM extends BasicCM {

	public function enqueue_scripts() {
		$this->enqueue_gtm_script();
	}

	private function enqueue_gtm_script() {
		//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.NotInFooter
		wp_enqueue_script( 'flexible-cookies-advanced-consent-mode-google-tag-manager', PathHelper::get_assets_url( 'js/google/advanced/advancedConsentInit.js' ), [], $this->plugin_version );
		wp_localize_script( 'flexible-cookies-advanced-consent-mode-google-tag-manager', 'advancedCMSettings', [ 'gtmId' => $this->gtm_id ] );
	}
}
