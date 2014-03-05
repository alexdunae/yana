<?php get_header(); ?>

<article class="site-body" role="main" id="main">
   <div class="content">
      <?php get_sidebar(); ?>

      <header>
        <h1><span itemprop="name"><?php single_cat_title(); ?></span></h1>
      </header>

      <?php
        printf("<div class='toc-intro'>%s</div>", category_description());

        echo "<div class='event-toc event-toc-third-party'>";
        while ( have_posts() ) : the_post();
          get_template_part( 'toc', 'yana-event' );
        endwhile;
        echo '</div>';
      ?>
  </div>
</article>
<?php get_footer();
