<?php

namespace WPDesk\FlexibleCookies\Google\ConsentMode;

interface ConsentMode {

	public function enqueue_scripts();
	public function set_default_values( array $default_values );
}
