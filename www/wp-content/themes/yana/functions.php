<?php
/**
 * YANA functions and definitions
 *
 * @package YANA
 */

require_once( dirname(__FILE__) . '/lib/yana.events.php' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

define('YANA_FACEBOOK_URL', 'https://www.facebook.com/pages/YANA-Comox-Valley/9846076614');

if ( ! function_exists( 'yana_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function yana_setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => 'Primary Menu',
		'secondary' => 'Secondary Menu',
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

  add_image_size('event-wide-thumbnail', 624, 0);
  set_post_thumbnail_size((288 * 2), 0, 0);
}
endif; // yana_setup
add_action( 'after_setup_theme', 'yana_setup' );

function yana_linked_thumbnail($post_id, $size = 'post-thumbnail') {
  $img = get_the_post_thumbnail($post_id, $size);
  if ( empty($img) ) {
    return false;
  } else {
    return sprintf("<a href='%s' class='image'>%s</a>", get_permalink($post_id), $img);
  }
}


function yana_get_archive_page_object() {
  $archive_page = null;
  if ( $post_type = get_post_type_object( get_query_var( 'post_type' ) ) ) {
    if ( isset( $post_type->rewrite['slug'] ) ) {
      $archive_page = get_page_by_path( $post_type->rewrite['slug'] );
    }
  } elseif ( is_home() || is_archive() ) {
    $archive_page = get_page( get_option( 'page_for_posts' ) );
  }

  return $archive_page;
}


/**
 * Register widgetized area and update sidebar with default widgets.
 */
function yana_widgets_init() {
	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'yana_widgets_init' );

function yana_scripts() {
	wp_enqueue_style( 'yana-style', get_stylesheet_uri() );
	wp_enqueue_script( 'yana-modernizr', get_template_directory_uri() . '/js/vendor/modernizr.js', null, 'TODO', false );
	wp_enqueue_script( 'yana-fonts', 'https://fast.fonts.net/jsapi/014930c9-fd65-4ba8-a0d8-c9968ba08138.js', null, null, false );
	wp_enqueue_script( 'yana-scripts', get_template_directory_uri() . '/yana.js', array( 'jquery' ), 'TODO', true );
}
add_action( 'wp_enqueue_scripts', 'yana_scripts' );

if (class_exists('MultiPostThumbnails')) {
  $types = array('page', 'yana-event');
  foreach($types as $type) {
    new MultiPostThumbnails(array(
        'label' => 'Masthead',
        'id' => 'masthead-image',
        'post_type' => $type
        )
    );

    add_image_size('post-secondary-image-thumbnail', 0, 430);
  }
}
