<?php
/**
 * The template part for displaying results in search pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<footer class="entry-footer-home">
	<?php 
		twentysixteen_entry_meta();
		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	?>
	</footer><!-- .entry-footer-home -->

	<div class="entry-body">
  <div class="entry-thumbnail">
    <?php twentysixteen_post_thumbnail(); ?>
	</div><!-- .entry-thumbnail -->
	<div class="entry-content">
    <?php	twentysixteen_excerpt(); ?>
	</div> <!-- .entry-content -->
  </div><!-- .entry-body -->

</article><!-- #post-## -->

