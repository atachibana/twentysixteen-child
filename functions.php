<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
    wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'font-opensans', 'https://fonts.googleapis.com/css?family=Open+Sans' );
}

function custom_excerpt_length( $length ) {
     return 150;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function my_thumbnailed_size_setup() {
	add_image_size('home_thumbnail', 200, 150, true );
}
add_action( 'after_setup_theme', 'my_thumbnailed_size_setup' );

/**********************************************************************
 *  twentysixteen_entry_meta
 *      - write create date and update date
 *      - write category list
 *********************************************************************/
function twentysixteen_entry_meta() {
    if ( in_array( get_post_type(), array( 'post', 'attachment', 'page' ) ) ) {
		twentysixteen_entry_date();
	}

	if ( 'post' === get_post_type() ) {
		twentysixteen_entry_taxonomies();
	}
}

/**********************************************************************
 *  twentysixteen_entry_date
 *      - write create date and update date
 *      - Adding fontawesome icon
 *********************************************************************/
function twentysixteen_entry_date() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

    if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">  <i class="fa fa-pencil"></i> %4$s</time>';
    }

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        get_the_date(),
        esc_attr( get_the_modified_date( 'c' ) ),
        get_the_modified_date()
    );

    printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><i class="fa fa-calendar"></i> %2$s</span>',
        _x( 'Posted on', 'Used before publish date.', 'twentysixteen' ),
        $time_string
    );
}

/**********************************************************************
 *  twentysixteen_entry_taxonomies
 *      - write category list
 *      - wrapping each category by span with class="post-category"
 *        for surrownding blue square
 *********************************************************************/
function twentysixteen_entry_taxonomies() {
    $categories = get_the_category();
    $separator = ' ';
    $categories_list = '';
    if ( $categories ) {
        foreach( $categories as $category ) {
            if ( $category->name != "Uncategorized" ) {
                $categories_list .= '<span class="post-category"><a href="' . get_category_link( $category->term_id ) . '" title="'
                    . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) )
                    . '">' . $category->cat_name . '</a></span>' . $separator;
            }
        }
    }
    if ( $categories_list && twentysixteen_categorized_blog() ) {
        printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
            _x( 'Categories', 'Used before category names.', 'twentysixteen' ),
            $categories_list
        );
    }

    $tags_list = get_the_tag_list( '', _x( ' ', 'Used between list items, there is a space after the comma.', 'twentysixteen' ) );
    if ( $tags_list ) {
        printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
            _x( 'Tags', 'Used before tag names.', 'twentysixteen' ),
            $tags_list
        );
    }
}

/**********************************************************************
 *  the_thumbnailed_article
 *
 *  Called by custom widget area such as recent posts to show
 *  thumbnail, title and date.
 *********************************************************************/
function the_thumbnailed_article() {
    printf('<div class="thumbnailed-article">');
    printf('<a href="%1$s">', get_the_permalink());
    if ( has_post_thumbnail() ) {
        printf('<div class="thumbnailed-area">');
        the_post_thumbnail(array(100,100));
        printf('</div><!-- .thumbnailed-area -->');
    }
    printf('<div class="thumbnailed-content">');
    the_title();
    printf('</a><br />');
    printf('<span class="thumbnailed-date">%1$s</span>', get_the_date());
    printf('</div><!-- .thumbnailed-content -->');

    printf('</div><!-- .thumbnailed-article -->');
}

/**********************************************************************
 *  the_home_thumbnailed_article
 *
 *  Called by home.php to show thumbnail (200x150) and title.
 *********************************************************************/
function the_home_thumbnailed_article() {
    printf('<div class="home-top-box">');
    printf('<a href="%1$s">', get_the_permalink());
    if ( has_post_thumbnail() ) {
        the_post_thumbnail('home_thumbnail');
    }
    the_title();
    printf('</a>');
    printf('</div><!-- .home-top-box -->');
}

/**********************************************************************
 *  TynyMCE customiation
 *
 *********************************************************************/

add_editor_style('editor-style.css');

function _my_tinymce($initArray) {
     $initArray['theme_advanced_blockformats'] = 'p,h2,h3,h4,pre';
     return $initArray;
}
add_filter('tiny_mce_before_init', '_my_tinymce', 10000);

