<?php
/**
 * Functions used in Hestia Hooks admin panel
 *
 * @package Hestia
 */

if ( ! function_exists( 'hestia_execute_hooks' ) ) {

	/**
	 * Function to execute actions added for each hook
	 *
	 * @param string $id Hook id.
	 */
	function hestia_execute_hooks( $id ) {
		$hooks = get_option( 'hestia_hooks' );

		$content = isset( $hooks[ $id ] ) ? $hooks[ $id ] : null;

		if ( ! $content ) {
			return;
		}

		$php = isset( $hooks[ $id . '_php' ] ) ? $hooks[ $id . '_php' ] : null;

		$value = do_shortcode( $content );

		if ( 'true' == $php ) {
			eval( "?>$value<?php " );
		} else {
			echo $value;
		}

	}
}


$hooks = get_option( 'hestia_hooks' );
if ( ! empty( $hooks ) ) {
	foreach ( $hooks as $hook => $action ) {

		add_action(
			$hook, function() use ( $hook ) {
				hestia_execute_hooks( $hook );
			}
		);

	}
}
