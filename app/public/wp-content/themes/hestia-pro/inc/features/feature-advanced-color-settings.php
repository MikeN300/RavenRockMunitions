<?php
/**
 * Customizer functionality for Advanced Color customizations.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

/**
 * Hook controls for Advanced Color Settings.
 *
 * @since Hestia 1.0
 */
function hestia_advanced_colors_customize_register( $wp_customize ) {

	if ( ! class_exists( 'Hestia_Customize_Alpha_Color_Control' ) ) {
		return;
	}

	$wp_customize->add_setting(
		'secondary_color', array(
			'default'           => '#2d3359',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'hestia_sanitize_colors',
		)
	);

	$wp_customize->add_control(
		new Hestia_Customize_Alpha_Color_Control(
			$wp_customize, 'secondary_color', array(
				'label'        => esc_html__( 'Secondary Color', 'hestia-pro' ),
				'section'      => 'colors',
				'show_opacity' => true,
				'palette'      => false,
				'priority'     => 15,
			)
		)
	);

	$wp_customize->add_setting(
		'body_color', array(
			'default'           => '#999999',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'hestia_sanitize_colors',
		)
	);

	$wp_customize->add_control(
		new Hestia_Customize_Alpha_Color_Control(
			$wp_customize, 'body_color', array(
				'label'        => esc_html__( 'Body Text Color', 'hestia-pro' ),
				'section'      => 'colors',
				'show_opacity' => true,
				'palette'      => false,
				'priority'     => 25,
			)
		)
	);

	$wp_customize->add_setting(
		'header_overlay_color', array(
			'default'           => 'rgba(0,0,0,0.5)',
			'sanitize_callback' => 'hestia_sanitize_colors',
		)
	);

	$wp_customize->add_control(
		new Hestia_Customize_Alpha_Color_Control(
			$wp_customize, 'header_overlay_color', array(
				'label'        => esc_html__( 'Header Overlay Color & Opacity', 'hestia-pro' ),
				'section'      => 'colors',
				'show_opacity' => true,
				'palette'      => false,
				'priority'     => 30,
			)
		)
	);

	$wp_customize->add_setting(
		'header_text_color', array(
			'default'           => '#fff',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'hestia_sanitize_colors',
		)
	);

	$wp_customize->add_control(
		new Hestia_Customize_Alpha_Color_Control(
			$wp_customize, 'header_text_color', array(
				'label'        => esc_html__( 'Header / Slider Text Color', 'hestia-pro' ),
				'section'      => 'colors',
				'show_opacity' => true,
				'palette'      => false,
				'priority'     => 35,
			)
		)
	);

	$wp_customize->add_setting(
		'navbar_background_color', array(
			'default'           => '#fff',
			'sanitize_callback' => 'hestia_sanitize_colors',
		)
	);

	$wp_customize->add_control(
		new Hestia_Customize_Alpha_Color_Control(
			$wp_customize, 'navbar_background_color', array(
				'label'        => esc_html__( 'Navbar Background Color', 'hestia-pro' ),
				'section'      => 'colors',
				'show_opacity' => true,
				'palette'      => false,
				'priority'     => 40,
			)
		)
	);

	$wp_customize->add_setting(
		'navbar_text_color', array(
			'default'           => '#555',
			'sanitize_callback' => 'hestia_sanitize_colors',
		)
	);

	$wp_customize->add_control(
		new Hestia_Customize_Alpha_Color_Control(
			$wp_customize, 'navbar_text_color', array(
				'label'        => esc_html__( 'Navbar Text Color', 'hestia-pro' ),
				'section'      => 'colors',
				'show_opacity' => true,
				'palette'      => false,
				'priority'     => 45,
			)
		)
	);

	$wp_customize->add_setting(
		'navbar_text_color_hover', array(
			'default'           => '#e91e63',
			'sanitize_callback' => 'hestia_sanitize_colors',
		)
	);

	$wp_customize->add_control(
		new Hestia_Customize_Alpha_Color_Control(
			$wp_customize, 'navbar_text_color_hover', array(
				'label'        => esc_html__( 'Navbar Text Color on Hover', 'hestia-pro' ),
				'section'      => 'colors',
				'show_opacity' => true,
				'palette'      => false,
				'priority'     => 50,
			)
		)
	);

	$wp_customize->add_setting(
		'navbar_transparent_text_color', array(
			'default'           => '#fff',
			'sanitize_callback' => 'hestia_sanitize_colors',
		)
	);

	$wp_customize->add_control(
		new Hestia_Customize_Alpha_Color_Control(
			$wp_customize, 'navbar_transparent_text_color', array(
				'label'        => esc_html__( 'Transparent Navbar Text Color', 'hestia-pro' ),
				'section'      => 'colors',
				'show_opacity' => true,
				'palette'      => false,
				'priority'     => 55,
			)
		)
	);
}

add_action( 'customize_register', 'hestia_advanced_colors_customize_register' );

