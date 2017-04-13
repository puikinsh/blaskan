<?php
/**
 * Jetpack Compatibility File
 *
 * @link    https://jetpack.com/
 *
 * @package blaskan
 */

/**
 * Jetpack setup function.
 */
function blaskan_jetpack_setup() {

	// Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'blog-display'       => 'content',
		// the default setting of the theme: 'content', 'excerpt' or array( 'content', 'excerpt' ) for themes mixing both display.
		'author-bio'         => true,
		// display or not the author bio: true or false.
		'author-bio-default' => false,
		// the default setting of the author bio, if it's being displayed or not: true or false (only required if false).
		'masonry'            => '.site-main .row',
		// a CSS selector matching the elements that triggers a masonry refresh if the theme is using a masonry layout.
		'post-details'       => array(
			'stylesheet' => 'blaskan-style', // name of the theme's stylesheet.
			'date'       => '.posted-on', // a CSS selector matching the elements that display the post date.
			'categories' => '.cat-links', // a CSS selector matching the elements that display the post categories.
			'tags'       => '.tags-links', // a CSS selector matching the elements that display the post tags.
			'author'     => '.byline', // a CSS selector matching the elements that display the post author.
		),
		'featured-images'    => array(
			'archive'         => true,
			// enable or not the featured image check for archive pages: true or false.
			'archive-default' => true,
			// the default setting of the featured image on archive pages, if it's being displayed or not: true or false (only required if false).
			'post'            => true,
			// enable or not the featured image check for single posts: true or false.
			'post-default'    => true,
			// the default setting of the featured image on single posts, if it's being displayed or not: true or false (only required if false).
			'page'            => true,
			// enable or not the featured image check for single pages: true or false.
			'page-default'    => true,
			// the default setting of the featured image on single pages, if it's being displayed or not: true or false (only required if false).
		),
	) );

	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'posts-container',
		'render'    => 'blaskan_infinite_scroll_render',
		'footer'    => false
		// 'wrapper'	=> false
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
}

add_action( 'after_setup_theme', 'blaskan_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function blaskan_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content' );
	}
}
