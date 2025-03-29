<?php
// functions.php

// Enqueue styles and scripts
add_theme_support( 'post-thumbnails' );

function customtheme_enqueue_scripts() {
    // Bootstrap CSS and JS
    wp_enqueue_style( 'bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' );
    wp_enqueue_style( 'google-font-quicksand', 'https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;700&display=swap' );
    wp_enqueue_style( 'customtheme-style', get_stylesheet_uri() );
    
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'customtheme_enqueue_scripts' );

// Register navigation menus (sitemap items: Home, About, FAQs, Blog, Contact)
function customtheme_register_menus() {
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'customtheme' ),
    ) );
}
add_action( 'after_setup_theme', 'customtheme_register_menus' );

// Register Custom Post Type: FAQ
function customtheme_register_faq_post_type() {
    $labels = array(
        'name'               => __( 'FAQs', 'customtheme' ),
        'singular_name'      => __( 'FAQ', 'customtheme' ),
        'menu_name'          => __( 'FAQs', 'customtheme' ),
        'name_admin_bar'     => __( 'FAQ', 'customtheme' ),
        'add_new'            => __( 'Add New', 'customtheme' ),
        'add_new_item'       => __( 'Add New FAQ', 'customtheme' ),
        'new_item'           => __( 'New FAQ', 'customtheme' ),
        'edit_item'          => __( 'Edit FAQ', 'customtheme' ),
        'view_item'          => __( 'View FAQ', 'customtheme' ),
        'all_items'          => __( 'All FAQs', 'customtheme' ),
        'search_items'       => __( 'Search FAQs', 'customtheme' ),
        'not_found'          => __( 'No FAQs found', 'customtheme' ),
        'not_found_in_trash' => __( 'No FAQs found in Trash', 'customtheme' ),
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'faqs' ),
        'supports'           => array( 'title', 'editor', 'thumbnail' ), // Using the featured image for the FAQ image.
    );
    
    register_post_type( 'faq', $args );
}
add_action( 'init', 'customtheme_register_faq_post_type' );

// FAQ Shortcode
// Usage: [faqs ids="1,2,3" layout="accordion"] or [faqs layout="grid"]
function customtheme_faq_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'ids'    => '',
        'layout' => 'accordion', // default layout is accordion
    ), $atts, 'faqs' );
    
    $args = array(
        'post_type'      => 'faq',
        'posts_per_page' => -1,
    );
    
    if ( ! empty( $atts['ids'] ) ) {
        $ids = explode( ',', $atts['ids'] );
        $ids = array_map( 'trim', $ids );
        $args['post__in'] = $ids;
    }
    
    $faq_query = new WP_Query( $args );
    $output = '';
    
    if ( $faq_query->have_posts() ) {
        if ( 'accordion' === $atts['layout'] ) {
            // Accordion layout
            $output .= '<div class="accordion" id="faqAccordion">';
            $i = 0;
            while ( $faq_query->have_posts() ) {
                $faq_query->the_post();
                $post_id = get_the_ID();
                $expanded = ( 0 === $i ) ? 'true' : 'false';
                $show     = ( 0 === $i ) ? 'show' : '';
                
                $output .= '<div class="card">';
                $output .= '<div class="card-header" id="heading' . $post_id . '">';
                $output .= '<h2 class="mb-0">';
                $output .= '<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse' . $post_id . '" aria-expanded="' . $expanded . '" aria-controls="collapse' . $post_id . '">';
                $output .= get_the_title();
                $output .= '</button>';
                $output .= '</h2>';
                $output .= '</div>';
                $output .= '<div id="collapse' . $post_id . '" class="collapse ' . $show . '" aria-labelledby="heading' . $post_id . '" data-parent="#faqAccordion">';
                $output .= '<div class="card-body">';
                if ( has_post_thumbnail() ) {
                    $output .= get_the_post_thumbnail( $post_id, 'medium', array( 'class' => 'img-fluid mb-3' ) );
                }
                $output .= apply_filters( 'the_content', get_the_content() );
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
                $i++;
            }
            $output .= '</div>';
        } elseif ( 'grid' === $atts['layout'] ) {
            // Two column grid layout
            $output .= '<div class="row">';
            while ( $faq_query->have_posts() ) {
                $faq_query->the_post();
                $output .= '<div class="col-md-6 mb-4">';
                $output .= '<div class="card">';
                if ( has_post_thumbnail() ) {
                    $output .= get_the_post_thumbnail( get_the_ID(), 'medium', array( 'class' => 'card-img-top' ) );
                }
                $output .= '<div class="card-body">';
                $output .= '<h5 class="card-title">' . get_the_title() . '</h5>';
                $output .= '<p class="card-text">' . get_the_excerpt() . '</p>';
                $output .= '<a href="' . get_permalink() . '" class="btn btn-primary">Read More</a>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</div>';
            }
            $output .= '</div>';
        }
        wp_reset_postdata();
    } else {
        $output .= '<p>No FAQs found.</p>';
    }
    
    return $output;
}
add_shortcode( 'faqs', 'customtheme_faq_shortcode' );

// Admin Options Page for Company Details
function customtheme_register_settings() {
    register_setting( 'customtheme_options_group', 'customtheme_options' );
}
add_action( 'admin_init', 'customtheme_register_settings' );

function customtheme_add_admin_menu() {
    add_menu_page(
        'Theme Options',        // Page title
        'Theme Options',        // Menu title
        'manage_options',       // Capability
        'customtheme-options',  // Menu slug
        'customtheme_options_page', // Callback function to render the page
        'dashicons-admin-generic',
        90
    );
}
add_action( 'admin_menu', 'customtheme_add_admin_menu' );

function customtheme_options_page() {
    ?>
    <div class="wrap">
        <h1>Theme Options</h1>
        <form method="post" action="options.php">
            <?php
                settings_fields( 'customtheme_options_group' );
                $options = get_option( 'customtheme_options' );
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Company Name</th>
                    <td>
                        <input type="text" name="customtheme_options[company_name]" value="<?php echo isset( $options['company_name'] ) ? esc_attr( $options['company_name'] ) : ''; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Company Address</th>
                    <td>
                        <input type="text" name="customtheme_options[company_address]" value="<?php echo isset( $options['company_address'] ) ? esc_attr( $options['company_address'] ) : ''; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Email</th>
                    <td>
                        <input type="email" name="customtheme_options[email]" value="<?php echo isset( $options['email'] ) ? esc_attr( $options['email'] ) : ''; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Telephone</th>
                    <td>
                        <input type="text" name="customtheme_options[telephone]" value="<?php echo isset( $options['telephone'] ) ? esc_attr( $options['telephone'] ) : ''; ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Social Media Links</th>
                    <td>
                        <textarea name="customtheme_options[social_links]" rows="5" cols="50"><?php echo isset( $options['social_links'] ) ? esc_textarea( $options['social_links'] ) : ''; ?></textarea>
                        <p class="description">Enter social media links separated by commas</p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">Blurb</th>
                    <td>
                        <textarea name="customtheme_options[blurb]" rows="5" cols="50"><?php echo isset( $options['blurb'] ) ? esc_textarea( $options['blurb'] ) : ''; ?></textarea>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
?>
