<?php

namespace YANA;

function linked_thumbnail($post_id, $size = 'post-thumbnail') {
  $img = get_the_post_thumbnail($post_id, $size);
  if ( empty($img) ) {
    return false;
  } else {
    return sprintf("<a href='%s' class='image'>%s</a>", get_permalink($post_id), $img);
  }
}

function get_archive_page_object() {
  $archive_page = null;
  if ( is_tax( \YANA\Events\TYPE_ID ) ) {
    $post_type = get_post_type_object( \YANA\Events\POST_TYPE );
    $archive_page = get_page_by_path( $post_type->rewrite['slug'] );
  } elseif ( $post_type = get_post_type_object( get_query_var( 'post_type' ) ) ) {
    if ( isset( $post_type->rewrite['slug'] ) ) {
      $archive_page = get_page_by_path( $post_type->rewrite['slug'] );
    }
  } elseif ( is_home() || is_archive() ) {
    $archive_page = get_page( get_option( 'page_for_posts' ) );
  }

  return $archive_page;
}
