<?php
/**
 * Theme options
 * Credits: http://themeshaper.com/sample-theme-options/
 */
require_once ( get_template_directory() . '/theme-options.php' );

/**
 * Load theme options
 */

$blaskan_options = get_option('blaskan_options');
define( 'BLASKAN_SIDEBARS', $blaskan_options['sidebars'] );
if ( $blaskan_options['custom_sidebars_in_pages'] == 1 ) {
	define( 'BLASKAN_CUSTOM_SIDEBARS_IN_PAGES', TRUE );
} else {
	define( 'BLASKAN_CUSTOM_SIDEBARS_IN_PAGES', FALSE );
}
define( 'BLASKAN_SHOW_CONTENT_IN_LISTINGS', $blaskan_options['show_content_in_listings'] );
define( 'BLASKAN_HEADER_MESSAGE', $blaskan_options['header_message'] );
define( 'BLASKAN_FOOTER_MESSAGE', $blaskan_options['footer_message'] );
define( 'BLASKAN_SHOW_CREDITS', $blaskan_options['show_credits'] );

/**
 * Theme setup
 */
if ( ! function_exists( 'blaskan_setup' ) ):
function blaskan_setup() {
	add_theme_support( 'automatic-feed-links' );
	
	add_theme_support( 'post-thumbnails' );
	
	if ( BLASKAN_SIDEBARS == 'one_sidebar') {
		set_post_thumbnail_size( 830, 9999, true );
		if ( ! isset( $content_width ) )
			$content_width = 830;
	} else {
		set_post_thumbnail_size( 540, 9999, true );
		if ( ! isset( $content_width ) )
			$content_width = 540;
	}
	
	load_theme_textdomain( 'blaskan', TEMPLATEPATH . '/languages' );
	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

  add_editor_style( 'editor-style.css' );
  
  add_custom_background();
  
	define( 'HEADER_TEXTCOLOR', '' );
	define( 'HEADER_IMAGE', '' );

	if (
		( is_active_sidebar( 'primary-sidebar' ) && is_active_sidebar( 'secondary-sidebar' ) ) ||
		( is_active_sidebar( 'primary-page-sidebar' ) && is_active_sidebar( 'secondary-page-sidebar' ) )
	) {
		define( 'HEADER_IMAGE_WIDTH', 1120 );
	} elseif (
		( is_active_sidebar( 'primary-sidebar' ) || is_active_sidebar( 'secondary-sidebar' ) ) ||
		( is_active_sidebar( 'primary-page-sidebar' ) || is_active_sidebar( 'secondary-page-sidebar' ) )
	) {
		define( 'HEADER_IMAGE_WIDTH', 830 );
	} else {
		define( 'HEADER_IMAGE_WIDTH', 540 );
	}
	
	define( 'HEADER_IMAGE_HEIGHT', 160 );
	define( 'NO_HEADER_TEXT', true );
	
	add_custom_image_header( '', 'blaskan_custom_image_header_admin' );

	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'blaskan' ),
		'footer' => __( 'Footer Navigation', 'blaskan' ),
	) );	
	
}
endif;
add_action( 'after_setup_theme', 'blaskan_setup' );

/**
 * Theme init
 */
if ( ! function_exists( 'blaskan_init' ) ):
function blaskan_init() {
	if ( !is_admin() ) {
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/libs/modernizr-1.7.min.js' );
	}
}
endif;
add_action( 'init', 'blaskan_init' );

/**
 * Register widget areas. All are empty by default.
 */
