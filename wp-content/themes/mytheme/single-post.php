<?php get_header(); ?>

<?php 
// If the post has a featured image, use it as a hero banner background:
if ( has_post_thumbnail() ) {
    $featured_image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
} else {
    // Fallback image if no featured image is set
    $featured_image_url = get_stylesheet_directory_uri() . '/images/hero-placeholder.jpg';
}
?>

<!-- Hero Section -->
<div class="post-hero" style="
  background: url('<?php echo esc_url( $featured_image_url ); ?>') center center / cover no-repeat; 
  height: 300px; 
  display: flex; 
  align-items: center; 
  justify-content: center;
">
  <h1 style="color: #fff; font-size: 2.5rem; margin: 0;">
    <?php the_title(); ?>
  </h1>
</div>

<div class="container my-5">
  <div class="row">
    <!-- Main Column: Post Content -->
    <div class="col-md-8">
      <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
          <div class="single-post-content">
            <h2 class="mb-4 text-center"><?php the_title(); ?></h2>
            <?php the_content(); ?>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
      
      <!-- FAQs Section: Two FAQ posts side by side -->
      <div class="faqs-section mt-5">
        <div class="row">
          <?php
            // Query exactly 2 FAQ posts
            $faq_args = array(
              'post_type'      => 'faq',
              'posts_per_page' => 2,
            );
            $faq_query = new WP_Query( $faq_args );

            if ( $faq_query->have_posts() ) :
              while ( $faq_query->have_posts() ) : $faq_query->the_post(); ?>
                
                <div class="col-md-6 mb-4">
                  <div class="faq-item" style="border: 1px solid #ccc; background-color: #fff;">
                    <!-- FAQ Heading -->
                    <h3 style="
                      background-color: #9AAD3B; 
                      padding: 10px; 
                      margin: 0; 
                      font-size: 1.1rem;
                      color: #fff;
                    ">
                      <?php the_title(); ?>
                    </h3>
                    <!-- FAQ Content -->
                    <div class="p-3">
                      <?php the_content(); ?>
                    </div>
                  </div>
                </div>

              <?php endwhile;
              wp_reset_postdata();
            else :
              echo '<p>No FAQs found.</p>';
            endif;
          ?>
        </div>
      </div>
    </div>
    
    <!-- Sidebar with Categories -->
    <div class="col-md-4">
      <aside style="">
        <h3></h3>
        <ul class="list-unstyled">
          <?php 
            wp_list_categories( array(
              'title_li' => '',
            ) );
          ?>
        </ul>
      </aside>
    </div>
  </div>
</div>

<?php get_footer(); ?>
