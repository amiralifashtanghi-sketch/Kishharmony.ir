<?php
namespace KishHarmonyDesigner;

if (!defined('ABSPATH')) {
    exit;
}

class Frontend {
    private static $instance = null;

    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('wp_head', array($this, 'inject_dynamic_css'), 99);
        add_action('wp_enqueue_scripts', array($this, 'enqueue_local_fonts'), 1);
        add_action('wp_enqueue_scripts', array($this, 'enqueue_live_preview_assets'));
        add_filter('body_class', array($this, 'inject_body_overrides'));
    }

    /**
     * Local Fonts Enqueue - Intranet Safe (No Google Fonts/External Request Dependency)
     */
    public function enqueue_local_fonts() {
        // Enqueue Vazirmatn locally hosted style if needed
        // Register local font-face definitions
        wp_register_style('khd-local-fonts', false);
        wp_enqueue_style('khd-local-fonts');

        $font_face_css = "
        @font-face {
            font-family: 'Vazirmatn';
            font-style: normal;
            font-weight: 100 900;
            font-display: swap;
            src: url('" . KHD_PLUGIN_URL . "assets/fonts/vazirmatn/vazirmatn.woff2') format('woff2');
        }
        @font-face {
            font-family: 'Shabnam';
            font-style: normal;
            font-weight: normal;
            font-display: swap;
            src: url('" . KHD_PLUGIN_URL . "assets/fonts/shabnam/shabnam.woff2') format('woff2');
        }
        @font-face {
            font-family: 'Samim';
            font-style: normal;
            font-weight: normal;
            font-display: swap;
            src: url('" . KHD_PLUGIN_URL . "assets/fonts/samim/samim.woff2') format('woff2');
        }
        ";
        wp_add_inline_style('khd-local-fonts', $font_face_css);
    }

    /**
     * Enqueue real-time live preview Javascript receiver when inside the preview Iframe
     */
    public function enqueue_live_preview_assets() {
        if (isset($_GET['khd_preview']) && $_GET['khd_preview'] === '1') {
            wp_enqueue_script(
                'khd-live-preview',
                KHD_PLUGIN_URL . 'assets/js/live-preview.js',
                array(),
                KHD_VERSION,
                true
            );
        }
    }

    /**
     * Fetch settings and override on a per-page metadata basis
     */
    public function get_effective_settings() {
        $global = Helpers::get_settings();

        if (is_singular()) {
            $page_id = get_the_ID();
            $override = get_post_meta($page_id, '_khd_page_override', true);
            if (is_array($override)) {
                if (!empty($override['primary_color'])) {
                    $global['global']['primary_color'] = $override['primary_color'];
                }
                if (!empty($override['bg_color'])) {
                    $global['global']['bg_color'] = $override['bg_color'];
                }
                if (!empty($override['custom_css'])) {
                    $global['custom_css'] .= "\n/* Page Override CSS */\n" . $override['custom_css'];
                }
            }
        }
        return $global;
    }

    /**
     * Dynamic CSS Variable Generator & Injection
     */
    public function inject_dynamic_css() {
        // Attempt to load cached generated CSS first to prevent server rebuild bottlenecks
        $cached_css = get_transient('khd_generated_css');
        $is_preview = isset($_GET['khd_preview']) && $_GET['khd_preview'] === '1';

        if ($cached_css && !$is_preview && !is_singular()) {
            echo "<!-- Harmony Designer Cached Style -->\n<style id='harmony-designer-css'>" . $cached_css . "</style>\n";
            return;
        }

        $settings = $this->get_effective_settings();
        $g = $settings['global'] ?? array();
        $t = $settings['typography'] ?? array();
        $s = $settings['spacing'] ?? array();

        $primary   = $g['primary_color'] ?? '#0B63D8';
        $secondary = $g['secondary_color'] ?? '#18D6D8';
        $bg        = $g['bg_color'] ?? '#f8fafc';
        $text      = $g['text_color'] ?? '#1e293b';
        $accent    = $g['accent_color'] ?? '#FF8A00';
        $font      = $g['font_family'] ?? 'Vazirmatn';
        $radius    = $g['border_radius'] ?? '20px';
        $width     = $g['container_width'] ?? '1280px';

        $css = "
        :root {
            --brand-blue: {$primary} !important;
            --tw-color-brand-blue: {$primary} !important;
            --brand-cyan: {$secondary} !important;
            --brand-orange: {$accent} !important;
            --brand-dark: {$text} !important;
            --harmony-primary-color: {$primary};
            --harmony-secondary-color: {$secondary};
            --harmony-bg-color: {$bg};
            --harmony-text-color: {$text};
            --harmony-accent-color: {$accent};
            --harmony-font-family: '{$font}', sans-serif;
            --harmony-border-radius: {$radius};
            --harmony-container-width: {$width};
        }

        body {
            background-color: var(--harmony-bg-color) !important;
            color: var(--harmony-text-color) !important;
            font-family: var(--harmony-font-family) !important;
        }

        /* Page Metadata Disable Header/Footer Overrides */
        .khd-disabled-header header,
        .khd-disabled-header .header {
            display: none !important;
        }
        .khd-disabled-footer footer,
        .khd-disabled-footer .footer {
            display: none !important;
        }

        /* Container Layout Control */
        .max-w-7xl, .container, .max-w-6xl {
            max-width: var(--harmony-container-width) !important;
        }

        /* Dynamic Theme Roundness Control */
        .rounded-3xl, .rounded-2xl, .rounded-xl, .rounded-lg, .rounded-\[24px\], .rounded-\[28px\], .rounded-\[30px\] {
            border-radius: var(--harmony-border-radius) !important;
        }

        /* Typography Heading 1 Styles */
        h1, .text-5xl, .text-4xl {
            font-size: " . ($t['h1']['desktop']['size'] ?? '36px') . " !important;
            font-weight: " . ($t['h1']['desktop']['weight'] ?? '900') . " !important;
            line-height: " . ($t['h1']['desktop']['line_height'] ?? '1.4') . " !important;
            letter-spacing: " . ($t['h1']['desktop']['letter_spacing'] ?? '0px') . " !important;
        }

        /* Typography Heading 2 Styles */
        h2, .text-2xl, .text-3xl {
            font-size: " . ($t['h2']['desktop']['size'] ?? '24px') . " !important;
            font-weight: " . ($t['h2']['desktop']['weight'] ?? '800') . " !important;
            line-height: " . ($t['h2']['desktop']['line_height'] ?? '1.5') . " !important;
            letter-spacing: " . ($t['h2']['desktop']['letter_spacing'] ?? '0px') . " !important;
        }

        /* Body & Standard Paragraph Typography */
        p, body, .text-base, .text-sm {
            font-size: " . ($t['body']['desktop']['size'] ?? '16px') . " !important;
            font-weight: " . ($t['body']['desktop']['weight'] ?? '400') . " !important;
            line-height: " . ($t['body']['desktop']['line_height'] ?? '1.6') . " !important;
            letter-spacing: " . ($t['body']['desktop']['letter_spacing'] ?? '0px') . " !important;
        }

        /* Spacing Padding and Margins Override via CSS Custom Properties */
        .hero {
            background-color: var(--harmony-primary-color) !important;
            padding-top: " . ($s['hero']['desktop']['padding_top'] ?? '70px') . " !important;
            padding-bottom: " . ($s['hero']['desktop']['padding_bottom'] ?? '24px') . " !important;
            margin-bottom: " . ($s['hero']['desktop']['margin_bottom'] ?? '176px') . " !important;
        }

        .search-filter-section {
            padding: " . ($s['search']['desktop']['padding'] ?? '24px') . " !important;
            margin-bottom: " . ($s['search']['desktop']['margin_bottom'] ?? '64px') . " !important;
        }

        /* Connecting Categories dynamic rounds and text settings */
        .categories-grid {
            border-radius: var(--harmony-border-radius) !important;
        }

        .category-item {
            transition: background-color " . ($hdr['animation_speed'] ?? '300ms') . " ease;
        }

        /* Tablet Responsive Fallback Overrides */
        @media (max-width: 1024px) {
            h1, .text-5xl, .text-4xl {
                font-size: " . ($t['h1']['tablet']['size'] ?? '28px') . " !important;
                font-weight: " . ($t['h1']['tablet']['weight'] ?? '900') . " !important;
                line-height: " . ($t['h1']['tablet']['line_height'] ?? '1.4') . " !important;
            }
            h2, .text-2xl, .text-3xl {
                font-size: " . ($t['h2']['tablet']['size'] ?? '20px') . " !important;
                font-weight: " . ($t['h2']['tablet']['weight'] ?? '800') . " !important;
                line-height: " . ($t['h2']['tablet']['line_height'] ?? '1.5') . " !important;
            }
            p, body, .text-base, .text-sm {
                font-size: " . ($t['body']['tablet']['size'] ?? '15px') . " !important;
                font-weight: " . ($t['body']['tablet']['weight'] ?? '400') . " !important;
            }
            .hero {
                padding-top: " . ($s['hero']['tablet']['padding_top'] ?? '24px') . " !important;
                padding-bottom: " . ($s['hero']['tablet']['padding_bottom'] ?? '24px') . " !important;
                margin-bottom: " . ($s['hero']['tablet']['margin_bottom'] ?? '176px') . " !important;
            }
            .search-filter-section {
                padding: " . ($s['search']['tablet']['padding'] ?? '24px') . " !important;
                margin-bottom: " . ($s['search']['tablet']['margin_bottom'] ?? '64px') . " !important;
            }
        }

        /* Mobile Responsive Fallback Overrides */
        @media (max-width: 640px) {
            h1, .text-5xl, .text-4xl {
                font-size: " . ($t['h1']['mobile']['size'] ?? '22px') . " !important;
                font-weight: " . ($t['h1']['mobile']['weight'] ?? '900') . " !important;
                line-height: " . ($t['h1']['mobile']['line_height'] ?? '1.4') . " !important;
            }
            h2, .text-2xl, .text-3xl {
                font-size: " . ($t['h2']['mobile']['size'] ?? '18px') . " !important;
                font-weight: " . ($t['h2']['mobile']['weight'] ?? '800') . " !important;
                line-height: " . ($t['h2']['mobile']['line_height'] ?? '1.5') . " !important;
            }
            p, body, .text-base, .text-sm {
                font-size: " . ($t['body']['mobile']['size'] ?? '14px') . " !important;
                font-weight: " . ($t['body']['mobile']['weight'] ?? '400') . " !important;
            }
            .hero {
                padding-top: " . ($s['hero']['mobile']['padding_top'] ?? '16px') . " !important;
                padding-bottom: " . ($s['hero']['mobile']['padding_bottom'] ?? '16px') . " !important;
                margin-bottom: " . ($s['hero']['mobile']['margin_bottom'] ?? '144px') . " !important;
            }
            .search-filter-section {
                padding: " . ($s['search']['mobile']['padding'] ?? '16px') . " !important;
                margin-bottom: " . ($s['search']['mobile']['margin_bottom'] ?? '48px') . " !important;
            }
        }
        ";

        // Add Custom CSS Selectors Styling
        if (isset($settings['custom_selectors']) && is_array($settings['custom_selectors'])) {
            foreach ($settings['custom_selectors'] as $sel) {
                if (!empty($sel['selector'])) {
                    $css .= "\n" . esc_html($sel['selector']) . " {\n";
                    if (!empty($sel['color'])) { $css .= "  color: " . esc_html($sel['color']) . " !important;\n"; }
                    if (!empty($sel['bg_color'])) { $css .= "  background-color: " . esc_html($sel['bg_color']) . " !important;\n"; }
                    if (!empty($sel['font_size'])) { $css .= "  font-size: " . esc_html($sel['font_size']) . " !important;\n"; }
                    if (!empty($sel['padding'])) { $css .= "  padding: " . esc_html($sel['padding']) . " !important;\n"; }
                    if (!empty($sel['margin'])) { $css .= "  margin: " . esc_html($sel['margin']) . " !important;\n"; }
                    if (!empty($sel['border_radius'])) { $css .= "  border-radius: " . esc_html($sel['border_radius']) . " !important;\n"; }
                    $css .= "}\n";
                }
            }
        }

        // Add Free Custom CSS
        if (!empty($settings['custom_css'])) {
            $css .= "\n/* Custom CSS block */\n" . $settings['custom_css'];
        }

        // Minify output lightly to save load overheads
        $minified_css = preg_replace('/\s+/', ' ', $css);

        // Cache the output unless in preview
        if (!$is_preview) {
            set_transient('khd_generated_css', $minified_css, DAY_IN_SECONDS);
        }

        echo "<!-- Harmony Designer Dynamic Style -->\n<style id='harmony-designer-css'>" . $minified_css . "</style>\n";
    }

    /**
     * Optional body classes for layouts / custom overrides
     */
    public function inject_body_overrides($classes) {
        if (is_singular()) {
            $override = get_post_meta(get_the_ID(), '_khd_page_override', true);
            if (is_array($override)) {
                if (!empty($override['disable_header'])) {
                    $classes[] = 'khd-disabled-header';
                }
                if (!empty($override['disable_footer'])) {
                    $classes[] = 'khd-disabled-footer';
                }
            }
        }
        return $classes;
    }
}
