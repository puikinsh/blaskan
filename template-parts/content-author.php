<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blaskan
 */

?>

<div class="author-container">
	<div class="author">
		<div class="author-avatar">
			<?php echo get_avatar(  get_the_author_meta( 'ID' ), 72 ); ?> 
		</div>
		<div class="author-description">
			<p class="author-name"> <?php echo get_the_author_meta( 'first_name' ).' '.get_the_author_meta( 'last_name' ) ?> </p>
			<div class="author-bio">
				<?php echo get_the_author_meta( 'description' ) ?>
			</div>
		</div>
	</div>
</div>
