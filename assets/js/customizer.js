/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Header text color.
	wp.customize( 'header_text', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$( '.site-title, .site-description' ).removeClass('hide');
			} else {
				$( '.site-title, .site-description' ).addClass('hide');
			}
		} );
	} );

} )( jQuery );
