<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blaskan
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">

	<?php get_template_part( 'template-parts/sidebar', 'footer' ) ?>

    <div class="site-info">
        <div class="container">
            <div class="row">
                <div class="copyright-info col-md-6 col-sm-12">
                    <a href="<?php echo esc_url( 'https://wordpress.org/' ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'blaskan' ), 'WordPress' ); ?></a>
                    <span class="sep"> | </span>
					<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'blaskan' ), 'Blaskan', '<a href="https://colorlib.com/" target="_blank" rel="designer">Colorlib.com</a>' ); ?>
                </div>
				<?php if ( has_nav_menu( 'menu-2' ) ) { ?>
                    <div class="main-footer-navigation col-md-6 col-sm-12">
						<?php wp_nav_menu( array( 'theme_location' => 'menu-2', 'menu_id' => 'footer-menu' ) ); ?>
                    </div>
				<?php } ?>
            </div>

        </div>
    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
