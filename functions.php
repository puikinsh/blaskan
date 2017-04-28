<?php
/**
 * blaskan functions and definitions
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package blaskan
 */

if ( ! function_exists( 'blaskan_setup' ) ) :

	function blaskan_setup() {
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain( 'blaskan', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
            'menu-1'      => esc_html__( 'Primary', 'blaskan' ),
            'menu-2'      => esc_html__( 'Footer', 'blaskan' ),
            'social-menu' => esc_html__( 'Social Menu', 'blaskan' ),
        ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'blaskan_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
			'height'        => 460,
			'width'         => 1600,
			'flex-width'    => true,
		) ) );

		add_theme_support( 'custom-logo', array(
			'height'      => 200,
			'width'       => 400,
			'flex-width'  => true,
			'flex-height'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		//Set up the WordPress core custom header feature.
		add_theme_support( 'custom-header', apply_filters( 'blaskan_custom_header_args', array(
			'height'        => 460,
			'width'         => 1600,
			'flex-width'    => true,
			'header-text'   => false,
			'default-image' => get_template_directory_uri() . '/assets/images/custom-header.jpg',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add image sizes
		add_image_size( 'related-blog-post', 360, 270, true );
		add_image_size( 'big-blog-post', 1140, 570, true );
		add_image_size( 'small-blog-post-portrait', 350, 390, true );
		add_image_size( 'small-blog-post-landscape', 350, 250, true );
	}
endif;
add_action( 'after_setup_theme', 'blaskan_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blaskan_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blaskan_content_width', 780 );
}

add_action( 'after_setup_theme', 'blaskan_content_width', 0 );

/**
 * Register widget area.
 */
function blaskan_widgets_init() {
	register_sidebar( array(
          'name'          => esc_html__( 'Sidebar', 'blaskan' ),
          'id'            => 'sidebar-1',
          'description'   => esc_html__( 'Add widgets here.', 'blaskan' ),
          'before_widget' => '<section id="%1$s" class="widget %2$s">',
          'after_widget'  => '</section>',
          'before_title'  => '<h5 class="widget-title">',
          'after_title'   => '</h5>',
      ) );

	$footer_layout = get_theme_mod( 'blaskan_footer_column', 'column-4' );
	$number        = str_replace( 'column-', '', $footer_layout );

	if ( $number == 1 ) {
		
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar', 'blaskan' ),
			'id'            => 'footer-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'blaskan' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		) );

	}else{

		register_sidebars( $number, array(
			'name'          => esc_html__( 'Footer Sidebar %d', 'blaskan' ),
			'id'            => 'footer-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'blaskan' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h5 class="widget-title">',
			'after_title'   => '</h5>',
		) );

	}

	

}

add_action( 'widgets_init', 'blaskan_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function blaskan_scripts() {

	wp_enqueue_style( 'blaskan-fonts', blaskan_fonts_url() );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );
	wp_enqueue_style( 'blaskan-style', get_stylesheet_uri() );

	wp_enqueue_script( 'imagesloaded' );
	wp_enqueue_script( 'masonry' );
	wp_enqueue_script( 'blaskan-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'blaskan-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'blaskan-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'blaskan_scripts' );

function blaskan_add_editor_styles() {
	add_editor_style( 'assets/css/editor-style.css' );
}

add_action( 'admin_init', 'blaskan_add_editor_styles' );

function blaskan_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	/* translators: %s: Name of current post */
	$link = blaskan_create_read_more_link( sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s <span class="meta-nav">→</span></a></p>',
	                 esc_url( get_permalink( get_the_ID() ) ),
	                 esc_html__( 'Continue reading', 'blaskan' )
	));

	return $link;
}

add_filter( 'excerpt_more', 'blaskan_excerpt_more' );

function blaskan_search_filter( $query ) {
	if ( $query->is_search && ! is_admin() ) {
		$query->set( 'post_type', array( 'post' ) );
	}

	return $query;
}

add_filter( 'pre_get_posts', 'blaskan_search_filter' );

function blaskan_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	* supported by Droid Serif, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$droid = _x( 'on', 'Droid Serif font: on or off', 'blaskan' );

	/* Translators: If there are characters in your language that are not
	* supported by Source Sans Pro, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$source_sans = _x( 'on', 'Source Sans Pro font: on or off', 'blaskan' );

	/* Translators: If there are characters in your language that are not
	* supported by Work Sans, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$work_sans = _x( 'on', 'Work Sans font: on or off', 'blaskan' );

	/* Translators: If there are characters in your language that are not
	* supported by Pacifico, translate this to 'off'. Do not translate
	* into your own language.
	*/
	$pacifico = _x( 'on', 'Pacifico font: on or off', 'blaskan' );

	if ( 'off' !== $droid || 'off' !== $source_sans || 'off' !== $work_sans ) {
		$font_families = array();

		if ( 'off' !== $droid ) {
			$font_families[] = 'Droid Serif:400,700';
		}

		if ( 'off' !== $source_sans ) {
			$font_families[] = 'Source Sans Pro:300,400,600,700,900';
		}

		if ( 'off' !== $work_sans ) {
			$font_families[] = 'Work Sans';
		}

		if ( 'off' !== $pacifico ) {
			$font_families[] = 'Pacifico';
		}

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load plugin enhancement file to display admin notices.
 */
require get_template_directory() . '/inc/class-blaskan-theme-plugin-enhancements.php';

/**
 * Load theme widgets.
 */
require get_template_directory() . '/inc/class-blaskan-author-widget.php';
