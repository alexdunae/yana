
<div class="page-sidebar" role="complementary">
	<?php if (is_front_page() ): ?>
		<?php get_template_part( 'sidebar', 'events-ad' ); ?>

		<?php get_template_part( 'sidebar', 'facebook' ); ?>

		<?php include('widget-signup.php'); ?>

		<?php get_template_part( 'sidebar', 'thank-yous' ); ?>

	<?php else: ?>
		<?php get_template_part( 'sidebar', 'nav' ); ?>

		<aside class="sidebar-community-quote">
			<blockquote>
				<p>“<span class="text">Y.A.N.A. gave my parents an apartment to live in near the hospital. Mom and Dad told me that Y.A.N.A. was able to help us because we lived in the Comox Valley, where people cared alot.</span>”</p>
			</blockquote>
		</aside>

		<?php get_template_part( 'sidebar', 'story-ad' ); ?>
	<?php endif; ?>
</div>
