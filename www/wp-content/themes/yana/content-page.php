<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if (!get_field('masthead_hide_h1', $post_for_masthead->ID)): ?>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>
	<?php endif; ?>

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
