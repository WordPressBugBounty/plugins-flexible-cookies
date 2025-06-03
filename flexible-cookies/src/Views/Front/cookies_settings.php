<?php
/**
 * @var array $params
 * @var \FlexibleCookiesVendor\WPDesk\View\Renderer\Renderer $this
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="flexiblecookies_settings_background"></div>
<div id="flexiblecookies_settings_container">
	<span id="flexiblecookies_settings_header">
		<h3><?php echo esc_html__( 'Cookies preferences', 'flexible-cookies' ); ?></h3>
		<span id="flexiblecookies_close_settings">✕</span>
	</span>
	<span id="flexiblecookies_settings">
		<table>
			<tbody>
				<?php

				$cookie_categories = apply_filters( 'flexible_cookies_displayed_categories', $params['cookies_categories'] );
				/* Look at plugin cookie value for accepted categories */
				$accepted_categories  = $params['accepted_cookies'];
				$accepted_all_cookies = $params['accepted_all_cookies'];

				foreach ( $cookie_categories as $slug => $category ) :
					$name = $category->get_title();
					if ( ! empty( $category ) ) :
						if ( $category->is_enabled() ) :

							if ( $category->is_necessary() ) :
								$this->output_render(
									'preferences/category_row',
									[
										'name'     => $name,
										'required' => true,
									]
								);
							elseif ( ! $accepted_all_cookies ) :

								if ( in_array( $slug, $accepted_categories, true ) ) :
									$this->output_render(
										'preferences/category_row',
										[
											'name'       => $name,
											'value'      => $slug,
											'attributes' => 'checked',
											'required'   => false,
										]
									);
									elseif ( ! in_array( $slug, $accepted_categories, true ) ) :
										$this->output_render(
											'preferences/category_row',
											[
												'name'     => $name,
												'value'    => $slug,
												'required' => false,
											]
										);
									endif;
								else :
									$this->output_render(
										'preferences/category_row',
										[
											'name'       => $name,
											'value'      => $slug,
											'attributes' => 'checked',
											'required'   => false,
										]
									);
							endif;
								?>
							<tr>
							<td colspan="2"
								class="flexiblecookies-description"><?php echo wp_kses_post( $category->get_description() ); ?></td>
							</tr>
							<?php
						endif;
					endif;
				endforeach;
				?>
			</tbody>
		</table>
		</span>
	<span class="cookie_settings_bottom_row">
		<button id="flexiblecookies_accept_settings_cookies" class="flexible-cookies-button primary"><?php echo esc_html__( 'Save and accept', 'flexible-cookies' ); ?></button>
	</span>
</div>
