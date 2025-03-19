<?php
/**
 * @var array $params
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<tr>
	<td><p class="flexiblecookies-category-label"> <?php echo esc_html( $params['name'] ); ?></p></td>
	<?php
	if ( $params['required'] ) :
		?>
		<td class="flexiblecookies-required-label"><?php echo esc_html__( 'Necessary', 'flexible-cookies' ); ?></td>
		<?php
	else :
		?>
		<td style='text-align: right;'>
			<label class="checkbox__toggle" for="wpdesk-checkbox-<?php echo esc_attr( $params['value'] ); ?>-category">
				<input type="checkbox" id="wpdesk-checkbox-<?php echo esc_attr( $params['value'] ); ?>-category"
						value="<?php echo esc_attr( $params['value'] ); ?>"
						class="wpdesk-cookie-category" <?php echo esc_attr( $params['attributes'] ?? '' ); ?>>
				<div class="checkbox__toggle-slider"></div>
			</label>

		</td>

		<?php
	endif;
	?>

</tr>
