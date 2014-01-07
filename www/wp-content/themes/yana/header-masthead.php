<?php
  $post_for_masthead = false;

  if ( is_archive() ) {
    $post_for_masthead = YANA\get_archive_page_object();
  }

  if ( !$post_for_masthead ) {
    $post_for_masthead = $post;
  }

  if ( $post_for_masthead ) {
    $image_id = get_field('masthead_image', $post_for_masthead->ID);
    $vignette_id = get_field('masthead_vignette', $post_for_masthead->ID);

    // need either an image or vignette
    if ( $image_id || $vignette_id ) {
      $style = '';
      $vignette = '';

      if ( $image_id ) {
        $image = wp_get_attachment_image_src($image_id, 'post-masthead-image');
        $style = sprintf("background-image: url('%s');", esc_attr($image[0]));
      }

      if ($bg_color = get_field('masthead_background', $post_for_masthead->ID)) {
        $style .= sprintf("background-color: %s", esc_attr($bg_color));
      }

      if ( $vignette_id ) {
        $vignette = sprintf("<div class='vignette'><div class='content'>%s</div></div>", wp_get_attachment_image($vignette_id, 'post-masthead-vignette', false, array('alt' => '', 'aria-hidden' => 'true')));
      }

      echo "<section class='masthead' style=\"$style\">$vignette";

      $headline = apply_filters( 'the_title', get_field('masthead_headline', $post_for_masthead->ID) );
      $text = apply_filters( 'the_content', get_field('masthead_text', $post_for_masthead->ID) );
      echo "<div class='content'>";
      printf("<div class='text-wrap'><div class='text'><h1 class='masthead-title'>%s</h1>%s</div></div>", $headline, $text);
      echo '</div>';

      echo '</section>';
    }
  }
