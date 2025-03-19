<?php

namespace WPDesk\FlexibleCookies\Settings\Fields;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class WPAction extends \FlexibleCookiesVendor\WPDesk\Forms\Field\BasicField {
	public function should_override_form_template(): bool {
		return true;
	}

	public function get_template_name(): string {
		return 'wpaction';
	}

	public function set_action_name( string $value ): \FlexibleCookiesVendor\WPDesk\Forms\Field {
		$this->meta['action_name'] = $value;
		return $this;
	}

	public function get_action_name(): string {
		/** @phpstan-ignore-next-line */
		return $this->meta['action_name'];
	}
}
