<?php
/**
 * Customizer functionality for the Slider section.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

/**
 * Hook controls for Slider section to Customizer.
 *
 * @since Hestia 1.0
 * @modified 1.1.30
 */
function hestia_slider_customize_register( $wp_customize ) {

	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

	$wp_customize->add_section(
		'hestia_slider', array(
			'title'    => esc_html__( 'Slider', 'hestia-pro' ),
			'panel'    => 'hestia_frontpage_sections',
			'priority' => 5,
		)
	);

	if ( class_exists( 'Hestia_Customize_Control_Radio_Image' ) ) {
		$wp_customize->add_setting(
			'hestia_slider_tabs', array(
				'sanitize_callback' => 'hestia_sanitize_alignment_options',
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			new Hestia_Customize_Control_Radio_Image(
				$wp_customize, 'hestia_slider_tabs', array(
					'priority' => 5,
					'section'  => 'hestia_slider',
					'is_tab'   => true,
					'choices'  => array(
						'slider' => array(
							'label'    => esc_html__( 'Slider', 'hestia-pro' ),
							'icon'     => 'picture-o',
							'controls' => array(
								'hestia_slider_alignment',
							),
						),
						'extra'  => array(
							'label'    => esc_html__( 'Extra', 'hestia-pro' ),
							'icon'     => 'user-plus',
							'controls' => array(
								'hestia_slider_type',
							),
						),
					),
				)
			)
		);

		$wp_customize->add_setting(
			'hestia_slider_alignment', array(
				'default'           => 'center',
				'sanitize_callback' => 'hestia_sanitize_alignment_options',
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			new Hestia_Customize_Control_Radio_Image(
				$wp_customize, 'hestia_slider_alignment', array(
					'label'     => esc_html__( 'Layout', 'hestia-pro' ),
					'priority'  => 10,
					'section'   => 'hestia_slider',
					'is_tab'    => true,
					'is_subtab' => true,
					'choices'   => array(
						'left'   => array(
							'url'      => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqBAMAAACsf7WzAAAAD1BMVEX////V1dUAhbo+yP/u9/pRM+FMAAAAZElEQVR42u3WsQ2AIBRFUd0AV3AFV3D/mSwsBI2BRIofPKchobjVK/7EQJZSit+az5/aq/WjVs99AQAjWxs8L4ZL0hqutTcoWt0OSa2orfdVaWl9b/XcqpbWvbXltLQCtwCA3AHhDKjAJvDMEwAAAABJRU5ErkJggg==',
							'controls' => array(
								'hestia_slider_disable_autoplay',
								'hestia_slider_content',
								'hestia_big_title_widgets_title',
								'widgets',
							),
						),
						'center' => array(
							'url'      => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqBAMAAACsf7WzAAAAD1BMVEX///8AhbrV1dU+yP/u9/q7NurVAAAAV0lEQVR42u3SsQ2AMAxFwYBYgA0QK7AC+89EQQOiIIoogn3XWHLxql8IZL1b+m+N5+ftaiVqfbkvACC8YW6iFbg17U0KCVQNTUvr0YK+bFdaWklaAPAXB4dWiADE72glAAAAAElFTkSuQmCC',
							'controls' => array(
								'hestia_slider_disable_autoplay',
								'hestia_slider_content',
							),
						),
						'right'  => array(
							'url'      => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqBAMAAACsf7WzAAAAD1BMVEX////V1dUAhbo+yP/u9/pRM+FMAAAAYElEQVR42u3SuQ2AMBBFQaAC3AIt0AL910RAAkICS1xrPJOstMGLfsOPpK0+fqtdPmdXq6LWnfsCAKJJe4+0hhxaVbWmHB9sVStCq7u8Ly2td7aqpXVsXNPSKrAFAOWbASNgr0b3Lh1kAAAAAElFTkSuQmCC',
							'controls' => array(
								'hestia_slider_disable_autoplay',
								'hestia_slider_content',
								'hestia_big_title_widgets_title',
								'widgets',
							),
						),
					),
				)
			)
		);

		$wp_customize->add_setting(
			'hestia_slider_type', array(
				'sanitize_callback' => 'hestia_sanitize_alignment_options',
				'default'           => 'video',
			)
		);

		$wp_customize->add_control(
			new Hestia_Customize_Control_Radio_Image(
				$wp_customize, 'hestia_slider_type', array(
					'label'     => esc_html__( 'Layout', 'hestia-pro' ),
					'priority'  => 20,
					'section'   => 'hestia_slider',
					'is_tab'    => true,
					'is_subtab' => true,
					'choices'   => array(
						'video'    => array(
							'url'      => trailingslashit( get_template_directory_uri() ) . 'inc/customizer-radio-image/img/video.png',
							'controls' => array(
								'header_video',
								'external_header_video',
							),
						),
						'parallax' => array(
							'url'      => trailingslashit( get_template_directory_uri() ) . 'inc/customizer-radio-image/img/parallax.png',
							'controls' => array(
								'hestia_parallax_layer1',
								'hestia_parallax_layer2',
							),
						),
					),
				)
			)
		);
	}

	$wp_customize->add_setting(
		'hestia_slider_disable_autoplay', array(
			'sanitize_callback' => 'hestia_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'hestia_slider_disable_autoplay', array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Disable auto-play', 'hestia-pro' ),
			'section'  => 'hestia_slider',
			'priority' => 13,
		)
	);

	if ( class_exists( 'Hestia_Repeater' ) ) {
		$slider_default = hestia_get_slider_default();

		$wp_customize->add_setting(
			'hestia_slider_content', array(
				'sanitize_callback' => 'hestia_repeater_sanitize',
				'default'           => json_encode( $slider_default ),
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			new Hestia_Repeater(
				$wp_customize, 'hestia_slider_content', array(
					'label'                                => esc_html__( 'Slider Content', 'hestia-pro' ),
					'section'                              => 'hestia_slider',
					'priority'                             => 15,
					'item_name'                            => esc_html__( 'Slide', 'hestia-pro' ),
					'add_field_label'                      => esc_html__( 'Add new Slide', 'hestia-pro' ),
					'customizer_repeater_image_control'    => true,
					'customizer_repeater_title_control'    => true,
					'customizer_repeater_subtitle_control' => true,
					'customizer_repeater_text_control'     => true,
					'customizer_repeater_link_control'     => true,
					'customizer_repeater_text2_control'    => true,
					'customizer_repeater_link2_control'    => true,
					'customizer_repeater_color_control'    => true,
					'customizer_repeater_color2_control'   => true,
				)
			)
		);
	}

	$wp_customize->add_setting(
		'hestia_big_title_widgets_title', array(
			'sanitize_callback' => 'wp_kses',
		)
	);

	$wp_customize->add_control(
		new Hestia_Customizer_Heading(
			$wp_customize, 'hestia_big_title_widgets_title', array(
				'label'    => esc_html__( 'Big Title Section', 'hestia-pro' ) . ' ' . esc_html__( 'Sidebar', 'hestia-pro' ),
				'section'  => 'hestia_slider',
				'priority' => 20,
			)
		)
	);

	/**
	 * Move video controls in header.
	 */
	$video_bg = $wp_customize->get_control( 'header_video' );
	if ( ! empty( $video_bg ) ) {
		$video_bg->section         = 'hestia_slider';
		$video_bg->priority        = -5;
		$video_bg->active_callback = '__return_true';
	}
	$external_video_bg = $wp_customize->get_control( 'external_header_video' );
	if ( ! empty( $external_video_bg ) ) {
		$external_video_bg->section         = 'hestia_slider';
		$external_video_bg->priority        = -5;
		$external_video_bg->active_callback = '__return_true';
	}

	$header_image = $wp_customize->get_setting( 'header_image' );
	if ( ! empty( $header_image ) ) {
		$header_image->transport = 'refresh';
	}

	$wp_customize->add_setting(
		'hestia_parallax_layer1', array(
			'sanitize_callback' => 'esc_url_raw',
			'default'           => apply_filters( 'hestia_parallax_layer1_default', false ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'hestia_parallax_layer1', array(
				'label'    => esc_html__( 'First Layer', 'hestia-pro' ),
				'section'  => 'hestia_slider',
				'priority' => 20,
			)
		)
	);

	$wp_customize->add_setting(
		'hestia_parallax_layer2', array(
			'sanitize_callback' => 'esc_url_raw',
			'default'           => apply_filters( 'hestia_parallax_layer2_default', false ),
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'hestia_parallax_layer2', array(
				'label'    => esc_html__( 'Second Layer', 'hestia-pro' ),
				'section'  => 'hestia_slider',
				'priority' => 25,
			)
		)
	);

	$settings = array(
		'section_id'       => 'sidebar-widgets-sidebar-big-title',
		'panel'            => 'hestia_frontpage_sections',
		'priority'         => 5,
		'controls_to_move' => array(
			'hestia_slider_tabs',
			'hestia_slider_alignment',
			'hestia_slider_type',
			'hestia_slider_disable_autoplay',
			'hestia_slider_content',
			'header_video',
			'external_header_video',
			'hestia_parallax_layer1',
			'hestia_parallax_layer2',
			'hestia_big_title_widgets_title',
		),
	);

	hestia_move_customizer_sidebar( $settings, $wp_customize );
}

add_action( 'customize_register', 'hestia_slider_customize_register' );

/**
 * Add selective refresh for slider section controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since 1.1.31
 * @access public
 */
function hestia_register_slider_partials( $wp_customize ) {
	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	$wp_customize->selective_refresh->add_partial(
		'hestia_slider_content', array(
			'selector'        => '#carousel-hestia-generic',
			'settings'        => 'hestia_slider_content',
			'render_callback' => 'hestia_slider_callback',
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'hestia_slider_alignment', array(
			'selector'        => '#carousel-hestia-generic',
			'settings'        => 'hestia_slider_alignment',
			'render_callback' => 'hestia_slider_callback',
		)
	);
}
add_action( 'customize_register', 'hestia_register_slider_partials' );

/**
 * Callback function for slider content selective refresh.
 *
 * @since 1.1.31
 * @access public
 */
function hestia_slider_callback() {
	hestia_slider( true );
}

/**
 * Function to get color from accent color into repeater.
 *
 * @since 1.1.41
 * @access public
 */
function hestia_slider_update_colors() {
	$migrate = get_option( 'hestia_update_slider_colors' );
	if ( isset( $migrate ) && false == $migrate ) {
		$hestia_slider_content = get_theme_mod( 'hestia_slider_content' );
		if ( ! empty( $hestia_slider_content ) ) {
			$color_accent = get_theme_mod( 'accent_color', apply_filters( 'hestia_accent_color_default', '#e91e63' ) );
			if ( ! empty( $color_accent ) ) {
				$hestia_slider_content_decoded = json_decode( $hestia_slider_content, true );
				foreach ( $hestia_slider_content_decoded as $key => $slide ) {
					$hestia_slider_content_decoded[ $key ]['color'] = $color_accent;
				}
				set_theme_mod( 'hestia_slider_content', json_encode( $hestia_slider_content_decoded ) );
			}
		}
		update_option( 'hestia_update_slider_colors', true );
	}
}
add_action( 'after_setup_theme', 'hestia_slider_update_colors' );
