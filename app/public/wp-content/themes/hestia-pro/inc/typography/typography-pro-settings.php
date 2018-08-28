<?php
/**
 * Pro typography settings.
 * Plus Container width control.
 *
 * @package Hestia
 * @since 1.1.38
 */

/**
 * Register typography controls for pro version.
 *
 * @param WP_Customize_Manager $wp_customize Customize manager.
 *
 * @since 1.1.38
 */
function hestia_typography_pro_settings( $wp_customize ) {

	if ( ! class_exists( 'Hestia_Customizer_Range_Value_Control' ) ) {
		return;
	}

	/**
	 * Enable responsive controls for all
	 * font size controls in Hestia PRO
	 */
	$enable_media_query = array(
		'hestia_post_page_headings_fs',
		'hestia_post_page_content_fs',
		'hestia_big_title_fs',
		'hestia_section_primary_headings_fs',
		'hestia_section_secondary_headings_fs',
		'hestia_section_content_fs',
	);
	foreach ( $enable_media_query as $control_to_enable ) {
		$control = $wp_customize->get_control( $control_to_enable );
		if ( ! empty( $control ) ) {
			$control->media_query = true;
		}
	}

	if ( class_exists( 'Hestia_Customizer_Heading' ) ) {

		/**
		 * Heading control that is displayed before generic font sizes controls.
		 */
		$wp_customize->add_setting(
			'hestia_generic_title', array(
				'sanitize_callback' => 'wp_kses',
			)
		);

		$wp_customize->add_control(
			new Hestia_Customizer_Heading(
				$wp_customize, 'hestia_generic_title', array(
					'label'    => esc_html__( 'Generic options', 'hestia-pro' ),
					'section'  => 'hestia_typography',
					'priority' => 300,
				)
			)
		);
	}

	/**
	 * --------------------------------------------------
	 * 2.x. Menu font size control
	 * This control allow users to choose a font size for the menu in header
	 * The values area between -25 and +25 px.
	 * --------------------------------------------------
	 */
	$wp_customize->add_setting(
		'hestia_menu_fs', array(
			'sanitize_callback' => 'hestia_sanitize_range_value',
			'default'           => 0,
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new Hestia_Customizer_Range_Value_Control(
			$wp_customize, 'hestia_menu_fs', array(
				'label'       => esc_html__( 'Menu', 'hestia-pro' ),
				'section'     => 'hestia_typography',
				'type'        => 'range-value',
				'input_attr'  => array(
					'min'  => - 25,
					'max'  => 25,
					'step' => 1,
				),
				'priority'    => 310,
				'media_query' => true,
				'sum_type'    => true,
			)
		)
	);

}

add_action( 'customize_register', 'hestia_typography_pro_settings', 25 );


/**
 * Add advanced inline style from customizer.
 *
 * @since 1.1.38
 */
function hestia_typography_advanced_inline_style() {
	$custom_css = '';

	/**
	 * Container width.
	 */
	$custom_css .= hestia_get_inline_style( 'hestia_container_width', 'hestia_get_container_width_style' );

	/**
	 * Menu font size
	 */
	$custom_css .= hestia_get_inline_style( 'hestia_menu_fs', 'hestia_get_menu_style' );

	wp_add_inline_style( 'hestia-font-sizes', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'hestia_typography_advanced_inline_style' );

/**
 * [Generic] Menu font size.
 *
 * This function is called by hestia_get_inline_style to change the font size for:
 * Primary menu
 * Footer menu
 *
 * @param string $value Font value.
 */
function hestia_get_menu_style( $value, $dimension = 'desktop' ) {
	$custom_css = '';
	if ( empty( $value ) ) {
		return $custom_css;
	}
	switch ( $dimension ) {
		case 'desktop':
		case 'tablet':
		case 'mobile':
			$v1 = ( 12 + (int) $value ) > 10 ? ( 12 + (int) $value ) : 10;
			break;
	}
	$custom_css .= '.navbar #main-navigation a, .footer .footer-menu li a {
	  font-size: ' . $v1 . 'px;
	}';

	$custom_css = hestia_add_media_query( $dimension, $custom_css );

	return $custom_css;
}

/**
 * Function that returns custom style for container width.
 *
 * @param float  $value Container width.
 * @param string $dimension Query dimension.
 *
 * @since 1.1.53
 * @return string
 */
function hestia_get_container_width_style( $value, $dimension = 'desktop' ) {
	$custom_css = '';
	switch ( $dimension ) {
		case 'desktop':
			$custom_css .= '
				div.container{
					width: ' . $value . 'px;
				}
			';
			break;
		case 'tablet':
			$custom_css .= '@media (max-width:768px){
				div.container{
					width: ' . $value . 'px;
				}
			}';
			break;
		case 'mobile':
			$custom_css .= '
			@media (max-width:480px){
				div.container{
					width: ' . $value . 'px;
				}
			}';
			break;
	}

	return $custom_css;
}

