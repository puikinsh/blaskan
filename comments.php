<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blaskan
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
        <h5 class="comments-title">
			<?php
			printf( // WPCS: XSS OK.
				esc_html( _nx( '%1$s comment', '%1$s comments', get_comments_number(), 'comments number', 'blaskan' ) ),
				number_format_i18n( get_comments_number() )
			);
			?>
        </h5><!-- .comments-title -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'blaskan' ); ?></h2>
                <div class="nav-links">

                    <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'blaskan' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'blaskan' ) ); ?></div>

                </div><!-- .nav-links -->
            </nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

        <ol class="comment-list">
			<?php
			wp_list_comments( array(
				                  'style'       => 'ol',
				                  'short_ping'  => true,
				                  'avatar_size' => 50,
				                  'callback'    => 'blaskan_comment'
			                  ) );
			?>
        </ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'blaskan' ); ?></h2>
                <div class="nav-links">

                    <div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'blaskan' ) ); ?></div>
                    <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'blaskan' ) ); ?></div>

                </div><!-- .nav-links -->
            </nav><!-- #comment-nav-below -->
			<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'blaskan' ); ?></p>
		<?php
	endif;

	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );

	$fields = array(

		'author' =>
			'<p class="comment-form-author">' .
			'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			'" size="30" ' . $aria_req . ' placeholder="' . esc_html__( 'Name', 'blaskan' ) . ( $req ? '*' : '' ) . '" /></p>',

		'email' =>
			'<p class="comment-form-email">' .
			'<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .
			'" size="30" ' . $aria_req . ' placeholder="' . esc_html__( 'Email', 'blaskan' ) . ( $req ? '*' : '' ) . '" /></p>',

		'url' =>
			'<p class="comment-form-url">' .
			'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="' . esc_html__( 'Website', 'blaskan' ) . '" /></p>',
	);

	$comment_form_args = array(
		'comment_field'      => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . _x( 'Comment', 'noun', 'blaskan' ) . '"></textarea></p>',
		'title_reply_before' => '<h5 id="reply-title" class="comment-reply-title">',
		'title_reply_after'  => '</h5>',
		'fields'             => $fields,
	);


	comment_form( $comment_form_args );
	?>

</div><!-- #comments -->
