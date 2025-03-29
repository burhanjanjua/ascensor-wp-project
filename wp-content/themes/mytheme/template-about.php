<?php
/*
Template Name: About Us
*/
get_header();
$options = get_option('customtheme_options');
?>
<div class="blog-hero" style="
  background: url('https://custom.21degrees.digital/wp-content/uploads/2025/03/view-from-backyard-of-farm-2025-03-23-22-01-52-utc-1.jpg') 
              center center / cover no-repeat;
  height: 250px; 
  display: flex; 
  align-items: center; 
  justify-content: center;
">
  <h1 style="color: #fff; font-size: 3rem; margin: 0;">About</h1>
</div>
<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
  <div class="row">
    <div class="col-md-8">
      <div class="about-content" style="margin-bottom: 50px;">
        <?php if ( have_posts() ) : ?>
          <?php while ( have_posts() ) : the_post(); ?>
            <div class="page-content" style="line-height: 1.8; font-size: 1.1rem;">
            <h2 class="mb-4 text-center fw-light"><?php the_title(); ?></h2>
              <?php the_content(); ?>
            </div>
          <?php endwhile; ?>
        <?php endif; ?>
      </div>
      <div class="faqs-section">
        <h2 style="font-size: 2rem; margin-bottom: 20px;">Frequently Asked Questions</h2>
        <?php
          $faq_args = array(
            'post_type'      => 'faq',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC'
          );
          $faq_query = new WP_Query( $faq_args );
        ?>
        <?php if ( $faq_query->have_posts() ) : ?>
          <div class="accordion" id="faqAccordion">
            <?php $i = 0; ?>
            <?php while ( $faq_query->have_posts() ) : $faq_query->the_post(); ?>
              <?php $faq_id = get_the_ID(); ?>
              <div class="card" style="margin-bottom: 10px;">
                <div class="card-header" id="heading-<?php echo $faq_id; ?>" style="background: #f60; padding: 10px;">
                  <h5 class="mb-0" style="margin: 0;">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $faq_id; ?>" aria-expanded="<?php echo (0 === $i ? 'true' : 'false'); ?>" aria-controls="collapse-<?php echo $faq_id; ?>" style="
                      color: #fff;
                      font-size: 1.1rem;
                      text-decoration: none;
                      width: 100%;
                      text-align: left;
                      padding: 0;">
                      <?php the_title(); ?>
                    </button>
                  </h5>
                </div>
                <div id="collapse-<?php echo $faq_id; ?>" class="collapse <?php echo (0 === $i ? 'show' : ''); ?>" aria-labelledby="heading-<?php echo $faq_id; ?>" data-parent="#faqAccordion">
                  <div class="card-body" style="background: #f7f7f7; padding: 15px; border: 1px solid #ddd;">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <div class="faq-thumb" style="margin-bottom: 15px;">
                        <?php the_post_thumbnail('medium', array('class' => 'img-fluid')); ?>
                      </div>
                    <?php endif; ?>
                    <?php the_content(); ?>
                  </div>
                </div>
              </div>
              <?php $i++; ?>
            <?php endwhile; ?>
          </div>
          <?php wp_reset_postdata(); ?>
        <?php else: ?>
          <p>No FAQs available.</p>
        <?php endif; ?>
      </div>
    </div>
    <div class="col-md-4">
      <aside class="about-sidebar p-3" style="">
        <h3 style="font-size: 1.5rem; margin-bottom: 20px;"></h3>
        <ul style="list-style: none; padding: 0; margin: 0;">
          <li style="margin-bottom: 10px;"><a href="<?php echo home_url('/about'); ?>" >About Us</a></li>
          <li style="margin-bottom: 10px;"><a href="<?php echo home_url('/test'); ?>" >FAQs</a></li>
          <li style="margin-bottom: 10px;"><a href="<?php echo home_url('/blogs'); ?>" >Blog</a></li>
        </ul>
      </aside>
    </div>
  </div>
</div>
<?php get_footer(); ?>