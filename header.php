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
				<?php }

                $disable_search = get_theme_mod( 'blaskan_disable_header_search', 0 );

                ?>
                <div class="search-header-form-container pull-right">
                    <?php if ( !$disable_search || is_customize_preview() ) { ?>
                    <div id="search-header-form" class="search <?php echo ( is_customize_preview() && $disable_search ) ? 'hide' : '' ?>">
                        <form role="search" method="get" class="search-form"
                              action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <input id="search" type="search" name="s"
                                   placeholder="<?php esc_html__( 'Search ...', 'blaskan' ) ?>">
                            <label for="search"><i class="fa fa-search" aria-hidden="true"></i></label>
                        </form>
                    </div>
                    <?php } ?>
                </div>

                

                <div class="clearfix"></div>
            </div>

            <div class="container">
				<?php

                $display_text = get_theme_mod( 'header_text', 1 );

				if ( function_exists( 'the_custom_logo' ) ) {
                    the_custom_logo();
				}
				if ( $display_text || is_customize_preview() ) {

					$extra_class = ! $display_text ? 'hide' : '';

					if ( is_front_page() && is_home() ) : ?>
                        <h1 class="site-title<?php echo esc_attr($extra_class) ?>"><a
                                    href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                    rel="home"><?php esc_html(bloginfo( 'name' )); ?></a></h1>
					<?php else : ?>
                        <p class="site-title<?php echo esc_attr($extra_class) ?>"><a
                                    href="<?php echo esc_url( home_url( '/' ) ); ?>"
                                    rel="home"><?php esc_html(bloginfo( 'name' )); ?></a></p>
						<?php
					endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
                        <p class="site-description <?php echo esc_attr($extra_class) ?>"><?php echo wp_kses_post( $description ); /* WPCS: xss ok. */ ?></p>
						<?php
					endif;

				}

				?>

            </div><!-- .container -->
        </div><!-- .site-branding -->

        <nav id="site-navigation" class="main-navigation container" role="navigation">
            <button class="menu-toggle" aria-controls="primary-menu"
                    aria-expanded="false"><?php esc_html_e( 'Menu', 'blaskan' ); ?></button>
            <div class="blaskan-main-menu">
			 <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu', 'container' => false ) ); ?>
            </div>
        </nav><!-- #site-navigation -->

        <!-- Custom Header -->
		<?php get_template_part( 'template-parts/custom', 'header' ); ?>

    </header><!-- #masthead -->

    <div id="content" class="site-content container">
