<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blaskan
 */

get_header(); ?>

<?php

// Get layout options
$site_layout = get_theme_mod( 'blaskan_site_layout', 'right-sidebar' );

$class = 'col-md-8 col-sm-12';

if ( $site_layout == 'left-sidebar' && is_active_sidebar( 'sidebar-1' ) ) {
	$class = 'col-md-8 col-sm-12 pull-right';
} elseif ( $site_layout == 'no-sidebar' || ! is_active_sidebar( 'sidebar-1' ) ) {
	$class = 'col-md-12 col-sm-12';
}

?>

    <div id="primary" class="content-area row">
        <main id="main" class="site-main <?php echo esc_attr($class) ?>" role="main">

			<?php
			if ( have_posts() ) :

				global $wp_query;

				if ( is_home() && ! is_front_page() ) : ?>
                    <header>
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>

					<?php
				endif;
				echo '<div id="posts-container" class="row">';
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					if ( $wp_query->current_post == 0 ) {
						get_template_part( 'template-parts/content-big', get_post_format() );
					} else {
						get_template_part( 'template-parts/content', get_post_format() );
					}


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
