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
    <script src="https://fast.fonts.net/jsapi/014930c9-fd65-4ba8-a0d8-c9968ba08138.js?v=2"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr.js"></script>
		<?php wp_head(); ?>
	</head>
<body <?php body_class(); ?>>
  <a href="#main" class="skip-link">Skip to main content</a>
    <div class="page" id="page">
    	<?php do_action( 'before' ); ?>
      <header class='site-header' role='banner'>
        <div class='content'>
          <div class='logo'><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">YANA Comox Valley</a></div>
          <a class="icon icon-nav nav-toggle" href="#"></a>
          <!-- TODO: nested roles allowed? -->

          <nav class='site-nav' role='navigation'>
            <div class="primary-nav">
            	<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
            </div>

            <div class="secondary-nav">
              <div class="inner secondary-content">
                <div class="links">
                	<?php wp_nav_menu( array( 'theme_location' => 'secondary', 'container' => false ) ); ?>
                  <span class="badge"><a class="icon-badge facebook-badge" href="<?php echo YANA\FACEBOOK_URL; ?>"><span aria-hidden="true" class="icon icon-facebook"></span><span class="label">Facebook</span></a></span>
                </div>
              </div>
            </div>
          </nav>
        </div>
      </header>

      <?php get_template_part( 'header', 'masthead' ); ?>

