<?php

  $archive_page = yana_get_archive_page_object();
  $title = '';

  if ( $archive_page ) {
    $title = $archive_page->post_title;
  }
?>
<header>
  <h1><span itemprop="name"><?php echo apply_filters( 'the_title', $title ); ?></span>
  <?php
    if ( is_archive() ) {
      echo '<br>';
      if ( is_day() ) {
        printf( '<span>%s</span>', get_the_date() );
      } elseif ( is_month() ) {
        printf( '<span>%s</span>', get_the_date( 'F Y ') );
      } elseif ( is_year() ) {
        printf( '<span>%s</span>', get_the_date( 'Y ') );
      } elseif ( is_category() ) {
        printf( '<span>%s</span>', single_cat_title( null, false ) );
      }
    }
  ?>
  </h1>
  <?php
      if ( $archive_page && trim( $archive_page->post_excerpt ) ) {
        printf( "<div class='lede'>%s</div>", apply_filters( 'the_content', $archive_page->post_excerpt ) );
      }
    ?>
</header>
<?php
  if ( $archive_page && trim( $archive_page->post_content ) ) {
    echo apply_filters( 'the_content', $archive_page->post_content );
  }
