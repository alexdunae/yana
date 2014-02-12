
<?php get_header(); ?>

<article class="site-body" role="main" id="main">
   <div class="content">
      <?php get_sidebar(); ?>

      <?php while ( have_posts() ) : the_post(); ?>
      <?php
        if ( in_category( 'thanks' ) ) {
            get_template_part( 'content', 'thanks' );
          } else {
            get_template_part( 'content', 'news' );
          }
      ?>
      <?php endwhile; ?>
  </div>
</article>

<?php get_footer();
