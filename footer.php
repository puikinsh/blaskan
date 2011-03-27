
		<footer id="footer">
			<?php get_sidebar( 'footer' ); ?>
			<?php echo blaskan_footer_nav(); ?>
			
			<?php if ( blaskan_footer_message() || blaskan_footer_credits() ) : ?>
				<div id="footer-info" role="contentinfo">
					<?php echo blaskan_footer_message(); ?>
					<?php echo blaskan_footer_credits(); ?>
				</div>
			<?php endif; ?>
		</footer>
		<!-- / #footer -->
	</div>
	<!-- / #wrapper -->

</div>
<!-- / #site -->

  <?php wp_footer(); ?>

	<!--[if lt IE 7]>
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/libs/unitpngfix.js"></script>
	<![endif]-->
	
	<!--[if lt IE 9]>
		<script type="text/javascript">
			// Load jQuery?
			!window.jQuery && document.write(unescape('%3Cscript src="/wp-includes/js/jquery/jquery.js"%3E%3C/script%3E'));
		</script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/ie.js"></script>
  <![endif]-->
</body>
</html>