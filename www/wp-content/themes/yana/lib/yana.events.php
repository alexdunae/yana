<?php

namespace YANA\Events;

const POST_TYPE = 'yana-event';
const META_KEY = '_yana_event_data';
const META_KEY_DATE = '_yana_event_date';

add_action( 'init', 'YANA\Events\init' );
add_action( 'add_meta_boxes', 'YANA\Events\add_meta_boxes' );
add_action( 'save_post', 'YANA\Events\save_post' );
add_action( 'pre_get_posts', 'YANA\Events\pre_get_posts' );
add_action( 'admin_bar_menu', 'YANA\Events\modify_admin_bar', 999 );

function init() {
  $labels = array(
    'name' => 'Events',
    'singular_name' => 'Event',
    'add_new_item' => 'Add New Event',
    'edit_item' => 'Edit Event',
    'new_item' => 'New Event',
    'all_items' => 'All Events',
    'view_item' => 'View Event',
    'search_items' => 'Search Events',
    'not_found' => 'No events found',
    'not_found_in_trash' => 'No events found in Trash',
    'parent_item_colon' => '',
    'menu_name' => 'Events'
  );

  register_post_type( POST_TYPE, array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_admin_bar' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'events' ),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' )
  ) );
}

function home_url() {
  return get_post_type_archive_link( POST_TYPE );
}

function title() {
  $page = get_page_by_path( 'events' );
  $title = $page ? $page->post_title : 'Events';
  return apply_filters( 'the_title', $title );
}

function _upcoming_meta_query( $future = true ) {
  return array(
    array(
      'key' => META_KEY_DATE,
      'compare' => $future ? '>=' : '<',
      'value' => mktime(0, 0, 0),
      'type' => 'numeric',
    )
  );
}

function upcoming( $count = -1 ) {
  $args = array(
    'post_type' => POST_TYPE,
    'meta_query'=> _upcoming_meta_query(),
    'meta_key' => META_KEY_DATE,
    'orderby' => 'meta_value',
    'order' => 'ASC',
    'numberposts' => $count
  );

  return get_posts( $args );
}

function recent( $count = -1 ) {
  $args = array(
    'post_type' => POST_TYPE,
    'meta_query'=> _upcoming_meta_query( false ),
    'meta_key' => META_KEY_DATE,
    'orderby' => 'meta_value',
    'order' => 'DESC',
    'numberposts' => $count
  );

  return get_posts( $args );
}

function meta( $ID ) {
  $defaults = array( 'location' => '', 'general_info' => '', 'priority' => 1 );
  $meta = (array)get_post_meta( $ID, META_KEY, true );
  $meta['date'] = get_post_meta( $ID, META_KEY_DATE, true );
  return array_merge( $defaults, $meta );
}

function add_meta_boxes() {
  add_meta_box(
      'yana_event_meta',
      'Event Details',
      '\YANA\Events\meta_boxes',
      POST_TYPE,
      'side',
      'high'
  );
}

function meta_boxes( $post ) {
  wp_nonce_field( POST_TYPE, 'yana_event_meta_nonce' );
  echo '<label class="screen-reader-text">Event Details</label>';
  $data = meta( $post->ID );
  $date = '';
  if ( intval( $data['date'] ) > 0 ) {
    $date = date( 'Y-m-d', intval( $data['date'] ) );
  }

  echo '<p><label for="yana_event_date">Expiration date (used for sorting chronologically)</label><br>';
  printf( "<input type='text' id='yana_event_date' name='yana_event_date' value='%s' placeholder='YYYY-MM-DD'></p>", esc_attr( $date ));

  echo '<p><label for="yana_event_general_info">Dates, time, location and other info</label><br>';
  printf( "<textarea id='yana_event_general_info' name='yana_event_general_info' rows='3' class='widefat'>%s</textarea>", esc_html( $data['general_info'] ) );

  echo "<p><label for='yana_event_priority'>Event prominence</label><br><select id='yana_event_priority' name='yana_event_priority'>";
  echo '<option value=0 ' . selected( intval( $data['priority'] ), 0 ) . '>Top Priority Event</option>';
  echo '<option value=1 ' . selected( intval( $data['priority'] ), 1 ) . '>Medium priority event</option>';
  echo '<option value=2 ' . selected( intval( $data['priority'] ), 2 ) . '>Standard event</option>';
  echo '</select></p>';

}

function save_post( $post_id ) {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }

  if ( !isset( $_POST['yana_event_meta_nonce'] ) || !wp_verify_nonce( $_POST['yana_event_meta_nonce'], POST_TYPE ) ) {
    return;
  }

  if ( !current_user_can( 'edit_post', $post_id ) ) {
    return;
  }

  $meta = array(
    'location' => filter_input( INPUT_POST, 'yana_event_location', FILTER_SANITIZE_STRING ),
    'general_info'  => filter_input( INPUT_POST, 'yana_event_general_info', FILTER_SANITIZE_STRING ),
    'priority' => intval( @$_POST[ 'yana_event_priority'] )
  );

  $date = strtotime( filter_input( INPUT_POST, 'yana_event_date', FILTER_SANITIZE_STRING ) );
  if ( $date < 1 ) {
    wp_die( 'Could not determine the date of the event. Please enter it in YYYY-MM-DD format.' );
  } else {
    update_post_meta( $post_id, META_KEY_DATE, $date );
    update_post_meta( $post_id, META_KEY, $meta );
  }
}


function pre_get_posts(&$wp_query) {
  // show only upcoming events, sorted with soonest first.
  if ( !is_admin() && is_post_type_archive( POST_TYPE ) && $wp_query->is_main_query() ) {
    $wp_query->set( 'meta_query',  _upcoming_meta_query() );
    $wp_query->set( 'meta_key', META_KEY_DATE );
    $wp_query->set( 'orderby', 'meta_value' );
    $wp_query->set( 'order', 'ASC' );
  }
}


function modify_admin_bar( $wp_admin_bar ){
  global $wp_query;
  // show edit page link on post type archives pages
  // lifted from wp-includes/admin-bar.php
  if ( !is_admin() && is_post_type_archive( POST_TYPE ) && $wp_query->is_main_query() ) {
    $current_object = \YANA\get_archive_page_object();

    if ( ! empty( $current_object->post_type )
        && ( $post_type_object = get_post_type_object( $current_object->post_type ) )
        && current_user_can( 'edit_post', $current_object->ID )
        && $post_type_object->show_ui && $post_type_object->show_in_admin_bar )
      {
        $wp_admin_bar->add_menu( array(
          'id' => 'edit',
          'title' => $post_type_object->labels->edit_item,
          'href' => get_edit_post_link( $current_object->ID )
        ) );
      }
    }
}

