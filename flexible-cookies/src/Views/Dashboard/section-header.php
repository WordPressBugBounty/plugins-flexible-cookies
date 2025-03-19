<?php

namespace FlexibleCookiesVendor;

/**
 * @var \WPDesk\Forms\Field $field
 * @var string $name_prefix
 * @var string $value
 */
if ( $field->has_label() ) {
	?>
	<tr>
		<td style="padding-left:0;" colspan="2">
			<h2 
			<?php
			if ( $field->has_classes() ) :
				?>
					class="
					<?php
					echo \esc_attr( $field->get_classes() );
					?>
					"
				<?php endif; ?>>
				<?php echo \wp_kses_post( $field->get_label() ); ?>
			</h2>
			<?php if ( $field->has_description() ) : ?>
				<p
				<?php
				if ( $field->has_classes() ) :
					?>
					class="
					<?php
					echo \esc_attr( $field->get_classes() );
					?>
					"
				<?php endif; ?>>
					<?php echo \wp_kses_post( $field->get_description() ); ?>
				</p>
			<?php endif; ?>
		</td>
	</tr>
	<?php
}
