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
			$args = array( 'include' => '550,545,902,559,544', 'orderby' => 'post__in' );
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
	<section class="widget">
		<h2 class="widget-title">プロフィール</h2>	
		<div class="author-info">
			<div class="author-avatar">
			    <?php
			    global $user;
			    $user = get_user_by('email', 'atachibana@unofficialtokyo.com');
			    if ($user == '') {
					$user = get_user_by('login', 'atachibana');
				}			    
				echo get_avatar('atachibana@unofficialtokyo.com', 100 );
				echo '<br />';
				echo '<h2 class="author-title">Akira Tachibana</h2>';
				?>
			</div><!-- .author-avatar -->
			<div class="author-description">
				<p class="author-bio">
					<?php the_author_meta( 'description', $user->get('ID') ); ?>
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

	</section>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- .sidebar .widget-area -->
<?php endif; ?>
