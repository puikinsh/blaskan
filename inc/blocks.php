<?php
/**
 * Block editor: a block style and a block pattern in the theme's own idiom.
 *
 * @package blaskan
 */

/**
 * A framed variant of the image block, matching the thin rule the theme uses around
 * widgets and the footer columns.
 */
function blaskan_register_block_styles() {
	register_block_style(
		'core/image',
		array(
			'name'         => 'blaskan-framed',
			'label'        => __( 'Framed', 'blaskan' ),
			'inline_style' => '.wp-block-image.is-style-blaskan-framed img {
				padding: 10px;
				border: 1px solid #ebebeb;
				background: #fff;
			}',
		)
	);

	register_block_style(
		'core/quote',
		array(
			'name'         => 'blaskan-plain-quote',
			'label'        => __( 'No rule', 'blaskan' ),
			'inline_style' => '.wp-block-quote.is-style-blaskan-plain-quote {
				border: 0 none;
				padding-left: 0;
				font-style: italic;
			}',
		)
	);
}
add_action( 'init', 'blaskan_register_block_styles' );

/**
 * An opening block for a post: a short standfirst above the body, set the way the
 * theme sets its own intro type.
 */
function blaskan_register_block_patterns() {
	if ( ! function_exists( 'register_block_pattern' ) ) {
		return;
	}

	register_block_pattern(
		'blaskan/standfirst',
		array(
			'title'       => __( 'Standfirst and body', 'blaskan' ),
			'description' => _x( 'A short introduction in larger type, followed by two columns of body text.', 'Block pattern description', 'blaskan' ),
			'categories'  => array( 'text' ),
			'content'     => '<!-- wp:paragraph {"fontSize":"large"} --><p class="has-large-font-size">'
				. esc_html__( 'Open with a sentence or two that says what the piece is about, set larger than the body so a reader can decide from the top of the page.', 'blaskan' )
				. '</p><!-- /wp:paragraph -->'
				. '<!-- wp:columns --><div class="wp-block-columns">'
				. '<!-- wp:column --><div class="wp-block-column"><!-- wp:paragraph --><p>'
				. esc_html__( 'Then carry on in the ordinary body size.', 'blaskan' )
				. '</p><!-- /wp:paragraph --></div><!-- /wp:column -->'
				. '<!-- wp:column --><div class="wp-block-column"><!-- wp:paragraph --><p>'
				. esc_html__( 'Two columns hold their measure on a wide screen and stack on a narrow one.', 'blaskan' )
				. '</p><!-- /wp:paragraph --></div><!-- /wp:column -->'
				. '</div><!-- /wp:columns -->',
		)
	);
}
add_action( 'init', 'blaskan_register_block_patterns' );
