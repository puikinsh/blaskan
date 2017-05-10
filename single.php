<?php
/**
 * The template for displaying all single posts
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'single' );

				$author_bio = get_option( 'jetpack_content_author_bio', true );

				if ( $author_bio ) {
					get_template_part( 'template-parts/author', 'description' );
				}

				$current_post_categories = wp_get_post_categories( get_the_ID(), array( 'fields' => 'ids' ) );
				if ( ! empty( $current_post_categories ) ) {

					$related_posts = new WP_Query( array( 'category__in'   => $current_post_categories,
					                                      'posts_per_page' => 3
					                               ) );
					if ( $related_posts->have_posts() ) {

						echo '<div class="related-posts row">';
						echo '<div class="related-header col-md-12"><h5>' . esc_html__( 'Similar Posts', 'blaskan' ) . '</h5></div>';
						while ( $related_posts->have_posts() ) {
							$related_posts->the_post();
							get_template_part( 'template-parts/content', 'related' );
						}
						echo '</div>';
						wp_reset_postdata();
					}
				}

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

        </main><!-- #main -->
		<?php get_sidebar(); ?>
    </div><!-- #primary -->

<?php

get_footer();
