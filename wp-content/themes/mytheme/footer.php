<footer class="site-footer py-5 bg-dark text-light">
  <div class="container">
    <div class="row">
      
      <!-- Blurb Column -->
      <div class="col-md-4 mb-4 mb-md-0">
        <h5>Blurb:</h5>
        <?php
          $options = get_option('customtheme_options');
          $blurb   = ! empty( $options['blurb'] ) ? $options['blurb'] : 'Lorem ipsum dolor sit amet...';
          echo '<p>' . esc_html( $blurb ) . '</p>';
        ?>
      </div>
      
      <!-- Company Info Column -->
      <div class="col-md-4 mb-4 mb-md-0">
        <h5>Company Title</h5>
        <?php
          $company_name    = ! empty( $options['company_name'] ) ? $options['company_name'] : get_bloginfo('name');
          $company_address = ! empty( $options['company_address'] ) ? $options['company_address'] : 'Address not set';
        ?>
        <p><strong><?php echo esc_html( $company_name ); ?></strong></p>
        <p><?php echo esc_html( $company_address ); ?></p>
      </div>
      
      <!-- Contact / Social Column -->
      <div class="col-md-4">
        <h5>Contact</h5>
        <?php
          $email       = ! empty( $options['email'] ) ? $options['email'] : '';
          $telephone   = ! empty( $options['telephone'] ) ? $options['telephone'] : '';
          $social      = ! empty( $options['social_links'] ) ? $options['social_links'] : '';
        ?>
        <p><strong>Email:</strong> <?php echo esc_html( $email ); ?></p>
        <p><strong>Tel:</strong> <?php echo esc_html( $telephone ); ?></p>
        
        <?php if ( $social ) : ?>
          <p><strong>Social:</strong> <?php echo esc_html( $social ); ?></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
  
  <div class="footer-bottom text-center mt-4">
    <p class="mb-0">
      &copy; <?php echo date('Y'); ?> <?php echo esc_html( $company_name ); ?>. 
      All Rights Reserved.
    </p>
  </div>
  
  <?php wp_footer(); ?>
</footer>
</body>
</html>
