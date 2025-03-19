<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$form            = $params['form'] ?? '';
$tab             = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'general'; // phpcs:ignore
$tabs            = $params['tabs'] ?? []; // phpcs:ignore
$subtabs         = $params['subtabs'] ?? [];
$subtab          = isset( $_GET['subtab'] ) ? sanitize_key( $_GET['subtab'] ) : ''; // phpcs:ignore
$default_subtabs = [
	'advanced' => 'advertising',
	'styles'   => 'bar',
];

?>
<div class="wrap" id="flexible-cookies-form-wrapper">
	<h1><?php echo esc_html__( 'Flexible Cookies', 'flexible-cookies' ); ?></h1>
	<div id="flexible-cookies-settings-header">
		<nav class="nav-tab-wrapper woo-nav-tab-wrapper">
			<?php
			foreach ( $tabs as $slug => $name ) :

				$current_tab = '';
				if ( $slug === $tab ) {
					$current_tab = $tab;
				}

				?>

				<a href="<?php echo esc_url( admin_url( 'options-general.php?page=cookies-settings-page' ) ); ?>&tab=<?php echo esc_attr( $slug ); ?>"
					class="nav-tab
					<?php
					if ( $current_tab ) :
						?>
						nav-tab-active<?php endif; ?>">
					<?php echo esc_html( $name ); ?>
				</a>

				<?php
			endforeach;
			?>
		</nav>
		<?php if ( ! empty( $subtabs ) ) : ?>
			<ul class="subsubsub">
				<?php


				if ( ! $subtab ) {
					switch ( $tab ) {
						case 'advanced':
							$subtab = $default_subtabs['advanced'];
							break;
						case 'styles':
							$subtab = $default_subtabs['styles'];
							break;
					}
				}

				foreach ( $subtabs as $slug => $name ) :
					$current_subtab = '';

					if ( $slug === $subtab ) {
						$current_subtab = $slug;
					}

					?>

					<li>
						<a href="<?php echo esc_url( admin_url( 'options-general.php?page=cookies-settings-page' ) ); ?>&tab=<?php echo esc_attr( $tab ); ?>&subtab=<?php echo esc_attr( $slug ); ?>"
							class="
							<?php
							if ( $current_subtab ) :
								?>
								current<?php endif; ?>">
							<?php echo esc_html( $name ); ?>
						</a>
						<span class="divider"> | </span>
					</li>
					<?php
				endforeach;
				?>
			</ul>
		<?php endif; ?>
	</div>
	<?php
	echo $form; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	// Every form element is escaped separately while rendering.
	?>
</div>
