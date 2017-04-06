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
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Theme Options
	$wp_customize->add_section( 'blaskan_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'blaskan' ),
		'priority' => 33,
	) );

	$wp_customize->add_setting( 'blaskan_site_layout', array(
		'default'           => 'right-sidebar',
		'sanitize_callback' => 'blaskan_sanitize_layout',
	) );

	$wp_customize->add_control( 'blaskan_site_layout', array(
		'label'             => esc_html__( 'Site layout', 'blaskan' ),
		'section'           => 'blaskan_theme_options',
		'type'              => 'radio',
		'choices'           => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'blaskan' ),
			'left-sidebar' => esc_html__( 'Left Sidebar', 'blaskan' ),
			'no-sidebar' => esc_html__( 'No Sidebar', 'blaskan' ),
		),
	) );

	// $wp_customize->add_setting( 'blaskan_article_content', array(
	// 	'default'           => 'excerpt',
	// 	'sanitize_callback' => 'blaskan_sanitize_content',
	// ) );

	// $wp_customize->add_control( 'blaskan_article_content', array(
	// 	'label'             => esc_html__( 'For each article in blog page, show', 'blaskan' ),
	// 	'section'           => 'blaskan_theme_options',
	// 	'type'              => 'radio',
	// 	'choices'           => array(
	// 		'excerpt' => esc_html__( 'Summary', 'blaskan' ),
	// 		'full-text' => esc_html__( 'Full text', 'blaskan' ),
	// 	),
	// ) );

	$wp_customize->add_setting( 'blaskan_footer_column', array(
		'default'           => 'column-3',
		'sanitize_callback' => 'blaskan_sanitize_column',
	) );

	$wp_customize->add_control( 'blaskan_footer_column', array(
		'label'             => esc_html__( 'Footer Area Layout', 'blaskan' ),
		'section'           => 'blaskan_theme_options',
		'type'              => 'radio',
		'choices'           => array(
			'column-1' => esc_html__( '1 Column', 'blaskan' ),
			'column-2' => esc_html__( '2 Columns', 'blaskan' ),
			'column-3' => esc_html__( '3 Columns', 'blaskan' ),
		),
	) );

}
add_action( 'customize_register', 'blaskan_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function blaskan_customize_preview_js() {
	wp_enqueue_script( 'blaskan_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'blaskan_customize_preview_js' );


/**
 * Sanitize the Column value.
 *
 * @param string $column.
 * @return string (column-1|column-2|column-3).
 */
function blaskan_sanitize_column( $column ) {
	if ( ! in_array( $column, array( 'column-1', 'column-2', 'column-3' ) ) ) {
		$column = 'column-1';
	}
	return $column;
}

/**
 * Sanitize the Layout value.
 *
 * @param string $layout.
 * @return string (right-sidebar|left-sidebar|no-sidebar).
 */
function blaskan_sanitize_layout( $column ) {
	if ( ! in_array( $column, array( 'right-sidebar', 'left-sidebar', 'no-sidebar' ) ) ) {
		$column = 'right-sidebar';
	}
	return $column;
}

/**
 * Sanitize the Layout value.
 *
 * @param string $layout.
 * @return string (right-sidebar|left-sidebar|no-sidebar).
 */
function blaskan_sanitize_content( $content ) {
	if ( ! in_array( $content, array( 'excerpt', 'full-text' ) ) ) {
		$content = 'excerpt';
	}
	return $content;
}