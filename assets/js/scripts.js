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

	// The magnifier is a button now, not a label, so it carries aria-expanded and has
	// to keep it in step with the class that reveals the field.
	$('.top-header .search').on('click', '.search-toggle', function( evt ){
		evt.stopPropagation();
		evt.preventDefault();
		var $search = $(this).closest('.search').toggleClass('active');
		$(this).attr('aria-expanded', $search.hasClass('active') ? 'true' : 'false');
		if ( $search.hasClass('active') ) {
			$search.find('.search-field').trigger('focus');
		}
	});

});

} )( jQuery );