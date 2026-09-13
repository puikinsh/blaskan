<?php
/**
 * The collapsible search in the top header.
 *
 * header.php and the Customizer's selective-refresh callback both render this, so the
 * markup lives in one place rather than being written out twice.
 *
 * The form itself comes from get_search_form(), which is what the theme guidelines ask
 * for: a search form written out by hand cannot be filtered by a plugin, and this
 * theme was carrying three separate copies of one. The magnifier is a real <button> with
 * aria-expanded rather than a <label> pressed into service as a toggle, so the control
 * announces itself and works from the keyboard.
 *
 * @package blaskan
 */

$blaskan_disable_search = get_theme_mod( 'blaskan_disable_header_search', 0 );

// The Customizer still renders it when disabled, hidden, so toggling the setting has
// something to reveal without a full refresh.
if ( $blaskan_disable_search && ! is_customize_preview() ) {
	return;
}
?>
<div id="search-header-form" class="search<?php echo ( is_customize_preview() && $blaskan_disable_search ) ? ' hide' : ''; ?>">
	<button type="button" class="search-toggle" aria-expanded="false" aria-controls="search-header-fields">
		<i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
		<span class="screen-reader-text"><?php esc_html_e( 'Toggle the search field', 'blaskan' ); ?></span>
	</button>
	<div id="search-header-fields" class="search-header-fields">
		<?php get_search_form(); ?>
	</div>
</div>
