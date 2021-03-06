<?php
  get_header(); ?>

<article class="site-body" role="main" id="main">
   <div class="content">
   		<?php get_sidebar(); ?>
      <header>
        <h1><?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
              printf( '%s', get_the_author() );

            endif;

						if ( is_day() ) :
              printf( '<br><span>%s</span>', get_the_date() );
						elseif ( is_month() ) :
							printf( '<br><span>%s</span>', get_the_date( 'F Y') );
						elseif ( is_year() ) :
							printf( '<br><span>%s</span>', get_the_date( 'Y') );
						endif;
					?>
        </h1>
        <?php
        $term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="lede">%s</div>', apply_filters( 'the_content', $term_description ) );
					endif;
        ?>
      </header>

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
      </div>

      <?php YANA\news_pagination(); ?>
	</div>
</article>

<?php get_footer();

