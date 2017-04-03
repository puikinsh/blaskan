<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blaskan
 */

?>

<article id="post-<?php the_ID(); ?>" class="col-md-4 col-sm-12">
	<?php if ( has_post_thumbnail() ) { 
		echo '<div class="entry-thumbnail">'; 
		the_post_thumbnail();
		echo '</div>';
	} ?>

	<p><?php the_title(); ?></p>
</article><!-- #post-## -->
