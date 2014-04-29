<?php
/*
Template Name: Stories Page
*/
get_header(); ?>

<article class="site-body" role="main" id="main">
   <div class="content">
      <?php get_sidebar(); ?>

      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content', 'page' ); ?>

        <section class="story-toc">
          <?php
            $stories = get_posts(array('post_parent' => $post->ID, 'post_type' => 'page', 'post_status' => 'publish', 'numberposts' => -1));

            foreach ( $stories as $post ) {
              setup_postdata($post);
          ?>
          <div id="post-<?php the_ID(); ?>"  <?php post_class( "entry story" ); ?>>
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php echo YANA\linked_thumbnail($post->ID, 'toc-thumbnail'); ?>
                <?php echo apply_filters('the_content', $post->post_excerpt); ?>
            </div>

          <?php } ?>
      <?php endwhile; ?>
  </div>
</article>

<?php get_footer();
