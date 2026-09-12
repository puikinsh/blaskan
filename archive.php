<?php
/**
 * The template for displaying archive pages
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
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
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
            </header><!-- .page-header -->

		<?php endif ?>


        <main id="main" class="site-main <?php echo esc_attr($class) ?>" role="main">

			<?php
			if ( have_posts() ) :

				echo '<div id="posts-container" class="row">';
				/* Start the Loop */
				while ( have_posts() ) : the_post();

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
