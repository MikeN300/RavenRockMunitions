<?php
/**
 * Customizer functionality for the Pro Manager.
 *
 * @package Hestia
 * @since Hestia 1.0
 */

/**
 * Registering and enqueuing scripts for pro version
 *
 * @since Hestia 1.0
 */
function hestia_pro_scripts() {
	wp_enqueue_script( 'hestia_scripts_pro', get_template_directory_uri() . '/assets/js/scripts-pro.js', array( 'jquery' ), HESTIA_VENDOR_VERSION, true );
	wp_enqueue_script( 'jquery-hammer', get_template_directory_uri() . '/assets/js/hammer.min.js', array( 'jquery' ), HESTIA_VENDOR_VERSION, true );

	// Scroll animations enqueue
	if ( is_front_page() && get_option( 'show_on_front' ) === 'page' ) {
		$enable_animations = apply_filters( 'hestia_enable_animations', true );
		if ( $enable_animations ) {
			wp_enqueue_script( 'animate-on-scroll', get_template_directory_uri() . '/assets/js/aos.min.js', HESTIA_VENDOR_VERSION, true );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'hestia_pro_scripts' );

/**
 * Hook Pro manager functionality to customizer.
 */
function hestia_pro_manager_customize_register( $wp_customize ) {

	$documentation_section = $wp_customize->get_section( 'hestia-theme-info' );

	if ( ! empty( $documentation_section ) ) {
		$documentation_section->theme_info_title = esc_html__( 'Hestia Pro', 'hestia-pro' );
		$documentation_section->label_url        = esc_url( 'http://docs.themeisle.com/article/532-hestia-pro-documentation' );
	}

	$wp_customize->remove_section( 'hestia-theme-info-section' );
	$wp_customize->remove_section( 'hestia_theme_info_main_section' );

	/**
	 * Top bar.
	 */
	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	if ( class_exists( 'Hestia_Customize_Alpha_Color_Control' ) ) {

		$wp_customize->add_setting(
			'hestia_top_bar_background_color', array(
				'transport'         => 'postMessage',
				'sanitize_callback' => 'hestia_sanitize_colors',
				'default'           => '#363537',
			)
		);

		$wp_customize->add_control(
			new Hestia_Customize_Alpha_Color_Control(
				$wp_customize, 'hestia_top_bar_background_color', array(
					'label'        => esc_html__( 'Background color', 'hestia-pro' ),
					'section'      => 'hestia_top_bar',
					'show_opacity' => true,
					'palette'      => false,
					'priority'     => 5,
				)
			)
		);
	}

	$wp_customize->add_setting(
		'hestia_top_bar_text_color', array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'hestia_sanitize_colors',
			'default'           => '#ffffff',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'hestia_top_bar_text_color', array(
				'label'    => esc_html__( 'Text', 'hestia-pro' ) . ' ' . esc_html__( 'Color', 'hestia-pro' ),
				'section'  => 'hestia_top_bar',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'hestia_top_bar_link_color', array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'hestia_sanitize_colors',
			'default'           => '#ffffff',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'hestia_top_bar_link_color', array(
				'label'    => esc_html__( 'Link', 'hestia-pro' ) . ' ' . esc_html__( 'Color', 'hestia-pro' ),
				'section'  => 'hestia_top_bar',
				'priority' => 15,
			)
		)
	);

	$wp_customize->add_setting(
		'hestia_top_bar_link_color_hover', array(
			'transport'         => 'postMessage',
			'sanitize_callback' => 'hestia_sanitize_colors',
			'default'           => '#eeeeee',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'hestia_top_bar_link_color_hover', array(
				'label'    => esc_html__( 'Link color on hover', 'hestia-pro' ),
				'section'  => 'hestia_top_bar',
				'priority' => 20,
			)
		)
	);

	if ( class_exists( 'Hestia_Customize_Control_Radio_Image' ) ) {
		$wp_customize->add_setting(
			'hestia_top_bar_alignment', array(
				'default'           => apply_filters( 'hestia_top_bar_alignment_default', 'right' ),
				'sanitize_callback' => 'hestia_sanitize_alignment_options',
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			new Hestia_Customize_Control_Radio_Image(
				$wp_customize, 'hestia_top_bar_alignment', array(
					'label'    => esc_html__( 'Layout', 'hestia-pro' ),
					'priority' => 25,
					'section'  => 'hestia_top_bar',
					'choices'  => array(
						'left'  => array(
							'url'   => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqCAMAAABpj1iyAAAAM1BMVEX///8Ahbojjr5mqMzU5O/f6/Pq8vf1+fs9l8NToMiGuNWjyN681ueVwNp3sNGwz+LI3evMEc51AAABPUlEQVR4Ae3RuYojSxhE4Ti5L1nL+z/tVdISNFwYY5hWy4jPCPjLOlTKzMzMzMzMzMzMzMzMzP61WvSJAllbjvETsxLof464fvUR8ysr6ylVSZGph5L1B3z3F/dL41KFuSdD0mq0A6QjECJR9QSOfba4Socwfz5r0rXYQxOkDDRAN7QAUZ12wvzKGpzjHVkFygmUwRSkSSgaoMEpBWKGlQZdkandeJX681nqXCGMx1AEaRClBF8VkXizvT7cAcJ6Q9YicN4Eup5/q+oATVq+IWa4UrqSIkPKZXX6G7IqsBT2CFKG0AHlwBbVCbFx64C2Qhsn4w1ZOqFq7BEkrQAdpHzEIzJUI3BWlQZzAL3oDUrKz1FKVVKuNSXpPNIFSw9J2nJ5zi+62XrVh0kzjktmZmZmZmZmZmZmZmZm9s1/51AJDRsfaTQAAAAASUVORK5CYII=',
							'label' => esc_html__( 'Left Sidebar', 'hestia-pro' ),
						),
						'right' => array(
							'url'   => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqCAMAAABpj1iyAAAAM1BMVEX///8Ahbojjr5mqMzU5O/f6/Pq8vf1+fs9l8NToMiGuNWjyN681ueVwNp3sNGwz+LI3evMEc51AAABO0lEQVR4Ae3RuWodQRhE4Tq9Lz3L+z+tb6MrMFZm0EhBfUHBP9FhWmZmZmZmZmZmZmZmZmb2Uot+o0DWlmP8jVkJ9MUR148+Yv7MynpLVVJk6qVkPaBxqcLckyFpNdoB0hEIkah6Asc+W1ylQ5j6B3/7j/urSddiD02QMtAA3dACRHXaCfMja3COJ7IKlBMogylIk1A0QINTCsQMKw26IlO78Sr1+7PUuUIYr6EI0iBKCT4qIvFm+/xwBwjrgaxF4LwJdL3/VtUBmrR8Q8xwpXQlRYaUy+r0B7IqsBT2CFKG0AHlwBbVCbFx64C2Qhsn44EsnVA19giSVoAOUj7iERmqETirSoM5gF6eyCopv0cpVUm51pSk80gXLL0kacvlPT/oZutVv0yacVwyMzMzMzMzMzMzMzMzs+/yB9eOCQ0dpl58AAAAAElFTkSuQmCC',
							'label' => esc_html__( 'Right Sidebar', 'hestia-pro' ),
						),
					),
				)
			)
		);
	}

	$top_bar_sidebar = $wp_customize->get_section( 'sidebar-widgets-sidebar-top-bar' );
	if ( ! empty( $top_bar_sidebar ) ) {
		$controls_to_move = array(
			'hestia_top_bar_background_color',
			'hestia_top_bar_text_color',
			'hestia_top_bar_link_color',
			'hestia_top_bar_link_color_hover',
			'hestia_top_bar_alignment',
		);
		foreach ( $controls_to_move as $control_id ) {
			$control = $wp_customize->get_control( $control_id );
			if ( ! empty( $control ) ) {
				$control->section  = 'sidebar-widgets-sidebar-top-bar';
				$control->priority = -1;
			}
		}
	}

	/**
	 * Pro control for sidebar width.
	 */
	if ( class_exists( 'Hestia_Customizer_Range_Value_Control' ) ) {
		$wp_customize->add_setting(
			'hestia_sidebar_width', array(
				'sanitize_callback' => 'absint',
				'default'           => 25,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Hestia_Customizer_Range_Value_Control(
				$wp_customize, 'hestia_sidebar_width', array(
					'label'      => esc_html__( 'Sidebar width (%)', 'hestia-pro' ),
					'section'    => 'hestia_general',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
					'priority'   => 25,
				)
			)
		);
	}

	$wp_customize->add_setting(
		'hestia_container_width', array(
			'sanitize_callback' => 'hestia_sanitize_range_value',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new Hestia_Customizer_Range_Value_Control(
			$wp_customize, 'hestia_container_width', array(
				'label'       => esc_html__( 'Container width (px)', 'hestia-pro' ),
				'section'     => 'hestia_general',
				'type'        => 'range-value',
				'media_query' => true,
				'input_attr'  => array(
					'mobile'  => array(
						'min'           => 200,
						'max'           => 748,
						'step'          => 0.1,
						'default_value' => 748,
					),
					'tablet'  => array(
						'min'           => 300,
						'max'           => 992,
						'step'          => 0.1,
						'default_value' => 992,
					),
					'desktop' => array(
						'min'           => 700,
						'max'           => 2000,
						'step'          => 0.1,
						'default_value' => 1170,
					),
				),
				'priority'    => 25,
			)
		)
	);

	/**
	 * Pro controls for shop section.
	 */
	if ( hestia_woocommerce_check() ) {
		if ( class_exists( 'Hestia_Select_Multiple' ) ) {
			$woo_categories = hestia_get_categories_list( 'product_cat' );
			$wp_customize->add_setting(
				'hestia_shop_categories', array(
					'sanitize_callback' => 'hestia_sanitize_array',
					'transport'         => $selective_refresh,
				)
			);

			$wp_customize->add_control(
				new Hestia_Select_Multiple(
					$wp_customize, 'hestia_shop_categories', array(
						'section'  => 'hestia_shop',
						'label'    => esc_html__( 'Categories:', 'hestia-pro' ),
						'choices'  => $woo_categories,
						'priority' => 20,
					)
				)
			);
		}// End if().

		$wp_customize->add_setting(
			'hestia_shop_order', array(
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => $selective_refresh,
				'default'           => 'DESC',
			)
		);

		$wp_customize->add_control(
			'hestia_shop_order', array(
				'label'    => esc_html__( 'Order', 'hestia-pro' ),
				'section'  => 'hestia_shop',
				'priority' => 25,
				'type'     => 'select',
				'choices'  => array(
					'ASC'  => esc_html__( 'Ascending', 'hestia-pro' ),
					'DESC' => esc_html__( 'Descending', 'hestia-pro' ),
				),
			)
		);

		$wp_customize->add_setting(
			'hestia_shop_shortcode', array(
				'sanitize_callback' => 'sanitize_text_field',
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			'hestia_shop_shortcode', array(
				'label'    => esc_html__( 'WooCommerce shortcode', 'hestia-pro' ),
				'section'  => 'hestia_shop',
				'priority' => 30,
			)
		);
	}
	/**
	 * Full screen menu.
	 */
	$wp_customize->add_setting(
		'hestia_full_screen_menu', array(
			'sanitize_callback' => 'hestia_sanitize_checkbox',
			'default'           => false,
		)
	);

	$wp_customize->add_control(
		'hestia_full_screen_menu', array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Enable full screen menu', 'hestia-pro' ),
			'section'  => 'hestia_navigation',
			'priority' => 1,
		)
	);

	/**
	 * Navbar Transparent
	 */
	$wp_customize->add_setting(
		'hestia_navbar_transparent', array(
			'sanitize_callback' => 'hestia_sanitize_checkbox',
			'default'           => true,
		)
	);

	$wp_customize->add_control(
		'hestia_navbar_transparent', array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Transparent Navbar', 'hestia-pro' ),
			'section'  => 'hestia_navigation',
			'priority' => 1,
		)
	);

	$navigation_sidebar = $wp_customize->get_section( 'sidebar-widgets-header-sidebar' );
	if ( ! empty( $navigation_sidebar ) ) {
		$hestia_full_screen_menu   = $wp_customize->get_control( 'hestia_full_screen_menu' );
		$hestia_search_in_menu     = $wp_customize->get_control( 'hestia_search_in_menu' );
		$hestia_navbar_transparent = $wp_customize->get_control( 'hestia_navbar_transparent' );
		if ( ! empty( $hestia_full_screen_menu ) ) {
			$hestia_navbar_transparent->section  = 'sidebar-widgets-header-sidebar';
			$hestia_navbar_transparent->priority = - 2;
			$hestia_full_screen_menu->section    = 'sidebar-widgets-header-sidebar';
			$hestia_full_screen_menu->priority   = - 3;
			$hestia_search_in_menu->section      = 'sidebar-widgets-header-sidebar';
			$hestia_search_in_menu->priority     = - 4;
		}
	}

	/**
	 * Features section. Allow image instead of icon
	 */
	$features_control = $wp_customize->get_control( 'hestia_features_content' );
	if ( ! empty( $features_control ) ) {
		$features_control->customizer_repeater_image_control = true;
	}

	// Customizer tabs
	if ( class_exists( 'Hestia_Customize_Control_Tabs' ) ) {

		// Pricing Tables Tabs
		$wp_customize->add_setting(
			'hestia_pricing_tabs', array(
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			new Hestia_Customize_Control_Tabs(
				$wp_customize, 'hestia_pricing_tabs', array(
					'section' => 'hestia_pricing',
					'tabs'    => array(
						'general' => array(
							'nicename' => esc_html__( 'General', 'hestia-pro' ),
							'icon'     => 'cogs',
							'controls' => array(
								'hestia_pricing_hide',
								'hestia_pricing_title',
								'hestia_pricing_subtitle',
							),
						),
						'first'   => array(
							'nicename' => esc_html__( 'First', 'hestia-pro' ),
							'icon'     => 'table',
							'controls' => array(
								'hestia_pricing_table_one_title',
								'hestia_pricing_table_one_icon',
								'hestia_pricing_table_one_price',
								'hestia_pricing_table_one_features',
								'hestia_pricing_table_one_link',
								'hestia_pricing_table_one_text',
							),
						),
						'second'  => array(
							'nicename' => esc_html__( 'Second', 'hestia-pro' ),
							'icon'     => 'table',
							'controls' => array(
								'hestia_pricing_table_two_title',
								'hestia_pricing_table_two_icon',
								'hestia_pricing_table_two_price',
								'hestia_pricing_table_two_features',
								'hestia_pricing_table_two_link',
								'hestia_pricing_table_two_text',
							),
						),
					),
				)
			)
		);
	}

	/**
	 * Pro controls for Blog section.
	 */
	if ( class_exists( 'Hestia_Select_Multiple' ) ) {
		$blog_categories = hestia_get_categories_list( 'category' );
		$wp_customize->add_setting(
			'hestia_blog_categories', array(
				'sanitize_callback' => 'hestia_sanitize_array',
				'transport'         => $selective_refresh,
			)
		);

		$wp_customize->add_control(
			new Hestia_Select_Multiple(
				$wp_customize, 'hestia_blog_categories', array(
					'section'  => 'hestia_blog',
					'label'    => esc_html__( 'Categories:', 'hestia-pro' ),
					'choices'  => $blog_categories,
					'priority' => 20,
				)
			)
		);
	}// End if().

}

add_action( 'customize_register', 'hestia_pro_manager_customize_register' );


/**
 * Filter to add classic blog option for hestia_header_layout control.
 *
 * @param array $input Control options.
 */
function hestia_enable_classic_blog( $input ) {
	$input['classic-blog'] = array(
		'url' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJYAAABqBAMAAACsf7WzAAAAElBMVEX///88SFhjbXl1fok+yP/V1dWks4cUAAAAXElEQVR4Ae3SMQ2AQBBE0QNAwFlAASKwgH8rNNSwCdfs5j0BU/xMo6ypByTfmveAxmd7Wz5xLP2Rf4tf1jPAli1btl7YsmWL7QoYuoX22lelvfbaa6892mufifbcjgr1IbRYbwEAAAAASUVORK5CYII=',
	);
	return $input;
}
add_filter( 'hestia_header_layout_choices', 'hestia_enable_classic_blog' );

/**
 * Add selective refresh for shop section pro controls.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @since 1.1.45
 * @access public
 */
function hestia_pro_manager_partials( $wp_customize ) {
	// Abort if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		return;
	}

	/**
	 * Selective refresh for shop controls
	 */
	$wp_customize->selective_refresh->add_partial(
		'hestia_shop_categories', array(
			'selector'            => '.hestia-shop-content',
			'render_callback'     => 'hestia_shop_content',
			'container_inclusive' => true,
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'hestia_shop_order', array(
			'selector'            => '.hestia-shop-content',
			'render_callback'     => 'hestia_shop_content',
			'container_inclusive' => true,
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'hestia_shop_shortcode', array(
			'selector'            => '.hestia-shop-content',
			'render_callback'     => 'hestia_shop_content',
			'container_inclusive' => true,
		)
	);

	/**
	 * Selective refresh for Blog section controls
	 */
	$wp_customize->selective_refresh->add_partial(
		'hestia_blog_categories', array(
			'selector'            => '.hestia-blog-content',
			'render_callback'     => 'hestia_blog_content',
			'container_inclusive' => true,
		)
	);

}
add_action( 'customize_register', 'hestia_pro_manager_partials' );

/**
 * Add jetpack notice to customizer.
 */
function hestia_customizer_notice_pro() {
	$info_path = trailingslashit( get_template_directory() ) . 'inc/customizer-info/class/class-hestia-customizer-info-singleton-pro.php';
	if ( file_exists( $info_path ) ) {
		require_once( $info_path );
	}
}

add_action( 'after_setup_theme', 'hestia_customizer_notice_pro', 100 );


// Remove Lite Slider / Big Title
remove_action( 'hestia_header', 'hestia_slider_compatibility' );
remove_action( 'customize_register', 'hestia_big_title_customize_register' );
remove_action( 'customize_register', 'hestia_register_big_title_partials' );
remove_filter( 'hestia_enable_parallax', 'hestia_enable_parallax_in_lite' );


// Hook Pro Slider
add_action( 'hestia_header', 'hestia_slider' );

/*
 * Import customizer options from Lite version
 */
add_action( 'after_switch_theme', 'hestia_get_lite_options' );

/**
 * Import lite options.
 */
function hestia_get_lite_options() {

	/* import Hestia options */
	$hestia_mods = get_option( 'theme_mods_hestia' );

	if ( ! empty( $hestia_mods ) ) {

		foreach ( $hestia_mods as $hestia_mod_k => $hestia_mod_v ) {
			set_theme_mod( $hestia_mod_k, $hestia_mod_v );
		}
	}
}

define( 'HESTIA_PRO_FLAG', 'pro_available' );

/**
 * Function to filter the about page settings
 *
 * @return array
 */
function hestia_about_page_array_pro() {

	return array(
		// Menu name under Appearance.
		'menu_name'           => apply_filters( 'hestia_about_page_filter', __( 'About Hestia Pro', 'hestia-pro' ), 'pro_menu_name' ),
		// Page title.
		'page_name'           => apply_filters( 'hestia_about_page_filter', __( 'About Hestia Pro', 'hestia-pro' ), 'pro_page_name' ),
		// Main welcome title
		/* translators: s - theme name */
		'welcome_title'       => apply_filters( 'hestia_about_page_filter', sprintf( __( 'Welcome to %s! - Version ', 'hestia-pro' ), 'Hestia Pro' ), 'pro_welcome_title' ),
		// Main welcome content
		'welcome_content'     => apply_filters( 'hestia_about_page_filter', esc_html__( 'Hestia Pro is a modern WordPress theme for professionals. It fits creative business, small businesses (restaurants, wedding planners, sport/medical shops), startups, corporate businesses, online agencies and firms, portfolios, ecommerce (WooCommerce), and freelancers. It has a multipurpose one-page design, widgetized footer, blog/news page and a clean look, is compatible with: Flat Parallax Slider, Photo Gallery, Travel Map and Elementor Page Builder . The theme is responsive, WPML, Retina ready, SEO friendly, and uses Material Kit for design.', 'hestia-pro' ), 'pro_welcome_content' ),
		/**
		 * Tabs array.
		 *
		 * The key needs to be ONLY consisted from letters and underscores. If we want to define outside the class a function to render the tab,
		 * the will be the name of the function which will be used to render the tab content.
		 */
		'tabs'                => array(
			'getting_started'     => __( 'Getting Started', 'hestia-pro' ),
			'recommended_actions' => __( 'Recommended Actions', 'hestia-pro' ),
			'recommended_plugins' => __( 'Useful Plugins', 'hestia-pro' ),
			'support'             => __( 'Support', 'hestia-pro' ),
			'changelog'           => __( 'Changelog', 'hestia-pro' ),
		),
		// Support content tab.
		'support_content'     => array(
			'first'  => array(
				'title'        => esc_html__( 'Contact Support', 'hestia-pro' ),
				'icon'         => 'dashicons dashicons-sos',
				'text'         => esc_html__( 'We want to make sure you have the best experience using Hestia Pro and that is why we gathered here all the necessary informations for you. We hope you will enjoy using Hestia Pro, as much as we enjoy creating great products.', 'hestia-pro' ),
				'button_label' => esc_html__( 'Contact Support', 'hestia-pro' ),
				'button_link'  => esc_url( 'https://themeisle.com/contact/' ),
				'is_button'    => true,
				'is_new_tab'   => true,
			),
			'second' => array(
				'title'        => esc_html__( 'Documentation', 'hestia-pro' ),
				'icon'         => 'dashicons dashicons-book-alt',
				'text'         => esc_html__( 'Need more details? Please check our full documentation for detailed information on how to use Hestia.', 'hestia-pro' ),
				'button_label' => esc_html__( 'Read full documentation', 'hestia-pro' ),
				'button_link'  => 'http://docs.themeisle.com/article/532-hestia-pro-documentation',
				'is_button'    => false,
				'is_new_tab'   => true,
			),
			'third'  => array(
				'title'        => esc_html__( 'Changelog', 'hestia-pro' ),
				'icon'         => 'dashicons dashicons-portfolio',
				'text'         => esc_html__( 'Want to get the gist on the latest theme changes? Just consult our changelog below to get a taste of the recent fixes and features implemented.', 'hestia-pro' ),
				'button_label' => esc_html__( 'Changelog', 'hestia-pro' ),
				'button_link'  => esc_url( admin_url( 'themes.php?page=hestia-pro-welcome&tab=changelog&show=yes' ) ),
				'is_button'    => false,
				'is_new_tab'   => false,
			),
			'fourth' => array(
				'title'        => esc_html__( 'Create a child theme', 'hestia-pro' ),
				'icon'         => 'dashicons dashicons-admin-customizer',
				'text'         => esc_html__( "If you want to make changes to the theme's files, those changes are likely to be overwritten when you next update the theme. In order to prevent that from happening, you need to create a child theme. For this, please follow the documentation below.", 'hestia-pro' ),
				'button_label' => esc_html__( 'View how to do this', 'hestia-pro' ),
				'button_link'  => 'http://docs.themeisle.com/article/14-how-to-create-a-child-theme',
				'is_button'    => false,
				'is_new_tab'   => true,
			),
			'fifth'  => array(
				'title'        => esc_html__( 'Speed up your site', 'hestia-pro' ),
				'icon'         => 'dashicons dashicons-controls-skipforward',
				'text'         => esc_html__( 'If you find yourself in the situation where everything on your site is running very slow, you might consider having a look at the below documentation where you will find the most common issues causing this and possible solutions for each of the issues.', 'hestia-pro' ),
				'button_label' => esc_html__( 'View how to do this', 'hestia-pro' ),
				'button_link'  => 'http://docs.themeisle.com/article/63-speed-up-your-wordpress-site',
				'is_button'    => false,
				'is_new_tab'   => true,
			),
			'sixth'  => array(
				'title'        => esc_html__( 'Build a landing page with a drag-and-drop content builder', 'hestia-pro' ),
				'icon'         => 'dashicons dashicons-images-alt2',
				'text'         => esc_html__( 'In the documentation below you will find an easy way to build a great looking landing page using a drag-and-drop content builder plugin.', 'hestia-pro' ),
				'button_label' => esc_html__( 'View how to do this', 'hestia-pro' ),
				'button_link'  => 'http://docs.themeisle.com/article/219-how-to-build-a-landing-page-with-a-drag-and-drop-content-builder',
				'is_button'    => false,
				'is_new_tab'   => true,
			),
		),
		// Getting started tab
		'getting_started'     => array(
			'first'  => array(
				'title'               => esc_html__( 'Recommended actions', 'hestia-pro' ),
				'text'                => esc_html__( 'We have compiled a list of steps for you to take so we can ensure that the experience you have using one of our products is very easy to follow.', 'hestia-pro' ),
				'button_label'        => esc_html__( 'Recommended actions', 'hestia-pro' ),
				'button_link'         => esc_url( admin_url( 'themes.php?page=hestia-pro-welcome&tab=recommended_actions' ) ),
				'is_button'           => false,
				'recommended_actions' => true,
				'is_new_tab'          => false,
			),
			'second' => array(
				'title'               => esc_html__( 'Read full documentation', 'hestia-pro' ),
				'text'                => esc_html__( 'Need more details? Please check our full documentation for detailed information on how to use Hestia Pro.', 'hestia-pro' ),
				'button_label'        => esc_html__( 'Documentation', 'hestia-pro' ),
				'button_link'         => 'http://docs.themeisle.com/article/532-hestia-pro-documentation',
				'is_button'           => false,
				'recommended_actions' => false,
				'is_new_tab'          => true,
			),
			'third'  => array(
				'title'               => esc_html__( 'Go to the Customizer', 'hestia-pro' ),
				'text'                => esc_html__( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'hestia-pro' ),
				'button_label'        => esc_html__( 'Go to the Customizer', 'hestia-pro' ),
				'button_link'         => esc_url( admin_url( 'customize.php' ) ),
				'is_button'           => true,
				'recommended_actions' => false,
				'is_new_tab'          => true,
			),
		),
		// Plugins array.
		'recommended_plugins' => array(
			'already_activated_message' => esc_html__( 'Already activated', 'hestia-pro' ),
			'version_label'             => esc_html__( 'Version: ', 'hestia-pro' ),
			'install_label'             => esc_html__( 'Install and Activate', 'hestia-pro' ),
			'activate_label'            => esc_html__( 'Activate', 'hestia-pro' ),
			'deactivate_label'          => esc_html__( 'Deactivate', 'hestia-pro' ),
			'content'                   => array(
				array(
					'slug' => 'elementor',
				),
				array(
					'slug' => 'translatepress-multilingual',
				),
				array(
					'slug' => 'beaver-builder-lite-version',
				),
				array(
					'slug' => 'wp-product-review',
				),
				array(
					'slug' => 'intergeo-maps',
				),
				array(
					'slug' => 'visualizer',
				),
				array(
					'slug' => 'adblock-notify-by-bweb',
				),
				array(
					'slug' => 'nivo-slider-lite',
				),
			),
		),
		// Required actions array.
		'recommended_actions' => array(
			'install_label'    => esc_html__( 'Install and Activate', 'hestia-pro' ),
			'activate_label'   => esc_html__( 'Activate', 'hestia-pro' ),
			'deactivate_label' => esc_html__( 'Deactivate', 'hestia-pro' ),
			'content'          => array(
				'themeisle-companion' => array(
					'title'       => 'Orbit Fox Companion',
					'description' => __( 'Extend your theme functionality with various modules like Social Media Share Buttons & Icons, custom menu-icons, one click import page templates, page builder addons and free stock featured images.', 'hestia-pro' ),
					'check'       => defined( 'THEMEISLE_COMPANION_VERSION' ),
					'plugin_slug' => 'themeisle-companion',
					'id'          => 'themeisle-companion',
				),
				'pirate-forms'        => array(
					'title'       => 'Pirate Forms',
					'description' => __( 'Makes your Contact section more engaging by creating a good-looking contact form. Interaction with your visitors has never been easier.', 'hestia-pro' ),
					'check'       => defined( 'PIRATE_FORMS_VERSION' ),
					'plugin_slug' => 'pirate-forms',
					'id'          => 'pirate-forms',
				),
				'elementor'           => array(
					'title'       => 'Elementor',
					'description' => hestia_get_wporg_plugin_description( 'elementor' ),
					'check'       => ( defined( 'ELEMENTOR_VERSION' ) || ! hestia_check_passed_time( MONTH_IN_SECONDS ) ),
					'plugin_slug' => 'elementor',
					'id'          => 'elementor',
				),

			),
		),
	);
}

add_filter( 'hestia_about_page_array', 'hestia_about_page_array_pro' );

add_filter( 'hestia_customizer_notify_array', 'hestia_customizer_notify_pro' );

/**
 * Filter the array of options used in the lite theme, for notices in customizer.
 * This filtering is done, to add different notice in Hestia PRO than Hestia.
 */
function hestia_customizer_notify_pro() {
	$config_customizer = array(
		'recommended_plugins'       => array(
			'themeisle-companion' => array(
				'recommended' => true,
				'description' => esc_html__( 'Extend your theme functionality with various modules like Social Media Share Buttons & Icons, custom menu-icons, one click import page templates, page builder addons and free stock featured images.', 'hestia-pro' ),
			),
		),
		'recommended_actions'       => array(),
		'recommended_actions_title' => esc_html__( 'Recommended Actions', 'hestia-pro' ),
		'recommended_plugins_title' => esc_html__( 'Recommended Plugins', 'hestia-pro' ),
		'install_button_label'      => esc_html__( 'Install and Activate', 'hestia-pro' ),
		'activate_button_label'     => esc_html__( 'Activate', 'hestia-pro' ),
		'deactivate_button_label'   => esc_html__( 'Deactivate', 'hestia-pro' ),
	);
	return $config_customizer;
}


/**
 * Get an array of categories for a certain taxonomy
 *
 * @since   1.1.40
 * @access  public
 * @return array Returns an array of the type category_id => category_name for the $taxonomy taxonomy. It only gets categories with at least one post in it.
 */
function hestia_get_categories_list( $taxonomy ) {

	$hestia_categories_array = array();
	$hestia_categories       = get_categories(
		array(
			'taxonomy'   => $taxonomy,
			'hide_empty' => 1,
			'title_li'   => '',
		)
	);
	if ( ! empty( $hestia_categories ) ) {
		foreach ( $hestia_categories as $hestia_cat ) {
			if ( ! empty( $hestia_cat->term_id ) && ! empty( $hestia_cat->name ) ) {
				$hestia_categories_array[ $hestia_cat->term_id ] = $hestia_cat->name;
			}
		}
	}

	return $hestia_categories_array;
}

/**
 * Add support for video header.
 *
 * @since 1.1.52
 * @param array $settings Custom header settings.
 */
function hestia_video_support( $settings ) {
	$settings['video'] = true;
	return $settings;
}
add_filter( 'hestia_custom_header_settings', 'hestia_video_support' );

/**
 * Filter the array of footer widget areas, to add a forth area just in Hestia PRO.
 *
 * @since Hestia 1.1.57
 */
function hestia_add_extra_widget_area_in_footer( $array ) {

	if ( ! empty( $array ) ) {
		$array = array_merge(
			$array, array(
				'footer-four-widgets' => esc_html__( 'Footer Four', 'hestia-pro' ),
			)
		);
	}

	return $array;
}
add_filter( 'hestia_footer_widget_areas_array', 'hestia_add_extra_widget_area_in_footer' );

/**
 * Add filter for default value of parallax layer 1.
 *
 * @return string
 */
function hestia_parallax_layer1_default() {
	return get_template_directory_uri() . '/assets/parallax/img/background1.jpg';
}
add_filter( 'hestia_parallax_layer1_default', 'hestia_parallax_layer1_default' );

/**
 * Add filter for default value of parallax layer 2.
 *
 * @return string
 */
function hestia_parallax_layer2_default() {
	return get_template_directory_uri() . '/assets/parallax/img/background2.png';
}
add_filter( 'hestia_parallax_layer2_default', 'hestia_parallax_layer2_default' );