if ( ! function_exists( 'blaskan_widgets_init' ) ):
function blaskan_widgets_init() {
	// Primary sidebar
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'blaskan' ),
		'id' => 'primary-sidebar',
		'description' => __( 'The primary sidebar', 'blaskan' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="title">',
		'after_title' => '</h3>',
	) );
	
	if ( BLASKAN_SIDEBARS !== 'one_sidebar' ) {
		// Secondary sidebar
		register_sidebar( array(
			'name' => __( 'Secondary Widget Area', 'blaskan' ),
			'id' => 'secondary-sidebar',
			'description' => __( 'The secondary sidebar', 'blaskan' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );
	}
	if ( BLASKAN_CUSTOM_SIDEBARS_IN_PAGES === TRUE ) {
		// Primary page sidebar
		register_sidebar( array(
			'name' => __( 'Primary Page Widget Area', 'blaskan' ),
			'id' => 'primary-page-sidebar',
			'description' => __( 'The primary page sidebar', 'blaskan' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );
	}
	if ( BLASKAN_CUSTOM_SIDEBARS_IN_PAGES === TRUE && BLASKAN_SIDEBARS !== 'one_sidebar' ) {
		// Secondary page sidebar
		register_sidebar( array(
			'name' => __( 'Secondary Page Widget Area', 'blaskan' ),
			'id' => 'secondary-page-sidebar',
			'description' => __( 'The secondary page sidebar', 'blaskan' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>',
		) );
	}
	
	// Footer widgets
	register_sidebar( array(
		'name' => __( 'Footer Widget Area', 'blaskan' ),
		'id' => 'footer-widget-area',
		'description' => __( 'The footer widget area', 'blaskan' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3 class="title">',
		'after_title' => '</h3>',
	) );
}
endif;
add_action( 'widgets_init', 'blaskan_widgets_init' );

/**
 * Head clean up
 */
function blaskan_head_cleanup() {
  remove_action( 'wp_head', 'rsd_link' );
  remove_action( 'wp_head', 'wlwmanifest_link' );
}
add_action( 'init' , 'blaskan_head_cleanup' );
remove_action( 'wp_head', 'wp_generator' );

/**
 * Format the title
 */
if ( ! function_exists( 'blaskan_head_title' ) ):
function blaskan_head_title() {
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'blaskan' ), max( $paged, $page ) );
}
endif;

/**
 * Add body classes
 */
if ( ! function_exists( 'blaskan_body_class' ) ):
function blaskan_body_class($classes) {
	if ( get_theme_mod( 'background_image' ) || get_theme_mod( 'background_color' ) ) {
    $classes[] = 'background-image';
		if ( get_theme_mod( 'background_color' ) == 'FFFFFF' || get_theme_mod( 'background_color' ) == 'FFF' ) {
			$classes[] = 'background-white';
		}
  }
  
  if ( get_theme_mod( 'header_image' ) ) {
    $classes[] = 'header-image';
  }

	if ( BLASKAN_SHOW_CONTENT_IN_LISTINGS ) {
		$classes[] = 'show-content';
	} else {
		$classes[] = 'hide-content';
	}
	
	if ( BLASKAN_SIDEBARS == 'one_sidebar' ) {
		$classes[] = 'content-wide';
		
		if ( is_page() && BLASKAN_CUSTOM_SIDEBARS_IN_PAGES === TRUE && is_active_sidebar( 'primary-page-sidebar' ) ) {
			$classes[] = 'sidebar';
			$classes[] = 'content-wide-sidebar';
		} elseif ( ( BLASKAN_CUSTOM_SIDEBARS_IN_PAGES === FALSE || !is_page() ) && is_active_sidebar( 'primary-sidebar' ) ) {
			$classes[] = 'sidebar';
			$classes[] = 'content-wide-sidebar';
		} else {
			$classes[] = 'no-sidebars';
			$classes[] = 'content-wide-no-sidebars';
		}
	} else {
		if ( is_page() && BLASKAN_CUSTOM_SIDEBARS_IN_PAGES === TRUE && ( is_active_sidebar( 'primary-page-sidebar' ) && is_active_sidebar( 'secondary-page-sidebar' ) ) ) {
			$classes[] = 'sidebars';
		} elseif ( is_page() && BLASKAN_CUSTOM_SIDEBARS_IN_PAGES === TRUE && ( is_active_sidebar( 'primary-page-sidebar' ) || is_active_sidebar( 'secondary-page-sidebar' ) ) ) {
			$classes[] = 'sidebar';
		} elseif ( !is_page() && ( is_active_sidebar( 'primary-sidebar' ) && is_active_sidebar( 'secondary-sidebar' ) ) ) {
			$classes[] = 'sidebars';
		} elseif ( !is_page() && ( is_active_sidebar( 'primary-sidebar' ) || is_active_sidebar( 'secondary-sidebar' ) ) ) {
			$classes[] = 'sidebar';
		} elseif ( is_page() && BLASKAN_CUSTOM_SIDEBARS_IN_PAGES === FALSE && ( is_active_sidebar( 'primary-sidebar' ) && is_active_sidebar( 'secondary-sidebar' ) ) ) {
			$classes[] = 'sidebars';
		} elseif ( is_page() && BLASKAN_CUSTOM_SIDEBARS_IN_PAGES === FALSE && ( is_active_sidebar( 'primary-sidebar' ) || is_active_sidebar( 'secondary-sidebar' ) ) ) {
			$classes[] = 'sidebar';
		} else {
			$classes[] = 'no-sidebars11';
		}
	}
	
	if ( is_active_sidebar( 'footer-widget-area' ) ) {
		$classes[] = 'footer-widgets';
	}
	
	return $classes;
}
endif;
add_filter( 'body_class', 'blaskan_body_class' );

/**
 * Sets custom image header in admin
 */
function blaskan_custom_image_header_admin() {
    ?><style type="text/css">
            #headimg {
                background-repeat: no-repeat;
                width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
                height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
            }
      </style><?php
}

/**
 * Checks if to display a header message
 */
if ( ! function_exists( 'blaskan_header_message' ) ):
function blaskan_header_message( $description = '' ) {
	if ( strlen( BLASKAN_HEADER_MESSAGE ) > 1 ) {
		echo '<div id="header-message">' . nl2br( stripslashes( wp_filter_post_kses( BLASKAN_HEADER_MESSAGE ) ) ) . '</div>';
	} elseif ( !empty( $description ) ) {
		echo '<div id="header-message">' . $description . '</div>';
	} else {
		return false;
	}
}
endif;

/**
 * Returns primary nav
 */
function blaskan_primary_nav() {
  $nav = wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => 1, 'echo' => false, 'container' => false ) );
  
  // Check nav for links
  if ( strpos( $nav, '<a' ) ) {
    return '<nav id="nav" role="navigation">' . $nav . '</nav>';
  } else {
    return; 
  }
}

