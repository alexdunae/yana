<?php

namespace YANA\Events;

const POST_TYPE = 'yana-event';
const TYPE_ID = 'yana-event-type';

add_action( 'init', 'YANA\Events\init' );
//add_action( 'pre_get_posts', 'YANA\Events\pre_get_posts' );
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

  $tax_labels = array(
      'name' => 'Event Type',
      'singular_name' => 'Event Type',
      'search_items' => 'Search Event Types',
      'popular_items' => 'Popular Event Types',
      'all_items' => 'All Event Types',
      'parent_item' => null,
      'parent_item_colon' => null,
      'edit_item' => 'Edit Event Type',
      'update_item' => 'Update Event Type',
      'add_new_item' => 'Add New Event Type',
      'new_item_name' => 'New Event Type Name',
      'separate_items_with_commas' => 'Separate event types with commas',
      'add_or_remove_items' => 'Add or remove event types',
      'choose_from_most_used' =>'Choose from the most used event types',
      'menu_name' => 'Event Types',
    );

    register_taxonomy( TYPE_ID, POST_TYPE, array(
      'hierarchical' => true,
      'labels' => $tax_labels,
      'show_ui' => true,
      'update_count_callback' => '_update_post_term_count',
      'query_var' => true,
      'show_admin_column' => true,
      'show_tag_cloud' => false,
      'rewrite' => false,
    )
  );
}

function group_by_type($posts) {
  $prioritized = array('featured' => array(), 'standard' => array(), 'third-party' => array());

  foreach($posts as $post) {
    $terms = wp_get_object_terms($post->ID, TYPE_ID, array('fields' => 'slugs'));
    if ( count($terms) < 1 || is_wp_error($terms) ) {
      $prioritized['standard'][] = $post;
    } else {
      foreach( $terms as $term ) {
        if (isset($prioritized[$term])) {
          $prioritized[$term][] = $post;
        } else {
          $prioritized['standard'][] = $post;
        }
      }
    }
  }
  return $prioritized;
}

function home_url() {
  return get_post_type_archive_link( POST_TYPE );
}

function title() {
  $page = get_page_by_path( 'events' );
  $title = $page ? $page->post_title : 'Events';
  return apply_filters( 'the_title', $title );
}

function pre_get_posts(&$wp_query) {
  global $wpdb;
  // show only upcoming events, sorted with soonest first.
  if ( !is_admin() && is_post_type_archive( POST_TYPE ) && $wp_query->is_main_query() ) {


    $meta_query = new \WP_Meta_Query( array(
                                     'relation' => 'OR',
                                     array(
                                         array(
                                           'key' => 'event_expiration',
                                           'compare' => '<=',
                                           'value' => mktime(0, 0, 0) * 1000,
                                           'type' => 'numeric',
                                         ),
                                         array(
                                           'key' => 'event_expiration',
                                           'compare' => '=',
                                           'value' => '',
                                           'type' => 'numeric',
                                         )
                                        )
                                    )
  );
  //$wp_query->set( 'meta_key', 'event_expiration');
    $wp_query->set( 'meta_query', $meta_query);
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

