<?php get_header(); ?>

<article class="site-body has-sidebar" role="main" id="main">
   <div class="content">
   		<?php get_sidebar(); ?>

			<?php while ( have_posts() ) : the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <?php
            if ( get_post_type() == 'post' ) {
              printf("<p class='dt'>Posted on <time datetime='%s'>%s</time></p>",
                      get_post_time('c', true),
                      get_the_date()
                    );

              printf("<p class='categories'>%s</p>", get_the_category_list(','));
            }
          ?>
          <?php the_excerpt(); ?>
        </div>
			<?php endwhile; ?>
	</div>
</article>

<?php get_footer();
