<?php

namespace FlexibleCookiesVendor\WPDesk\Forms\Validator;

use FlexibleCookiesVendor\WPDesk\Forms\Validator;
class NoValidateValidator implements Validator
{
    public function is_valid($value): bool
    {
        return \true;
    }
    public function get_messages(): array
    {
        return [];
    }
}
