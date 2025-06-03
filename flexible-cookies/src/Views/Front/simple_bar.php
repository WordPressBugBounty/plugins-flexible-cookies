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
	<p><?php echo esc_js( $params['message'] ); ?></p>
	</span>
		<span class="flexiblecookies_cookie_actions">
	<button id="flexiblecookies_accept_cookies" class="flexible-cookies-button primary"><?php echo esc_html__( 'Accept', 'flexible-cookies' ); ?></button>
	</span>
	</div>
</div>

