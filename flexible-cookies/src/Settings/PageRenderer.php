<?php

namespace WPDesk\FlexibleCookies\Settings;

use FlexibleCookiesVendor\WPDesk\View\Renderer\Renderer;
use WPDesk\FlexibleCookies\Settings\Tabs\TabInterface;

class PageRenderer {

	/**
	 * @var Renderer
	 */
	private $renderer;

	private const SETTINGS_TEMPLATE = 'settings';

	public function __construct( Renderer $renderer ) {
		$this->renderer = $renderer;
	}

	public function render( TabInterface $tab, array $params = [] ): void {
		$params['form']    = $tab->get_content();
		$params['subtabs'] = $tab->get_subtabs();

		$this->renderer->output_render( self::SETTINGS_TEMPLATE, $params );
	}
}
