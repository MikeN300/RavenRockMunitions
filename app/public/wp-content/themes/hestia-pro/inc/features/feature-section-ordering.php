<?php
/**
 * Customizer functionality for Section ordering control.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

// include customizer section order control
$section_order_path = get_template_directory() . '/inc/customizer-sections-order/customizer-sections-order.php';
if ( file_exists( $section_order_path ) ) {
	require_once( $section_order_path );
}
