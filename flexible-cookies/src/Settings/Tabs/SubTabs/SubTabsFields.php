<?php

namespace WPDesk\FlexibleCookies\Settings\Tabs\SubTabs;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
interface SubTabsFields {
	/**
	 * @return array
	 */
	public function get_fields(): array;
}
