<?php

/**
 * Credits:
 * http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/
 */

add_action( 'admin_init', 'blaskan_options_init' );
add_action( 'admin_menu', 'blaskan_options_add_page' );

/**
 * Init plugin options to white list our options
 */
function blaskan_options_init() {
	register_setting( 'theme_options', 'blaskan_options', 'blaskan_options_validate' );
	register_taxonomy_for_object_type( 'post_tag', 'page' );
  register_taxonomy_for_object_type( 'category', 'page' );
}

/**
 * Properly enqueue styles and scripts for our theme options page
 */
function blaskan_admin_enqueue_scripts( $hook_suffix ) {
	wp_enqueue_style( 'blaskan-theme-options', get_template_directory_uri() . '/theme-options.css' );
	wp_enqueue_script( 'blaskan-theme-options', get_template_directory_uri() . '/theme-options.js', array( 'farbtastic' ) );
	wp_enqueue_style( 'farbtastic' );
}
add_action( 'admin_print_styles-appearance_page_theme_options', 'blaskan_admin_enqueue_scripts' );

/**
 * Load up the menu page
 */
function blaskan_options_add_page() {
	add_theme_page( __( 'Theme Options', 'blaskan' ), __( 'Theme Options', 'blaskan' ), 'edit_theme_options', 'theme_options', 'blaskan_options_do_page' );
}

/**
 * Create arrays for the sidebars on pages options
 */
$sidebars_options = array(
	'2' => array(
		'value' =>	'two_sidebars'
	),
	'1' => array(
		'value' =>	'one_sidebar'
	)
);

/**
 * Create arrays for typeface in titles options
 */
$typeface_title_options = array(
	'1' => array(
		'value' =>	'default',
		'label' => __( 'League Gothic (default)', 'blaskan' )
	),
	'2' => array(
		'value' =>	'sans_serif',
		'label' => __( 'Helvetica Neue, sans-serif', 'blaskan' )
	)
);

/**
 * Create the options page
 */
