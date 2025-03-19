<?php

namespace WPDesk\FlexibleCookies\Cookies\Categories;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class Performance extends Template {

	/**
	 * @var string
	 */
	protected $settings_slug = 'performance';

	public function __construct() {
		$this->title               = esc_html__( 'Performance', 'flexible-cookies' );
		$this->default_description = esc_html__( 'Performance cookies are used to understand and analyze the key performance indexes of the website which helps in delivering a better user experience for the visitors.', 'flexible-cookies' );
		parent::__construct();
	}
}
