<?php

namespace WPDesk\FlexibleCookies\Cookies\Categories;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class Functional extends Template {

	/**
	 * @var string
	 */
	protected $settings_slug = 'functional';

	public function __construct() {
		$this->title               = esc_html__( 'Functional', 'flexible-cookies' );
		$this->default_description = esc_html__( 'Functional cookies help to perform certain functionalities like sharing the content of the website on social media platforms, collect feedbacks, and other third-party features.', 'flexible-cookies' );
		parent::__construct();
	}
}
