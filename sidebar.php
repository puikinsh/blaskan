<?php
$blaskan_options = get_option('blaskan_options');
if ( $blaskan_options['custom_sidebars_in_pages'] == 1 ) {
	$custom_sidebars_in_pages = TRUE;
} else {
	$custom_sidebars_in_pages = FALSE;
}
?>
<?php /* if ($custom_sidebars): ?>
	true
<?php else: ?>
	false
<?php endif; */ ?>

<?php if ( BLASKAN_SIDEBARS == 'no_sidebar' ): ?>
	<?php return; ?>
<?php elseif ( BLASKAN_SIDEBARS == 'one_sidebar' ): ?>
	<?php if ( $custom_sidebars_in_pages && is_page() ): ?>
		<?php if ( is_active_sidebar( 'primary-page-sidebar' ) ) : ?>
		<aside id="primary" role="complementary">
				<?php dynamic_sidebar( 'primary-page-sidebar' ); ?>
				
				<!--[if IE 6]>
					<div class="ie-clear"></div>
			  <![endif]-->
		</aside>
		<!-- / #primary -->
    <?php endif; ?>
	<?php else: ?>
		<?php if ( is_active_sidebar( 'primary-sidebar' ) ) : ?>
		<aside id="primary" role="complementary">
				<?php dynamic_sidebar( 'primary-sidebar' ); ?>
				
				<!--[if IE 6]>
					<div class="ie-clear"></div>
			  <![endif]-->
		</aside>
		<!-- / #primary -->
    <?php endif; ?>
	<?php endif;?>
<?php else: ?>
	<?php if ( $custom_sidebars_in_pages && is_page() ): ?>
		<?php if ( is_active_sidebar( 'primary-page-sidebar' ) ) : ?>
		<aside id="primary" role="complementary">
				<?php dynamic_sidebar( 'primary-page-sidebar' ); ?>
				
				<!--[if IE 6]>
					<div class="ie-clear"></div>
			  <![endif]-->
		</aside>
		<!-- / #primary -->
    <?php endif; ?>

    <?php if ( is_active_sidebar( 'secondary-page-sidebar' ) ) : ?>
		<aside id="secondary" role="complementary">
				<?php dynamic_sidebar( 'secondary-page-sidebar' ); ?>
				
				<!--[if IE 6]>
					<div class="ie-clear"></div>
			  <![endif]-->
		</aside>
		<!-- / #secondary -->
    <?php endif; ?>
	<?php else: ?>
		<?php if ( is_active_sidebar( 'primary-sidebar' ) ) : ?>
		<aside id="primary" role="complementary">
				<?php dynamic_sidebar( 'primary-sidebar' ); ?>
				
				<!--[if IE 6]>
					<div class="ie-clear"></div>
			  <![endif]-->
		</aside>
		<!-- / #primary -->
    <?php endif; ?>

    <?php if ( is_active_sidebar( 'secondary-sidebar' ) ) : ?>
		<aside id="secondary" role="complementary">
				<?php dynamic_sidebar( 'secondary-sidebar' ); ?>
				
				<!--[if IE 6]>
					<div class="ie-clear"></div>
			  <![endif]-->
		</aside>
		<!-- / #secondary -->
    <?php endif; ?>
	<?php endif;?>
<?php endif; ?>

		
