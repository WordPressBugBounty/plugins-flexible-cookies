<?php

namespace WPDesk\FlexibleCookies\Settings\Fields;

use FlexibleCookiesVendor\WPDesk\Forms\Field\Paragraph;

class SectionHeader extends Paragraph {

	public function get_template_name(): string {
		return 'section-header';
	}
}
