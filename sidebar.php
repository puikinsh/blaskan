<?php
/**
 * The sidebar containing the main widget area
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blaskan
 */

if ( ! blaskan_has_sidebar() ) {
	return;
}

$blaskan_has_widgets = is_active_sidebar( 'sidebar-1' );
?>

<aside id="secondary" class="widget-area col-md-4 col-sm-12" role="complementary">
	<?php
	if ( $blaskan_has_widgets ) {
		dynamic_sidebar( 'sidebar-1' );
	} else {
		/*
		 * Only reachable in the Customizer -- blaskan_has_sidebar() returns false for an
		 * empty widget area anywhere else. Without this, choosing a sidebar layout with
		 * no widgets looks like a setting that does nothing.
		 */
		$blaskan_widgets_url = is_customize_preview()
			? 'javascript: wp.customize.panel( "widgets" ).focus();'
			: admin_url( 'widgets.php' );
		?>
		<p class="blaskan-empty-sidebar-message">
			<?php
			printf(
				/* translators: %s: URL of the widgets panel. */
				wp_kses( __( 'This sidebar is empty, so visitors see the page full width. <a href="%s">Add a widget</a> to fill it.', 'blaskan' ), array( 'a' => array( 'href' => array() ) ) ),
				esc_attr( $blaskan_widgets_url )
			);
			?>
		</p>
		<?php
	}
	?>
</aside><!-- #secondary -->
