<?php
/**
 * Kish Harmony Child Theme Functions
 * Based on WordPress Twenty Twenty-Five Architecture
 */

if (!defined('ABSPATH')) {
    exit;
}

define('KISH_HARMONY_VERSION', '1.0.0');
define('KISH_HARMONY_DIR', get_stylesheet_directory());
define('KISH_HARMONY_URI', get_stylesheet_directory_uri());

// Core Module Inclusions
require_ok(KISH_HARMONY_DIR . '/inc/class-kish-css-compiler.php');
require_ok(KISH_HARMONY_DIR . '/inc/class-kish-admin-designer.php');
require_ok(KISH_HARMONY_DIR . '/inc/class-kish-layout-builder.php');

function require_ok($filepath) {
    if (file_exists($filepath)) {
        require_once $filepath;
    }
}

function kish_harmony_child_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    add_theme_support('align-wide');

    register_nav_menus(array(
        'primary-menu' => __('منوی اصلی هدر', 'kish-harmony'),
        'footer-menu'  => __('منوی فوتر', 'kish-harmony'),
    ));
}
add_action('after_setup_theme', 'kish_harmony_child_setup');

function kish_harmony_child_scripts() {
    // Local Fonts CSS
    wp_enqueue_style('kish-harmony-fonts', KISH_HARMONY_URI . '/assets/css/fonts.css', array(), KISH_HARMONY_VERSION);

    // FontAwesome 6 (CDN fallback / local)
    wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1');

    // Tailwind Runtime / Compiled Engine
    wp_enqueue_script('tailwind-cdn', 'https://cdn.tailwindcss.com', array(), '3.4.1', false);

    // Parent Theme Style
    wp_enqueue_style('twentytwentyfive-style', get_template_directory_uri() . '/style.css');

    // Child Theme Main Style
    wp_enqueue_style('kish-harmony-style', get_stylesheet_uri(), array('twentytwentyfive-style'), KISH_HARMONY_VERSION);
}
add_action('wp_enqueue_scripts', 'kish_harmony_child_scripts');
