<?php
    if (get_post_type() == YANA\Events\POST_TYPE) {
      $archive = YANA\get_archive_page_object();
      echo '<nav class="sidebar-nav"><ul>';
      printf("<li><a href='%s'>%s</a></li>", get_permalink($archive), apply_filters('the_title', $archive->post_title));

      $events = YANA\Events\get_posts_by_types( array('featured', 'standard') );
      foreach ( $events as $event ) {
        printf("<li><a href='%s'>%s</a></li>", get_permalink($event), apply_filters('the_title', $event->post_title));
      }


      echo '</ul></nav>';
    } elseif ( is_home() || is_archive() || get_post_type() == 'post' ) {
      echo '<nav class="sidebar-nav"><ul>';
      wp_list_categories( array (
                         'title_li' => false,
                         'depth' => 1
                         ) );
      echo '</ul></nav>';

    } elseif ( $post && !is_front_page()) {
      $post_id = $post->ID;
      $ancestors = get_post_ancestors($post_id);

      //$ancestors is an array of post IDs starting with the current post going up the root
      //'Pop' the root ancestor out or returns the current ID if the post has no ancestors.
      $root_id = (!empty($ancestors) ? array_pop($ancestors) : $post_id);
      $root = get_post($root_id);

      $links = wp_list_pages( array(
        'child_of' => $root_id,
        'depth' => 1, // TODO: what happens if we're on a tertiary page
        'sort_column'  => 'menu_order, post_title',
        'title_li' => false,
        'echo' => false
      ) );

      // if there are children then print them along with the parent
      if ( $links && !empty($links) ) {
        echo '<nav class="sidebar-nav"><ul>';
        printf("<li><a href='%s'>%s</a></li>", get_permalink($root), apply_filters('the_title', $root->post_title));
        echo $links;
        echo '</ul></nav>';
      }
    }
