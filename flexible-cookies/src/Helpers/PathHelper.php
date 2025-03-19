<?php

namespace WPDesk\FlexibleCookies\Helpers;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class PathHelper {
	public static function get_assets_url( string $path = '' ): string {
		return plugin_dir_url( dirname( __DIR__ ) ) . 'assets/' . ltrim( $path, '/' );
	}
	public static function get_assets_path( string $path = '' ): string {
		return plugin_dir_path( dirname( __DIR__ ) ) . 'assets/' . ltrim( $path, '/' );
	}
	public static function get_templates_path( string $path = '' ): string {
		return plugin_dir_path( __DIR__ ) . 'Views/' . ltrim( $path, '/' );
	}
}
