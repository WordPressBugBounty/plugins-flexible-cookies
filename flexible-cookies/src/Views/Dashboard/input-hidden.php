<?php

namespace WPDesk\FlexibleCookies;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @var \WPDesk\Forms\Field $field
 * @var \WPDesk\View\Renderer\Renderer $renderer
 * @var string $name_prefix
 * @var string $value
 * @var string $template_name Real field template.
 */
?>

<input type="hidden" name="<?php echo esc_attr( $field->get_name() ); ?>" value="<?php echo esc_attr( $field->get_default_value() ); ?>" />
