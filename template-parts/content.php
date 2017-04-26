<?php
/**
 * Template part for displaying posts
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blaskan
 */

if ( ! is_single() ) {
	$class = 'col-md-6 col-sm-12';
} else {
	$class = 'col-md-12 col-sm-12';
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
    <header class="entry-header">

		<?php if ( has_post_thumbnail() && blaskan_jetpack_featured_image() ) {
			echo '<div class="entry-thumbnail">';
			echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
			$image_orientation = blaskan_verify_image_orientation( get_post_thumbnail_id() );
			the_post_thumbnail( 'small-blog-post-'.$image_orientation );
			echo '</a>';
			echo '</div>';
		} ?>

		<?php if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
				<?php blaskan_posted_on(); ?>
            </div><!-- .entry-meta -->
		<?php endif; ?>

		<?php
		if ( is_sticky() ) {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><i class="fa fa-thumb-tack" aria-hidden="true"></i>', '</a></h2>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		?>

    </header><!-- .entry-header -->

    <div class="entry-content">
		<?php
		the_content( sprintf(
		             /* translators: %s: Name of current post. */
			             wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'blaskan' ), array( 'span' => array( 'class' => array() ) ) ),
			             the_title( '<span class="screen-reader-text">"', '"</span>', false )
		             ) );

		wp_link_pages( array(
			               'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blaskan' ),
			               'after'  => '</div>',
		               ) );
		?>
    </div><!-- .entry-content -->

</article><!-- #post-## -->
