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
        $g = $settings['global'] ?? array();

        $primary      = $g['primary_color'] ?? '#0B63D8';
        $accent       = $g['accent_color'] ?? '#FF8A00';
        $radius       = $g['border_radius'] ?? '20px';

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
            padding: 18px !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04) !important;
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease !important;
            border: 1px solid #f1f5f9 !important;
        }

        .woocommerce ul.products li.product:hover {
            transform: translateY(-5px) !important;
            box-shadow: 0 16px 30px rgba(0,0,0,0.08) !important;
            border-color: {$primary} !important;
        }

        /* Buttons & Actions Styling */
        .woocommerce ul.products li.product .button,
        .woocommerce a.button,
        .woocommerce button.button.alt,
        .woocommerce input.button.alt,
        .woocommerce #respond input#submit,
        .woocommerce-message .button,
        .woocommerce-info .button,
        .woocommerce-error .button {
            background-color: {$btn_bg} !important;
            color: {$btn_text} !important;
            border-radius: {$radius} !important;
            font-family: var(--harmony-font-family, 'Vazirmatn') !important;
            font-weight: 800 !important;
            padding: 12px 24px !important;
            transition: all 0.2s ease-in-out !important;
            box-shadow: 0 4px 12px rgba(11, 99, 216, 0.15) !important;
        }

        .woocommerce ul.products li.product .button:hover,
        .woocommerce a.button:hover,
        .woocommerce button.button.alt:hover,
        .woocommerce input.button.alt:hover,
        .woocommerce-message .button:hover {
            opacity: 0.95 !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 6px 18px rgba(11, 99, 216, 0.25) !important;
        }

        /* Star Ratings Controls */
        .woocommerce .star-rating span,
        .woocommerce-page .star-rating span {
            color: {$accent} !important;
        }

        /* Sale Badges Controls */
        .woocommerce span.onsale,
        .woocommerce-page span.onsale {
            background-color: {$accent} !important;
            color: #ffffff !important;
            font-weight: 900 !important;
            border-radius: 8px !important;
            padding: 4px 12px !important;
            font-size: 11px !important;
            min-height: auto !important;
            line-height: 1.5 !important;
        }

        /* Single Product Customization */
        .woocommerce div.product .product_title {
            font-size: 26px !important;
            font-weight: 900 !important;
            margin-bottom: 15px !important;
        }

        .woocommerce div.product p.price,
        .woocommerce div.product span.price {
            color: {$primary} !important;
            font-weight: 900 !important;
            font-size: 22px !important;
        }

        .woocommerce div.product .woocommerce-product-gallery__wrapper img {
            border-radius: {$radius} !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05) !important;
        }

        /* WooCommerce Notices & Messages styling matching border-radiuses */
        .woocommerce-message,
        .woocommerce-info,
        .woocommerce-error {
            border-top-color: {$primary} !important;
            background-color: #ffffff !important;
            border-radius: 12px !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03) !important;
            padding: 15px 20px !important;
            font-weight: bold !important;
        }

        /* Cart, checkout, and Account form rounded containers */
        .woocommerce-cart .cart-collaterals,
        .woocommerce-checkout #order_review,
        .woocommerce-checkout form.checkout_coupon,
        .woocommerce-checkout form.login,
        .woocommerce-MyAccount-navigation,
        .woocommerce-MyAccount-content,
        .woocommerce-cart table.cart {
            background-color: #ffffff !important;
            border-radius: {$radius} !important;
            padding: 24px !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02) !important;
        }

        /* Pagination & Filters widgets styling */
        .woocommerce nav.woocommerce-pagination ul {
            border: 1px solid #e2e8f0 !important;
            border-radius: 10px !important;
            overflow: hidden !important;
        }

        .woocommerce nav.woocommerce-pagination ul li a:hover,
        .woocommerce nav.woocommerce-pagination ul li span.current {
            background-color: {$primary} !important;
            color: #ffffff !important;
        }

        .widget_price_filter .ui-slider .ui-slider-range {
            background-color: {$primary} !important;
        }
        .widget_price_filter .ui-slider .ui-slider-handle {
            background-color: {$primary} !important;
            border-radius: 50% !important;
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
