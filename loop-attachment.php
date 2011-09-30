<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<?php if ( ! empty( $post->post_parent ) ) : ?>
					<nav class="back-to-post">
						<a href="<?php echo get_permalink( $post->post_parent ); ?>" rel="gallery">
							<?php echo get_the_title( $post->post_parent ); ?>
						</a>
					</nav>
					<!-- / #post-back -->
				<?php endif; ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header>
						<time datetime="<?php the_date('c'); ?>" pubdate><?php echo get_the_date(); ?></time>
						<h1><?php the_title(); ?></h1>
					</header>


<?php if ( wp_attachment_is_image() ) :
	$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
	foreach ( $attachments as $k => $attachment ) {
		if ( $attachment->ID == $post->ID )
			break;
	}
	$k++;
	// If there is more than 1 image attachment in a gallery
	if ( count( $attachments ) > 1 ) {
		if ( isset( $attachments[ $k ] ) )
			// get the URL of the next image attachment
			$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
		else
			// or get the URL of the first image attachment
			$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
	} else {
		// or, if there's only 1 image attachment, get the URL of the image
		$next_attachment_url = wp_get_attachment_url();
	}
?>
						<figure>
							<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo wp_get_attachment_image( $post->ID, 'large' ); ?></a>
							<figcaption><?php echo $post->post_excerpt; ?></figcaption>
						</figure>

						<nav class="post-nav" role="navigation">
							<div class="nav-previous"><?php previous_image_link( false ); ?></div>
							<div class="nav-next"><?php next_image_link( false ); ?></div>
						</nav>
						<!-- / .post-nav -->
<?php else : ?>
						<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php echo basename( get_permalink() ); ?></a>
<?php endif; ?>


<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'blaskan' ) ); ?>
<?php wp_link_pages( array( 'before' => '<nav class="page-link" role="navigation">' . __( 'Pages:', 'blaskan' ), 'after' => '</nav>' ) ); ?>


					<footer>
					  <?php if ( get_post_type() !== 'page' ): ?>
						  <span class="author"><span class="author-label"><?php _e( 'Uploaded by', 'blaskan' ); ?></span> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>
						<?php endif; ?>
						<?php edit_post_link( __( 'Edit', 'blaskan' ), '<span class="edit">', '</span>' ); ?>
					</footer>

				</article>

<?php comments_template(); ?>

<?php endwhile; // end of the loop. ?>