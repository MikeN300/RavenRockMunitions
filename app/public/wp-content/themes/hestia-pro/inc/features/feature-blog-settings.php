<?php
/**
 * Customizer functionality for the Blog settings panel.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

/**
 * Hook controls for Blog Settings section to Customizer.
 *
 * @since Hestia 1.0
 */
function hestia_blog_settings_customize_register( $wp_customize ) {

	// Alternative Blog Layout.
	if ( class_exists( 'Hestia_Customize_Control_Radio_Image' ) ) {

		$wp_customize->add_setting(
			'hestia_alternative_blog_layout', array(
				'default'           => 'blog_normal_layout',
				'sanitize_callback' => 'hestia_sanitize_blog_layout_control',
			)
		);

		$wp_customize->add_control(
			new Hestia_Customize_Control_Radio_Image(
				$wp_customize, 'hestia_alternative_blog_layout', array(
					'label'    => esc_html__( 'Blog', 'hestia-pro' ) . ' ' . esc_html__( 'Layout', 'hestia-pro' ),
					'section'  => 'hestia_blog_layout',
					'priority' => 5,
					'choices'  => array(
						'blog_alternative_layout' => array(
							'url' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqAgMAAAAjP0ATAAAACVBMVEX///8+yP/V1dXG9YqxAAAAS0lEQVRYw2NgGAXDE4RCQMDAKONahQ5WUKBs1AujXqDEC6NgiANRSDyH0EwZRvJZ1UCBslEvjHqBZl4YBYMUjNb1o14Y9cIoGH4AALJWvPSk+QsLAAAAAElFTkSuQmCC',
						),
						'blog_normal_layout'      => array(
							'url' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqAgMAAAAjP0ATAAAACVBMVEX///8+yP/V1dXG9YqxAAAAPklEQVR42mNgGAXDE4RCQMDAKONahQ5WUKBs1AujXqDEC6NgtOAazTKjXhgtuEbBaME1mutHvTBacI0C4gEAenW95O4Ccg4AAAAASUVORK5CYII=',
						),
					),
				)
			)
		);
	}// End if().

	// Add authors on blog page panel.
	$wp_customize->add_section(
		'hestia_blog_authors', array(
			'title'    => esc_html__( 'Authors Section', 'hestia-pro' ),
			'panel'    => 'hestia_blog_settings',
			'priority' => 20,
		)
	);

	if ( class_exists( 'Hestia_Select_Multiple' ) ) {

		$wp_customize->add_setting(
			'hestia_authors_on_blog', array(
				'sanitize_callback' => 'hestia_sanitize_array',
			)
		);

		$wp_customize->add_control(
			new Hestia_Select_Multiple(
				$wp_customize, 'hestia_authors_on_blog', array(
					'section'      => 'hestia_blog_authors',
					'description'  => wp_kses(
						__( 'Select the team members to appear at the bottom of the blog archive pages. Hold down <b>control / cmd</b> key to select multiple members.', 'hestia-pro' ), array(
							'b' => array(),
						)
					),
					'label'        => esc_html__( 'Team members to appear on blog page', 'hestia-pro' ),
					'choices'      => hestia_get_team_on_blog(),
					'priority'     => 1,
					'custom_class' => 'repeater-multiselect-team',
				)
			)
		);

	}

	// Background image for authors section on blog.
	$wp_customize->add_setting(
		'hestia_authors_on_blog_background', array(
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'hestia_authors_on_blog_background', array(
				'label'    => esc_html__( 'Background Image', 'hestia-pro' ),
				'section'  => 'hestia_blog_authors',
				'priority' => 2,
			)
		)
	);

	// Add subscribe on blog page panel.
	$wp_customize->add_section(
		'hestia_blog_subscribe', array(
			'title'    => esc_html__( 'Subscribe Section', 'hestia-pro' ),
			'panel'    => 'hestia_blog_settings',
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'hestia_blog_subscribe_title', array(
			'default'           => esc_html__( 'Subscribe to our Newsletter', 'hestia-pro' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'hestia_blog_subscribe_title', array(
			'label'    => esc_html__( 'Section Title', 'hestia-pro' ),
			'section'  => 'hestia_blog_subscribe',
			'priority' => 10,
		)
	);

	$wp_customize->add_setting(
		'hestia_blog_subscribe_subtitle', array(
			'default'           => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'hestia_blog_subscribe_subtitle', array(
			'label'    => esc_html__( 'Section Subtitle', 'hestia-pro' ),
			'section'  => 'hestia_blog_subscribe',
			'priority' => 15,
		)
	);

	if ( class_exists( 'Hestia_Subscribe_Info' ) ) {
		$wp_customize->add_setting(
			'hestia_blog_subscribe_info', array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Hestia_Subscribe_Info(
				$wp_customize, 'hestia_blog_subscribe_info', array(
					'label'      => esc_html__( 'Instructions', 'hestia-pro' ),
					'section'    => 'hestia_blog_subscribe',
					'capability' => 'install_plugins',
					'priority'   => 20,
				)
			)
		);
	}

	$layout_section = $wp_customize->get_section( 'hestia_blog_layout' );
	if ( ! empty( $layout_section ) ) {
		$layout_section->panel = 'hestia_blog_settings';
	}
}

add_action( 'customize_register', 'hestia_blog_settings_customize_register' );

/**
 * Add selective refresh for controls that are on blog page (index).
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function hestia_register_blog_page_partials( $wp_customize ) {

	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial(
		'hestia_blog_subscribe_title', array(
			'selector'        => '#subscribe-on-blog h3.hestia-title',
			'render_callback' => 'hestia_blog_subscribe_title_callback',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'hestia_blog_subscribe_subtitle', array(
			'selector'        => '#subscribe-on-blog p.description',
			'render_callback' => 'hestia_blog_subscribe_subtitle_callback',
		)
	);

}
add_action( 'customize_register', 'hestia_register_blog_page_partials' );

/**
 * Callback function for hestia_blog_subscribe_subtitle customizer control.
 *
 * @return string
 */
function hestia_blog_subscribe_subtitle_callback() {
	return get_theme_mod( 'hestia_blog_subscribe_subtitle' );
}

/**
 * Callback function for hestia_blog_subscribe_title customizer control.
 *
 * @return string
 */
function hestia_blog_subscribe_title_callback() {
	return get_theme_mod( 'hestia_blog_subscribe_title' );
}
/**
 * Get choices for team on blog control.
 *
 * @since 1.1.40
 */
function hestia_get_team_on_blog() {
	$result_array = array();

	$default             = hestia_get_team_default();
	$hestia_team_content = get_theme_mod( 'hestia_team_content', $default );
	if ( ! empty( $hestia_team_content ) ) {
		$json = json_decode( $hestia_team_content, true );
		if ( ! empty( $json ) ) {
			foreach ( $json as $team_member ) {
				if ( ! empty( $team_member['id'] ) && ! empty( $team_member['title'] ) ) {
					$result_array[ $team_member['id'] ] = $team_member['title'];
				}
			}
		}
	}
	return $result_array;
}

/**
 * Change label of layout section in pro.
 *
 * @return string
 */
function hestia_blog_layout_control_label() {
	return esc_html__( 'Layout', 'hestia-pro' );
}
add_filter( 'hestia_blog_layout_control_label', 'hestia_blog_layout_control_label' );
