<?php

namespace FlexibleCookiesVendor\WPDesk\Forms;

interface Escaper
{
    /** @param mixed $value */
    public function escape($value): string;
}
