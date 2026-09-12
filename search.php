<?php
/**
 * The template for displaying search results pages
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package blaskan
 */

get_header(); ?>

<?php

$class = blaskan_content_class();

?>

    <div id="primary" class="content-area row">

		<?php if ( have_posts() ): ?>

            <header class="page-header archive-header">
                <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'blaskan' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
            </header><!-- .page-header -->

		<?php endif ?>


        <main id="main" class="site-main <?php echo $class ?>" role="main">

			<?php
			if ( have_posts() ) :

				echo '<div id="posts-container" class="row">';
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );

				endwhile;
				echo '</div>';
				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

        </main><!-- #main -->
		<?php get_sidebar(); ?>
    </div><!-- #primary -->

<?php

get_footer();