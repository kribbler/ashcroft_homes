<?php
wp_register_script('jquery', ("http://code.jquery.com/jquery-latest.min.js"), false, '');
wp_enqueue_script('jquery');

wp_register_script('backstretch', (get_stylesheet_directory_uri() . "/js/jquery.backstretch.min.js"), false, '');
wp_enqueue_script('backstretch');

$browser = get_user_browser();
if($browser == "ie"){
    //wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . "ie.css");
    wp_enqueue_style('theme-style', get_stylesheet_uri());
} else{
    //wp_enqueue_style('theme-style', get_stylesheet_uri());
}

function get_user_browser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $ub = '';
    if(preg_match('/MSIE/i',$u_agent))
    {
        $ub = "ie";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $ub = "firefox";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $ub = "safari";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $ub = "chrome";
    }
    elseif(preg_match('/Flock/i',$u_agent))
    {
        $ub = "flock";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $ub = "opera";
    }

    return $ub;
}

function child_ts_theme_widgets_init(){
    register_sidebar( array(
        'name' => __( 'Header Top Right', 'liva' ),
        'id' => 'header-top-right',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );

    register_sidebar( array(
        'name' => __( 'Header Text', 'liva' ),
        'id' => 'header-text',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );

    register_sidebar( array(
        'name' => __( 'Header Right', 'liva' ),
        'id' => 'header-right',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );

	register_sidebar( array(
        'name' => __( 'Copyright area 1', 'liva' ),
        'id' => 'coyright-area-1',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Copyright area 2', 'liva' ),
        'id' => 'coyright-area-2',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
	
    register_sidebar( array(
        'name' => __( 'Footer Above Home', 'liva' ),
        'id' => 'footer-above-home',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Above Inner', 'liva' ),
        'id' => 'footer-above-inner',
        'before_widget' => '<div id="%1$s" class="sidebar_widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar_title"><h3>',
        'after_title' => '</h3></div>',
    ) );
}

add_action( 'widgets_init', 'child_ts_theme_widgets_init' );

add_shortcode( 'get_last_listings_small', 'get_last_listings_small' );
function get_last_listings_small($atts, $content = null){
    extract(shortcode_atts(array(
        'id'       => '',
        'taxonomy' => '',
        'term'     => '',
        'limit'    => '',
        'columns'  => ''
    ), $atts ) );

    $columns = 3;

    $query_args = array(
        'post_type'       => 'listing',
        'posts_per_page'  => $limit
    );

    if($term && $taxonomy) {
        $query_args = array(
            'post_type'       => 'listing',
            'posts_per_page'  => $limit,
            'tax_query'       => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'     => $term
                )
            )
        );
    }

    global $post;

    $listings_array = get_posts( $query_args );
    $k = 0;
    $output = '<div class="listings_small">';
    foreach ( $listings_array as $post ) : setup_postdata( $post );
        $output .= '<a class="small_featured" href="javascript:void(0);"><img src="' . get_listing_thumb( $post->ID , 'homepage-tabbed-listing' ) . '" /></a>';
        $k++;
        if ($k %2 == 0){
            $output .= '<div class="small_spacer"></div>';
        }
    endforeach;
    $output .= '</div>';
    return $output;
}

add_shortcode( 'homepage_listings', 'show_featured_listings_homepage' );

function show_featured_listings_homepage($atts, $content = null) {
    extract(shortcode_atts(array(
        'id'       => '',
        'taxonomy' => '',
        'term'     => '',
        'limit'    => '',
        'columns'  => ''
    ), $atts ) );

    $limit = 8;

    $columns = 4;
//var_dump($term);

    $query_args = array(
        'post_type'       => 'listing',
        'posts_per_page'  => $limit
    );

    //$taxonomy = "status";
    if($term && $taxonomy) {
        $query_args = array(
            'post_type'       => 'listing',
            'posts_per_page'  => $limit,
            'tax_query'       => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'     => $term
                )
            )
        );
    }
//echo "<pre>"; var_dump($query_args); echo "</pre>";
    global $post;

    $listings_array = get_posts( $query_args );

    

    $output = '<div class="featured_listings">';
    $output .= '<div class="row">';

    $output .= '<div id="carousel_container">';
    $output .= '<div id="left_scroll"></div>';
    $output .= '<div id="carousel_inner">';
    $output .= '<ul id="carousel_ul">';

    $count = 0;
    $extra_info = array();

    foreach ( $listings_array as $post ) : setup_postdata( $post );
        $count++;

        $output .= '<li class="li_inactive" id="use_the_'.$count.'">';
        $output .= '<div class="span3 featured_h" id="featured_listing_'.$count.'">';
        $output .= '<a class="small_featured" href="'.get_permalink().'"><img src="' . get_listing_thumb( $post->ID , 'homepage-featured-listing' ) . '" /></a>';
        //$output .= '<div class="small_featured">' . the_post_thumbnail('homepage-featured-listing', false) . '</div>';
        $output .= '<div class="listing_summary">';
            $output .= '<a class="featured_listing_title" href="' . get_permalink() . '">' . get_the_title() . '</a>';
            
            $output .= '<div class="featured_listing_bedrooms">' . get_post_meta( $post->ID, '_listing_bedrooms', true ) . '</div>';
            $output .= '<div class="featured_listing_bathrooms">' . get_post_meta( $post->ID, '_listing_bathrooms', true ) . '</div>';
            $output .= '<div class="clearfix"></div>';
            $output .= '<div class="featured_listing_price">$' . number_format( get_post_meta( $post->ID, '_listing_price', true ), 0, ".", "," ) . '</div>';
        $output .= '</div>';

        $output .= '</div>';

        $output .= '</li>';

        $extra_info[$count]['id'] = $count;
        $extra_info[$count]['specification'] = ( $post->post_excerpt ) ? $post->post_excerpt : $post->post_content;
        $extra_info[$count]['house_plan_image'] = get_master_plan($post->ID);
        $extra_info[$count]['listing_link'] = get_permalink();
        $extra_info[$count]['video'] = get_post_meta( $post->ID, '_listing_video_home', true );

    endforeach;

    $output .= '</ul></div>'; //<div id='carousel_inner'>
    $output .= '<div id="right_scroll"></div>';
    $output .= '</div>'; //<div id='carousel_container'>

    $output .= '</div><!--row-->';

    $output .= '<div class="featured_listing_extend tri_1">';
    foreach ($extra_info as $info){
        $output .= '<div class="featured_listing_hidden_info" id="featured_hidden_'.$info['id'].'">';
            $output .= '<div class="row">';
            
                $output .= '<div class="span2">';
                $output .= '<h4>specification</h4>';
                $output .= $info['specification'];
                $output .= '</div><!--span2-->';
                
                $output .= '<div class="span5">';
                $output .= '<a href="'.$info['listing_link'].'"><img class="img_225" src="'.$info['house_plan_image'].'" /></a>';
                $output .= '</div><!--span4-->';

                $output .= '<div class="span4">';
                $output .= '<h4>Hear from our Ashcroft Families</h4>';
                $output .= $info['video'];
                $output .= '</div><!--span4-->';        

            $output .= '</div><!--row-->';
        $output .= '</div>';
    }
    $output .= '</div><!--featured_listing_extend-->';

    $output .= '</div>';

    $output .= "
    <script type='text/javascript'>
    jQuery(document).ready(function($) {
         
  });
    </script>";
    wp_reset_postdata();
    return $output;
}

//homepage_listings_tabbed
add_shortcode( 'homepage_listings_tabbed', 'show_tabbed_listings_homepage' );

function show_tabbed_listings_homepage($atts, $content = null) {
    extract(shortcode_atts(array(
        'id'       => '',
        'taxonomy' => '',
        'term'     => '',
        'limit'    => '',
        'columns'  => ''
    ), $atts ) );

    $limit = 5;

    $columns = 5;

    $query_args = array(
        'post_type'       => 'listing',
        'posts_per_page'  => $limit
    );

    $output = "";
    $output .= '<div id="tabbed_title">';
    $output .= '<span id="tab_1_title" class="tab_title">HOUSE & LAND PACKAGES</span>';
    $output .= '<span id="tab_2_title" class="tab_title visible_tab">AUCKLAND NEW HOMES FOR SALE</span>';
    
    //$output .= '<span id="tab_3_title" class="tab_title">AVAILABLE SOON</span>';

    $output .= '</div><!-- tabbed_title -->';
    $taxonomy = "property-types";
    global $post;
    
    //get the 'Auckland New Homes For Sale' listings
    $term = "Auckland New Homes For Sale";

    if($term && $taxonomy) {
        $query_args = array(
            'post_type'       => 'listing',
            'posts_per_page'  => $limit,
            'tax_query'       => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'     => $term
                )
            )
        );
    }
