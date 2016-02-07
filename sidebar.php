<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<?php if ( is_active_sidebar( 'sidebar-1' )  ) : ?>
	<aside id="secondary" class="sidebar widget-area" role="complementary">

	<section class="widget">
		<h2 class="widget-title">おすすめ記事</h2>
		<?php
			$args = array( 'include' => '972,1107,545,559', 'orderby' => 'post__in' );
			$postslist = get_posts( $args );
			foreach ( $postslist as $post ) :
  				setup_postdata( $post );
				the_thumbnailed_article();
			endforeach;
			wp_reset_postdata();
		?>
	</section>

	<section class="widget">
		<h2 class="widget-title">最新記事</h2>
		<?php
			$args = array( 'posts_per_page' => 5 );
			$postslist = get_posts( $args );
			foreach ( $postslist as $post ) :
  				setup_postdata( $post );
				the_thumbnailed_article();
			endforeach;
			wp_reset_postdata();
		?>
	</section>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>

	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
