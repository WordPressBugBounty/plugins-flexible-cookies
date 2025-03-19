<?php

namespace WPDesk\FlexibleCookies\Cookies\Categories;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class Analytics extends Template {

	/**
	 * @var string
	 */
	protected $settings_slug = 'analytics';

	public function __construct() {
		$this->title               = esc_html__( 'Analytics', 'flexible-cookies' );
		$this->default_description = esc_html__( 'Analytical cookies are used to understand how visitors interact with the website. These cookies help provide information on metrics the number of visitors, bounce rate, traffic source, etc.', 'flexible-cookies' );
		parent::__construct();
	}
}
