<?php
/**
 * Dynamic CSS Compiler & Caching Manager
 * Kish Harmony Visual Design Management System
 */

if (!defined('ABSPATH')) {
    exit;
}

class Kish_CSS_Compiler {
    private static $instance = null;
    private $option_key = 'kish_harmony_design_options';
    private $transient_key = 'kish_harmony_compiled_css';

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_compiled_css'), 20);
        add_action('update_option_' . $this->option_key, array($this, 'clear_cache'));
    }

    public function clear_cache() {
        delete_transient($this->transient_key);
    }

    public function get_options() {
        $defaults = array(
            'primary_color' => '#0B63D8',
            'secondary_color' => '#18D6D8',
            'accent_color' => '#FF8A00',
            'dark_color' => '#071E3D',
            'bg_color' => '#f8fafc',
            'font_family' => 'Vazirmatn, sans-serif',
            'font_size_base' => '16px',
            'container_max_width' => '1200px',
            'breakpoint_desktop' => '1200px',
            'breakpoint_tablet' => '768px',
            'breakpoint_mobile' => '480px',
            'header_bg' => 'rgba(255, 255, 255, 0.9)',
            'header_glass_blur' => '12px',
            'footer_turquoise' => '#18D6D8',
            'footer_deep_blue' => '#0B63D8',
            'custom_css' => '',
        );

        $saved = get_option($this->option_key, array());
        return wp_parse_args($saved, $defaults);
    }

    public function compile_css() {
        $cached_css = get_transient($this->transient_key);
        if ($cached_css !== false) {
            return $cached_css;
        }

        $opts = $this->get_options();

        $css = "/* Kish Harmony Dynamic Compiled CSS */\n";
        $css .= ":root {\n";
        $css .= "  --kh-brand-blue: " . esc_attr($opts['primary_color']) . ";\n";
        $css .= "  --kh-brand-cyan: " . esc_attr($opts['secondary_color']) . ";\n";
        $css .= "  --kh-brand-orange: " . esc_attr($opts['accent_color']) . ";\n";
        $css .= "  --kh-brand-dark: " . esc_attr($opts['dark_color']) . ";\n";
        $css .= "  --kh-bg-slate: " . esc_attr($opts['bg_color']) . ";\n";
        $css .= "  --kh-font-family: " . esc_attr($opts['font_family']) . ";\n";
        $css .= "  --kh-container-width: " . esc_attr($opts['container_max_width']) . ";\n";
        $css .= "  --kh-header-bg: " . esc_attr($opts['header_bg']) . ";\n";
        $css .= "  --kh-footer-turquoise: " . esc_attr($opts['footer_turquoise']) . ";\n";
        $css .= "  --kh-footer-deep-blue: " . esc_attr($opts['footer_deep_blue']) . ";\n";
        $css .= "}\n\n";

        // Layout & Logical Properties Cascade
        $css .= "body {\n";
        $css .= "  font-family: var(--kh-font-family) !important;\n";
        $css .= "  background-color: var(--kh-bg-slate);\n";
        $css .= "  direction: rtl;\n";
        $css .= "  text-align: start;\n";
        $css .= "  margin: 0;\n";
        $css .= "  padding: 0;\n";
        $css .= "}\n\n";

        // Responsive Media Queries Cascade
        $css .= "@media screen and (max-width: " . esc_attr($opts['breakpoint_tablet']) . ") {\n";
        $css .= "  .kh-container { padding-inline: 1rem; }\n";
        $css .= "}\n\n";

        $css .= "@media screen and (max-width: " . esc_attr($opts['breakpoint_mobile']) . ") {\n";
        $css .= "  .kh-container { padding-inline: 0.5rem; }\n";
        $css .= "}\n\n";

        if (!empty($opts['custom_css'])) {
            $css .= "/* Custom Designer CSS */\n" . $opts['custom_css'] . "\n";
        }

        set_transient($this->transient_key, $css, 86400 * 7); // Cache for 7 days
        return $css;
    }

    public function enqueue_compiled_css() {
        $css = $this->compile_css();
        wp_add_inline_style('kish-harmony-style', $css);
    }
}

Kish_CSS_Compiler::get_instance();
