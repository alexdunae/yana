<?php get_header(); ?>

<section class="home-circles">
  <div class="content">
    <div class="entry entry-0">
      <div class="inner">
        <h2 class="title"><a href="<?php echo get_permalink( get_page_by_path('get-support') ); ?>">Get Support for your Family</a></h2>
        <p>Find out how Y.A.N.A. can help make things easier for your family.</p>
      </div>
    </div>

    <div class="entry entry-1">
      <div class="inner">
        <h2 class="title"><a href="<?php echo get_permalink( get_page_by_path('fundraise') ); ?>">Organize a Fundraiser</a></h2>
        <p>Planning a fundraising event to benefit local families? We can help.</p>
      </div>
    </div>

    <div class="entry entry-2">
      <div class="inner">
        <h2 class="title"><a href="<?php echo get_permalink( get_page_by_path('volunteer') ); ?>">Volunteer with us</a></h2>
        <p>Interested in offering your time to Y.A.N.A.? We’d be happy to have your help.</p>
      </div>
    </div>

    <div class="entry entry-3">
      <div class="inner">
        <h2 class="title"><a href="<?php echo get_permalink( get_page_by_path('donate') ); ?>">Donate to YANA</a></h2>
        <p>We couldn’t help without your help. Learn about the many ways to give.</p>
      </div>
    </div>
  </div>
</section>


<section class="home-intro out-of-body">
  <div class="content">
    <h2 class="title">What is YANA?</h2>
    <p>YANA is a Comox Valley charity offering help to local families who need to travel to access medical treatment for their children.</p>
  </div>
</section>


<article class="site-body has-sidebar" role="main" id="main">
   <div class="content">
   		<?php get_sidebar(); ?>


      <div class="news-toc news-toc-home">
        <?php
          $cat = get_category_by_slug('thanks');
          $posts = get_posts( array( 'numberposts' => 5, 'category' => ('-' . $cat->term_id) ) );
          foreach( $posts as $post ):
            setup_postdata($post);
        ?>
          <div id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
            <?php echo yana_linked_thumbnail($post->ID, 'large'); ?>
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php echo apply_filters('the_content', $post->post_excerpt); ?>
            <p><a href="<?php the_permalink(); ?>">Read more</a></p>
          </div>
  			<?php
          endforeach;
          wp_reset_postdata();
        ?>
      </div>
	</div>
</article>

<?php get_footer();
