<?php
/**
 * blaskan Theme Customizer
 *
 * @package blaskan
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function blaskan_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_text' )->transport = 'postMessage';

	// Theme Options
	$wp_customize->add_section( 'blaskan_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'blaskan' ),
		'priority' => 33,
	) );

	$wp_customize->add_setting( 'blaskan_disable_header_search', array(
		'default'           => 0,
		'transport'			=> 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'blaskan_disable_header_search', array(
		'label'   => esc_html__( 'Hide Header Search', 'blaskan' ),
		'section' => 'blaskan_theme_options',
		'type'    => 'checkbox',
	) );

	$wp_customize->add_setting( 'blaskan_site_layout', array(
		'default'           => 'right-sidebar',
		'sanitize_callback' => 'blaskan_sanitize_layout',
	) );

	$wp_customize->add_control( 'blaskan_site_layout', array(
		'label'   => esc_html__( 'Site layout', 'blaskan' ),
		'section' => 'blaskan_theme_options',
		'type'    => 'radio',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'blaskan' ),
			'left-sidebar'  => esc_html__( 'Left Sidebar', 'blaskan' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'blaskan' ),
		),
	) );

	$wp_customize->add_setting( 'blaskan_footer_column', array(
		'default'           => 'column-4',
		'sanitize_callback' => 'blaskan_sanitize_column',
	) );

	$wp_customize->add_control( 'blaskan_footer_column', array(
		'label'   => esc_html__( 'Footer Area Layout', 'blaskan' ),
		'section' => 'blaskan_theme_options',
		'type'    => 'radio',
		'choices' => array(
			'column-1' => esc_html__( '1 Column', 'blaskan' ),
			'column-2' => esc_html__( '2 Columns', 'blaskan' ),
			'column-3' => esc_html__( '3 Columns', 'blaskan' ),
			'column-4' => esc_html__( '4 Columns', 'blaskan' ),
		),
	) );

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'        => '.site-title',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'        => '.site-description',
	) );
	$wp_customize->selective_refresh->add_partial( 'blaskan_disable_header_search', array(
		'selector'        => '#search-header-form',
		'container_inclusive' => true,
		'render_callback' => function() {
            $disable_search = get_theme_mod( 'blaskan_disable_header_search', 0 );
            if ( $disable_search ) {
            	return "";
            }else{
            	$output = "";
            	$output .= '<div id="search-header-form" class="search"><form role="search" method="get" class="search-form" action="'.esc_url( home_url( '/' ) ).'">';
                    $output .= '<input id="search" type="search" name="s" placeholder="'.esc_html__( 'Search ...', 'blaskan' ).'">';
                    $output .= '<label for="search"><i class="fa fa-search" aria-hidden="true"></i></label>';
                $output .= '</form></div>';

                return $output;
            }
        },
	) );

}

add_action( 'customize_register', 'blaskan_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blaskan_customize_preview_js() {

	wp_enqueue_style( 'blaskan_previewer', get_template_directory_uri() . '/assets/css/customizer_preview.css' );

	wp_enqueue_script( 'blaskan_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}

add_action( 'customize_preview_init', 'blaskan_customize_preview_js' );


/**
 * Sanitize the Column value.
 *
 * @param string $column .
 *
 * @return string (column-1|column-2|column-3|column-4).
 */
function blaskan_sanitize_column( $column ) {
	if ( ! in_array( $column, array( 'column-1', 'column-2', 'column-3',  'column-4' ) ) ) {
		$column = 'column-1';
	}

	return $column;
}

/**
 * Sanitize the Layout value.
 *
 * @param string $layout .
 *
 * @return string (right-sidebar|left-sidebar|no-sidebar).
 */
function blaskan_sanitize_layout( $layout ) {
	if ( ! in_array( $layout, array( 'right-sidebar', 'left-sidebar', 'no-sidebar' ) ) ) {
		$layout = 'right-sidebar';
	}

	return $layout;
}

/**
 * Sanitize the Content value.
 *
 * @param string $content .
 *
 * @return string (excerpt|full-text).
 */
function blaskan_sanitize_content( $content ) {
	if ( ! in_array( $content, array( 'excerpt', 'full-text' ) ) ) {
		$content = 'excerpt';
	}

	return $content;
}