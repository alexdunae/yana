<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if (!get_field('masthead_hide_h1', $post->ID)): ?>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>
  <?php endif; ?>

  <?php
    if ( $info = get_field('event_information', $post->ID) ) {
      printf("<aside class='event-info'><h2 class='title'>Event Details</h4><div class='inner'>%s</div></aside>", apply_filters('the_content', $info));
    }
   ?>

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
