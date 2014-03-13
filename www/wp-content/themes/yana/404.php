<?php get_header(); ?>

<article class="site-body" role="main" id="main">
   <div class="content">
   		<?php get_sidebar(); ?>

			<div id="post-error-404" class="error-page">
				<pre><?php var_dump($wp_query); ?>
				<header class="entry-header">
					<h1 class="entry-title">Web page not found</h1>
				</header>

				<div class="entry-content">
					<p>Unfortunately we couldn't find the page you were looking for.  Sorry.</p>

					<p>Try using the links above the get back on your way.</p>
				</div>
			</div>

	</div>
</article>

<?php get_footer();
