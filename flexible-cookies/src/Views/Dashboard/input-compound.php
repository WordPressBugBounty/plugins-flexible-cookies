<?php

namespace FlexibleCookiesVendor;

use FlexibleCookiesVendor\WPDesk\Forms\Field\BasicField;
use WPDesk\FlexibleCookies\Settings\Fields\CompoundField;

/**
 * @var CompoundField $field
 * @var \WPDesk\View\Renderer\Renderer $renderer
 * @var string $name_prefix
 * @var string $value
 * @var string $template_name Real field template.
 */
if ( empty( $value ) || \is_string( $value ) ) {
	$input_values[] = $value;
} else {
	$input_values = $value;
}

if ( ! empty( $field->get_name() ) ) {
	$name_prefix = $name_prefix . '[' . $field->get_name() . ']';
}
/**
 * @var $compound_field BasicField
 */
?>
<div class="compound-wrapper <?php echo esc_attr( $field->get_classes() ); ?>" style="display: flex; gap: 4px;">
<?php
foreach ( $field->get_fields() as $compound_field ) :
	?>
	<div class="compound-field">
		<?php if ( $compound_field->get_description() ) : ?>
			<p class="compound-field-description description" style="font-size: 12px; margin-top:0; text-align: center;"><?php echo wp_kses_post( $compound_field->get_description() ); ?></p>
			<?php
		endif;
			$renderer->output_render(
				$compound_field->get_template_name(),
				[
					'field'         => $compound_field,
					'renderer'      => $renderer,
					'name_prefix'   => $name_prefix,
					'value'         => $input_values[ $compound_field->get_name() ] ?? $compound_field->get_default_value(),
					'template_name' => $compound_field->get_template_name(),
				]
			);
	?>
	</div>
<?php endforeach; ?>
</div>
