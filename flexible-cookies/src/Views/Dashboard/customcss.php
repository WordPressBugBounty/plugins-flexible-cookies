<?php

namespace FlexibleCookiesVendor;

/**
 * @var \WPDesk\Forms\Field $field
 * @var string              $name_prefix
 * @var string              $value
 */
?>

<textarea
	id="<?php echo \esc_attr( $field->get_id() ); ?>"
		<?php
		if ( $field->has_classes() ) :
			?>
			class="<?php echo \esc_attr( $field->get_classes() ); ?>"
		<?php endif; ?>
	name="<?php echo \esc_attr( $name_prefix ); ?>[<?php echo \esc_attr( $field->get_name() ); ?>]"
<?php foreach ( $field->get_attributes() as $key => $attr_val ) : ?>
	<?php echo \esc_attr( $key ); ?>="<?php echo \esc_attr( $attr_val ); ?>"
<?php endforeach; ?>

<?php if ( $field->has_placeholder() ) : ?>
	placeholder="<?php echo \esc_html( $field->get_placeholder() ); ?>"
<?php endif; ?>
>
<?php
echo \stripslashes( esc_html( $value ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
?>
</textarea>
<button name="<?php echo \esc_attr( $name_prefix ); ?>[<?php echo \esc_attr( $field->get_name() ); ?>_reset]"
		id="reset_custom_css" value="reset"
		class="button-secondary"><?php echo esc_html( __( 'Reset', 'flexible-cookies' ) ); ?>
</button>
