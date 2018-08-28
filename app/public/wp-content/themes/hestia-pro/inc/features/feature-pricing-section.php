<?php
/**
 * Customizer functionality for the Pricing section.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

/**
 * Hook controls for Pricing section to Customizer.
 *
 * @since Hestia 1.0
 * @modified 1.1.49
 */
function hestia_pricing_customize_register( $wp_customize ) {

	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

	if ( class_exists( 'Hestia_Hiding_Section' ) ) {
		$wp_customize->add_section(
			new Hestia_Hiding_Section(
				$wp_customize, 'hestia_pricing', array(
					'title'          => esc_html__( 'Pricing', 'hestia-pro' ),
					'panel'          => 'hestia_frontpage_sections',
					'priority'       => apply_filters( 'hestia_section_priority', 35, 'hestia_pricing' ),
					'hiding_control' => 'hestia_pricing_hide',
				)
			)
		);
	} else {
		$wp_customize->add_section(
			'hestia_pricing', array(
				'title'    => esc_html__( 'Pricing', 'hestia-pro' ),
				'panel'    => 'hestia_frontpage_sections',
				'priority' => apply_filters( 'hestia_section_priority', 40, 'hestia_pricing' ),
			)
		);
	}

	$wp_customize->add_setting(
		'hestia_pricing_hide', array(
			'sanitize_callback' => 'hestia_sanitize_checkbox',
			'default'           => true,
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		'hestia_pricing_hide', array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Disable section', 'hestia-pro' ),
			'section'  => 'hestia_pricing',
			'priority' => 1,
		)
	);

	$wp_customize->add_setting(
		'hestia_pricing_title', array(
			'default'           => esc_html__( 'Choose a plan for your next project', 'hestia-pro' ),
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		'hestia_pricing_title', array(
			'label'    => esc_html__( 'Section Title', 'hestia-pro' ),
			'section'  => 'hestia_pricing',
			'priority' => 5,
		)
	);

	$wp_customize->add_setting(
		'hestia_pricing_subtitle', array(
			'default'           => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'hestia-pro' ),
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		'hestia_pricing_subtitle', array(
			'label'    => esc_html__( 'Section Subtitle', 'hestia-pro' ),
			'section'  => 'hestia_pricing',
			'priority' => 10,
		)
	);

	$wp_customize->add_setting(
		'hestia_pricing_table_one_title', array(
			'default'           => esc_html__( 'Basic Package', 'hestia-pro' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		'hestia_pricing_table_one_title', array(
			'label'    => esc_html__( 'Pricing Table One: Title', 'hestia-pro' ),
			'section'  => 'hestia_pricing',
			'priority' => 15,
		)
	);

	if ( class_exists( 'Hestia_Iconpicker' ) ) {

		$wp_customize->add_setting(
			'hestia_pricing_table_one_icon', array(
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Hestia_Iconpicker(
				$wp_customize, 'hestia_pricing_table_one_icon', array(
					'label'    => esc_html__( 'Pricing Table One: Icon', 'hestia-pro' ),
					'section'  => 'hestia_pricing',
					'priority' => 16,
				)
			)
		);
	}

	$wp_customize->add_setting(
		'hestia_pricing_table_one_price', array(
			'default'           => '<small>$</small>0',
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		'hestia_pricing_table_one_price', array(
			'label'    => esc_html__( 'Pricing Table One: Price', 'hestia-pro' ),
			'section'  => 'hestia_pricing',
			'priority' => 20,
		)
	);

	$default = sprintf( '<b>%1$s</b> %2$s', esc_html__( '1', 'hestia-pro' ), esc_html__( 'Domain', 'hestia-pro' ) ) .
		sprintf( '\n<b>%1$s</b> %2$s', esc_html__( '1GB', 'hestia-pro' ), esc_html__( 'Storage', 'hestia-pro' ) ) .
		sprintf( '\n<b>%1$s</b> %2$s', esc_html__( '100GB', 'hestia-pro' ), esc_html__( 'Bandwidth', 'hestia-pro' ) ) .
		sprintf( '\n<b>%1$s</b> %2$s', esc_html__( '2', 'hestia-pro' ), esc_html__( 'Databases', 'hestia-pro' ) );
	$wp_customize->add_setting(
		'hestia_pricing_table_one_features', array(
			'default'           => $default,
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		'hestia_pricing_table_one_features', array(
			'label'       => esc_html__( 'Pricing Table One: Features', 'hestia-pro' ),
			'description' => esc_html__( 'Seperate your features by adding \n between lines.', 'hestia-pro' ),
			'section'     => 'hestia_pricing',
			'priority'    => 25,
			'type'        => 'textarea',
		)
	);

	$wp_customize->add_setting(
		'hestia_pricing_table_one_link', array(
			'default'           => esc_url( '#' ),
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		'hestia_pricing_table_one_link', array(
			'label'    => esc_html__( 'Pricing Table One: Link', 'hestia-pro' ),
			'section'  => 'hestia_pricing',
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'hestia_pricing_table_one_text', array(
			'default'           => esc_html__( 'Free Download', 'hestia-pro' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		'hestia_pricing_table_one_text', array(
			'label'    => esc_html__( 'Pricing Table One: Text', 'hestia-pro' ),
			'section'  => 'hestia_pricing',
			'priority' => 35,
		)
	);

	$wp_customize->add_setting(
		'hestia_pricing_table_two_title', array(
			'default'           => esc_html__( 'Premium Package', 'hestia-pro' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		'hestia_pricing_table_two_title', array(
			'label'    => esc_html__( 'Pricing Table Two: Title', 'hestia-pro' ),
			'section'  => 'hestia_pricing',
			'priority' => 40,
		)
	);

	if ( class_exists( 'Hestia_Iconpicker' ) ) {

		$wp_customize->add_setting(
			'hestia_pricing_table_two_icon', array(
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Hestia_Iconpicker(
				$wp_customize, 'hestia_pricing_table_two_icon', array(
					'label'    => esc_html__( 'Pricing Table Two: Icon', 'hestia-pro' ),
					'section'  => 'hestia_pricing',
					'priority' => 41,
				)
			)
		);
	}

	$wp_customize->add_setting(
		'hestia_pricing_table_two_price', array(
			'default'           => '<small>$</small>49',
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		'hestia_pricing_table_two_price', array(
			'label'    => esc_html__( 'Pricing Table Two: Price', 'hestia-pro' ),
			'section'  => 'hestia_pricing',
			'priority' => 45,
		)
	);

	$default = sprintf( '<b>%1$s</b> %2$s', esc_html__( '5', 'hestia-pro' ), esc_html__( 'Domain', 'hestia-pro' ) ) .
		sprintf( '\n<b>%1$s</b> %2$s', esc_html__( 'Unlimited', 'hestia-pro' ), esc_html__( 'Storage', 'hestia-pro' ) ) .
		sprintf( '\n<b>%1$s</b> %2$s', esc_html__( 'Unlimited', 'hestia-pro' ), esc_html__( 'Bandwidth', 'hestia-pro' ) ) .
		sprintf( '\n<b>%1$s</b> %2$s', esc_html__( 'Unlimited', 'hestia-pro' ), esc_html__( 'Databases', 'hestia-pro' ) );
	$wp_customize->add_setting(
		'hestia_pricing_table_two_features', array(
			'default'           => $default,
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		'hestia_pricing_table_two_features', array(
			'label'       => esc_html__( 'Pricing Table Two: Features', 'hestia-pro' ),
			'description' => esc_html__( 'Seperate your features by adding \n between lines.', 'hestia-pro' ),
			'section'     => 'hestia_pricing',
			'priority'    => 50,
			'type'        => 'textarea',
		)
	);

	$wp_customize->add_setting(
		'hestia_pricing_table_two_link', array(
			'default'           => esc_url( '#' ),
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		'hestia_pricing_table_two_link', array(
			'label'    => esc_html__( 'Pricing Table Two: Link', 'hestia-pro' ),
			'section'  => 'hestia_pricing',
			'priority' => 55,
		)
	);

	$wp_customize->add_setting(
		'hestia_pricing_table_two_text', array(
			'default'           => esc_html__( 'Order Now', 'hestia-pro' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		)
	);

	$wp_customize->add_control(
		'hestia_pricing_table_two_text', array(
			'label'    => esc_html__( 'Pricing Table Two: Text', 'hestia-pro' ),
			'section'  => 'hestia_pricing',
			'priority' => 60,
		)
	);

}

add_action( 'customize_register', 'hestia_pricing_customize_register' );
