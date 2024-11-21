<?php

function alimran_enqueue_styles() {
    wp_enqueue_style( 'alimran-style', get_stylesheet_uri() );
    wp_enqueue_script( 'alimran-script', get_template_directory_uri() . '/assets/js/main.js', array(), false, true );
}

add_action( 'wp_enqueue_scripts', 'alimran_enqueue_styles' );

function alimran_theme_support() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'custom-background' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'alimran_theme_support' );

// Register Theme Customizer Settings
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/theme-functions.php';
require get_template_directory() . '/inc/hooks.php';


function alimran_register_menus() {
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'alimran' ),
        'footer'  => __( 'Footer Menu', 'alimran' ),  // Optional footer menu
    ) );
}

class Alimran_Nav_Walker extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= '<li' . $class_names . '>';

        $attributes = !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $output .= '<a' . $attributes . '>' . apply_filters('the_title', $item->title, $item->ID);

        if (in_array('menu-item-has-children', $classes)) {
            $output .= ' <span class="submenu-caret">&#9662;</span>'; // Caret for submenu
        }

        $output .= '</a>';
    }
}


add_action( 'after_setup_theme', 'alimran_register_menus' );

function alimran_enqueue_mobile_menu_script() {
    // Only enqueue the script on the frontend
    if ( ! is_admin() ) {
        ?>
        <script type="text/javascript">
           document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector(".menu-toggle");
    const menu = document.querySelector(".menu");

    if (menuToggle && menu) {
        menuToggle.addEventListener("click", function () {
            menu.classList.toggle("open");
            menuToggle.classList.toggle("open");
        });
    }
});

        </script>
        <?php
    }
}
add_action('wp_footer', 'alimran_enqueue_mobile_menu_script');




// Sidebar Widget
function alimran_widgets_init() {
    // Register Sidebar Widget Area
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'alimran' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));

    // Register Footer Widget Area
    register_sidebar( array(
        'name'          => __( 'Footer', 'alimran' ),
        'id'            => 'footer-1',
        'before_widget' => '<div class="footer-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
}

add_action( 'widgets_init', 'alimran_widgets_init' );

// Page Breadcrumb
function alimran_breadcrumbs() {
    if ( !is_front_page() ) {
        echo '<a href="' . home_url() . '">Home</a> » ';
        if ( is_category() ) {
            echo single_cat_title();
        } elseif ( is_single() ) {
            echo the_title();
        }
    }
}

// Image Lazy Load
function alimran_lazyload_images( $content ) {
    if ( is_single() ) {
        $content = preg_replace( '/<img(.*?)src=/', '<img$1loading="lazy" src=', $content );
    }
    return $content;
}
add_filter( 'the_content', 'alimran_lazyload_images' );


// Minimize CSS, JS
function alimran_enqueue_minified_styles() {
    wp_enqueue_style( 'alimran-style-min', get_template_directory_uri() . '/assets/css/style.min.css' );
    wp_enqueue_script( 'alimran-script-min', get_template_directory_uri() . '/assets/js/main.min.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'alimran_enqueue_minified_styles' );


// Register Custom Post Type: Portfolio
function alimran_register_custom_post_type() {
    $args = array(
        'label'               => 'Portfolio',
        'description'         => 'A collection of portfolio items.',
        'public'              => true,
        'show_ui'             => true,
        'show_in_rest'        => true, // Enable Gutenberg editor
        'has_archive'         => true,
        'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt' ),
        'taxonomies'          => array( 'portfolio_category' ), // Link to taxonomy
        'rewrite'             => array( 'slug' => 'portfolio' ),
        'menu_icon'           => 'dashicons-portfolio',
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
    );
    register_post_type( 'portfolio', $args );
}
add_action( 'init', 'alimran_register_custom_post_type' );


// Register Custom Taxonomy: Portfolio Category
function alimran_register_custom_taxonomy() {
    $args = array(
        'labels' => array(
            'name'              => 'Portfolio Categories',
            'singular_name'     => 'Portfolio Category',
            'search_items'      => 'Search Categories',
            'all_items'         => 'All Categories',
            'edit_item'         => 'Edit Category',
            'update_item'       => 'Update Category',
            'add_new_item'      => 'Add New Category',
            'new_item_name'     => 'New Category Name',
            'menu_name'         => 'Categories',
        ),
        'hierarchical'         => true, // Like categories
        'public'               => true,
        'show_ui'              => true,
        'show_in_rest'         => true, // Enable Gutenberg editor
        'show_in_menu'         => true,
        'show_tagcloud'        => true,
        'rewrite'              => array( 'slug' => 'portfolio-category' ),
    );
    register_taxonomy( 'portfolio_category', array( 'portfolio' ), $args );
}
add_action( 'init', 'alimran_register_custom_taxonomy' );


// Add Custom Meta Box for Portfolio
function alimran_add_custom_meta_boxes() {
    add_meta_box(
        'portfolio_details',       // ID
        'Portfolio Details',       // Title
        'alimran_render_portfolio_meta_box', // Callback function
        'portfolio',               // Post type
        'normal',                  // Context
        'high'                     // Priority
    );
}
add_action( 'add_meta_boxes', 'alimran_add_custom_meta_boxes' );


// Render the Custom Meta Box
function alimran_render_portfolio_meta_box( $post ) {
    wp_nonce_field( 'portfolio_details_nonce', 'portfolio_nonce' );
    $project_link = get_post_meta( $post->ID, '_project_link', true );
    $client_name  = get_post_meta( $post->ID, '_client_name', true );
    $project_year = get_post_meta( $post->ID, '_project_year', true );
    
    echo '<label for="project_link">Project Link: </label>';
    echo '<input type="url" id="project_link" name="project_link" value="' . esc_attr( $project_link ) . '" class="widefat" />';
    
    echo '<label for="client_name">Client Name: </label>';
    echo '<input type="text" id="client_name" name="client_name" value="' . esc_attr( $client_name ) . '" class="widefat" />';
    
    echo '<label for="project_year">Project Year: </label>';
    echo '<input type="number" id="project_year" name="project_year" value="' . esc_attr( $project_year ) . '" class="widefat" />';
}

// Save the custom fields data
function alimran_save_portfolio_meta( $post_id ) {
    if ( ! isset( $_POST['portfolio_nonce'] ) || ! wp_verify_nonce( $_POST['portfolio_nonce'], 'portfolio_details_nonce' ) ) {
        return;
    }

    if ( isset( $_POST['project_link'] ) ) {
        update_post_meta( $post_id, '_project_link', sanitize_text_field( $_POST['project_link'] ) );
    }

    if ( isset( $_POST['client_name'] ) ) {
        update_post_meta( $post_id, '_client_name', sanitize_text_field( $_POST['client_name'] ) );
    }

    if ( isset( $_POST['project_year'] ) ) {
        update_post_meta( $post_id, '_project_year', sanitize_text_field( $_POST['project_year'] ) );
    }
}
add_action( 'save_post', 'alimran_save_portfolio_meta' );
