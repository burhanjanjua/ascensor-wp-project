<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
  <div class="container d-flex justify-content-between align-items-center py-3">
    <!-- Company Name (Logo Area) -->
    <div class="site-branding">
      <a href="<?php echo home_url(); ?>" class="site-title">
        <?php
          // If you have a theme option for Company Name, you can use that:
          $options = get_option('customtheme_options');
          $company_name = ! empty( $options['company_name'] ) ? $options['company_name'] : get_bloginfo('name');
          echo esc_html( $company_name );
        ?>
      </a>
    </div>
    
    <!-- Navigation Menu -->
    <nav class="site-navigation">
      <?php
        wp_nav_menu( array(
          'theme_location'  => 'primary',
          'menu_class'      => 'nav',
          'container'       => false,
          'fallback_cb'     => false,
        ) );
      ?>
    </nav>
  </div>
</header>
