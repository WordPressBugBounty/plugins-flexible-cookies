<?php
/**
 * @var array $params
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<style>
	/* bar */
	#flexiblecookies_container {
		all: unset;
		display: none;
		font-size: 13px;
	}

	#flexiblecookies_cookie_banner {
		background: <?php echo esc_html( $params['bar']['background'] ); ?>;
		padding: 10px 20px;
		display: flex;
		align-items: center;
		flex-wrap: wrap;
		flex-direction: column;
		justify-content: center;
		position: fixed;
		bottom: 0px;
	<?php echo $params['bar']['position'] === 'right' ? 'right:0;' : 'left:0'; ?>;
		box-sizing: border-box;
		width: <?php echo $params['bar']['fullwidth'] ? '100%' : ( empty( $params['bar']['width'] ) ? 'auto' : esc_html( $params['bar']['width'] ) ); ?>;
		z-index: 9997;
		text-align: left;
	}

	span.flexiblecookies_cookie_text {
		flex: 1;
		margin-right: 20px;
	}

	span.flexiblecookies_cookie_text p {
		margin: 0;
		padding: 0;
		font-size: 12px;
		font-weight: 400;
		color: <?php echo esc_html( $params['bar']['color'] ); ?>;
	}

	span.flexiblecookies_cookie_text h3, #flexiblecookies_settings_header h3 {
		all: unset;
		font-size: 21px;
		color: #333;
		font-weight: 400;
	}

	/* preferences */
	#flexiblecookies_settings_background {
		display: none;
		z-index: 9998;
		width: 100%;
		height: 100%;
		position: fixed;
		backdrop-filter: grayscale(90) blur(5px);
		-webkit-backdrop-filter: grayscale(90) blur(5px);
		left: 0;
		right: 0;
		top: 0;
		bottom: 0;
		background: #00000090;
	}

	#flexiblecookies_settings_container {
		width: 700px;
		min-height: 600px;
		height: auto;
		background: <?php echo esc_html( $params['preferences']['background'] ); ?>;

		color: #333333;
		position: fixed;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		z-index: 9999;
		padding: 10px;
		display: none;
		flex-direction: column;
	}

	#flexiblecookies_settings table {
		width: 100%;
		border-spacing: 0 5px;
	}

	#flexiblecookies_settings_header {
		width: 100%;
		display: flex;
		position: relative;
	}

	#flexiblecookies_settings_header h3 {
		text-align: center;
		width: 100%;
		height: 45px;
		color: #555;
		margin: 0;
		flex: 1;
	}

	#flexiblecookies_close_settings {
		cursor: pointer;
		position: absolute;
		right: 10px;
		top: 3px;
	}

	#flexiblecookies_settings {
		margin: 20px 0px;
		height: 500px;
		display: inherit;
		overflow-y: auto;
	}

	.cookie_settings_bottom_row {
		text-align: right;
		display: block;
	}

	.flexiblecookies-description {
		font-size: 10px;
		padding-bottom: 10px;
		border-bottom: 1px solid #eee;
		color: <?php echo esc_html( $params['preferences']['description_color'] ); ?>;
	}

	.flexiblecookies-category-label {
		margin: 3px;
		font-size: 18px;
		font-weight: 300;
		color: <?php echo esc_html( $params['preferences']['header_color'] ); ?>;
	}

	.flexiblecookies-required-label {
		font-size: 10px;
		font-weight: bold;
		color: #610000;
	}

	/* buttons */

	.flexiblecookies_cookie_actions {
		display: flex;
		flex-wrap: nowrap;
		flex-direction: row;
		gap: 10px;
		width: 100%;
		justify-content: space-between;
	}

	.flexiblecookies_cookie_actions button, .cookie_settings_bottom_row button {
		all: unset;
		font-size: 12px;
		text-align: center;
	}

	<?php if ( $params['buttons']['custom_styling'] ) : ?>
	.flexiblecookies_cookie_actions button, .cookie_settings_bottom_row button {
		background: <?php echo esc_html( $params['buttons']['background'] ); ?>;
		color: <?php echo esc_html( $params['buttons']['color'] ); ?>;
		cursor: pointer;
	}

	.flexiblecookies_cookie_actions button:hover, .cookie_settings_bottom_row button:hover {
		background: <?php echo esc_html( $params['buttons']['background_hover'] ); ?>;
	}

	<?php endif; ?>


	/* toggle checkboxes */
	.checkbox__toggle {
		display: inline-block;
		height: 17px;
		position: relative;
		width: 30px;
	}

	.checkbox__toggle input {
		display: none;
	}

	.checkbox__toggle-slider {
		background-color: #ccc;
		bottom: 0;
		cursor: pointer;
		left: 0;
		position: absolute;
		right: 0;
		top: 0;
		transition: .4s;
	}

	.checkbox__toggle-slider:before {
		background-color: #fff;
		bottom: 2px;
		content: "";
		height: 13px;
		left: 2px;
		position: absolute;
		transition: .4s;
		width: 13px;
	}

	input:checked + .checkbox__toggle-slider {
		background-color: #66bb6a;
	}

	input:checked + .checkbox__toggle-slider:before {
		transform: translateX(13px);
	}

	.checkbox__toggle-slider {
		border-radius: 17px;
	}

	.checkbox__toggle-slider:before {
		border-radius: 50%;
	}
</style>