//echo "<pre>"; var_dump($query_args);echo "</pre>";
    $listings_array = get_posts( $query_args );
    $output .= '<div id="tab_2" class="row listings_tab">';
    foreach ( $listings_array as $post ) : setup_postdata( $post );
        $output .= '<div class="span2 tabbed_span2">';
            $output .= '<div class="tab_listing_image">';
                //$output .= get_the_post_thumbnail( $post->ID, 'listings' );
                $output .= '<a href="'.get_permalink().'"><img src="' . get_listing_thumb( $post->ID , 'homepage-tabbed-listing' ) . '" /></a>';
            $output .= '</div>';
            $output .= '<div class="tab_listing_city">';
            $output .= get_post_meta( $post->ID, '_listing_city', true );
            $output .= ' - $';
            //$output .= get_post_meta( $post->ID, '_listing_price', true );
            $output .= number_format( get_post_meta( $post->ID, '_listing_price', true ), 0, ".", "," ); 
            $output .= '</div>';            
            $output .= '<div class="featured_listing_bedrooms">' . get_post_meta( $post->ID, '_listing_bedrooms', true ) . '</div>';
            $output .= '<div class="featured_listing_bathrooms">' . get_post_meta( $post->ID, '_listing_bathrooms', true ) . '</div>';
        $output .= '</div>';
    endforeach;

    $output .= '</div>';

    //get the 'House & Land Packages' listings
    $term = "House & Land Packages";

    if($term && $taxonomy) {
        $query_args = array(
            'post_type'       => 'listing',
            'posts_per_page'  => $limit,
            'tax_query'       => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'     => $term
                )
            )
        );
    }

    $listings_array = get_posts( $query_args );
    $output .= '<div id="tab_1" class="row listings_tab">';
    foreach ( $listings_array as $post ) : setup_postdata( $post );
        $output .= '<div class="span2 tabbed_span2">';
            $output .= '<div class="tab_listing_image">';
                //$output .= get_the_post_thumbnail( $post->ID, 'listings' );
            $output .= '<a href="'.get_permalink().'"><img src="' . get_listing_thumb( $post->ID , 'homepage-tabbed-listing' ) . '" /></a>';
            $output .= '</div>';
            $output .= '<div class="tab_listing_city">';
            $output .= get_post_meta( $post->ID, '_listing_city', true );
            $output .= ' - $';
            //$output .= get_post_meta( $post->ID, '_listing_price', true );
            $output .= number_format( get_post_meta( $post->ID, '_listing_price', true ), 0, ".", "," ); 
            $output .= '</div>';            
            $output .= '<div class="featured_listing_bedrooms">' . get_post_meta( $post->ID, '_listing_bedrooms', true ) . '</div>';
            $output .= '<div class="featured_listing_bathrooms">' . get_post_meta( $post->ID, '_listing_bathrooms', true ) . '</div>';
        $output .= '</div>';
    endforeach;

    $output .= '</div>';

    //get the 'Available Soon' listings
    $term = "Available Soon";

    if($term && $taxonomy) {
        $query_args = array(
            'post_type'       => 'listing',
            'posts_per_page'  => $limit,
            'tax_query'       => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'     => $term
                )
            )
        );
    }

    $listings_array = get_posts( $query_args );
    $output .= '<div id="tab_3" class="row listings_tab">';
    foreach ( $listings_array as $post ) : setup_postdata( $post );
        $output .= '<div class="span2 tabbed_span2">';
            $output .= '<div class="tab_listing_image">';
                $output .= get_the_post_thumbnail( $post->ID, 'listings' );
            $output .= '</div>';
            $output .= '<div class="tab_listing_city">';
            $output .= get_post_meta( $post->ID, '_listing_city', true );
            $output .= ' - $';
            //$output .= get_post_meta( $post->ID, '_listing_price', true );
            $output .= number_format( get_post_meta( $post->ID, '_listing_price', true ), 0, ".", "," ); 
            $output .= '</div>';            
            $output .= '<div class="featured_listing_bedrooms">' . get_post_meta( $post->ID, '_listing_bedrooms', true ) . '</div>';
            $output .= '<div class="featured_listing_bathrooms">' . get_post_meta( $post->ID, '_listing_bathrooms', true ) . '</div>';
        $output .= '</div>';
    endforeach;

    $output .= '</div>';

    wp_reset_postdata();
    return $output;

    //echo "<pre>"; var_dump($listings_array); echo "</pre>";
}

