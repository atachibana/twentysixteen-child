<?php
/**
 * The template part for displaying an Author biography
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<div class="author-info">
	<div class="author-avatar">
		<?php
		/**
		 * Filter the Twenty Sixteen author bio avatar size.
		 *
		 * @since Twenty Sixteen 1.0
		 *
		 * @param int $size The avatar height and width size in pixels.
		 */
		$author_bio_avatar_size = apply_filters( 'twentysixteen_author_bio_avatar_size', 100 );

		echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		?>
	</div><!-- .author-avatar -->

	<div class="author-description">
		<h2 class="author-title"><?php echo get_the_author(); ?></h2>
		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			</a>
		</p><!-- .author-bio -->
		<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentysixteen' ); ?>">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'social',
					'menu_class'     => 'social-links-menu',
					'depth'          => 1,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
				) );
			?>
		</nav><!-- .social-navigation -->
	</div><!-- .author-description -->
</div><!-- .author-info -->
