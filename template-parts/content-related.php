<?php
/**
 * Template part for displaying posts
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blaskan
 */

?>

<article id="post-<?php the_ID(); ?>" class="col-md-4 col-sm-12">
	<?php if ( has_post_thumbnail() ) {
		echo '<div class="entry-thumbnail">';
		echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
		the_post_thumbnail( 'related-blog-post' );
		echo '</a>';
		echo '</div>';
	} ?>

    <p><?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' ); ?></p>
</article><!-- #post-## -->
