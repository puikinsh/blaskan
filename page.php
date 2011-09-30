<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
		<article id="content" role="main" <?php post_class(); ?>>

				<header>
					<?php if ( has_post_thumbnail() ) : ?>
					  <figure class="post-thumbnail">
							<?php if ( !is_single() ) : ?>
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'blaskan' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_post_thumbnail(); ?></a>
							<?php else: ?>
								<?php the_post_thumbnail(); ?>
							<?php endif; ?>
						</figure>
					<?php endif; ?>
					
					<?php if ( get_the_title() ): ?>
						<h1><?php the_title(); ?></h1>
					<?php endif; ?>
				</header>

				<?php the_content(); ?>
				
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'blaskan' ), 'after' => '</div>' ) ); ?>
				
				<?php edit_post_link( __( 'Edit', 'blaskan' ), '<span class="edit-link">', '</span>' ); ?>

				<?php comments_template( '', true ); ?>
		
			</article>
			<!-- #content -->

<?php endwhile; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>