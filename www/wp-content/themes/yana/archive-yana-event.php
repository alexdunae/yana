<?php get_header(); ?>

<article class="site-body" role="main" id="main">
   <div class="content">
      <?php get_sidebar(); ?>
      <?php get_template_part( 'archives-content-header' ); ?>

      <?php
        $prioritized = YANA\Events\group_by_type($wp_query->posts);

        foreach ( $prioritized as $level => $posts ) {
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

          ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class( "entry priority-$level" ); ?>>
              <?php if($level == 'featured'): ?>
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php echo YANA\linked_thumbnail($post->ID, 'toc-thumbnail'); ?>
              <?php elseif($level == 'third-party'): ?>
                <h2 class="entry-title"><?php the_title(); ?></h2>
              <?php else: ?>
                <?php echo YANA\linked_thumbnail($post->ID, 'post-thumbnail'); ?>
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <?php endif; ?>

              <?php echo apply_filters('the_content', $post->post_excerpt); ?>

              <?php if($level == 'featured'): ?>
                <p><a class="btn" href="<?php the_permalink(); ?>">More details</a></p>
              <?php endif; ?>
            </div>

          <?php

          endforeach;
          wp_reset_postdata();
          echo '</div>';
        }
      ?>
  </div>
</article>
<?php get_footer();





