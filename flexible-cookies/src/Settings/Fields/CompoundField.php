<?php

namespace WPDesk\FlexibleCookies\Settings\Fields;

use FlexibleCookiesVendor\WPDesk\Forms\Field\BasicField;

class CompoundField extends BasicField {

	private array $fields = [];

	public function get_template_name(): string {
		return 'input-compound';
	}

	public function add_field( BasicField $field ): self {
		$this->fields[] = $field;
		return $this;
	}

	public function get_fields(): array {
		return $this->fields;
	}
}