function blaskan_options_do_page() {
	global $sidebars_options;
	global $typeface_title_options;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false;
	?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options', 'blaskan' ) . "</h2>"; ?>

		<?php if ( false !== $_REQUEST['updated'] ) : ?>
		<div class="updated fade"><p><strong><?php _e( 'Options saved', 'blaskan' ); ?></strong></p></div>
		<?php endif; ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'theme_options' ); ?>
			<?php $options = get_option( 'blaskan_options' ); ?>

			<table class="form-table">
			  
			  <tr><th colspan="2"><strong><?php _e( 'Design', 'blaskan' ); ?></strong></th></tr>
			  
			  <?php
				/**
				 * Typeface in titles
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Typeface in titles', 'blaskan' ); ?></th>
					<td>
						<p>
							<?php _e( "Choose which typeface to use in titles. The default typeface, League Gothic, doesn't play nicely in all languages and/or perhaps you'd prefer Helvetica instead.", 'blaskan' ); ?>
						</p>

						<?php
						if ( empty( $options['typeface_titles'] ) ) {
							$options['typeface_titles'] = '';
						}
						$selected = $options['typeface_titles'];
						$typeface_options = array();
						foreach ( $typeface_title_options as $option ) {
							if ( $selected == $option['value'] ) {
								$typeface_options[] = '<input checked="checked" type="radio" name="blaskan_options[typeface_titles]" value="' . esc_attr( $option['value'] ) . '">';
							} else {
								$typeface_options[] = '<input type="radio" name="blaskan_options[typeface_titles]" value="' . esc_attr( $option['value'] ) . '">';
							}
						}
						?>

						<div class="blaskan-option">
							<label class="description">
								<?php echo $typeface_options[0]; ?>
								<br>
								<span class="blaskan-typeface-option blaskan-typeface-option-league-gothic">
									League Gothic
								</span>
							</label>
						</div>

						<div class="blaskan-option">
							<label class="description">
								<?php echo $typeface_options[1]; ?>
								<br>
								<span class="blaskan-typeface-option blaskan-typeface-option-helvetica">
									Helvetica Neue / Sans Serif
								</span>
							</label>
						</div>

						<div style="clear: both;"></div>
					</td>
				</tr>

				<?php
				/**
				 * Link color
				 */
				if ( empty( $options['link_color'] ) ) {
					$link_color = '#2e6eb0';
				} else {
					$link_color = stripslashes( $options['link_color'] );
				}
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Link color', 'blaskan' ); ?></th>
					<td style="position:relative">
						<input type="text" name="blaskan_options[link_color]" id="link-color" value="<?php echo esc_attr( $link_color ); ?>" />
						<a href="#" class="pickcolor hide-if-no-js" id="link-color-example"></a>
						<input type="button" class="pickcolor button hide-if-no-js" value="<?php esc_attr_e( 'Select a color', 'blaskan' ); ?>" />
						<div id="colorPickerDiv" style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div>
						<br />
						<span><?php printf( __( 'Default color: %s', 'blaskan' ), '<span id="default-color">#2e6eb0</span>' ); ?></span>
					</td>
				</tr>

				<tr><th colspan="2"><strong><?php _e( 'Layout', 'blaskan' ); ?></strong></th></tr>

			  <?php
				/**
				 * Content layout
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Default layout', 'blaskan' ); ?></th>
					<td>
						<?php
						$selected = $options['sidebars'];
						$layout_options = array();
						foreach ( $sidebars_options as $option ) {
							$label = __($option['label'], 'blaskan');
							if ( $selected == $option['value'] ) {
								$layout_options[] = '<input checked="checked" type="radio" name="blaskan_options[sidebars]" value="' . esc_attr( $option['value'] ) . '">';
							} else {
								$layout_options[] = '<input type="radio" name="blaskan_options[sidebars]" value="' . esc_attr( $option['value'] ) . '">';
							}
						}
						?>

						<div class="blaskan-option">
							<label class="description">
								<?php echo $layout_options[0]; ?>
								<br>
								<img src="<?php echo get_template_directory_uri(); ?>/img/content-two-sidebars.png">
								<br>
								<?php _e( "Narrow content column", 'blaskan' ); ?><br>
								<?php _e( "Max two sidebars", 'blaskan' ); ?>
							</label>
						</div>

						<div class="blaskan-option">
							<label class="description">
								<?php echo $layout_options[1]; ?>
								<br>
								<img src="<?php echo get_template_directory_uri(); ?>/img/content-wide-one-sidebar.png">
								<br>
								<?php _e( "Wide content column", 'blaskan' ); ?><br>
								<?php _e( "Max one sidebar", 'blaskan' ); ?>
							</label>
						</div>

						<div style="clear: both;"></div>
					</td>
				</tr>
			  
			  <?php
				/**
				 * Custom sidebars in pages?
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Separate sidebar widget areas', 'blaskan' ); ?></th>
					<td>
						<input id="blaskan_options[custom_sidebars_in_pages]" name="blaskan_options[custom_sidebars_in_pages]" type="checkbox" value="1" <?php checked( '1', $options['custom_sidebars_in_pages'] ); ?> />
						<label class="description" for="blaskan_options[custom_sidebars_in_pages]"><?php _e( 'Use separate sidebar widget areas in pages and posts.', 'blaskan' ); ?></label>
					</td>
				</tr>

        <tr><th colspan="2"><strong><?php _e( 'Header', 'blaskan' ); ?></strong></th></tr>

				<?php
				/**
				 * Header message
				 */
				if ( empty( $options['header_message'] ) ) {
					$header_message = '';
				} else {
					$header_message = esc_textarea( stripslashes( $options['header_message'] ) );
				}
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Header message', 'blaskan' ); ?></th>
					<td>
						<textarea id="blaskan_options[header_message]" class="large-text" cols="50" rows="10" name="blaskan_options[header_message]"><?php echo $header_message; ?></textarea>
						<br>
						<label class="description" for="blaskan_options[header_message]"><?php _e( 'A message that is displayed in the header. Falls back to the blog description if empty.', 'blaskan' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * Header image height
				 */
				if ( empty ( $options['header_image_height'] ) || !is_numeric ( $options['header_image_height'] ) ) {
					$header_image_height = '160';
				} else {
					$header_image_height = $options['header_image_height'];
				}
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Header image height', 'blaskan' ); ?></th>
					<td>
						<input type="text" id="blaskan_options[header_image_height]" name="blaskan_options[header_image_height]" value="<?php echo $header_image_height; ?>" /> px<br/>
						<label class="description" for="blaskan_options[header_image_height]"><?php _e( 'The height of the image in the header', 'blaskan' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * Hide site title and header message?
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Hide site title and header message?', 'blaskan' ); ?></th>
					<td>
						<input id="blaskan_options[hide_site_title_header_message]" name="blaskan_options[hide_site_title_header_message]" type="checkbox" value="1" <?php checked( '1', $options['hide_site_title_header_message'] ); ?> />
						<label class="description" for="blaskan_options[hide_site_title_header_message]"><?php _e( "Hide", 'blaskan' ); ?></label><br/>
						<small style="color: #666"><?php _e( "Might be useful if you're using a custom header.", 'blaskan' ); ?></small>
					</td>
				</tr>

				<tr><th colspan="2"><strong><?php _e( 'Footer', 'blaskan' ); ?></strong></th></tr>

				<?php
				/**
				 * Footer message
				 */
				if ( empty( $options['footer_message'] ) ) {
					$footer_message = '';
				} else {
					$footer_message = esc_textarea( stripslashes( $options['footer_message'] ) );
				}
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Footer message', 'blaskan' ); ?></th>
					<td>
						<textarea id="blaskan_options[footer_message]" class="large-text" cols="50" rows="10" name="blaskan_options[footer_message]"><?php echo $footer_message; ?></textarea>
						<br>
						<label class="description" for="blaskan_options[footer_message]"><?php _e( 'A message that is displayed in the footer.', 'blaskan' ); ?></label>
					</td>
				</tr>
				
				<tr><th colspan="2"><strong><?php _e( 'Support Blaskan', 'blaskan' ); ?></strong></th></tr>
				
				<?php
				/**
				 * Show credits?
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Show credits', 'blaskan' ); ?></th>
					<td>
						<input id="blaskan_options[show_credits]" name="blaskan_options[show_credits]" type="checkbox" value="1" <?php checked( '1', $options['show_credits'] ); ?> />
						<label class="description" for="blaskan_options[show_credits]"><?php _e( 'Display links to the Blaskan theme and WordPress.org in the footer.', 'blaskan' ); ?></label>
					</td>
				</tr>
			</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'blaskan' ); ?>" />
			</p>
		</form>

		<p style="color: #777; margin-top: 30px;">
			<?php printf( __( '<a href="%s">%s</a> is designed and developed by <a href="%s">%s</a>. Please report bugs and provide feedback on <a href="%s">GitHub</a>.', 'blaskan' ), 'http://www.blaskan.net', 'Blaskan', 'http://www.helloper.com', 'Per Sandström', 'http://github.com/persand/blaskan' ); ?>
		</p>
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function blaskan_options_validate( $input ) {
	// Validate typeface in titles options
	if ( $input['typeface_titles'] !== 'default' ) {
		$input['typeface_titles'] = 'sans_serif';
	} else {
		$input['typeface_titles'] = 'default';
	}

	// Link color must be 3 or 6 hexadecimal characters
	if ( isset( $input['link_color'] ) && preg_match( '/^#?([a-f0-9]{3}){1,2}$/i', $input['link_color'] ) )
		$input['link_color'] = '#' . strtolower( ltrim( $input['link_color'], '#' ) );

	// Validate layout options
	if ( $input['sidebars'] !== 'one_sidebar' ) {
		$input['sidebars'] = 'two_sidebars';
	} else {
		$input['sidebars'] = 'one_sidebar';
	}
		
	// Our custom sidebars value is either 0 or 1
	if ( ! isset( $input['custom_sidebars_in_pages'] ) )
		$input['custom_sidebars_in_pages'] = null;
	$input['custom_sidebars_in_pages'] = ( $input['custom_sidebars_in_pages'] == 1 ? 1 : 0 );
	
	// Header message may contain allowed HTML tags
	$input['header_message'] = wp_filter_post_kses( $input['header_message'] );

	// Hide site title and header message?
	if ( ! isset( $input['hide_site_title_header_message'] ) )
		$input['hide_site_title_header_message'] = null;
	$input['hide_site_title_header_message'] = ( $input['hide_site_title_header_message'] == 1 ? 1 : 0 );

	// Header image height
	$input['header_image_height'] = esc_attr( $input['header_image_height'] );
	
	// Footer message may contain allowed HTML tags
	$input['footer_message'] = wp_filter_post_kses( $input['footer_message'] );
	
	// Our show_credits value is either 0 or 1
	if ( ! isset( $input['show_credits'] ) )
		$input['show_credits'] = null;
	$input['show_credits'] = ( $input['show_credits'] == 1 ? 1 : 0 );

	return $input;
}

/**
 * Add a style block to the theme for the current link color.
 *
 * This function is attached to the wp_head action hook.
 *
 * Lifted from Twenty Ten theme
 */
function blaskan_print_link_color_style() {
	$options = get_option( 'blaskan_options' );
	$default_link_color = '#2e6eb0';

	if ( ! empty( $options['link_color'] ) ) {
		$link_color = $options['link_color'];
	} else {
		$link_color = $default_link_color;
	}
	
	// Don't do anything if the current link color is the default.
	if ( $default_link_color == $link_color || empty( $link_color ) )
		return;
?>
	<style>
		/* Link color */
		a {
			color: <?php echo $link_color; ?>;
		}
	</style>
<?php
}
add_action( 'wp_head', 'blaskan_print_link_color_style', 100 );
