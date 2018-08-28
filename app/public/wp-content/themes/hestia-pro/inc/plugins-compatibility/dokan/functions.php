<?php
/**
 * Compatibility functions for Dokan Multivendor functions
 *
 * @package hestia
 * @since 1.1.44
 */

/**
 * Enqueue style for dokan plugin.
 *
 * @since 1.1.44
 */
function hestia_enqueue_dokan_style() {
	wp_enqueue_style( 'hestia-dokan-style', get_template_directory_uri() . '/inc/plugins-compatibility/dokan/css/style.css', array(), HESTIA_VENDOR_VERSION );
}
add_action( 'wp_enqueue_scripts', 'hestia_enqueue_dokan_style' );

/**
 * Add wraper for new-product-single for Dokan
 *
 * @since 1.1.44
 */
function hestia_before_wrap() {
	?>
	<div class="section section-text pagebuilder-section">
	<?php
}
add_action( 'dokan_dashboard_wrap_before', 'hestia_before_wrap' );

/**
 * Close wrapper for new-product-single for Dokan
 *
 * @since 1.1.44
 */
function hestia_after_wrap() {

	?>
	</div>
	<?php
}
add_action( 'dokan_dashboard_wrap_after', 'hestia_after_wrap' );
