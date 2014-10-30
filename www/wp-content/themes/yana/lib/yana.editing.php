<?php

namespace YANA;

add_action( 'init', 'YANA\editor_style' );
add_filter( 'img_caption_shortcode_width', function ( $w, $a, $c ) { return ''; }, 10, 3 );
add_filter( 'mce_buttons', 'YANA\style_select' );
add_filter( 'tiny_mce_before_init', 'YANA\styles_dropdown' );
add_filter( 'image_size_names_choose', 'YANA\insertable_image_sizes' );
add_action( 'admin_enqueue_scripts', 'YANA\admin_fonts_enqueue' );

function editor_style() {
  add_editor_style( 'editor-style.css' );
}


function admin_fonts_enqueue($hook) {
  if ($hook !== 'post.php' && $hook !== 'post-new.php') {
    return;
  }
  wp_enqueue_script( 'yana_admin_fonts', 'https://fast.fonts.net/jsapi/014930c9-fd65-4ba8-a0d8-c9968ba08138.js?v=2', false, false, false );
}


function insertable_image_sizes($sizes) {
   unset( $sizes['thumbnail']);
   unset( $sizes['medium'] );
   unset( $sizes['full'] );
   return $sizes;
}

function style_select( $buttons ) {
  array_unshift( $buttons, 'styleselect' );
  return $buttons;
}

function styles_dropdown( $settings ) {
  $styles = array(
    array( 'title' => 'Regular paragraph',  'format' => 'p', 'classes' => 'p1'),
    array( 'title' => 'Heading 1',  'format' => 'h1' ),
    array( 'title' => 'Heading 2',  'format' => 'h2' ),
    array( 'title' => 'Heading 3',  'format' => 'h3' ),
    array( 'title' => 'Heading 4',  'format' => 'h4' ),
    array( 'title' => 'Button',  'block' => 'div', 'classes' => 'editor-btn')
  );

  $settings['style_formats_merge'] = false;
  $settings['style_formats'] = json_encode( $styles );
  return $settings;
}
