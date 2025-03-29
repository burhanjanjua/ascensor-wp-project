<?php
/**
 * Template Name: Front Page
 */
get_header();

// Get theme options if needed
$options       = get_option('customtheme_options');
$company_name  = ! empty( $options['company_name'] ) ? $options['company_name'] : get_bloginfo('name');
?>

<!-- Hero Section -->
<div class="hero-section" style="position: relative; text-align: center;">
  <div class="hero-background" 
       style="
         background: url('http://custom.21degrees.digital/wp-content/uploads/2025/03/view-of-the-mountains-reflected-in-a-lake-with-bir-2025-03-24-05-51-17-utc-1-1.jpg') center center / cover no-repeat; 
         height: 512px;
         display: flex;
         align-items: center;
         justify-content: center;
       ">
    <h1 style="color: #fff; font-size: 3rem;">
      <?php echo esc_html( $company_name ); ?>
    </h1>
  </div>
</div>

<!-- Main Content Section -->
<div class="container my-5">
  <h2 class="text-center mb-5">Content Example</h2>
  
  <div class="row">
    <!-- Example Column 1 -->
    <div class="col-md-4 text-center">
      <img src="http://custom.21degrees.digital/wp-content/uploads/2025/03/forest-with-bright-sun-shining-through-the-trees-c-2025-03-05-16-53-21-utc-1-1.jpg" alt="Example 1" class="img-fluid mb-3">
      <h3>Example Text</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vel urna eget justo imperdiet finibus.</p>
    </div>
    
    <!-- Example Column 2 -->
    <div class="col-md-4 text-center">
      <img src="http://custom.21degrees.digital/wp-content/uploads/2025/03/flying-over-an-green-empty-field-2025-01-29-05-47-22-utc-1-1.jpg" alt="Example 2" class="img-fluid mb-3">
      <h3>Example Text</h3>
      <p>Aliquam erat volutpat. Nam ac vulputate arcu, sit amet lobortis neque. Pellentesque habitant morbi tristique.</p>
    </div>
    
    <!-- Example Column 3 -->
    <div class="col-md-4 text-center">
      <img src="http://custom.21degrees.digital/wp-content/uploads/2025/03/a-photo-of-green-and-lush-forest-2025-02-24-21-03-49-utc-1-1.jpg" alt="Example 3" class="img-fluid mb-3">
      <h3>Example Text</h3>
      <p>Morbi dictum nisi id quam semper, a pretium ligula tempor. Maecenas convallis enim vel elit egestas.</p>
    </div>
  </div>
</div>

<?php get_footer(); ?>
