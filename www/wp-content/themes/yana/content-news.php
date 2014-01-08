<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  <?php
    if ( get_post_type() == 'post' ) {
      printf("<p class='dt'>Posted by %s on <time datetime='%s'>%s</time></p>",
              get_the_author_link(),
              get_post_time('c', true),
              get_the_date()
            );
    }
  ?>
  <?php the_content('Read more'); ?>
</div>
