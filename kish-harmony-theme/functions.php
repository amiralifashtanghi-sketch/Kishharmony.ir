<?php
/**
 * Kish Harmony WordPress Theme Functions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function kish_harmony_setup() {
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    register_nav_menus(array(
        'primary-menu' => __('منوی اصلی هدر', 'kish-harmony'),
        'footer-menu'  => __('منوی فوتر', 'kish-harmony'),
    ));

    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
}
add_action('after_setup_theme', 'kish_harmony_setup');

function kish_harmony_scripts() {
    // FontAwesome 6.5.1
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1');

    // Vazirmatn Persian Google Font
    wp_enqueue_style('vazirmatn-font', 'https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap', array(), '33.003');

    // Main Theme Compiled Style
    wp_enqueue_style('kish-harmony-style', get_stylesheet_uri(), array(), '1.0.0');

    // React Bundle Script (with ES Module support)
    wp_enqueue_script('kish-harmony-app', get_template_directory_uri() . '/assets/js/app-bundle.js', array(), '1.0.0', true);

    // Interactive fallback script
    wp_enqueue_script('kish-harmony-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'kish_harmony_scripts');

// Inject type="module" for Vite ES Module bundles in WordPress
function kish_harmony_script_type_module($tag, $handle, $src) {
    if ('kish-harmony-app' === $handle || 'kish-harmony-main' === $handle) {
        return '<script type="module" src="' . esc_url($src) . '"></script>' . "\n";
    }
    return $tag;
}
add_filter('script_loader_tag', 'kish_harmony_script_type_module', 10, 3);
