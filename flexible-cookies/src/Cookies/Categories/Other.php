<?php

namespace WPDesk\FlexibleCookies\Cookies\Categories;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class Other extends Template {

	/**
	 * @var string
	 */
	protected $settings_slug = 'other';

	/**
	 * @var string[]
	 */
	protected $cookie_template = [
		'MARKETING_COOKIE_TEMPLATE_1',
		'MARKETING_COOKIE_TEMPLATE_2',
	];

	public function __construct() {
		$this->title               = esc_html__( 'Others', 'flexible-cookies' );
		$this->default_description = esc_html__( 'Other uncategorized cookies are those that are being analyzed and have not been classified into a category as yet.', 'flexible-cookies' );
		parent::__construct();
	}
}
