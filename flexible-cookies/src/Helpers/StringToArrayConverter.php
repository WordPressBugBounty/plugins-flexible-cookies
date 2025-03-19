<?php

namespace WPDesk\FlexibleCookies\Helpers;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class StringToArrayConverter {
	public static function convert_string_to_array( string $text ): array {
		$text = preg_replace( '/\s+/', '', $text );

		return explode( ',', $text );
	}
}
