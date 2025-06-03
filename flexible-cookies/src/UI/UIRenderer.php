<?php

namespace WPDesk\FlexibleCookies\UI;

use FlexibleCookiesVendor\WPDesk\View\Renderer\Renderer;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 *
 * Class outputs rendered HTML of frontend UI elements
 */
class UIRenderer {

	private Renderer $renderer;

	public function __construct( Renderer $renderer ) {
		$this->renderer = $renderer;
	}

	public function output( UIElement $ui ): void {
		$content = $this->renderer->render( $ui->get_template(), $ui->get_params() );
		$content = apply_filters( 'flexible_cookies_template_content', $content, $ui );
		echo $content; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
