<?php

namespace FlexibleCookiesVendor\WPDesk\Forms\Validator;

use FlexibleCookiesVendor\WPDesk\Forms\Validator;
class RequiredValidator implements Validator
{
    public function is_valid($value): bool
    {
        return $value !== null;
    }
    public function get_messages(): array
    {
        return [];
    }
}
