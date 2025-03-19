<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$iframe_url = add_query_arg( 'flexible_cookies', 'runScanner', get_home_url() );

// Cookies in <tbody> are added dynamically in assets/js/scanner/scanner_reveicer.js.
?>

<h3><?php echo esc_html__( 'Page preview', 'flexible-cookies' ); ?></h3>
<iframe id="flexible_cookies_scanner_iframe" src="<?php echo esc_url( $iframe_url ); ?>"></iframe>
<form method="post" action=" <?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
	<?php wp_nonce_field( 'save_flxblcks_settings' ); ?>
	<input type="hidden" name="tab" value="scanner">
	<input type="hidden" name="action" value="flexible_cookies_save_settings">

	<div class="scanned_cookies">
		<span class="scanner_spinner"><?php echo esc_html__( 'Scanning...', 'flexible-cookies' ); ?></span>
		<table id="flexible_cookies_cookie_table">
			<thead>
			<tr>
				<th><input type="checkbox" class="select_all_cookies" checked></th>
				<th> <?php echo esc_html__( 'Cookie name', 'flexible-cookies' ); ?></th>
				<th> <?php echo esc_html__( 'Category', 'flexible-cookies' ); ?></th>
			</tr>
			</thead>
			<tbody>

			</tbody>
		</table>
	</div>
	<?php submit_button( esc_html__( 'Save', 'flexible-cookies' ), 'primary', 'save' ); ?>
</form>
