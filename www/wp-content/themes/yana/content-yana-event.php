<?php
  $meta = YANA\Events\meta($post->ID);
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( "priority-${meta['priority']}"); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

    <?php
	    if ($meta['general_info'] && !empty($meta['general_info'])) {
	      printf("<section class='event-info'>%s</section>", apply_filters('the_content', $meta['general_info']));
	    }
     ?>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">Pages:',
				'after'  => '</div>',
			) );
		?>
	</div>
</div>
