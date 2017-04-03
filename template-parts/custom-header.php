<?php

$header_image = get_header_image();

if ( $header_image ) { ?>
	
<div class="custom-header">
	<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
</div>

<?php }