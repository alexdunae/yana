
      <a href="#page" class="skip-link">Back to the top</a>

      <footer class="site-footer" role="supplemental">
        <div class="content">
          <section class="footer-about">
            <div class="logo">You Are Not Alone</div>
            <p>YANA provides accommodation and funding to Comox Valley families who need to travel outside the community for medical treatment for a child under 19 or for an expecting mother.</p>
            <p><a href="<?php echo YANA\FACEBOOK_URL; ?>">Connect with us on Facebook</a></p>

            <section class="footer-enews enews">
              <form method="POST" action="http://dialogue.dialect.ca/t/y/s/qtjhrt/">
                <label for="footer-enews-email">Subscribe for updates:</label>
                <div class="controls">
                  <input type="email" name="cm-qtjhrt-qtjhrt" id="footer-enews-email" placeholder="Your email address" required>
                  <button type="submit">Submit</button>
                </div>
                <p class="note">We're still setting up newsletter program; we hope to begin sharing regular updates by email soon.</p>
              </form>
            </section>
            <p class="credits">Most photography courtesy of <a href="http://www.mckinnonphotography.com/">McKinnon Photography</a><br><a href="http://dialect.ca/">Website by Dialect</a></p>

            <?php // TODO: <p><a href="#" class="toggle-contrast">Toggle high colour contrast mode</a></p> ?>
          </section>
          <section class="footer-nav">
            <div class='tel'><span class='icon icon-phone'></span> <span class='label'>Call us at 250-871-0343</span></div>
            <?php wp_nav_menu( array( 'theme_location' => 'primary-footer', 'container_class' => 'nav primary' ) ); ?>
            <?php wp_nav_menu( array( 'theme_location' => 'secondary-footer', 'container_class' => 'nav secondary' ) ); ?>
            <?php wp_nav_menu( array( 'theme_location' => 'tertiary-footer', 'container_class' => 'nav tertiary' ) ); ?>
          </section>
          <a href="#page" class="back-to-top">Back to the top</a>

        </div>
      </footer>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>
