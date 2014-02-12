<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <img src="<?php echo get_template_directory_uri(); ?>/img/heart.png" width="72" height="64" alt="" class="icon">
  <?php
    // don't truncate 'more' links on thank yous
    echo apply_filters('the_content', $post->post_content);
  ?>
</div>
