<?php
/**
 * WPML and Polylang compatibility functions.
 *
 * @package hestia
 * @since 1.1.34
 */

/**
 * Filter to translate strings
 */
function hestia_translate_single_string( $original_value, $domain ) {
	if ( is_customize_preview() ) {
		$wpml_translation = $original_value;
	} else {
		$wpml_translation = apply_filters( 'wpml_translate_single_string', $original_value, $domain, $original_value );
		if ( $wpml_translation === $original_value && function_exists( 'pll__' ) ) {
			return pll__( $original_value );
		}
	}
	return $wpml_translation;
}
add_filter( 'hestia_translate_single_string', 'hestia_translate_single_string', 10, 2 );

/**
 * Helper to register pll string.
 *
 * @param String    $theme_mod Theme mod name.
 * @param bool/json $default Default value.
 * @param String    $name Name for polylang backend.
 */
function hestia_pll_string_register_helper( $theme_mod, $default = false, $name ) {
	if ( ! function_exists( 'pll_register_string' ) ) {
		return;
	}

	$repeater_content = get_theme_mod( $theme_mod, $default );
	$repeater_content = json_decode( $repeater_content );
	if ( ! empty( $repeater_content ) ) {
		foreach ( $repeater_content as $repeater_item ) {
			foreach ( $repeater_item as $field_name => $field_value ) {
				if ( $field_value !== 'undefined' ) {
					if ( $field_name === 'social_repeater' ) {
						$social_repeater_value = json_decode( $field_value );
						if ( ! empty( $social_repeater_value ) ) {
							foreach ( $social_repeater_value as $social ) {
								foreach ( $social as $key => $value ) {
									if ( $key === 'link' ) {
										pll_register_string( 'Social link', $value, $name );
									}
									if ( $key === 'icon' ) {
										pll_register_string( 'Social icon', $value, $name );
									}
								}
							}
						}
					} else {
						if ( $field_name !== 'id' ) {
							$f_n = ucfirst( $field_name );
							pll_register_string( $f_n, $field_value, $name );
						}
					}
				}
			}
		}
	}
}

/**
 * Features section. Register strings for translations.
 *
 * @modified 1.1.30
 * @access public
 */
function hestia_features_register_strings() {
	$default = hestia_get_features_default();
	hestia_pll_string_register_helper( 'hestia_features_content', $default, 'Features section' );
}

/**
 * Testimonials section. Register strings for translations.
 *
 * @modified 1.1.34
 * @access public.
 */
function hestia_testimonials_register_strings() {
	$default = hestia_get_testimonials_default();
	hestia_pll_string_register_helper( 'hestia_testimonials_content', $default, 'Testimonials section' );
}

/**
 * Team section. Register strings for translations.
 *
 * @modified 1.1.34
 * @access public.
 */
function hestia_team_register_strings() {
	$default = hestia_get_team_default();
	hestia_pll_string_register_helper( 'hestia_team_content', $default, 'Team section' );
}

/**
 * Register polylang strings
 *
 * @since 1.1.31
 * @modified 1.1.34
 * @access public
 */
function hestia_slider_register_strings() {
	$default = hestia_get_slider_default();
	hestia_pll_string_register_helper( 'hestia_slider_content', json_encode( $default ), 'Slider section' );
}

/**
 * Register polylang strings for clients bar
 *
 * @since 1.1.47
 */
function hestia_clients_bar_register_strings() {
	hestia_pll_string_register_helper( 'hestia_clients_bar_content', false, 'Clients bar' );
}


if ( function_exists( 'pll_register_string' ) ) {
	add_action( 'after_setup_theme', 'hestia_features_register_strings', 11 );
	add_action( 'after_setup_theme', 'hestia_testimonials_register_strings', 11 );
	add_action( 'after_setup_theme', 'hestia_team_register_strings', 11 );
	add_action( 'after_setup_theme', 'hestia_slider_register_strings', 11 );
	add_action( 'after_setup_theme', 'hestia_clients_bar_register_strings', 11 );
}


