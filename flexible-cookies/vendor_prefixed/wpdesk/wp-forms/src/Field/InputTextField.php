<?php

namespace FlexibleCookiesVendor\WPDesk\Forms\Field;

use FlexibleCookiesVendor\WPDesk\Forms\Sanitizer;
use FlexibleCookiesVendor\WPDesk\Forms\Sanitizer\TextFieldSanitizer;
class InputTextField extends BasicField
{
    public function get_sanitizer(): Sanitizer
    {
        return new TextFieldSanitizer();
    }
    public function get_template_name(): string
    {
        return 'input-text';
    }
}
