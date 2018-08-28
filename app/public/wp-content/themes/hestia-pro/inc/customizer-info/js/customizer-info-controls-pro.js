/**
 * JS File for Jetpack notification in customizer
 *
 * @package Hestia
 */
( function( api ) {

	// Extends our custom "hestia_info_jetpack" section.
	api.sectionConstructor.hestia_info_jetpack = api.Section.extend(
		{

				// No events for this type of section.
			attachEvents: function () {},

				// Always make the section active.
			isContextuallyActive: function () {
				return true;
			}
		}
	);

} )( wp.customize );
