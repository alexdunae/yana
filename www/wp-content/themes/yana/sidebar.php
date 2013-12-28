<div class="page-sidebar" role="complementary">
	<?php
		if ( $post ) {
			$post_id = $post->ID;
			$ancestors = get_post_ancestors($post_id);

			//$ancestors is an array of post IDs starting with the current post going up the root
			//'Pop' the root ancestor out or returns the current ID if the post has no ancestors.
			$root_id = (!empty($ancestors) ? array_pop($ancestors) : $post_id);

			// TODO: check for children first?
			echo '<nav class="sidebar-nav"><ul>';
			wp_list_pages( array(
				'child_of' => $root_id,
				'depth' => 1, // TODO: what happens if we're on a tertiary page
				'sort_column'  => 'menu_order, post_title',
				'title_li' => false

			) );

			echo '</ul></nav>';
		}
	?>

	<aside class="sidebar-community-quote">
		<blockquote>
			<p>“Y.A.N.A. gave  my parents an apartment to live in near the hospital. Mom and Dad told me that Y.A.N.A. was able to help us because we lived in the Comox Valley, where people cared alot.”</p>
		</blockquote>
	</aside>

	<aside class="sidebar-image-ad">
		<div class="image">
			<img src="<?php echo get_template_directory_uri(); ?>/img/sidebar-share-todo.jpg" width="258" height="213" alt="">
		</div>
		<div class="mask"></div>
		<a class="link" href="#todo">
			<span class="text">Share your story with us</span>
		</a>
	</aside>

	<?php do_action( 'before_sidebar' ); ?>
	<?php // dynamic_sidebar( 'sidebar-1' ) ?>
</div>
