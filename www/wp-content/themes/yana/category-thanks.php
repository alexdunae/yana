<?php
  $cat = get_category_by_slug('thanks');
  get_header(); ?>

<article class="site-body" role="main" id="main">
   <div class="content">
   		<?php get_sidebar(); ?>


      <header>
        <h1><span itemprop="name"><?php echo apply_filters( 'the_title', $cat->name ); ?></span>
        <?php
          if ( is_day() ) {
            printf( '<span>%s</span>', get_the_date() );
          } elseif ( is_month() ) {
            printf( '<span>%s</span>', get_the_date( 'F Y ') );
          } elseif ( is_year() ) {
            printf( '<span>%s</span>', get_the_date( 'Y ') );
          }
        ?>
        </h1>
        <?php
            if ( $cat && trim( $cat->description ) ) {
              printf( "<div class='lede'>%s</div>", apply_filters( 'the_content', $cat->description ) );
            }
          ?>
      </header>


      <div class="post-toc">
  			<?php while ( have_posts() ) : the_post(); ?>
          <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_excerpt(); ?>
          </div>
  			<?php endwhile; ?>
      </div>

      <?php previous_posts_link(); ?>
      <?php next_posts_link(); ?>

	</div>
</article>

<?php get_footer();
