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
function blaskan_options_init(){
	register_setting( 'theme_options', 'blaskan_options', 'blaskan_options_validate' );
}

/**
 * Load up the menu page
 */
function blaskan_options_add_page() {
	add_theme_page( __( 'Theme Options', 'blaskan' ), __( 'Theme Options', 'blaskan' ), 'edit_theme_options', 'theme_options', 'blaskan_options_do_page' );
}

/**
 * Create the options page
 */
function blaskan_options_do_page() {
	global $footer_widget_width_options;

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

				<?php
				/**
				 * Header message
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Header message', 'blaskan' ); ?></th>
					<td>
						<textarea id="blaskan_options[header_message]" class="large-text" cols="50" rows="10" name="blaskan_options[header_message]"><?php echo stripslashes( $options['header_message'] ); ?></textarea>
						<label class="description" for="blaskan_options[header_message]"><?php _e( 'A message that is displayed in the header. Falls back to the blog description if empty.', 'blaskan' ); ?></label>
					</td>
				</tr>

				<?php
				/**
				 * Footer message
				 */
				?>
				<tr valign="top"><th scope="row"><?php _e( 'Footer message', 'blaskan' ); ?></th>
					<td>
						<textarea id="blaskan_options[footer_message]" class="large-text" cols="50" rows="10" name="blaskan_options[footer_message]"><?php echo stripslashes( $options['footer_message'] ); ?></textarea>
						<label class="description" for="blaskan_options[footer_message]"><?php _e( 'A message that is displayed in the footer.', 'blaskan' ); ?></label>
					</td>
				</tr>
				
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
	</div>
	<?php
}

/**
 * Sanitize and validate input. Accepts an array, return a sanitized array.
 */
function blaskan_options_validate( $input ) {
	// Header message may contain allowed HTML tags
	$input['header_message'] = wp_filter_post_kses( $input['header_message'] );
	
	// Footer message may contain allowed HTML tags
	$input['footer_message'] = wp_filter_post_kses( $input['footer_message'] );
	
	// Our show_credits value is either 0 or 1
	if ( ! isset( $input['show_credits'] ) )
		$input['show_credits'] = null;
	$input['show_credits'] = ( $input['show_credits'] == 1 ? 1 : 0 );

	return $input;
}
