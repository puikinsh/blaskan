<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blaskan
 */

?>

	</div><!-- #content -->



	<footer id="colophon" class="site-footer" role="contentinfo">
		<?php if ( blaskna_has_footer_widgets() ): ?>
			<div class="footer-widgets container">
				<div class="row">
					<?php blaskna_footer_widgets() ?>
				</div>
			</div>
		<?php endif ?>
		<div class="site-info">
			<div class="container">
				<div class="copyright-info col-md-6 col-sm-12">
					<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'blaskan' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'blaskan' ), 'WordPress' ); ?></a>
					<span class="sep"> | </span>
					<?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'blaskan' ), 'Blaskan', '<a href="https://MachoThemes.com" target="_blank" rel="designer">MachoThemes.com</a>' ); ?>
				</div>
				<?php if ( has_nav_menu( 'menu-2' ) ) { ?>
					<div class="main-footer-navigation col-md-6 col-sm-12">
					<?php wp_nav_menu( array( 'theme_location' => 'menu-2', 'menu_id' => 'footer-menu' ) ); ?>
					</div>
				<?php } ?>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
