<?php

namespace FlexibleCookiesVendor\WPDesk\Forms\Sanitizer;

use FlexibleCookiesVendor\WPDesk\Forms\Sanitizer;
class NoSanitize implements Sanitizer
{
    public function sanitize($value)
    {
        return $value;
    }
}
