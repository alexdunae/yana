<?php
	$cat = get_category_by_slug('thanks');
	$link = get_category_link($cat->cat_ID);

	if ( $cat ) {
		$thankyous = get_posts( array(
		                       'category' => $cat->term_id,
		                       'numberposts' => 5 ) );


		if (count($thankyous) > 0) {
			$count = 0;
			echo '<section class="sidebar-thank-yous"><div class="frame"><div class="inner"><div class="title-wrap"><h4 class="title"><a href="' .
					$link .
					'"><span class="logo">YANA</span> <span class="text">Thank Yous</span></a></h4></div><ul>';

			foreach( $thankyous as $thanks ) {
				$count++;
				printf("<li class='entry-%d'><a href='%s'>%s</a></li>", $count, $link, esc_html($thanks->post_excerpt));
			}

			echo '</ul></div></div></section>';
		}
}
