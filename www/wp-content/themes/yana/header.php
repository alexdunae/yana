<!DOCTYPE html>
<!--[if lt IE 7]> <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7" id="ie6"> <![endif]-->
<!--[if IE 7]>    <html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8" id="ie7"> <![endif]-->
<!--[if IE 8]>    <html <?php language_attributes(); ?> class="no-js lt-ie9" id="ie8"> <![endif]-->
<!--[if gt IE 8]><!-->
<html <?php language_attributes(); ?>lang="en">
<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

		<?php wp_head(); ?>
	</head>
<body <?php body_class(); ?>>
  <a href="#main" class="skip-link">Skip to main content</a>
    <div class="page" id="page">
    	<?php do_action( 'before' ); ?>
      <header class='site-header' role='banner'>
        <div class='content'>
          <div class='logo'><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">YANA Comox Valley</a></div>
          <!-- TODO: nested roles allowed? -->
          <nav class='site-nav' role='navigation'>
            <div class="primary-nav">
            	<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
            </div>

            <div class="secondary-nav">
              <div class="inner secondary-content">
              	<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
                <span class="badge"><a class="icon-badge facebook-badge" href="<?php echo YANA\FACEBOOK_URL; ?>"><span aria-hidden="true" class="icon icon-facebook"></span><span class="label">Facebook</span></a></span>
              </div>
            </div>
          </nav>
        </div>
      </header>
      <?php get_template_part( 'header', 'masthead' ); ?>

