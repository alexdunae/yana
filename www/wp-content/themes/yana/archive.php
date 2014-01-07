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
							printf( __( 'Author: %s', 'yana' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( 'Day: %s', 'yana' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Month: %s', 'yana' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'yana' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Year: %s', 'yana' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'yana' ) ) . '</span>' );

						else :
							_e( 'Archives', 'yana' );

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

