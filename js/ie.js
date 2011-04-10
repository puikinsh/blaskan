jQuery(document).ready(function($) {
  // Check layout setting
  if ($('body').hasClass('content-wide')) {
    // Clear IE8
  	$('.ie8 .content-wide-no-sidebars #footer section:nth-child(3n+1), .ie8 .content-wide-sidebar #footer section:nth-child(4n+1)').css('clear', 'both');

  	//Fix margins IE8
  	$('.ie8 .content-wide-no-sidebars #footer section:nth-child(3n), .ie8 .content-wide-sidebar #footer section:nth-child(4n)').css('margin-right', '0');
  	
  	// Fix margins and clear IE6 + IE7 
  	if ($('html').hasClass('ie6') || $('html').hasClass('ie7')) {
  		var i = 0;
  		$('.ie7 #footer-widgets section, .ie6 #footer-widgets section').each(function(){
  			i++;
  			$(this).addClass('ie-widget-'+i);
  			if (i == 4) {
  				i = 0;
  			}
  		});
  		$('.content-wide-no-sidebars .ie-widget-1, .content-wide-sidebar .ie-widget-1').css('clear', 'both');
  		$('.content-wide-no-sidebars .ie-widget-1, .content-wide-sidebar .ie-widget-1').before('<div style="clear:both"></div>');
  		$('.content-wide-no-sidebars .ie-widget-3, .content-wide-sidebar .ie-widget-4').css('margin-right', '0');
  	}
  } else {
    // Clear IE8
  	$('.ie8 .no-sidebars #footer section:nth-child(2n+1), .ie8 .sidebar #footer section:nth-child(3n+1), .ie8 .sidebars #footer section:nth-child(4n+1)').css('clear', 'both');

  	//Fix margins IE8
  	$('.ie8 .no-sidebars #footer section:nth-child(2n), .ie8 .sidebar #footer section:nth-child(3n), .ie8 .sidebars #footer section:nth-child(4n)').css('margin-right', '0');
  	
  	// Fix margins and clear IE6 + IE7 
  	if ($('html').hasClass('ie6') || $('html').hasClass('ie7')) {
  		var i = 0;
  		$('.ie7 #footer-widgets section, .ie6 #footer-widgets section').each(function(){
  			i++;
  			$(this).addClass('ie-widget-'+i);
  			if (i == 4) {
  				i = 0;
  			}
  		});
  		$('.no-sidebars .ie-widget-1, .no-sidebars .ie-widget-3, .sidebar .ie-widget-4, .sidebars .ie-widget-1').css('clear', 'both');
  		$('.no-sidebars .ie-widget-1, .no-sidebars .ie-widget-3, .sidebar .ie-widget-4, .sidebars .ie-widget-1').before('<div style="clear:both"></div>');
  		$('.no-sidebars .ie-widget-2, .no-sidebars .ie-widget-4, .sidebar .ie-widget-3, .sidebars .ie-widget-4').css('margin-right', '0');
  	}
  }
	
	// Add dividing dashes in IE 6 and IE 7
	if ($('html').hasClass('ie6') || $('html').hasClass('ie7')) {
  	$('.post footer .comments, .post footer .categories, .post footer .tags, .post footer .edit, .type-attachment footer .comments, .type-attachment footer .categories, .type-attachment footer .tags, .type-attachment footer .edit').prepend('<span class="ie-divider">&nbsp;–&nbsp;</span>');
	}
});