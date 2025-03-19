<?php

namespace FlexibleCookiesVendor\WPDesk\Forms\Sanitizer;

use FlexibleCookiesVendor\WPDesk\Forms\Sanitizer;
class EmailSanitizer implements Sanitizer
{
    public function sanitize($value): string
    {
        return sanitize_email($value);
    }
}
