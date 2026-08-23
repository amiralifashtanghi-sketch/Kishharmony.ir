<?php
/**
 * Kish Harmony Child Theme Functions
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. Include Theme Options & WooCommerce Metaboxes
if (file_exists(get_stylesheet_directory() . '/inc/theme-options.php')) {
    require_once get_stylesheet_directory() . '/inc/theme-options.php';
}

// 2. Theme Setup
function kishharmony_child_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');

    register_nav_menus(array(
        'primary-menu' => __('منوی اصلی هدر', 'kish-harmony'),
        'footer-menu'  => __('منوی فوتر', 'kish-harmony'),
    ));
}
add_action('after_setup_theme', 'kishharmony_child_setup');

// 3. Enqueue Styles & Native Scripts
function kishharmony_child_scripts() {
    // Main Child Theme Stylesheet
    wp_enqueue_style('kishharmony-parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('kishharmony-child-style', get_stylesheet_uri(), array('kishharmony-parent-style'), '1.0.0');

    // FontAwesome 6.5.1
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1');

    // Vazirmatn Font
    wp_enqueue_style('vazirmatn-font', 'https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css', array(), '33.003');

    // Theme Custom JS Script
    wp_enqueue_script('kishharmony-main-js', get_stylesheet_directory_uri() . '/assets/js/main-native.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'kishharmony_child_scripts');

// 4. WooCommerce Cart Fragments (Live Cart Count)
add_filter('woocommerce_add_to_cart_fragments', 'kishharmony_cart_count_fragments', 10, 1);
function kishharmony_cart_count_fragments($fragments) {
    if (class_exists('WooCommerce') && !is_null(WC()->cart)) {
        $count = WC()->cart->get_cart_contents_count();
        $fragments['span.custom-cart-count'] = '<span class="cart-count custom-cart-count">' . esc_html($count) . '</span>';
    }
    return $fragments;
}
