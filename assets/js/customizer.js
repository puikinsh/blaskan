/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).addClass('hide');
			} else {
				$( '.site-title, .site-description' ).removeClass('hide');
			}
		} );
	} );

	// Disable/enable search header
	wp.customize( 'blaskan_disable_header_search', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$('#search-header-form').addClass( 'hide' );
			}else{
				$('#search-header-form').removeClass( 'hide' );
			}
		} );
	} );

} )( jQuery );
