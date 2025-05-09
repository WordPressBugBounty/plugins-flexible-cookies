<?php

namespace FlexibleCookiesVendor;

/**
 * @var \WPDesk\Forms\Field $field
 * @var \WPDesk\View\Renderer\Renderer $renderer
 * @var string $name_prefix
 * @var string $value
 * @var string $template_name Real field template.
 */
?>

<button
	type="<?php 
echo \esc_attr($field->get_type());
?>"
	name="<?php 
echo \esc_attr($name_prefix) . '[' . \esc_attr($field->get_name()) . ']';
?>"
	id="<?php 
echo \esc_attr($field->get_id());
?>"
	value="<?php 
echo \esc_html($value);
?>"
	<?php 
if ($field->has_classes()) {
    ?>
		class="<?php 
    echo \esc_attr($field->get_classes());
    ?>"
	<?php 
}
?>
	<?php 
foreach ($field->get_attributes() as $key => $val) {
    ?>
		<?php 
    echo \esc_attr($key) . '="' . \esc_attr($val) . '"';
    ?>
	<?php 
}
?>

><?php 
echo \esc_html($field->get_label());
?></button>

<?php 
