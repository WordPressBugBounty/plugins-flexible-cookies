<?php

namespace WPDesk\FlexibleCookies\Settings\Tabs;

interface TabInterface {
	public function get_content(): string;

	public function get_subtabs(): array;

	public function save_data(): void;
}
