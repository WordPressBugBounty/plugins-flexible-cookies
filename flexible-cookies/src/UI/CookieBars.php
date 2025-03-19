<?php

namespace WPDesk\FlexibleCookies\UI;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
abstract class CookieBars extends UIElement {
	protected function get_default_params(): array {
		return [
			'banner_message' => esc_html__( 'This website uses cookies to improve your experience while you navigate through the website. Out of these, the cookies that are categorized as necessary are stored on your browser as they are essential for the working of basic functionalities of the website. We also use third-party cookies that help us analyze and understand how you use this website. These cookies will be stored in your browser only with your consent. You also have the option to opt-out of these cookies.', 'flexible-cookies' ),
			'banner_title'   => esc_html__( 'We value your privacy', 'flexible-cookies' ),
		];
	}

	public function get_params(): array {

		return [
			'message' => $this->settings->get( 'banner_message' ),
			'title'   => $this->settings->get( 'banner_title' ),
		];
	}
}
