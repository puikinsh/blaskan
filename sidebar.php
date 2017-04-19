<?php
/**
 * The sidebar containing the main widget area
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blaskan
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}

// Get layout options
$site_layout = get_theme_mod( 'blaskan_site_layout', 'right-sidebar' );

if ( $site_layout == 'no-sidebar' ) {
	return;
}

?>

<aside id="secondary" class="widget-area col-md-4 col-sm-12" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
