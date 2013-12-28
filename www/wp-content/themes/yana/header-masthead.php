<?php
  if ( $post ) {

    //$image = MultiPostThumbnails::get_the_post_thumbnail(get_post_type(), 'masthead-image', NULL,  'post-masthead-image-thumbnail');

    $image_id = MultiPostThumbnails::get_post_thumbnail_id(get_post_type(), 'masthead-image', $post->ID);
    if ( $image_id ) {
      $image = wp_get_attachment_image_src($image_id, 'post-secondary-image-thumbnail');
      printf("<section class='masthead' style='background-image: url(\"%s\");'>", esc_attr($image[0]));
      echo '<span class="mask"></span>';
      echo '<span class="bar bar-top"></span>';
      echo '<span class="bar bar-bottom"></span>';



      $attachment = get_post($image_id);
      $title = apply_filters( 'the_title', $attachment->post_title );
      $summary = apply_filters( 'the_content', $attachment->post_excerpt );
      echo "<div class='content'>";
      printf("<div class='text-wrap'><div class='text'><h1>%s</h1>%s</div></div>", $title, $summary);
      echo '</div>';

      echo '</section>';
    }
  }
?>
