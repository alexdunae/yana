<?php get_header(); ?>

<article class="site-body" role="main" id="main">
   <div class="content">
      <?php get_sidebar(); ?>
      <?php get_template_part( 'archives-content-header' ); ?>

      <?php
        $prioritized = YANA\Events\group_by_type($wp_query->posts);

        foreach ( $prioritized as $level => $posts ) {
          if ( $level == 'third-party' ) {
            continue;
          }
          printf("<div class='event-toc event-toc-%s'>", $level);

          $term = get_term_by( 'slug', $level, YANA\Events\TYPE_ID, OBJECT );

          if ( $term && !empty($term->description) ) {
            printf("<div class='toc-intro'>%s</div>", apply_filters('the_content', $term->description));
          }

          $post_ids = array();

          foreach( $posts as $post ):
            setup_postdata($post);

            // avoid duplicates within a single level
            if (in_array($post->ID, $post_ids)) {
              continue;
            }
            $post_ids[] = $post->ID;
            get_template_part( 'toc', 'yana-event' );

          endforeach;
          wp_reset_postdata();

          echo '</div>';
        }
        printf("<p><a class='btn' href='%s'>Community Led Events</a></p>", get_term_link('third-party', YANA\Events\TYPE_ID));
      ?>
  </div>
</article>
<?php get_footer();





