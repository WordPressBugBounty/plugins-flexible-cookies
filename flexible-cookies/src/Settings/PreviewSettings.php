<?php

namespace WPDesk\FlexibleCookies\Settings;

class PreviewSettings extends Settings {

	private array $preview_settings;

	public function __construct( array $preview_settings ) {
		parent::__construct();
		$this->preview_settings = $preview_settings;
	}

	public function set( string $id, $value ): void {
		$this->persistance->set( $id, $value );
	}

	public function get( $id ) {
		$default = parent::get( $id );

		return $this->preview_settings[ $id ] ?? $default;
	}
}
