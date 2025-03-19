<?php

namespace WPDesk\FlexibleCookies\Helpers;

/**
 * @package WPDesk\FlexibleCookies
 * @author Eryk Mika <eryk.mika@wpdesk.eu>
 * @since 1.0.0
 */
class CSVReader {

	private const DELIMITER = ';';

	public function get_data( string $file_path ): array {
		$data = [];

		if ( file_exists( $file_path ) ) {
			$file = fopen( $file_path, 'r' );

			while ( ( $file_data = fgetcsv( $file, 0, self::DELIMITER ) ) ) { // phpcs:ignore Generic.CodeAnalysis.AssignmentInCondition.FoundInWhileCondition
				$category    = strtolower( $file_data[0] );
				$name        = $file_data[1];
				$description = $file_data[2];
				$data[]      = [
					'name'        => $name,
					'category'    => $category,
					'description' => $description,
				];
			}

			fclose( $file );
		}

		return $data;
	}
}
