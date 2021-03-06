<?php
/**
 * Lite Manager
 *
 * @package Hestia
 * @since 1.0.12
 */


/**
 * About page class
 */
require_once get_template_directory() . '/ti-notifications/ti-about-page/class-themeisle-about-page.php';

/*
* About page instance
*/
$config = array(
	// Menu name under Appearance.
	'menu_name'           => apply_filters( 'hestia_about_page_filter', __( 'About Hestia', 'hestia-pro' ), 'menu_name' ),
	// Page title.
	'page_name'           => apply_filters( 'hestia_about_page_filter', __( 'About Hestia', 'hestia-pro' ), 'page_name' ),
	// Main welcome title
	/* translators: s - theme name */
	'welcome_title'       => apply_filters( 'hestia_about_page_filter', sprintf( __( 'Welcome to %s! - Version ', 'hestia-pro' ), 'Hestia' ), 'welcome_title' ),
	// Main welcome content
	'welcome_content'     => apply_filters( 'hestia_about_page_filter', esc_html__( 'Hestia is a modern WordPress theme for professionals. It fits creative business, small businesses (restaurants, wedding planners, sport/medical shops), startups, corporate businesses, online agencies and firms, portfolios, ecommerce (WooCommerce), and freelancers. It has a multipurpose one-page design, widgetized footer, blog/news page and a clean look, is compatible with: Flat Parallax Slider, Photo Gallery, Travel Map and Elementor Page Builder . The theme is responsive, WPML, Retina ready, SEO friendly, and uses Material Kit for design.', 'hestia-pro' ), 'welcome_content' ),
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
		'free_pro'            => __( 'Free vs PRO', 'hestia-pro' ),
	),
	// Support content tab.
	'support_content'     => array(
		'first'  => array(
			'title'        => esc_html__( 'Contact Support', 'hestia-pro' ),
			'icon'         => 'dashicons dashicons-sos',
			'text'         => esc_html__( 'We want to make sure you have the best experience using Hestia, and that is why we have gathered all the necessary information here for you. We hope you will enjoy using Hestia as much as we enjoy creating great products.', 'hestia-pro' ),
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
			'button_link'  => 'http://docs.themeisle.com/article/569-hestia-documentation',
			'is_button'    => false,
			'is_new_tab'   => true,
		),
		'third'  => array(
			'title'        => esc_html__( 'Changelog', 'hestia-pro' ),
			'icon'         => 'dashicons dashicons-portfolio',
			'text'         => esc_html__( 'Want to get the gist on the latest theme changes? Just consult our changelog below to get a taste of the recent fixes and features implemented.', 'hestia-pro' ),
			'button_label' => esc_html__( 'Changelog', 'hestia-pro' ),
			'button_link'  => esc_url( admin_url( 'themes.php?page=hestia-welcome&tab=changelog&show=yes' ) ),
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
			'text'         => esc_html__( 'If you find yourself in a situation where everything on your site is running very slowly, you might consider having a look at the documentation below where you will find the most common issues causing this and possible solutions for each of the issues.', 'hestia-pro' ),
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
			'button_link'         => esc_url( admin_url( 'themes.php?page=hestia-welcome&tab=recommended_actions' ) ),
			'is_button'           => false,
			'recommended_actions' => true,
			'is_new_tab'          => false,
		),
		'second' => array(
			'title'               => esc_html__( 'Read full documentation', 'hestia-pro' ),
			'text'                => esc_html__( 'Need more details? Please check our full documentation for detailed information on how to use Hestia.', 'hestia-pro' ),
			'button_label'        => esc_html__( 'Documentation', 'hestia-pro' ),
			'button_link'         => 'http://docs.themeisle.com/article/569-hestia-documentation',
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
	// Free vs PRO array.
	'free_pro'            => array(
		'free_theme_name'     => 'Hestia',
		'pro_theme_name'      => 'Hestia Pro',
		'pro_theme_link'      => apply_filters( 'hestia_upgrade_link_from_child_theme_filter', 'https://themeisle.com/themes/hestia-pro/upgrade/' ),
		/* translators: s - theme name */
		'get_pro_theme_label' => sprintf( __( 'Get %s now!', 'hestia-pro' ), 'Hestia Pro' ),
		'banner_link'         => 'http://docs.themeisle.com/article/647-what-is-the-difference-between-hestia-and-hestia-pro',
		'banner_src'          => get_template_directory_uri() . '/assets/img/free_vs_pro_banner.png',
		'features'            => array(
			array(
				'title'       => __( 'Mobile friendly', 'hestia-pro' ),
				'description' => __( 'Responsive layout. Works on every device.', 'hestia-pro' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),
			array(
				'title'       => __( 'WooCommerce Compatible', 'hestia-pro' ),
				'description' => __( 'Ready for e-commerce. You can build an online store here.', 'hestia-pro' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),
			array(
				'title'       => __( 'Frontpage Sections', 'hestia-pro' ),
				'description' => __( 'Big title, Features, About, Team, Testimonials, Subscribe, Blog, Contact', 'hestia-pro' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),
			array(
				'title'       => __( 'Background image', 'hestia-pro' ),
				'description' => __( 'You can use any background image you want.', 'hestia-pro' ),
				'is_in_lite'  => 'true',
				'is_in_pro'   => 'true',
			),
			array(
				'title'       => __( 'Section Reordering', 'hestia-pro' ),
				'description' => __( 'The ability to reorganize your Frontpage Sections more easily and quickly.', 'hestia-pro' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),
			array(
				'title'       => __( 'Shortcodes for each section', 'hestia-pro' ),
				'description' => __( 'Display a frontpage section wherever you like by adding its shortcode in page or post content.', 'hestia-pro' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),
			array(
				'title'       => __( 'Header Slider', 'hestia-pro' ),
				'description' => __( 'You will be able to add more content to your site header with an awesome slider.', 'hestia-pro' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),
			array(
				'title'       => __( 'Fully Customizable Colors', 'hestia-pro' ),
				'description' => __( 'Change colors for the header overlay, header text and navbar.', 'hestia-pro' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),
			array(
				'title'       => __( 'Jetpack Portfolio', 'hestia-pro' ),
				'description' => __( 'Portfolio section with two possible layouts.', 'hestia-pro' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),
			array(
				'title'       => __( 'Pricing Plans Section', 'hestia-pro' ),
				'description' => __( 'A fully customizable pricing plans section.', 'hestia-pro' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),
			array(
				'title'       => __( 'Quality Support', 'hestia-pro' ),
				'description' => __( '24/7 HelpDesk Professional Support', 'hestia-pro' ),
				'is_in_lite'  => 'false',
				'is_in_pro'   => 'true',
			),
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
				'description' => __( 'It is highly recommended that you install the companion plugin to have access to the Frontpage features, Team and Testimonials sections.', 'hestia-pro' ),
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
Themeisle_About_Page::init( apply_filters( 'hestia_about_page_array', $config ) );

/*
 * Notifications in customize
 */
require get_template_directory() . '/ti-notifications/ti-customizer-notify/class-themeisle-customizer-notify.php';

$config_customizer = array(
	'recommended_plugins'       => array(
		'themeisle-companion' => array(
			'recommended' => true,
			/* translators: s - Orbit Fox Companion */
			'description' => sprintf( esc_html__( 'If you want to take full advantage of the options this theme has to offer, please install and activate %s.', 'hestia-pro' ), sprintf( '<strong>%s</strong>', 'Orbit Fox Companion' ) ),
		),
	),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'hestia-pro' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugins', 'hestia-pro' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'hestia-pro' ),
	'activate_button_label'     => esc_html__( 'Activate', 'hestia-pro' ),
	'deactivate_button_label'   => esc_html__( 'Deactivate', 'hestia-pro' ),
);
Themeisle_Customizer_Notify::init( apply_filters( 'hestia_customizer_notify_array', $config_customizer ) );