/**
 * Adds inline style for sidebar width
 *
 * @since 1.1.31
 */
function hestia_sidebar_width_inline_style() {
	$custom_css = '';

	if ( is_page() || ( function_exists( 'is_shop' ) && is_shop() ) ) {
		$hestia_page_sidebar_layout = get_theme_mod( 'hestia_page_sidebar_layout', 'full-width' );
		$custom_css                .= hestia_sidebar_style( $hestia_page_sidebar_layout, 'page' );
	} else {
		$default_blog_layout        = hestia_sidebar_on_single_post_get_default();
		$hestia_blog_sidebar_layout = get_theme_mod( 'hestia_blog_sidebar_layout', $default_blog_layout );
		$custom_css                .= hestia_sidebar_style( $hestia_blog_sidebar_layout, 'blog' );
	}

	wp_add_inline_style( 'hestia_style', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'hestia_sidebar_width_inline_style' );

/**
 * Add inline style for sidebar width.
 *
 * @param string $layout Page layout.
 * @param string $type Control type.
 *
 * @return string
 */
function hestia_sidebar_style( $layout, $type ) {
	$hestia_sidebar_width = get_theme_mod( 'hestia_sidebar_width', 25 );
	$page_id              = get_the_ID();
	$individual_layout    = get_post_meta( $page_id, 'hestia_layout_select', true );
	$custom_css           = '';
	if ( $layout !== 'full-width' && $individual_layout !== 'full-width' ) {

		if ( ! empty( $hestia_sidebar_width ) ) {
			$hestia_content_width = 100 - $hestia_sidebar_width;
			if ( $hestia_sidebar_width <= 3 || $hestia_sidebar_width >= 80 ) {
				$hestia_content_width = 100;
				$hestia_sidebar_width = 100;
			}
			$content_width = $hestia_content_width - 8.33333333;
			switch ( $type ) {
				case 'blog':
					if ( is_active_sidebar( 'sidebar-1' ) ) {
						$custom_css .= '
						@media (min-width: 992px){
							.blog-sidebar-wrapper:not(.no-variable-width){
								width: ' . $hestia_sidebar_width . '%;
								display: inline-block;
							}
					
							.single-post-wrap,
							.blog-posts-wrap, 
							.archive-post-wrap {
								width: ' . $content_width . '%;
							}
						} ';
					}
					break;
				case 'page':
					$custom_css .= '@media (min-width: 992px){.page-content-wrap{
						width: ' . $hestia_content_width . '%;
					}
					.blog-sidebar-wrapper:not(.no-variable-width){
						width: ' . $hestia_sidebar_width . '%;
					}}
					';
					if ( is_active_sidebar( 'sidebar-woocommerce' ) ) {
						$custom_css .= '
							@media (min-width: 992px){
								.shop-sidebar.card.card-raised.col-md-3, .shop-sidebar-wrapper {
									width: ' . $hestia_sidebar_width . '%;
								}
								.content-sidebar-left,
								.content-sidebar-right{
									width: ' . $hestia_content_width . '%;
								}
							}';
					}
			}
		}// End if().
	}// End if().
	return $custom_css;
}

/**
 * Function to change the label for the font size control from
 * Big title section to Header Slider.
 *
 * @return string
 */
function hestia_big_title_fs_label() {
	return esc_html__( 'Header Slider', 'hestia-pro' );
}
add_filter( 'hestia_big_title_fs_label', 'hestia_big_title_fs_label' );
