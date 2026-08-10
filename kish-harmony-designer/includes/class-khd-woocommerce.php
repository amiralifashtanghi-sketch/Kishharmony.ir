<?php
namespace KishHarmonyDesigner;

if (!defined('ABSPATH')) {
    exit;
}

class WooCommerce {
    private static $instance = null;

    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('wp_head', array($this, 'inject_woocommerce_styles'), 100);
        add_filter('woocommerce_product_get_rating_html', array($this, 'toggle_ratings'), 10, 2);
        add_filter('woocommerce_get_price_html', array($this, 'toggle_prices'), 10, 2);
    }

    /**
     * Dynamically styles WooCommerce elements to align with the chosen colors and card radiuses
     */
    public function inject_woocommerce_styles() {
        if (!class_exists('WooCommerce')) {
            return;
        }

        $settings = Helpers::get_settings();
        $woo = $settings['woocommerce'] ?? array();

        $card_bg      = $woo['card_bg'] ?? '#ffffff';
        $card_radius  = $woo['card_border_radius'] ?? '16px';
        $btn_bg       = $woo['button_bg'] ?? '#0B63D8';
        $btn_text     = $woo['button_text_color'] ?? '#ffffff';

        $woo_css = "
        /* WooCommerce Specific Harmony Styling Override */
        .woocommerce ul.products li.product,
        .woocommerce-page ul.products li.product {
            background-color: {$card_bg} !important;
            border-radius: {$card_radius} !important;
            padding: 15px !important;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05) !important;
            transition: transform 0.25s ease, box-shadow 0.25s ease !important;
        }

        .woocommerce ul.products li.product:hover {
            transform: translateY(-4px) !important;
            box-shadow: 0 12px 24px rgba(0,0,0,0.1) !important;
        }

        .woocommerce ul.products li.product .button,
        .woocommerce a.button,
        .woocommerce button.button.alt,
        .woocommerce input.button.alt,
        .woocommerce #respond input#submit {
            background-color: {$btn_bg} !important;
            color: {$btn_text} !important;
            border-radius: var(--harmony-border-radius, 20px) !important;
            font-family: var(--harmony-font-family, 'Vazirmatn') !important;
            font-weight: bold !important;
            padding: 10px 20px !important;
            transition: all 0.25s ease !important;
        }

        .woocommerce ul.products li.product .button:hover,
        .woocommerce a.button:hover,
        .woocommerce button.button.alt:hover,
        .woocommerce input.button.alt:hover {
            opacity: 0.9 !important;
            transform: scale(1.02) !important;
        }

        /* Cart, checkout, and Account form rounded containers */
        .woocommerce-cart .cart-collaterals,
        .woocommerce-checkout #order_review,
        .woocommerce-MyAccount-navigation,
        .woocommerce-MyAccount-content {
            background-color: #ffffff !important;
            border-radius: var(--harmony-border-radius, 20px) !important;
            padding: 24px !important;
            border: 1px solid #e2e8f0 !important;
        }
        ";

        echo "<!-- WooCommerce Harmony Designer Dynamic Style -->\n<style id='harmony-designer-woocommerce-css'>" . preg_replace('/\s+/', ' ', $woo_css) . "</style>\n";
    }

    /**
     * Dynamic toggle for WooCommerce Product Rating visibility
     */
    public function toggle_ratings($html, $rating) {
        $settings = Helpers::get_settings();
        $show = $settings['woocommerce']['show_rating'] ?? true;
        if (!$show) {
            return '';
        }
        return $html;
    }

    /**
     * Dynamic toggle for WooCommerce Product Price visibility
     */
    public function toggle_prices($html, $product) {
        $settings = Helpers::get_settings();
        $show = $settings['woocommerce']['show_price'] ?? true;
        if (!$show) {
            return '';
        }
        return $html;
    }
}
