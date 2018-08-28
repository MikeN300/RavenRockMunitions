<?php
/**
 * Shortcodes module.
 *
 * @package hestia
 * @since 1.1.34
 */

/**
 * Function to register a shortcode for each section.
 *
 * @since 1.1.34
 */
function hestia_create_shortcodes() {
	$tags = array(
		'hestia_features',
		'hestia_testimonials',
		'hestia_team',
		'hestia_subscribe',
		'hestia_shop',
		'hestia_pricing',
		'hestia_portfolio',
		'hestia_contact',
		'hestia_slider',
		'hestia_blog',
		'hestia_ribbon',
		'hestia_clients_bar',
	);
	foreach ( $tags as $tag ) {
		add_shortcode( $tag, 'hestia_shortcode' );
	}
}
add_action( 'init', 'hestia_create_shortcodes' );

/**
 * Shortcode action.
 *
 * @param mixed  $atts Shortcode attributes.
 * @param null   $content Content.
 * @param string $tag Shortcode name.
 * @since 1.1.34
 */
function hestia_shortcode( $atts, $content = null, $tag = '' ) {

	$full_width_sections = array(
		'hestia_slider',
	);

	if ( function_exists( $tag ) ) {
		if ( in_array( $tag, $full_width_sections ) ) {
			call_user_func( $tag );
		} else {
			call_user_func( $tag, true );
		}
	}
}

/**
 * Enqueue script for shortcodes title attributes.
 *
 * @since 1.1.34
 */
function hestia_shortcodes_script() {
	wp_enqueue_script( 'hestia-shortcodes-script', get_template_directory_uri() . '/inc/shortcodes/js/script.js', array( 'jquery' ), HESTIA_VERSION, true );
	$control_settings = array(
		'sections_container' => '#accordion-panel-hestia_frontpage_sections > ul, #sub-accordion-panel-hestia_frontpage_sections',
		'blocked_items'      => '#accordion-section-hestia_slider, #accordion-section-hestia_info_jetpack, #accordion-section-hestia_info_woocommerce',
	);
	wp_localize_script( 'hestia-shortcodes-script', 'shortcode_settings', $control_settings );
}
add_action( 'customize_controls_enqueue_scripts', 'hestia_shortcodes_script' );
