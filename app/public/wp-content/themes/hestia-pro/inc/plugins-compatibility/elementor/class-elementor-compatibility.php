<?php
/**
 * Elementor compatibility class.
 *
 * @package Hestia
 */

/**
 * Class Elementor_Compatibility
 */
class Elementor_Compatibility {

	/**
	 * Elementor_Compatibility constructor.
	 */
	function __construct() {
		add_action( 'elementor/theme/register_locations', array( $this, 'hestia_register_theme_locations' ) );
	}

	/**
	 * Register Theme Location for Elementor
	 * see https://developers.elementor.com/theme-locations-api/
	 *
	 * @param object $elementor_theme_manager Elementor object.
	 */
	public function hestia_register_theme_locations( $elementor_theme_manager ) {
		$elementor_theme_manager->register_location(
			'header',
			[
				'hook'            => 'hestia_do_header',
				'remove_hooks'    => [ 'hestia_the_header_content' ],
				'edit_in_content' => false,
			]
		);
		$elementor_theme_manager->register_location(
			'footer',
			[
				'hook'            => 'hestia_do_footer',
				'remove_hooks'    => [ 'hestia_the_footer_content' ],
				'edit_in_content' => false,
			]
		);
	}
}
new Elementor_Compatibility();
