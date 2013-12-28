<?php get_header(); ?>

<article class="site-body has-sidebar" role="main" id="main">
   <div class="content">
      <?php get_sidebar(); ?>
      <?php get_template_part( 'archives-content-header' ); ?>

      <?php
        $prioritized = array(array(), array(), array());

        foreach($wp_query->posts as $post) {
          $meta = YANA\Events\meta($post->ID);
          $prioritized[intval($meta['priority'])][] = $post;
        }


        foreach ( $prioritized as $level => $posts ) {

          printf("<div class='event-toc event-toc-%d'>", $level);

          foreach( $posts as $post ):
              setup_postdata($post);
          ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class( "priority-$level" ); ?>>
              <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <?php the_excerpt(); ?>
              <p><a class="btn" href="<?php the_permalink(); ?>">More details</a></p>
            </div>

          <?php

          endforeach;
          echo '</div>';
        }
      ?>
  </div>
</article>
<?php get_footer();





