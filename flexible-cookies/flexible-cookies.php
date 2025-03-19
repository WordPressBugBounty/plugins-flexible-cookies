<?php
/**
 * Plugin Name: Flexible Cookies
 * Plugin URI: https://www.wpdesk.net/products/flexible-cookies/
 * Description: Plugin for managing cookies
 * Version: 1.1.9
 * Author: WP Desk
 * Author URI: https://www.wpdesk.net/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: flexible-cookies
 * Domain Path: /lang/
 * Requires at least: 6.2
 * Tested up to: 6.5
 * Requires PHP: 7.4
 * Copyright 2022 WP Desk Ltd.
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

use WPDesk\FlexibleCookies\Plugin;

defined( 'ABSPATH' ) || exit;

/* THESE TWO VARIABLES CAN BE CHANGED AUTOMATICALLY */
$plugin_version = '1.1.9';

$plugin_name        = 'Flexible Cookies';
$plugin_class_name  = Plugin::class;
$plugin_text_domain = 'flexible-cookies';
$product_id         = 'Flexible Cookies';
$plugin_file        = __FILE__;
$plugin_dir         = __DIR__;

$requirements = [
	'php'          => '7.4',
	'wp'           => '5.7',
	'repo_plugins' => [],
];

require __DIR__ . '/vendor_prefixed/wpdesk/wp-plugin-flow-common/src/plugin-init-php52-free.php';
