<?php

add_filter('show_admin_bar', '__return_false');
add_theme_support( 'post-formats', array( 'aside', 'video' ) );
add_post_type_support( 'page', 'post-formats' );
add_post_type_support( 'my_custom_post_type', 'post-formats' );
add_theme_support('post-thumbnails');

add_action( 'wp_enqueue_scripts', 'mh_load_my_script' );
function mh_load_my_script() {
    wp_enqueue_script( 'jquery' );
}

/* display theme version in toolbar */
add_action( 'admin_bar_menu', 'toolbar_theme_version', 999 );
function toolbar_theme_version( $wp_admin_bar ) {
    $my_theme = wp_get_theme();
    $say = $my_theme->get( 'Name' ) . " [ " . $my_theme->get( 'Version' ) . " ]";
    //$blogUrl = (url to theme options)

    $args = array(
        'id'    => 'theme_version',
        'title' => $say,
        //'href'  => $blogUrl,
        'meta'  => array( 'class' => 'current-theme-version' )
    );
    $wp_admin_bar->add_node( $args );
}

add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function custom_excerpt_length( $length ) {
    return 160;
}

add_filter( 'excerpt_more', 'new_excerpt_more' );
function new_excerpt_more( $more ) {
    return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'your-text-domain') . '</a>';
}


function returnSliderChildren( $id ) {
    global $wpdb;
    $child_pages = $wpdb->get_results(
        "SELECT * FROM $wpdb->posts
        WHERE post_parent = " . $id . "
        AND post_type = 'page'
        AND post_status = 'publish'
        ORDER BY menu_order",
        'OBJECT'
    );
    return $child_pages;
}

class Menu_With_Description extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '<br /><span class="sub">' . $item->description . '</span>';
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

function portraitBlock() {
    $portraits = query_posts( array(
        'category_name' => 'featured-portraits',
        'posts_per_page' => 6,
        'orderby' => 'date',
        'order' => 'DESC'
    ) );

    return $portraits;
}

function is_tree($pid) {
    global $post;

    if(is_page() && ($post->post_parent == $pid || is_page($pid)) ) {
        if(is_page('about'))
            return false;

        if(is_page('contact'))
            return false;

        return true;

    } else {
        return false;
    }
}

class FooterContactPageImage {

    public function weddings() {
        $weddings = get_page_by_title('Weddings');

        return $weddings;
    }

    public function engagements() {
        $engagements = get_page_by_title('Engagements');

        return $engagements;
    }

    public function contact() {
        $contactUs = get_page_by_title('Contact Us');

        return $contactUs;
    }

    public function about() {
        $aboutMe = get_page_by_title('About Us');

        return $aboutMe;
    }

    public function portfolio() {
        $portfolio = get_page_by_title('Portfolio');

        return $portfolio;
    }

    public function blog() {
        $blog = get_page_by_title('blog');

        return $blog;
    }
}

$obj = new FooterContactPageImage();