/**
 * Scripts file for Hestia Pro
 *
 * @package Hestia
 */

jQuery( document ).ready(
	function ($) {

		// Open WooCommerce nav cart after add product
		var addToCartBtn = $( '.btn.product_type_simple.ajax_add_to_cart' );

		if (addToCartBtn.length > 0) {

			var navCart = $( 'li.nav-cart' );

			$( addToCartBtn ).click(
				function() {
					setTimeout(
						function(){
							navCart.addClass( 'hestia-anim-cart' );
						}, 1000
					); // delay before, avoid adding product flick

					setTimeout(
						function(){
							navCart.removeClass( 'hestia-anim-cart' );
						}, 5000
					); // close the cart content after 5 sec
				}
			);
		}

	}
);