function get_master_plan($id){
    $gallery = get_post_meta( $id, '_listing_gallery', false );
    //var_dump($gallery);
    $pattern ="/<img (.*?) src=\"(.*?)\" (.*?) \/>/s";
    preg_match_all(
        $pattern,
        $gallery[0],
        $matches,
        PREG_SET_ORDER
    );

    //echo "<pre>"; var_dump($matches);

    return $matches[0][2];
}

add_shortcode( 'show_7_processes', 'show_processes' );

function show_processes($atts, $content = null) {
    extract(shortcode_atts(array(
    ), $atts ) );

    $query_args = array(
        'post_type'       => 'post',
        'category_name'    => 'our-process',
        'posts_per_page'    => 7,
        'order'           => 'ASC'
    );

    $posts_array = get_posts( $query_args );

    $k = 1;
    $output = '<div id="our_process_graph">';
    foreach ( $posts_array as $post ) : setup_postdata( $post );
        $output .= '<div class="our_process_content" id="process_'.$k.'">';
        $output .= '<h5>' . get_the_title($post->ID) . '</h5>';
        $output .= apply_filters('the_content', get_post_field('post_content', $post->ID));
        $output .= '</div>';
        $k++;
    endforeach;
    $output .= '';
    $output .= '</div>';
    //get_bloginfo('stylesheet_directory');
    
    return $output;
}

