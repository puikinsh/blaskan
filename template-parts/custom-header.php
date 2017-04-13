<?php

$header_image = get_header_image();

if ( $header_image ) {

	$contianer_height = get_custom_header()->height . 'px';

	?>

    <div class="custom-header"
         style="background-image:url(<?php header_image(); ?>);height:<?php echo get_custom_header()->height ?>px"></div>

<?php }