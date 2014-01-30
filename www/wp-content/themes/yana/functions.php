<?php

namespace YANA;

require_once( dirname(__FILE__) . '/lib/yana.template.php' );
require_once( dirname(__FILE__) . '/lib/yana.events.php' );
require_once( dirname(__FILE__) . '/lib/yana.subscribe.php' );



const FACEBOOK_URL = 'https://www.facebook.com/pages/YANA-Comox-Valley/9846076614';

add_action( 'after_setup_theme', 'YANA\setup' );
add_action( 'widgets_init', 'YANA\widgets_init' );
add_action( 'wp_enqueue_scripts', 'YANA\scripts' );
add_filter( 'image_size_names_choose', 'YANA\insertable_image_sizes' );
add_filter( 'img_caption_shortcode', 'YANA\img_caption_shortcode', 10, 3 );
add_filter( 'embed_oembed_html', 'YANA\format_oembed', 10, 3 );
add_filter( 'body_class', 'YANA\body_class' );
add_action( 'wp_footer', 'YANA\wp_footer' );
add_action( 'init', 'YANA\add_editor_style' );


if ( ! isset( $content_width ) ) {
	$content_width = 618;
}

function setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
  add_image_size('event-wide-thumbnail', 624, 0);
  add_image_size('post-masthead-image', 0, 432);
  add_image_size('post-masthead-vignette', 0, 480);
  update_option('image_default_link_type','none');

  set_post_thumbnail_size((288 * 2), 0, 0);

	register_nav_menus( array(
		'primary' => 'Primary Menu',
		'secondary' => 'Secondary Menu',
    'primary-footer' => 'Primary Footer Menu',
    'secondary-footer' => 'Secondary Footer Menu',
    'tertiary-footer' => 'Tertiary Footer Menu'
	) );
}

function add_editor_style() {
    \add_editor_style( 'editor-style.css' );
}

function body_class($classes) {
  if ( is_front_page() ) {
    $classes[] = 'front-page';
  } else {
    $classes[] = 'inner-page';
  }
  return $classes;
}

function insertable_image_sizes($sizes) {
   unset( $sizes['thumbnail']);
   unset( $sizes['medium'] );
   unset( $sizes['full'] );
   return $sizes;
}

function format_oembed( $html, $url, $args ) {
  return "<div class='embed'><div class='inner'>$html</div></div>";
}



  // no fixed width
function img_caption_shortcode( $a, $attr, $content ) {
  extract(shortcode_atts(array(
    'id'  => '',
    'align' => 'alignnone',
    'width' => '',
    'caption' => ''
  ), $attr));

  if ( 1 > (int) $width || empty($caption) )
    return $content;

  if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

  return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '">'
  . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

function pagination() {
  global $wp_query;

  $big = 9999999;

  $links = paginate_links( array(
      'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
      'current' => max( 1, get_query_var('paged') ),
      'total' => $wp_query->max_num_pages,
      'prev_text' => 'Previous',
      'next_text' => 'Next page'
  ) );

  if ($links && !empty($links)) {
    return printf("<div class='pagination'>%s</div>", $links);
  } else {
    return false;
  }
}

function wp_footer() {
  printf("<script> if (window.YANA == null) { window.YANA = {}; }; window.YANA.XHR_URL = '%s';", admin_url( 'admin-ajax.php') );
  $path = dirname(__FILE__) . '/sidebar-quotes.json';
  if ( is_readable($path) ) {
    $quotes = file_get_contents($path);
    printf(" window.YANA.Quotes = %s; ", $quotes );

  }
  echo '</script>';

}


/**
 * Register widgetized area and update sidebar with default widgets.
 */
function widgets_init() {
	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}

function scripts() {
	wp_enqueue_style( 'yana-style', get_stylesheet_uri() );
	wp_enqueue_script( 'yana-modernizr', get_template_directory_uri() . '/js/vendor/modernizr.js', null, 'TODO', false );
	wp_enqueue_script( 'yana-fonts', 'https://fast.fonts.net/jsapi/014930c9-fd65-4ba8-a0d8-c9968ba08138.js?v=2', null, null, false );
	wp_enqueue_script( 'yana-scripts', get_template_directory_uri() . '/yana.js', array( 'jquery' ), 'TODO', true );
}
