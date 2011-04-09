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
 * Create arrays for the sidebars on pages options
 */
$sidebars_options = array(
	'2' => array(
		'value' =>	'two_sidebars',
		'label' => __( 'Up to two sidebars - content max width 560 px', 'blaskan' )
	),
	'1' => array(
		'value' =>	'one_sidebar',
		'label' => __( 'Up to one sidebar - content max width 830 px', 'blaskan' )
	),
	'0' => array(
		'value' => 'no_sidebars',
		'label' => __( 'No sidebars - content max width 1120 px', 'blaskan' )
	)
);

/**
 * Create the options page
 */
function blaskan_options_do_page() {
	global $sidebars_options;

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
			  
			  <tr><th colspan="2"><strong><?php _e( 'Layout', 'blaskan' ); ?></strong></th></tr>
			  
			  <?php
				/**
				 * Content layout
				 */
				?>
				<tr valign="top" id="blaskan-options-sidebars"><th scope="row"><?php _e( 'Sidebars', 'blaskan' ); ?></th>
					<td><?php // print_r($options); ?>
						<select name="blaskan_options[sidebars]">
							<?php
								$selected = $options['sidebars'];
								$p = '';
								$r = '';
								foreach ( $sidebars_options as $option ) {
									$label = $option['label'];
									if ( $selected == $option['value'] ) // Make default first in list
										$p = "\n\t<option style=\"padding-right: 10px;\" selected='selected' value='" . esc_attr( $option['value'] ) . "'>$label</option>";
									else
										$r .= "\n\t<option style=\"padding-right: 10px;\" value='" . esc_attr( $option['value'] ) . "'>$label</option>";
								}
								echo $p . $r;
							?>
						</select>
						<label class="description" for="blaskan_options[sidebars]"><?php _e( 'The maximum amount of sidebars', 'blaskan' ); ?></label>
					</td>
				</tr>
			  
			  <?php
				/**
				 * Custom sidebars in pages?
				 */
				?>
				<tr valign="top" id="blaskan-option-custom-sidebars-in-pages"><th scope="row"><?php _e( 'Custom sidebars', 'blaskan' ); ?></th>
					<td>
						<input id="blaskan_options[custom_sidebars_in_pages]" name="blaskan_options[custom_sidebars_in_pages]" type="checkbox" value="1" <?php checked( '1', $options['custom_sidebars_in_pages'] ); ?> />
						<label class="description" for="blaskan_options[custom_sidebars_in_pages]"><?php _e( 'Use custom sidebars in pages.', 'blaskan' ); ?></label>
					</td>
				</tr>

        <tr><th colspan="2"><strong><?php _e( 'Header', 'blaskan' ); ?></strong></th></tr>

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

				<tr><th colspan="2"><strong><?php _e( 'Footer', 'blaskan' ); ?></strong></th></tr>

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
				
				<tr><th colspan="2"><strong><?php _e( 'Misc', 'blaskan' ); ?></strong></th></tr>
				
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
	global $sidebars_options;
	
	// Validate layout options
	/*if ( ! array_key_exists( $input['sidebars'], $sidebars_options ) )
		$input['sidebars'] = null;*/
		
	// Our custom sidebars value is either 0 or 1
	if ( ! isset( $input['custom_sidebars_in_pages'] ) )
		$input['custom_sidebars_in_pages'] = null;
	$input['custom_sidebars_in_pages'] = ( $input['custom_sidebars_in_pages'] == 1 ? 1 : 0 );
	
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
