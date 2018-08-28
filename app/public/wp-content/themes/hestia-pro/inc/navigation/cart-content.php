<?php
/**
 * Cart content.
 *
 * @package Hestia
 * @since Hestia 1.0
 */
if ( ! function_exists( 'hestia_cart_item' ) ) {

	/**
	 * Display cart item in menu.
	 *
	 * @param boolean $responsive rendering the responsive cart.
	 *
	 * @return string
	 */
	function hestia_cart_item( $responsive = false ) {
		$class = 'nav-cart';
		$cart  = '';
		if ( (bool) $responsive === true ) {
			$class = 'nav-cart responsive-nav-cart';
		}
		$cart .= '<li class="' . esc_attr( $class ) . '"><a href="' . esc_url( wc_get_cart_url() ) . '" title="' . esc_attr__( 'View cart', 'hestia-pro' ) . '" class="nav-cart-icon"><i class="fa fa-shopping-cart"></i>' . trim( ( WC()->cart->get_cart_contents_count() > 0 ) ? '<span>' . WC()->cart->get_cart_contents_count() . '</span>' : '' ) . '</a>';
		if ( (bool) $responsive !== true ) {
			$cart .= apply_filters( 'hestia_cart_content', '' );
		}
		$cart .= '</li>';

		return $cart;
	}
}

if ( ! function_exists( 'hestia_cart_content' ) ) :
	/**
	 * Function to display cart content.
	 *
	 * @since 1.1.24
	 * @access public
	 */
	function hestia_cart_content() {
		// If WooCommerce exists
		if ( hestia_woocommerce_check() ) {
			ob_start();
			the_widget( 'WC_Widget_Cart' );
			$cart = ob_get_contents();
			ob_end_clean();

			return '<div class="nav-cart-content">' . $cart . '</div>';
		}
	}
endif;

add_filter( 'hestia_cart_content', 'hestia_cart_content' );

if ( hestia_woocommerce_check() && function_exists( 'hestia_cart_item' ) ) {
	/**
	 * Render responsive cart.
	 */
	function hestia_responsive_nav_cart() {
		echo hestia_cart_item( true );
	}
	add_action( 'hestia_before_navbar_toggle_hook', 'hestia_responsive_nav_cart' );
}
