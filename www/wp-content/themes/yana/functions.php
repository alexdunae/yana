<?php

namespace YANA;

require_once( dirname(__FILE__) . '/lib/yana.template.php' );
require_once( dirname(__FILE__) . '/lib/yana.events.php' );



const FACEBOOK_URL = 'https://www.facebook.com/pages/YANA-Comox-Valley/9846076614';

add_action( 'after_setup_theme', 'YANA\setup' );
add_action( 'widgets_init', 'YANA\widgets_init' );
add_action( 'wp_enqueue_scripts', 'YANA\scripts' );

if ( ! isset( $content_width ) ) {
	$content_width = 618;
}

function setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
  add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );   // TODO
  add_image_size('event-wide-thumbnail', 624, 0);
  set_post_thumbnail_size((288 * 2), 0, 0);

	register_nav_menus( array(
		'primary' => 'Primary Menu',
		'secondary' => 'Secondary Menu',
	) );

  if (class_exists('\MultiPostThumbnails')) {
    $types = array('page', 'yana-event');
    foreach($types as $type) {
      new \MultiPostThumbnails(array(
          'label' => 'Masthead',
          'id' => 'masthead-image',
          'post_type' => $type
          )
      );

      add_image_size('post-secondary-image-thumbnail', 0, 430);
    }
  }
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