function get_listing_thumb($post_id, $thumb){
    $url = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), $thumb );
    //var_dump($url[0]);
    return $url[0];
}

add_image_size( 'homepage-featured-listing', 129, 84, true );
add_image_size( 'homepage-tabbed-listing', 210, 126, true );
add_image_size( 'listing-huge', 650, 640, true );

function d_get_single_listing_post_content(){
    global $post; ?>

    <div class="full_width_gray">
        <div class="container page-content inner-page single-listing">
            <div class="pad-top40">
                <h1><span class="introducing">the</span> <?php echo $post->post_title; ?></h1>
            </div>
            <div class="row">
                <div class="span12">
                    <div class="listing-image-wrap">
                        <?php echo get_the_post_thumbnail( $post->ID, '', array('class' => 'single-listing-image') );?>
                    </div><!-- .listing-image-wrap -->
                </div>
            </div>
            <div class="row listing_top">
                <div class="span12">
                    <?php get_listing_plans( $post->ID ); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container page-content inner-page single-listing no-pad-top">
        <ul class="listing-meta">
            <li class="listing-price">
                FROM &nbsp;&nbsp; $<?php 
                    echo number_format( get_post_meta( $post->ID, '_listing_price', true ), 0, ".", "," ); 
                    //echo get_post_meta( $post->ID, '_listing_price', true ); 
                    ?>
            </li>
            <li class="listing-bedrooms">
                <?php echo get_post_meta( $post->ID, '_listing_bedrooms', true ); ?>
            </li>
            <li class="listing-bathrooms">
                <?php echo get_post_meta( $post->ID, '_listing_bathrooms', true ); ?>
            </li>
            <li class="listing-livingrooms">
                <?php echo get_post_meta( $post->ID, '_listing_livingrooms', true ); ?>
            </li>
            <li class="listing-garages">
                <?php echo get_post_meta( $post->ID, '_listing_garages', true ); ?>
            </li>
            <li class="listing-sqft">
                <span class="blueish_sqft">FLOOR AREA</span> <?php echo get_post_meta( $post->ID, '_listing_sqft', true ); ?>
            </li>
        </ul>
        
        <div class="clearfix"></div>
        
        <div class="pad-top40"><?php echo apply_filters('the_content', get_post_field('post_content', $post->ID));?></div>

        <div class="row pad-top40">
            <div class="span6">
                <?php
                if ( get_post_meta( $post->ID, '_listing_home_sum', true) != '' || get_post_meta( $post->ID, '_listing_kitchen_sum', true) != '' || get_post_meta( $post->ID, '_listing_living_room', true) != '' || get_post_meta( $post->ID, '_listing_master_suite', true) != '') { ?>
                    <ul class="additional-features">
                        <?php if (get_post_meta( $post->ID, '_listing_home_sum', true)){?>
                        <li>
                            <h6><?php _e("Home Summary", 'wp_listings'); ?></h6>
                            <p class="value"><?php echo do_shortcode(get_post_meta( $post->ID, '_listing_home_sum', true)); ?></p>
                        </li>
                        <?php } ?>

                        <?php if (get_post_meta( $post->ID, '_listing_kitchen_sum', true)){?>
                        <li>
                            <h6><?php _e("Kitchen Summary", 'wp_listings'); ?></h6>
                            <p class="value"><?php echo do_shortcode(get_post_meta( $post->ID, '_listing_kitchen_sum', true)); ?></p>
                        </li>
                        <?php } ?>

                        <div class="clearfix"></div>

                        <?php if (get_post_meta( $post->ID, '_listing_living_room', true)){?>
                        <li>
                            <h6><?php _e("Living Room", 'wp_listings'); ?></h6>
                            <p class="value"><?php echo do_shortcode(get_post_meta( $post->ID, '_listing_living_room', true)); ?></p>
                        </li>
                        <?php } ?>

                        <?php if (get_post_meta( $post->ID, '_listing_master_suite', true)){?>
                        <li>
                            <h6><?php _e("Master Suite", 'wp_listings'); ?></h6>
                            <p class="value"><?php echo do_shortcode(get_post_meta( $post->ID, '_listing_master_suite', true)); ?></p>
                        </li>
                        <?php } ?>

                        <div class="clearfix"></div>

                         <?php if (get_post_meta( $post->ID, '_listing_school_neighborhood', true)){?>
                        <li>
                            <h6><?php _e("School and Neighborhood Info", 'wp_listings'); ?></h6>
                            <p class="value"><?php echo do_shortcode(get_post_meta( $post->ID, '_listing_school_neighborhood', true)); ?></p>
                        </li>
                        <?php } ?>
                        
                    </ul><!-- .additional-features -->
                    <div class="clearfix"></div>
                <?php } ?>
            </div>
            <div class="span6">
                <?php 
                    if ($_SERVER['REMOTE_ADDR'] == '::1') {
                        echo "here is the video!";
                    } else {
                        echo do_shortcode(get_post_meta( $post->ID, '_listing_video', true)); 
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="pad-top40"></div>

<?php } // function d_get_single_listing_post_content

function get_listing_plans($id){
    $gallery = get_post_meta( $id, '_listing_gallery', false );
    //echo "<pre>"; var_dump($gallery); die();
    //echo $gallery[0];

    echo apply_filters('the_content', $gallery[0]);
}

/**
* Overwritten shortcode from wp-listings/includes/shortcodes.php
*/

add_shortcode( 's11_listings', 'wp_listings_shortcode_s11' );

function wp_listings_shortcode_s11($atts, $content = null) {
    extract(shortcode_atts(array(
        'id'       => '',
        'taxonomy' => '',
        'term'     => '',
        'limit'    => '',
        'columns'  => ''
    ), $atts ) );

    /**
     * if limit is empty set to all
     */
    if(!$limit) {
        $limit = -1;
    }

    /**
     * if columns is empty set to 0
     */
    if(!$columns) {
        $columns = 2;
    }

    /*
     * query args based on parameters
     */
    $query_args = array(
        'post_type'       => 'listing',
        'posts_per_page'  => $limit
    );

    if($id) {
        $query_args = array(
            'post_type'       => 'listing',
            'post__in'        => explode(',', $id)
        );
    }

    if($term && $taxonomy) {
        $query_args = array(
            'post_type'       => 'listing',
            'posts_per_page'  => $limit,
            'tax_query'       => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'slug',
                    'terms'     => $term
                )
            )
        );
    }
    //echo "<pre>";var_dump($query_args); echo "</pre>";
    /*
     * start loop
     */
    global $post;

    $listings_array = get_posts( $query_args );

    $count = 0;

    $output = '<div class="wp-listings-shortcode">';

    foreach ( $listings_array as $post ) : setup_postdata( $post );

        $count = ( $count == $columns ) ? 1 : $count + 1;

        $first_class = ( 1 == $count ) ? 'first' : '';

        $output .= '<div class="listing-wrap ' . get_column_class($columns) . ' ' . $first_class . '"><div class="listing-widget-thumb"><a href="' . get_permalink() . '" class="listing-image-link">' . get_the_post_thumbnail( $post->ID, 'listings' ) . '</a>';

        /*if ( '' != wp_listings_get_status() ) {
            $output .= '<span class="listing-status ' . strtolower(str_replace(' ', '-', wp_listings_get_status())) . '">' . wp_listings_get_status() . '</span>';
        }*/

        $output .= '<div class="listing-thumb-meta">';
        /*
        if ( '' != get_post_meta( $post->ID, '_listing_text', true ) ) {
            $output .= '<span class="listing-text">' . get_post_meta( $post->ID, '_listing_text', true ) . '</span>';
        } elseif ( '' != wp_listings_get_property_types() ) {
            $output .= '<span class="listing-property-type">' . wp_listings_get_property_types() . '</span>';
        }*/

        if ( '' != get_post_meta( $post->ID, '_listing_price', true ) ) {
            $output .= '<span class="listing-price">' . number_format( get_post_meta( $post->ID, '_listing_price', true ), 0, ".", "," ) . '</span>';
        }

        $output .= '</div><!-- .listing-thumb-meta --></div><!-- .listing-widget-thumb -->';

        if ( '' != get_post_meta( $post->ID, '_listing_open_house', true ) ) {
            $output .= '<span class="listing-open-house">Open House: ' . get_post_meta( $post->ID, '_listing_open_house', true ) . '</span>';
        }

        $output .= '<div class="listing-widget-details">';
        $extra_title = "";
        //var_dump($taxonomy); var_dump($terms);
        if ($taxonomy && $term){
            //echo "<pre>"; var_dump(get_the_term_list( $post->ID, "locations"));echo "</pre>";
            $extra_title = strip_tags(get_the_term_list( $post->ID, "locations"));
            //var_dump(strip_tags($extra_title));
        }
        $output .= '<h3 class="listing-title"><a href="' . get_permalink() . '"><span class="small_the">The </span><b>' . get_the_title() . '</b> <span class="the_location">' . $extra_title . '</span></a></h3>';
        $output .= '<span class="open_detail" id="open_detail_'.$post->ID.'">+</span>';

        $output .= '<div id="lis_des_'.$post->ID.'" class="hidden_listing_description">';
            $output .= '<ul class="listing-meta">';
                $output .= '<li class="listing-bedrooms">';
                    $output .= get_post_meta( $post->ID, '_listing_bedrooms', true ); 
                $output .= '</li>';
                $output .= '<li class="listing-bathrooms">';
                    $output .= get_post_meta( $post->ID, '_listing_bathrooms', true );
                $output .= '</li>';
                $output .= '<li class="listing-livingrooms">';
                    $output .= get_post_meta( $post->ID, '_listing_livingrooms', true );
                $output .= '</li>';
                $output .= '<li class="listing-garages">';
                    $output .= get_post_meta( $post->ID, '_listing_garages', true );
                $output .= '</li>';
                $output .= '<li class="listing-sqft">';
                    $output .= '<span class="whiteish_sqft">FLOOR AREA</span> ' . get_post_meta( $post->ID, '_listing_sqft', true );
                $output .= '</li>';
            $output .= '</ul>';

            $output .= '<div class="clearfix"></div>';

            $output .= '<div class="listings_description">';
            $output .= $post->post_content;
            $output .= '</div>';

            $output .= '<a class="listings_view_plans" href="' . get_permalink( $post->ID ) . '">view the ' . $post->post_title . ' plans</a>';
        $output .= '</div>';     //div hidden_listing_description
        $output .= '<div class="clearfix"></div>';
        $output .= '</div><!-- .listing-widget-details --></div><!-- .listing-wrap -->';

    endforeach;

    $output .= '</div><!-- .wp-listings-shortcode -->';

    wp_reset_postdata();

    return $output;

}