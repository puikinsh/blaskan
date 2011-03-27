		
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
