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
kish_require_ok(KISH_HARMONY_DIR . '/inc/class-kish-css-compiler.php');
kish_require_ok(KISH_HARMONY_DIR . '/inc/class-kish-admin-designer.php');
kish_require_ok(KISH_HARMONY_DIR . '/inc/class-kish-layout-builder.php');

function kish_require_ok($filepath) {
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

    // Compiled Theme Local CSS (Replaces external Tailwind CDN)
    if (file_exists(KISH_HARMONY_DIR . '/assets/css/app-compiled.css')) {
        wp_enqueue_style('kish-harmony-app-compiled', KISH_HARMONY_URI . '/assets/css/app-compiled.css', array(), KISH_HARMONY_VERSION);
    }

    // Parent Theme Style
    wp_enqueue_style('twentytwentyfive-style', get_template_directory_uri() . '/style.css');

    // Child Theme Main Style
    wp_enqueue_style('kish-harmony-style', get_stylesheet_uri(), array('twentytwentyfive-style'), KISH_HARMONY_VERSION);

    // Local JS Main Interactive Script
    if (file_exists(KISH_HARMONY_DIR . '/assets/js/main.js')) {
        wp_enqueue_script('kish-harmony-main', KISH_HARMONY_URI . '/assets/js/main.js', array(), KISH_HARMONY_VERSION, true);
    }
}
add_action('wp_enqueue_scripts', 'kish_harmony_child_scripts');
