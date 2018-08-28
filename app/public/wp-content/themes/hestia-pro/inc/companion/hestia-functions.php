<?php
/**
 * Companion code for Hestia
 *
 * @author Themeisle
 * @package themeisle-companion
 */

/**
 * Include sections from Companion plugin
 */
function themeisle_hestia_require() {
	if ( function_exists( 'hestia_setup_theme' ) ) {
		$sections_paths = array(
			'hestia/inc/sections/hestia-features-section.php',
			'hestia/inc/sections/hestia-testimonials-section.php',
			'hestia/inc/sections/hestia-team-section.php',
			'hestia/inc/sections/hestia-ribbon-section.php',
			'hestia/inc/sections/hestia-clients-bar-section.php',
		);
		themeisle_hestia_require_files( $sections_paths );
	}
}


/**
 * Include customizer controls in customizer
 */
function themeisle_hestia_load_controls() {
	if ( function_exists( 'hestia_setup_theme' ) ) {
		$features_paths = array(
			'hestia/inc/features/feature-features-section.php',
			'hestia/inc/features/feature-testimonials-section.php',
			'hestia/inc/features/feature-team-section.php',
			'hestia/inc/features/feature-ribbon-section.php',
			'hestia/inc/features/feature-clients-bar-section.php',
			'hestia/inc/customizer.php',
		);
		themeisle_hestia_require_files( $features_paths );
	}
}

/**
 * This function iterates thorough an array of file paths, checks if the file exist and if it does, it require the
 * file in plugin.
 *
 * @param array $array Array of files to require.
 */
function themeisle_hestia_require_files( $array ) {
	foreach ( $array as $path ) {
		$file_path = trailingslashit( THEMEISLE_COMPANION_PATH ) . $path;
		if ( file_exists( $file_path ) ) {
			require_once( $file_path );
		}
	}
}
