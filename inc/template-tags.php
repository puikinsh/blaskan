<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package blaskan
 */

if ( ! function_exists( 'blaskan_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function blaskan_posted_on() {

		$posted_on = '';

		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'blaskan' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		$posted_on = '<span class="byline">' . $byline . '</span>';

		$categories_list = get_the_category_list( ', ' );
		if ( $categories_list && blaskan_categorized_blog() && is_single() ) {
			$categories = sprintf( '<span class="category-delimeter"> - </span><span class="cat-links">%1$s</span>', $categories_list ); // WPCS: XSS OK.
			$posted_on  .= $categories;
		}

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
		                        esc_attr( get_the_date( 'c' ) ),
		                        esc_html( get_the_date() ),
		                        esc_attr( get_the_modified_date( 'c' ) ),
		                        esc_html( get_the_modified_date() )
		);

		if ( ! is_sticky() ) {
			$posted_on .= '<span class="posted-on"><span class="posted-on-delimeter">  -  </span><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>';
		}

		echo $posted_on;

	}
endif;

if ( ! function_exists( 'blaskan_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function blaskan_entry_footer() {
		// Hide category and tag text for pages.
		echo '<div class="col-md-8 col-xs-12">';
		if ( 'post' === get_post_type() ) {

			$tags_list = get_the_tag_list( '', esc_html__( ' ', 'blaskan' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">%1$s</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'blaskan' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
		echo '</div>';

		echo '<div class="col-md-4 col-xs-12 pull-right text-right">';
		$url   = urlencode( esc_url(get_permalink()) );
		$title = urlencode( esc_attr(get_the_title()) );
		echo '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '" target="_blank" class="social-icons"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
		echo '<a href="https://twitter.com/home?status=' . $url . '" target="_blank" class="social-icons"><i class="fa fa-twitter" aria-hidden="true"></i></a>';

		if ( has_post_thumbnail() ) {
			$image = urlencode( esc_url((get_the_post_thumbnail_url( get_the_ID(), 'full' ))) );
			echo '<a href="https://pinterest.com/pin/create/button/?url=' . $url . '&media=' . $image . '" target="_blank" class="social-icons"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>';
		}

		echo '<a href="https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $title . '" target="_blank" class="social-icons"><i class="fa fa-linkedin" aria-hidden="true"></i></a>';

		echo '</div>';


	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function blaskan_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'blaskan_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
             'fields'     => 'ids',
             'hide_empty' => 1,
             // We only need to know if there is more than one category.
             'number'     => 2,
         ) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'blaskan_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so blaskan_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so blaskan_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in blaskan_categorized_blog.
 */
function blaskan_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'blaskan_categories' );
}

add_action( 'edit_category', 'blaskan_category_transient_flusher' );
add_action( 'save_post', 'blaskan_category_transient_flusher' );

function blaskan_jetpack_featured_image() {

	if ( ! function_exists( 'jetpack_featured_images_remove_post_thumbnail' ) ) {
		return true;
	}

	$options = get_theme_support( 'jetpack-content-options' );

	if ( ! isset( $options[0]['featured-images'] ) ) {
		return true;
	}

	$featured_image_options = $options[0]['featured-images'];

	if ( ( is_home() || is_archive() ) && $featured_image_options['archive'] ) {
		return true;
	} elseif ( is_page() && $featured_image_options['page'] ) {
		return true;
	} elseif ( is_single() && $featured_image_options['post'] ) {
		return true;
	}


	return false;

}

add_filter( 'the_content_more_link', 'blaskan_create_read_more_link' );

function blaskan_create_read_more_link( $more_link ){

	$output = '<footer class="entry-footer index-entry">';
	
	$output .= '<div class="post-social pull-left">';

	$url   = urlencode( esc_url(get_permalink()) );
	$title = urlencode( esc_attr(get_the_title()) );
	$output .= '<a href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '" target="_blank" class="social-icons"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
	$output .= '<a href="https://twitter.com/home?status=' . $url . '" target="_blank" class="social-icons"><i class="fa fa-twitter" aria-hidden="true"></i></a>';

	if ( has_post_thumbnail() ) {
		$image = urlencode( esc_url((get_the_post_thumbnail_url( get_the_ID(), 'full' ))) );
		$output .= '<a href="https://pinterest.com/pin/create/button/?url=' . $url . '&media=' . $image . '" target="_blank" class="social-icons"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>';
	}

	$output .= '<a href="https://www.linkedin.com/shareArticle?mini=true&url=' . $url . '&title=' . $title . '" target="_blank" class="social-icons"><i class="fa fa-linkedin" aria-hidden="true"></i></a>';

	$output .= '</div>';
	$output .= $more_link;
	$output .= '</footer>';

	return $output;

}