<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
		<article id="content" role="main" <?php post_class(); ?>>

				<header><h1><?php the_title(); ?></h1></header>

				<?php the_content(); ?>
				
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'blaskan' ), 'after' => '</div>' ) ); ?>
				
				<?php edit_post_link( __( 'Edit', 'blaskan' ), '<span class="edit-link">', '</span>' ); ?>

				<?php comments_template( '', true ); ?>
		
			</article>
			<!-- #content -->

<?php endwhile; ?>

			

<?php get_sidebar(); ?>
<?php get_footer(); ?>
