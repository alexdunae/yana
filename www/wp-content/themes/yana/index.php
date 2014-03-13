<?php get_header(); ?>

<article class="site-body" role="main" id="main">
   <div class="content">
   		<?php get_sidebar(); ?>
      <?php get_template_part( 'archives-content-header' ); ?>

      <div class="news-toc">
			<?php
        while ( have_posts() ) : the_post();
          if ( in_category( 'thanks' ) ) {
            get_template_part( 'content', 'thanks' );
          } else {
            get_template_part( 'content', 'news' );
          }
        endwhile;
      ?>
      <?php YANA\news_pagination(); ?>
      </div>
	</div>
</article>

<?php get_footer();
