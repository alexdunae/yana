
      <a href="#page" class="skip-link">Back to the top</a>

      <footer class="site-footer" role="supplemental">
        <div class="content">
          <section class="footer-about">
            <div class="logo">You Are Not Alone</div>
            <p>YANA provides accommodation and funding to Comox Valley families who need to travel outside the community for medical treatment for a child under 19 or for an expecting mother.</p>
            <p><a href="<?php echo YANA\FACEBOOK_URL; ?>">Connect with us on Facebook</a></p>

            <section class="footer-enews enews">
              <label for="footer-enews-email">Subcribe for updates:</label>
              <div class="controls">
                <input type="email" name="email" id="footer-enews-email" placeholder="Your email address">
                <button type="submit">Submit</button>
              </div>
            </section>
            <?php // TODO: <p><a href="#" class="toggle-contrast">Toggle high colour contrast mode</a></p> ?>
          </section>
          <section class="footer-nav">
            <?php wp_nav_menu( array( 'theme_location' => 'primary-footer', 'container_class' => 'nav primary' ) ); ?>
            <?php wp_nav_menu( array( 'theme_location' => 'secondary-footer', 'container_class' => 'nav secondary' ) ); ?>
            <?php wp_nav_menu( array( 'theme_location' => 'tertiary-footer', 'container_class' => 'nav tertiary' ) ); ?>
          </section>
        </div>
      </footer>

    </div>
    <?php do_action( 'yana_credits' ); ?>
    <?php wp_footer(); ?>
  </body>
</html>
