<?php get_header(); ?>

<article class="site-body" role="main" id="main">
   <div class="content">
      <?php get_sidebar(); ?>
      <?php get_template_part( 'archives-content-header' ); ?>

      <?php
        $prioritized = array(array(), array(), array());

        foreach($wp_query->posts as $post) {
          //$meta = YANA\Events\meta($post->ID);
          $meta['priority'] = 1;
          $prioritized[intval($meta['priority'])][] = $post;
        }


        foreach ( $prioritized as $level => $posts ) {

          printf("<div class='event-toc event-toc-%d'>", $level);

          foreach( $posts as $post ):
              setup_postdata($post);
          ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class( "entry priority-$level" ); ?>>
              <?php if($level == 0): ?>
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php echo YANA\linked_thumbnail($post->ID, 'event-wide-thumbnail'); ?>
              <?php elseif($level == 1): ?>
                <?php echo YANA\linked_thumbnail($post->ID, 'post-thumbnail'); ?>
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <?php else: ?>
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
              <?php endif; ?>

              <?php echo apply_filters('the_content', $post->post_excerpt); ?>

              <?php if($level == 0): ?>
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





