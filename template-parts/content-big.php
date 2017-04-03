<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blaskan
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php blaskan_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php

		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			if ( is_sticky() ) {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><i class="fa fa-thumb-tack" aria-hidden="true"></i>', '</a></h2>' );
			}else{
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		endif;

		?>

		<?php if ( has_post_thumbnail() ) { 
			echo '<div class="entry-thumbnail">'; 
			the_post_thumbnail();
			echo '</div>';
		} ?>
		
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			if ( is_single() ) {
				the_content( sprintf(
					/* translators: %s: Name of current post. */
					wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'blaskan' ), array( 'span' => array( 'class' => array() ) ) ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blaskan' ),
					'after'  => '</div>',
				) );
			}else{
				blaskan_show_index_content();
			}
		?>
	</div><!-- .entry-content -->

	<?php if ( is_single() ): ?>
		<footer class="entry-footer">
			<?php blaskan_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	<?php endif ?>
</article><!-- #post-## -->
