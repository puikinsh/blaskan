<?php get_header(); ?>

			<section id="content" role="main">
<?php if ( have_posts() ) : ?>
				<h1 class="page-title"><?php printf( __( 'Search results for: %s', 'blaskan' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php get_template_part( 'loop', 'search' ); ?>
<?php else : ?>
				<article class="post no-results not-found">
					<h1><?php _e( 'Nothing Found', 'blaskan' ); ?></h1>
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'blaskan' ); ?></p>
						<?php get_search_form(); ?>
				</article>
<?php endif; ?>
			</section>
			<!-- / #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>