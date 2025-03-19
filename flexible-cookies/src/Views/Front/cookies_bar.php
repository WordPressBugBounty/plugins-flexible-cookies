<?php
/**
 * @var array $params
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="flexiblecookies_container">
	<div id="flexiblecookies_cookie_banner">
		<span class="flexiblecookies_cookie_text">
			<h3><?php echo esc_html( $params['title'] ); ?></h3>
			<p><?php echo wp_kses_post( $params['message'] ); ?></p>
		</span>
		<span class="flexiblecookies_cookie_actions">
			<button id="flexiblecookies_accept_cookies"><?php echo esc_html__( 'Accept all', 'flexible-cookies' ); ?></button>
			<button id="flexiblecookies_deny_cookies"><?php echo esc_html__( 'Deny all', 'flexible-cookies' ); ?></button>
			<button id="flexiblecookies_open_settings" class="flexiblecookies_open_settings_button"><?php echo esc_html__( 'Preferences', 'flexible-cookies' ); ?></button>
		</span>
	</div>
</div>

