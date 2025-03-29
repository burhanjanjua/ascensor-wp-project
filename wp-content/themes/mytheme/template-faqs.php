<?php
/*
Template Name: FAQs Page
*/

get_header(); 
?>
<div class="faq-hero" style="
  background: url('http://custom.21degrees.digital/wp-content/uploads/2025/03/a-photo-of-green-and-lush-forest-2025-02-24-21-03-49-utc-1-1.jpg') 
              center center / cover no-repeat;
  height: 250px; 
  display: flex; 
  align-items: center; 
  justify-content: center;
">
  <h1 style="color: #fff; font-size: 3rem; margin: 0;">
    FAQs
  </h1>
</div>

<div class="container my-5">
  
  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <div class="faq-intro text-center mb-5">
        <h2><?php the_title(); ?></h2>
        <?php the_content(); ?>
      </div>
    <?php endwhile; ?>
  <?php endif; ?>

  <?php
    $faq_args = array(
      'post_type'      => 'faq',
      'posts_per_page' => -1,
      'orderby'        => 'date',
      'order'          => 'DESC',
    );
    $faq_query = new WP_Query( $faq_args );
  ?>

  <?php if ( $faq_query->have_posts() ) : ?>
    <div class="row">
      <?php while ( $faq_query->have_posts() ) : $faq_query->the_post(); ?>
        <div class="col-md-6 mb-4">
          <div class="faq-item" style="
            border: 1px solid #ccc;
            background-color: #fff;
          ">
            <h3 style="
              background-color: #9AAD3B;
              color: #fff;
              padding: 10px;
              margin: 0;
              font-size: 1.2rem;
            ">
              <?php the_title(); ?>
            </h3>
            
            <div class="p-3">
              <?php if ( has_post_thumbnail() ) : ?>
                <div class="faq-image mb-3">
                  <?php the_post_thumbnail( 'medium', array( 'class' => 'img-fluid' ) ); ?>
                </div>
              <?php endif; ?>
              
              <?php the_content(); ?>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
    <?php wp_reset_postdata(); ?>
  <?php else : ?>
    <p class="text-center">No FAQs found.</p>
  <?php endif; ?>
</div>

<?php get_footer(); ?>
