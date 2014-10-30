<?php

namespace YANA;

require_once( dirname(__FILE__) . '/lib/yana.editing.php' );
require_once( dirname(__FILE__) . '/lib/yana.template.php' );
require_once( dirname(__FILE__) . '/lib/yana.events.php' );
require_once( dirname(__FILE__) . '/lib/yana.subscribe.php' );
require_once( dirname(__FILE__) . '/lib/yana.sidebar-ad-widget.php' );

const FACEBOOK_URL = 'https://www.facebook.com/pages/YANA-Comox-Valley/9846076614';

add_action( 'after_setup_theme', 'YANA\setup' );
add_action( 'wp_enqueue_scripts', 'YANA\scripts' );

add_filter( 'embed_oembed_html', 'YANA\format_oembed', 10, 3 );
add_filter( 'body_class', 'YANA\body_class' );
add_action( 'wp_footer', 'YANA\wp_footer' );

add_action( 'pre_get_posts', 'YANA\pre_get_posts' );
add_action( 'generate_rewrite_rules', 'YANA\extend_date_archives_add_rewrite_rules' );
add_action( 'init', 'YANA\extend_date_archives_flush_rewrite_rules' );
add_filter( 'use_default_gallery_style', function () { return false; });
add_action( 'widgets_init', 'YANA\widgets_init' );

remove_shortcode('gallery', 'gallery_shortcode'); // removes the original shortcode
add_shortcode('gallery', 'YANA\gallery_shortcode'); // add your own shortcode



function show_testimonials_sidebar() {
  global $post;
  if ( \is_page() ) {

    // don't show in 'get support section'
    $support_page = \get_page_by_path( 'get-support' );

    if ( !$support_page ) {
      return true;
    }

    if ( $post->ID == $support_page->ID ) {
      return false;
    }

    $roots = \get_ancestors( $post->ID, 'page' );
    if ( in_array( $support_page->ID, $roots ) ) {
      return false;
    }
  }

  return true;
}

function gallery_shortcode($attr) {
  if ( !isset($attr) || !is_array($attr)) {
    $attr = array();
  }

  $attr['link'] = 'none';
  $attr['columns'] = 99999;
  $attr['itemtag'] = 'div';
  $attr['icontag'] = 'div';
  $attr['captiontag'] = 'p';
  $attr['size'] = 'large';

  $output = \gallery_shortcode($attr);


  return sprintf("<section class='gallery-wrapper'><nav><a href='#' class='prev nav'><span class='icon icon-arrow-left'></span></a><a href='#' class='next nav'><span class='icon icon-arrow-right'></span></a></nav>%s</section>", $output);
}


if ( ! isset( $content_width ) ) {
	$content_width = 618;
}

function setup() {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
  add_post_type_support( 'page', 'excerpt' );
  add_image_size('toc-thumbnail', 624, 414, true);
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

function body_class($classes) {
  if ( is_front_page() ) {
    $classes[] = 'front-page';
  } else {
    $classes[] = 'inner-page';
  }
  return $classes;
}

function format_oembed( $html, $url, $args ) {
  return "<div class='embed'><div class='inner'>$html</div></div>";
}


/*
  Generate monthly pagination links for the news section.

  WordPress doesn't have an easy way to generate monthly post links scoped
  by category.  This function checks for a category scope and then manually
  creates the links.

  See also the date-based rewrite filters.
 */
function news_pagination( $category_id = null ) {
  global $wp_query, $wpdb;

  $links = array();
  $link_base = '';
  $where = '';

  $category_id = null;
  $category_name = get_query_var( 'category_name' );


  if ( $category_name && !empty( $category_name) ) {
    $category_id = get_category_by_slug( $category_name )->term_id;
    $link_base = get_category_link( $category_id );

    $post_ids = get_objects_in_term( $category_id, 'category' );
    if ( count($post_ids) > 0 ) {
      $where = sprintf( " AND ID IN (%s) ", implode($post_ids, ','));
    }
  }

  $sql = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts
        FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' $where
        GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC";

  $results = $wpdb->get_results($sql);

  foreach ( $results as $result ) {
    $date = mktime(0, 0, 0, $result->month, 1, $result->year);
    if ( $category_id ) {
      $link = sprintf("%s%s", $link_base, date('Y/m/', $date) );
    } else {
      $link = get_month_link($result->year, $result->month);
    }


    $links[] = sprintf("<a href='%s'>%s</a>", $link, date('F Y', $date) );
  }


  if ($links && count($links) > 0) {
    return printf("<div class='pagination'>%s</div>", implode(' ', $links) );
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

function pre_get_posts(&$wp_query) {
  if ( is_admin() || ! $wp_query->is_main_query() ) {
    return;
  }

  if ( is_home() ) {
    $wp_query->set( 'posts_per_page', 30 );
  } elseif ( $wp_query->is_archive() ) {
    $wp_query->set( 'posts_per_page', 9999 );
  }
}

// http://snipplr.com/view.php?codeview&id=17432
function extend_date_archives_flush_rewrite_rules(){
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}

function extend_date_archives_add_rewrite_rules($wp_rewrite){
  $rules = array();
  $structures = array(
    $wp_rewrite->get_category_permastruct() . $wp_rewrite->get_date_permastruct(),
    $wp_rewrite->get_category_permastruct() . $wp_rewrite->get_month_permastruct(),
    $wp_rewrite->get_category_permastruct() . $wp_rewrite->get_year_permastruct(),
  );
  foreach( $structures as $s ){
    $rules += $wp_rewrite->generate_rewrite_rules($s);
  }
  $wp_rewrite->rules = $rules + $wp_rewrite->rules;
}

function widgets_init() {
  register_sidebar( array(
    'name' => 'Homepage Sidebar',
    'id' => 'front-page-widget-area',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ) );
}

function scripts() {
	wp_enqueue_style( 'yana-style',      get_stylesheet_uri() );

  wp_enqueue_script( 'yana-console',    get_template_directory_uri() . '/js/vendor/console.js', array(), false, true );
  wp_enqueue_script( 'yana-cookies',    get_template_directory_uri() . '/js/vendor/cookies.js', array(), false, true );
  wp_enqueue_script( 'yana-flexslider', get_template_directory_uri() .'/js/vendor/jquery-plugins/jquery.flexslider.js', array('jquery'), false, true );
  wp_enqueue_script( 'yana-scripts',    get_template_directory_uri() . '/js/yana.js', array('yana-console', 'yana-cookies', 'yana-flexslider', 'jquery'), false, true );
}

