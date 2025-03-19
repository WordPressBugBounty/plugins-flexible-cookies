<?php
/**
 * @var array $params
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<style>
	<?php
	//phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo stripslashes( wp_kses_post( $params['css'] ) );
	?>
</style>

