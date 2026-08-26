<?php
// functions.php for Kishharmony child theme

// Load parent & child styles
function kishharmony_enqueue_styles(){
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('kishharmony-child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));
}
add_action('wp_enqueue_scripts','kishharmony_enqueue_styles');

// Include inc files
foreach (glob(get_stylesheet_directory() . '/inc/*.php') as $file) {
    require_once $file;
}

// Register a menu location
function kishharmony_register_menus(){
    register_nav_menus(array(
        'header_menu' => __('Header Menu', 'kishharmony-child'),
    ));
}
add_action('after_setup_theme','kishharmony_register_menus');

// Make search default to products if search form used from theme search form
function kishharmony_search_products($query){
    if(!is_admin() && $query->is_main_query() && $query->is_search()){
        // keep default if WP admin or doing admin search
        $query->set('post_type', array('product'));
    }
}
add_action('pre_get_posts','kishharmony_search_products');
