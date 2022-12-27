<?php

/**
 * Check if acf is loading
 *
 * @return bool
 */
function xcore_loading_requirements()
{
	if ( ! function_exists( 'get_field' ) ) {
		return false;
	}

	return true;
}

/**
 * Output frontend notice if acf is missing
 */
add_action( 'at_init', function () {
	if ( ! xcore_loading_requirements() ) {
		?>
		<style>
			body {
				background: #f8f9fa;
			}

			.wrapper {
				max-width: 800px;
				margin: 0 auto;
			}

			.alert {
				position: relative;
				padding: .75rem 1.25rem;
				margin-bottom: 1rem;
				border: 1px solid transparent;
				border-radius: .25rem;
				position: fixed;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
			}

			.alert-danger {
				color: #721c24;
				background-color: #f8d7da;
				border-color: #f5c6cb;
			}
		</style>

		<div class="wrapper">
			<div class="alert alert-danger">
				<p><strong>Warning:</strong> Required Plugin <a href="https://www.advancedcustomfields.com/" target="_blank">Advanced Custom Fields PRO</a> is missing. Please download and activate the plugin.</p>
			</div>
		</div>
		<?php

		die();
	}
} );

add_action( 'admin_notices', function () {
	if ( ! xcore_loading_requirements() ) {
		?>
		<div class="notice notice-error">
			<p><strong>Warning:</strong> Required Plugin <a href="https://www.advancedcustomfields.com/" target="_blank">Advanced Custom Fields PRO</a> is missing. Please download and activate the plugin.</p>
		</div>
		<?php
	}
} );