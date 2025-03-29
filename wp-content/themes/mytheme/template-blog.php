<?php
/*
Template Name: Blog Page
*/

get_header();
?>
<div class="blog-hero" style="
  background: url('http://custom.21degrees.digital/wp-content/uploads/2025/03/view-from-backyard-of-farm-2025-03-23-22-01-52-utc-1.jpg') 
              center center / cover no-repeat;
  height: 250px; 
  display: flex; 
  align-items: center; 
  justify-content: center;
">
  <h1 style="color: #fff; font-size: 3rem; margin: 0;">Blog</h1>
</div>

<div class="container my-5">
  <div class="row">
    <div class="col-md-8">
      <?php
        $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
        $args = array(
          'post_type'      => 'post',
          'posts_per_page' => 5,
          'paged'          => $paged,
        );
        $blog_query = new WP_Query( $args );
      ?>

      <?php if ( $blog_query->have_posts() ) : ?>
        <?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
          <div class="post-item mb-4" style="
            background-color: #f9f9f9; 
            padding: 15px; 
            border: 1px solid #ddd;
          ">
            <div class="row">
              <div class="col-md-4">
                <?php if ( has_post_thumbnail() ) : ?>
                  <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'medium', array( 'class' => 'img-fluid mb-3' ) ); ?>
                  </a>
                <?php else: ?>
                  <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/placeholder.png' ); ?>" 
                       class="img-fluid mb-3" 
                       alt="Placeholder">
                <?php endif; ?>
              </div>
              <div class="col-md-8">
                <h2 style="margin-top: 0;">
                  <a href="<?php the_permalink(); ?>" style="text-decoration: none; color: #333;">
                    <?php the_title(); ?>
                  </a>
                </h2>
                <p class="text-muted">
                  <?php echo get_the_time('l jS F Y'); ?>
                </p>
                <p>
                  <?php the_excerpt(); ?>
                </p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>

        <div class="pagination text-center">
          <?php
          echo paginate_links( array(
            'total'   => $blog_query->max_num_pages,
            'current' => $paged,
          ) );
          ?>
        </div>

        <?php wp_reset_postdata(); ?>
      <?php else: ?>
        <p>No posts found.</p>
      <?php endif; ?>
    </div>
    <div class="col-md-4">
      <aside style="
        padding: 15px; 
      ">
        <h4></h4>
        <ul class="list-unstyled">
          <?php
            wp_list_categories( array(
              'title_li' => '', 
              'orderby'  => 'name',
              'order'    => 'ASC',
            ) );
          ?>
        </ul>
      </aside>
    </div>
  </div>
</div>

<?php get_footer(); ?>
