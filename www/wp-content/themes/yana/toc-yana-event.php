<?php
  $level = '';

  $terms = wp_get_object_terms($post->ID, YANA\Events\TYPE_ID, array( 'fields' => 'slugs' ) );

  if ( is_array($terms) && count($terms) > 0 ) {
    $level = $terms[0];
  }
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( "entry priority-$level" ); ?>>
  <?php if($level == 'featured'): ?>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php echo YANA\linked_thumbnail($post->ID, 'large'); ?>
  <?php elseif($level == 'third-party'): ?>
    <h2 class="entry-title"><?php the_title(); ?></h2>
  <?php else: ?>
    <?php echo YANA\linked_thumbnail($post->ID, 'toc-thumbnail'); ?>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  <?php endif; ?>

  <?php echo apply_filters('the_content', $post->post_excerpt); ?>

  <?php if($level == 'featured'): ?>
    <p><a class="btn" href="<?php the_permalink(); ?>">More details</a></p>
  <?php endif; ?>
</div>
