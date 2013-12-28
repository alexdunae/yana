
<?php get_header(); ?>

<article class="site-body has-sidebar" role="main" id="main">
   <div class="content">
      <?php get_sidebar(); ?>

      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content', get_post_type() ); ?>
      <?php endwhile; ?>
  </div>
</article>

<?php get_footer();
