( function( $ ) {

$(document).ready(function(){

	if ( $('.mansonry-posts #main .row > article').length > 1 ) {

		$('.mansonry-posts #main .row').imagesLoaded(function () {
	        $('.mansonry-posts #main .row').masonry({
				itemSelector: '.post', 
				percentPosition: true, 
				columnWidth: '.col-md-6'
			});
	    });
		
		// Triggers re-layout on infinite scroll
		infinite_count = 0;
	    $( document.body ).on( 'post-load', function () {
	    	infinite_count = infinite_count + 1;
	    	var $selector = $('#infinite-view-' + infinite_count);
	    	var $elements = $selector.find('.hentry');
			var $container = $('.mansonry-posts #main .row');
			$container.imagesLoaded(function () {
				$selector.remove();
				$container.append( $elements );
				$container.masonry( 'appended', $elements, true );
				$container.masonry();
			});
	    });

	}

	$('.top-header .search .search-form label').click(function( evt ){
		evt.stopPropagation();
		evt.preventDefault();
		$('.top-header .search').toggleClass( 'active' );
		$('.top-header #search').focus();
	});	

});

} )( jQuery );