/**
 * Date and author archives only show the title so lets display more posts
 */
function blaskan_date_archive_posts_per_page( $query ){
  if ( $query->is_year || $query->is_month || $query->is_day || $query->is_author ) {
    $query->set( 'posts_per_page', 60 );
  }
  return $query;
}
add_filter( 'pre_get_posts', 'blaskan_date_archive_posts_per_page' );


/**
 * Returns footer nav
 */
function blaskan_footer_nav() {
  $nav = wp_nav_menu( array( 'theme_location' => 'footer', 'depth' => 1, 'fallback_cb' => false, 'echo' => false, 'container' => false ) );

  // Check nav for links
  if ( strpos( $nav, '<a' ) ) {
    return '<nav id="footer-nav" role="navigation">' . $nav . '</nav>';
  } else {
    return; 
  }
}

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 * Credits: http://wordpress.org/extend/themes/coraline
 */
function blaskan_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'blaskan_remove_recent_comments_style' );

/**
 * Root relative permalinks
 * Credits: http://www.456bereastreet.com/archive/201010/how_to_make_wordpress_urls_root_relative/
 */
function blaskan_root_relative_permalinks($input) {
    return preg_replace('!http(s)?://' . $_SERVER['SERVER_NAME'] . '/!', '/', $input);
}
add_filter( 'the_permalink', 'blaskan_root_relative_permalinks' );

/**
 * Remove empty span
 * Credits: http://nicolasgallagher.com/anatomy-of-an-html5-wordpress-theme/
 */
function blaskan_remove_empty_read_more_span($content) {
	return eregi_replace( "(<p><span id=\"more-[0-9]{1,}\"></span></p>)", "", $content );
}
add_filter( 'the_content', 'blaskan_remove_empty_read_more_span' );

/**
 * Remove more jump link
 * Credits: http://codex.wordpress.org/Customizing_the_Read_More#Link_Jumps_to_More_or_Top_of_Page
 */
function blaskan_remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'blaskan_remove_more_jump_link');

/**
 * Use <figure> and <figcaption> in captions
 * Credits: http://wpengineer.com/917/filter-caption-shortcode-in-wordpress/
 */
