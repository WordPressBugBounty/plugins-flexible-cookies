<?php

// phpcs:disable WordPress.PHP.DiscouragedPHPFunctions
namespace FlexibleCookiesVendor\WPDesk\Forms\Serializer;

use FlexibleCookiesVendor\WPDesk\Forms\Serializer;
class SerializeSerializer implements Serializer
{
    public function serialize($value): string
    {
        return serialize($value);
    }
    public function unserialize(string $value)
    {
        return unserialize($value);
    }
}