/**
 * Adds inline style from customizer
 *
 * @since Hestia 1.0
 */
function hestia_advanced_custom_colors_inline_style() {

	$color_headings    = get_theme_mod( 'secondary_color', '#2d3359' );
	$color_body        = get_theme_mod( 'body_color', '#999999' );
	$color_overlay     = get_theme_mod( 'header_overlay_color', 'rgba(0,0,0,0.5)' );
	$color_header_text = get_theme_mod( 'header_text_color', '#fff' );

	$navbar_background       = get_theme_mod( 'navbar_background_color', '#fff' );
	$navbar_solid_text       = get_theme_mod( 'navbar_text_color', '#555' );
	$navbar_text_hover       = get_theme_mod( 'navbar_text_color_hover', '#e91e63' );
	$navbar_transparent_text = get_theme_mod( 'navbar_transparent_text_color', '#fff' );

	$color_accent = get_theme_mod( 'accent_color', apply_filters( 'hestia_accent_color_default', '#e91e63' ) );

	$custom_css = '';

	if ( ! empty( $color_headings ) ) {

		// Secondary Color
		$custom_css .= '
.title, .title a, 
.card-title, 
.card-title a,
.card-title a:hover,
.info-title,
.info-title a,
.footer-brand, 
.footer-brand a,
.media .media-heading, 
.media .media-heading a,
.hestia-info .info-title, 
.card-blog a.moretag,
.card-blog a.more-link,
.card .author a,
.hestia-about:not(.section-image) h1, .hestia-about:not(.section-image) h2, .hestia-about:not(.section-image) h3, .hestia-about:not(.section-image) h4, .hestia-about:not(.section-image) h5,
aside .widget h5,
aside .widget a,
.woocommerce.archive .blog-post .products .product-category h2,
 .woocommerce #reviews #comments ol.commentlist li .comment-text p.meta .woocommerce-review__author {
	color: ' . esc_attr( $color_headings ) . ';
}';
	}

	if ( ! empty( $color_body ) ) {

		// Body Colors
		$custom_css .= '
.description, .card-description, .footer-big, .hestia-features .hestia-info p, .text-gray, .hestia-about:not(.section-image) p, .hestia-about:not(.section-image) h6 {
	color: ' . esc_attr( $color_body ) . ';
}';
	}

	if ( ! empty( $color_overlay ) ) {

		// Header Overlay Color & Opacity
		$custom_css .= ' 
.header-filter:before {
	background-color: ' . esc_attr( $color_overlay ) . ';
}';
	}

	if ( ! empty( $color_header_text ) ) {

		// Header Text Color
		$custom_css .= ' 
.page-header, .page-header .hestia-title, .page-header .sub-title {
	color: ' . esc_attr( $color_header_text ) . ';
}';
	}

	if ( ! empty( $navbar_background ) ) {
		$full_screen_menu_bg = hestia_hex_rgba( $navbar_background, 0.9 );
		// Navbar background
		$custom_css .= '
@media( max-width: 768px ) {
	/* On mobile background-color */
	.header > .navbar,
	.navbar.navbar-fixed-top .navbar-collapse {
		background-color: ' . esc_attr( $navbar_background ) . ';
	}
}
.navbar:not(.navbar-transparent),
.navbar .dropdown-menu,
.nav-cart .nav-cart-content .widget {
	background-color: ' . esc_attr( $navbar_background ) . ';
}

@media ( min-width: 769px ) {
	.navbar.full-screen-menu .nav.navbar-nav { background-color: ' . esc_attr( $full_screen_menu_bg ) . ' }
}
';
	}

	if ( ! empty( $navbar_transparent_text ) ) {
		// Navbar transparent items color
		$custom_css .= '
@media( min-width: 769px ) {
	.navbar.navbar-transparent .navbar-brand,
	.navbar.navbar-transparent .navbar-nav > li:not(.btn) > a,
	.navbar.navbar-transparent .navbar-nav > .active > a,
	.navbar.navbar-transparent.full-screen-menu .navbar-toggle,
	.navbar.navbar-transparent:not(.full-screen-menu) .nav-cart-icon, 
	.navbar.navbar-transparent.full-screen-menu li.responsive-nav-cart > a.nav-cart-icon,
	.navbar.navbar-transparent .hestia-toggle-search {
		color: ' . esc_attr( $navbar_transparent_text ) . ';
	}
}
';
	}
	if ( ! empty( $navbar_solid_text ) ) {
		// Navbar solid items color
		$custom_css .= '
@media( min-width: 769px ) {
	.menu-open .navbar.full-screen-menu.navbar-transparent .navbar-toggle,
	.navbar:not(.navbar-transparent) .navbar-brand,
	.navbar:not(.navbar-transparent) li:not(.btn) > a,
	.navbar.navbar-transparent.full-screen-menu li:not(.btn) > a,
	.navbar.navbar-transparent .dropdown-menu li:not(.btn) > a,
	.hestia-mm-heading, .hestia-mm-description, 
	.navbar:not(.navbar-transparent) .navbar-nav > .active > a,
	.navbar:not(.navbar-transparent).full-screen-menu .navbar-toggle,
	.navbar .nav-cart-icon,  
	.navbar:not(.navbar-transparent) .hestia-toggle-search {
		color: ' . esc_attr( $navbar_solid_text ) . ';
	}
}
@media( max-width: 768px ) {
	.navbar.navbar-default .navbar-brand,
	.navbar.navbar-default .navbar-nav li:not(.btn).menu-item > a,
	.navbar.navbar-default .navbar-nav .menu-item.active > a,
	.navbar.navbar-default .navbar-toggle,
	.navbar.navbar-default .navbar-toggle,
	.navbar .navbar-nav .dropdown:not(.btn) a .caret,
	.navbar.navbar-default .responsive-nav-cart a,
	.navbar.navbar-default .nav-cart .nav-cart-content a,
	.navbar.navbar-default .hestia-toggle-search,
	.hestia-mm-heading, .hestia-mm-description {
		color: ' . esc_attr( $navbar_solid_text ) . ';
	}
	
	.navbar .navbar-nav .dropdown:not(.btn) a .caret {
		border-color: ' . esc_attr( $navbar_solid_text ) . ';
	}
}
';
	}

	if ( ! empty( $navbar_text_hover ) ) {
		// Navbar solid items color
		$custom_css .= '
	.navbar.navbar-default:not(.navbar-transparent) li:not(.btn):hover > a,
	.navbar.navbar-default.navbar-transparent .dropdown-menu li:not(.btn):hover > a,
	.navbar.navbar-default:not(.navbar-transparent) li:not(.btn):hover > a i,
	.navbar.navbar-default:not(.navbar-transparent) .navbar-toggle:hover,
	.navbar.navbar-default:not(.full-screen-menu) .nav-cart-icon .nav-cart-content a:hover, 
	.navbar.navbar-default:not(.navbar-transparent) .hestia-toggle-search:hover {
		color: ' . esc_attr( $navbar_text_hover ) . ';
	}
@media( max-width: 768px ) {
	.navbar.navbar-default.navbar-transparent li:not(.btn):hover > a,
	.navbar.navbar-default.navbar-transparent li:not(.btn):hover > a i,
	.navbar.navbar-default.navbar-transparent .navbar-toggle:hover,
	.navbar.navbar-default .responsive-nav-cart a:hover
	.navbar.navbar-default .navbar-toggle:hover {
		color: ' . esc_attr( $navbar_text_hover ) . ' !important;
	}
}
';
	}

	if ( ! empty( $color_accent ) ) {

		// FORMS UNDERLINE COLOR
		$custom_css .= '
		.form-group.is-focused .form-control,
		 div.wpforms-container .wpforms-form .form-group.is-focused .form-control,
		 .nf-form-cont input:not([type=button]):focus,
		 .nf-form-cont select:focus,
		 .nf-form-cont textarea:focus {
		 background-image: -webkit-gradient(linear,left top, left bottom,from(' . esc_attr( $color_accent ) . '),to(' . esc_attr( $color_accent ) . ')),-webkit-gradient(linear,left top, left bottom,from(#d2d2d2),to(#d2d2d2));
		 background-image: -webkit-linear-gradient(' . esc_attr( $color_accent ) . '),to(' . esc_attr( $color_accent ) . '),-webkit-linear-gradient(#d2d2d2,#d2d2d2);
		 background-image: linear-gradient(' . esc_attr( $color_accent ) . '),to(' . esc_attr( $color_accent ) . '),linear-gradient(#d2d2d2,#d2d2d2);
		 }
		
		 .navbar.navbar-transparent.full-screen-menu .navbar-collapse .navbar-nav > li:not(.btn) > a:hover,
		 .nav-cart .nav-cart-content .widget a:not(.remove):not(.button):hover {
		 color: ' . esc_attr( $color_accent ) . ';
		 }
		
		 @media( max-width: 768px ) {
		 }
		 
		 .hestia-ajax-loading{
		 border-color: ' . esc_attr( $color_accent ) . ';
		 }
		 ';
	}

	wp_add_inline_style( 'hestia_style', $custom_css );

	// WooCommerce Custom Colors
	if ( class_exists( 'WooCommerce' ) ) {
		// Initialize empty string.
		$custom_css_woocommerce = '';

		if ( ! empty( $color_body ) ) {
			// Secondary color
			$custom_css_woocommerce .= '.woocommerce .product .card-product .card-description p,
			 .woocommerce.archive .blog-post .products li.product-category a h2 .count {
				color: ' . esc_attr( $color_body ) . ';
			}';
		}
		wp_add_inline_style( 'hestia_woocommerce_style', $custom_css_woocommerce );
	}
}
add_action( 'wp_enqueue_scripts', 'hestia_advanced_custom_colors_inline_style', 20 );
