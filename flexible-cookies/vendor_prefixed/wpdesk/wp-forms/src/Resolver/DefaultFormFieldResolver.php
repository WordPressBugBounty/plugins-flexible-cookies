<?php

namespace FlexibleCookiesVendor\WPDesk\Forms\Resolver;

use FlexibleCookiesVendor\WPDesk\View\Renderer\Renderer;
use FlexibleCookiesVendor\WPDesk\View\Resolver\DirResolver;
use FlexibleCookiesVendor\WPDesk\View\Resolver\Resolver;
/**
 * Use with View to resolver form fields to default templates.
 *
 * @package WPDesk\Forms\Resolver
 */
class DefaultFormFieldResolver implements Resolver
{
    /** @var Resolver */
    private $dir_resolver;
    public function __construct()
    {
        $this->dir_resolver = new DirResolver(__DIR__ . '/../../templates');
    }
    public function resolve($name, Renderer $renderer = null): string
    {
        return $this->dir_resolver->resolve($name, $renderer);
    }
}
