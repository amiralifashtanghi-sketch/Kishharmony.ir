<?php
/**
 * Plugin Name: Kish Harmony Designer
 * Plugin URI:  https://kishharmony.ir
 * Description: پلاگین پیشرفته تنظیمات طراحی و مدیریت قالب کیش هارمونی (کنترل پیکسلی، فونت‌ها و چیدمان سکشن‌ها)
 * Version:     1.0.0
 * Author:      Kish Harmony Team & Jules
 * Author URI:  https://kishharmony.ir
 * License:     GPL2
 * Text Domain: kish-harmony-designer
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define Constants
define('KHD_VERSION', '1.0.0');
define('KHD_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('KHD_PLUGIN_URL', plugin_dir_url(__FILE__));
define('KHD_OPTION_KEY', 'khd_theme_settings');

// Include required classes
require_once KHD_PLUGIN_DIR . 'includes/helpers.php';
require_once KHD_PLUGIN_DIR . 'includes/class-khd-admin.php';
require_once KHD_PLUGIN_DIR . 'includes/class-khd-frontend.php';
require_once KHD_PLUGIN_DIR . 'includes/class-khd-woocommerce.php';

/**
 * Initialize the plugin classes
 */
function khd_init_plugin() {
    // Initialize Admin
    if (is_admin()) {
        \KishHarmonyDesigner\Admin::get_instance();
    }

    // Initialize Frontend
    \KishHarmonyDesigner\Frontend::get_instance();

    // Initialize WooCommerce Integration
    \KishHarmonyDesigner\WooCommerce::get_instance();
}
add_action('plugins_loaded', 'khd_init_plugin');

/**
 * Activation Hook - Setup Default Config
 */
register_activation_hook(__FILE__, 'khd_activate_plugin');
function khd_activate_plugin() {
    $defaults = \KishHarmonyDesigner\Helpers::get_default_settings();
    if (!get_option(KHD_OPTION_KEY)) {
        update_option(KHD_OPTION_KEY, $defaults);
    }
}