if ( ! function_exists( 'blaskan_caption' ) ):
function blaskan_caption($attr, $content = null) {
	// Allow plugins/themes to override the default caption template.
	$output = apply_filters( 'img_caption_shortcode', '', $attr, $content );
	if ( $output != '' )
		return $output;

	extract( shortcode_atts ( array(
		'id'	=> '',
		'align'	=> 'alignnone',
		'width'	=> '',
		'caption' => ''
	), $attr ) );

	if ( 1 > (int) $width || empty( $caption ) )
		return $content;

	if ( $id ) $id = 'id="' . $id . '" ';

	return '<figure ' . $id . 'class="wp-caption ' . $align . '" style="width: ' . $width . 'px">'
	. do_shortcode( $content ) . '<figcaption class="wp-caption-text">' . $caption . '</figcaption></figure>';
}
endif;
add_shortcode( 'wp_caption', 'blaskan_caption' );
add_shortcode( 'caption', 'blaskan_caption' );

if ( ! function_exists( 'blaskan_comment' ) ) :
function blaskan_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<header class="comment-header">
		  <article>
			  <?php echo blaskan_avatar( $comment ); ?>
  			<time><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf( __( '%1$s - %2$s', 'blaskan' ), get_comment_date(),  get_comment_time() ); ?></a></time>

  			<?php if ( $comment->user_id && !$comment->comment_author_url ): ?>
  			  <cite><a href="<?php echo get_author_posts_url( $comment->user_id ); ?>"><?php echo $comment->comment_author; ?></a></cite>
  			<?php else: ?>
  			  <?php printf( '<cite>%s</cite>', get_comment_author_link() ); ?>
  			<?php endif; ?>
  		</header>

  		<?php if ( $comment->comment_approved == '0' ) : ?>
  			<p class="moderation"><em><?php _e( 'Your comment is awaiting moderation.', 'blaskan' ); ?></em></p>
  		<?php endif; ?>

  		<?php comment_text(); ?>

  		<div class="reply">
  			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

  			<?php edit_comment_link( __( 'Edit', 'blaskan' ), ' ' ); ?>
  		</div><!-- .reply -->
		  </article>
	<?php
			break;
		case 'pingback'  :
	?>
	<li class="pingback">
		<time><?php printf( __( '%1$s - %2$s', 'blaskan' ), get_comment_date(),  get_comment_time() ); ?></time>
		<?php _e( 'Pingback:', 'blaskan' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('Edit', 'blaskan'), ' ' ); ?>
	<?php
			break;
		case 'trackback' :
	?>
	<li class="trackback">
		<time><?php printf( __( '%1$s - %2$s', 'blaskan' ), get_comment_date(),  get_comment_time() ); ?></time>
		<?php _e( 'Trackback:', 'blaskan' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('Edit', 'blaskan'), ' ' ); ?>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Display avatar
 */
if ( ! function_exists( 'blaskan_avatar' ) ):
function blaskan_avatar( $user ) {
	$avatar = get_avatar( $user, 40 );
	
	if ( !empty( $avatar ) ) {
		return '<figure>' . $avatar . '</figure>';
	} else {
		return;
	}
}
endif;

/**
 * Checks if to display a footer message
 */
if ( ! function_exists( 'blaskan_footer_message' ) ):
function blaskan_footer_message() {
	if ( strlen( BLASKAN_FOOTER_MESSAGE ) > 1 ) {
		return '<div id="footer-message">' . nl2br( stripslashes( wp_filter_post_kses( BLASKAN_FOOTER_MESSAGE ) ) ) . '</div>';
	} else {
		return false;
	}
}
endif;

/**
 * Checks if to display footer credits
 */
if ( ! function_exists( 'blaskan_footer_credits' ) ):
function blaskan_footer_credits() {
	if ( BLASKAN_SHOW_CREDITS ) {
		return '<div id="footer-credits">' . sprintf( __( 'Powered by <a href="%s">Blaskan</a> and <a href="%s">WordPress</a>.', 'blaskan' ), 'http://www.blaskan.net', 'http://www.wordpress.org' ) . '</div>';
	} else {
		return false;
	}
}
endif;