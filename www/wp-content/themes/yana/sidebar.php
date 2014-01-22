
<div class="page-sidebar" role="complementary">
	<?php
		if (get_post_type() == YANA\Events\POST_TYPE) {
			$archive = YANA\get_archive_page_object();
			echo '<nav class="sidebar-nav"><ul>';
			printf("<li><a href='%s'>%s</a></li>", get_permalink($archive), apply_filters('the_title', $archive->post_title));

			$events = YANA\Events\get_posts_by_types( array('featured', 'standard') );
			foreach ( $events as $event ) {
				printf("<li><a href='%s'>%s</a></li>", get_permalink($event), apply_filters('the_title', $event->post_title));
			}


			echo '</ul></nav>';
		} elseif ( is_home() || is_archive() || get_post_type() == 'post' ) {
			echo '<nav class="sidebar-nav"><ul>';
			wp_list_categories( array (
			                   'title_li' => false,
			                   'depth' => 1
			                   ) );
			echo '</ul></nav>';

		} elseif ( $post && !is_front_page()) {
			$post_id = $post->ID;
			$ancestors = get_post_ancestors($post_id);

			//$ancestors is an array of post IDs starting with the current post going up the root
			//'Pop' the root ancestor out or returns the current ID if the post has no ancestors.
			$root_id = (!empty($ancestors) ? array_pop($ancestors) : $post_id);
			$root = get_post($root_id);

			$links = wp_list_pages( array(
				'child_of' => $root_id,
				'depth' => 1, // TODO: what happens if we're on a tertiary page
				'sort_column'  => 'menu_order, post_title',
				'title_li' => false,
				'echo' => false
			) );

			// if there are children then print them along with the parent
			if ( $links && !empty($links) ) {
				echo '<nav class="sidebar-nav"><ul>';
				printf("<li><a href='%s'>%s</a></li>", get_permalink($root), apply_filters('the_title', $root->post_title));
				echo $links;
				echo '</ul></nav>';
			}
		}
	?>

	<?php if (is_front_page() ): ?>
	<aside class="sidebar-facebook-ad">
		<a class="frame" href='<?php echo YANA\FACEBOOK_URL; ?>'>
			<span class="inner">
				Connect with us on Facebook
			</span>
		</a>
	</aside>

	<?php
		include('widget-signup.php');
	?>

	<?php
		include('widget-thank-yous.php');
	?>

	<?php endif; ?>

	<aside class="sidebar-community-quote">
		<blockquote>
			<p>“<span class="text">Y.A.N.A. gave my parents an apartment to live in near the hospital. Mom and Dad told me that Y.A.N.A. was able to help us because we lived in the Comox Valley, where people cared alot.</span>”</p>
		</blockquote>
	</aside>

	<aside class="sidebar-image-ad">
		<div class="image">
			<img src="<?php echo get_template_directory_uri(); ?>/img/share-ad.jpg" width="258" height="213" alt="">
		</div>
		<!-- TODO <div class="mask"></div> -->
		<a class="link" href="#todo">
			<span class="text">Share your story with us</span>
		</a>
	</aside>

	<?php do_action( 'before_sidebar' ); ?>
	<?php // dynamic_sidebar( 'sidebar-1' ) ?>
</div>
