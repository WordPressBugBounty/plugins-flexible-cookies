<?php

namespace WPDesk\FlexibleCookies\Cookies\Categories;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class Advertising extends Template {

	/**
	 * @var string
	 */
	protected $settings_slug = 'advertising';

	public function __construct() {
		$this->title               = esc_html__( 'Advertisement', 'flexible-cookies' );
		$this->default_description = esc_html__( 'Advertisement cookies are used to provide visitors with relevant ads and marketing campaigns. These cookies track visitors across websites and collect information to provide customized ads.', 'flexible-cookies' );
		parent::__construct();
	}
}
