<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php
			if ( get_post_type() == 'post' ) {
				printf("<p class='dt'>Posted on <time datetime='%s'>%s</time></p>",
								get_post_time('c', true),
								get_the_date()
							);

				printf("<p class='categories'>%s</p>", get_the_category_list(','));
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
