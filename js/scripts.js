jQuery(document).ready(function(){

	if ( jQuery('.mansonry-posts #main .row > article').length > 1 ) {


		jQuery('.mansonry-posts #main .row').imagesLoaded(function () {
	        jQuery('.mansonry-posts #main .row').masonry({
				itemSelector: '.post', 
				percentPosition: true, 
				columnWidth: '.col-md-6'
			});
	    });
		

	}
	

	jQuery('.top-header .search .search-form label').click(function( evt ){
		evt.stopPropagation();
		evt.preventDefault();
		jQuery('.top-header .search').toggleClass( 'active' );
		jQuery('.top-header #search').focus();
	});	

});