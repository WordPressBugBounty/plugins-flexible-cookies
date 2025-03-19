<?php

namespace WPDesk\FlexibleCookies;

use WPDesk\FlexibleCookies\Settings\Fields\WPAction;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @var WPAction $field
 * @var \WPDesk\View\Renderer\Renderer $renderer
 * @var string $name_prefix
 * @var string $value
 * @var string $template_name Real field template.
 */
?>

<input type="hidden" name="action" value="<?php echo esc_attr( $field->get_action_name() ); ?>" />
