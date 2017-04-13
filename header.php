<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blaskan
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <header id="masthead" class="site-header" role="banner">
        <div class="site-branding ">

            <div class="top-header container">

				<?php if ( has_nav_menu( 'social-menu' ) ) { ?>
                    <div class="blaskan-social-menu pull-right">
						<?php wp_nav_menu( array(
							                   'theme_location' => 'social-menu',
							                   'menu_id'        => 'social-menu',
							                   'link_before'    => '<span>',
							                   'link_after'     => '</span>'
						                   ) ); ?>
                    </div>
				<?php } ?>

                <div class="search pull-right">
                    <form role="search" method="get" class="search-form"
                          action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <input id="search" type="search" name="s"
                               placeholder="<?php esc_html__( 'Search ...', 'blaskan' ) ?>">
                        <label for="search"><i class="fa fa-search" aria-hidden="true"></i></label>
                    </form>
                </div>

                <div class="clearfix"></div>
            </div>

            <div class="container">
				<?php

				if ( function_exists( 'the_custom_logo' ) ) {
					the_custom_logo();
				}
				if ( display_header_text() || is_customize_preview() ) {

					$extra_class = ! display_header_text() ? ' hide' : '';

					if ( is_front_page() && is_home() ) : ?>
                        <h1 class="site-title<?php echo $extra_class ?>"><a
                                    href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                    rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
                        <p class="site-title<?php echo $extra_class ?>"><a
                                    href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                    rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
                        <p class="site-description<?php echo $extra_class ?>"><?php echo wp_kses_post( $description ); /* WPCS: xss ok. */ ?></p>
						<?php
					endif;

				}

				?>

            </div><!-- .container -->
        </div><!-- .site-branding -->

        <nav id="site-navigation" class="main-navigation container" role="navigation">
            <button class="menu-toggle" aria-controls="primary-menu"
                    aria-expanded="false"><?php esc_html_e( 'Menu', 'blaskan' ); ?></button>
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
        </nav><!-- #site-navigation -->

        <!-- Custom Header -->
		<?php get_template_part( 'template-parts/custom', 'header' ); ?>

    </header><!-- #masthead -->

    <div id="content" class="site-content container">
