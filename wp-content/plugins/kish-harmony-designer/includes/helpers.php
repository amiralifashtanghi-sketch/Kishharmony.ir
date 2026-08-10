<?php
namespace KishHarmonyDesigner;

if (!defined('ABSPATH')) {
    exit;
}

class Helpers {
    /**
     * Get default theme options
     */
    public static function get_default_settings() {
        return array(
            'sections' => array(
                array('id' => 'hero', 'name' => 'بخش هیرو (بنر اصلی)', 'active' => true),
                array('id' => 'categories', 'name' => 'باکس‌های دسته‌بندی شناور', 'active' => true),
                array('id' => 'search', 'name' => 'جستجو و تگ‌های محبوب', 'active' => true),
                array('id' => 'sea_category', 'name' => 'تفریحات دریایی و ساحلی', 'active' => true),
                array('id' => 'special_offers', 'name' => 'پیشنهادهای ویژه و لحظه آخری', 'active' => true),
                array('id' => 'weather', 'name' => 'وضعیت آب و هوا', 'active' => true),
                array('id' => 'custom_html_1', 'name' => 'سکشن محتوای سفارشی ۱', 'active' => false),
                array('id' => 'custom_html_2', 'name' => 'سکشن محتوای سفارشی ۲', 'active' => false),
            ),
            'global' => array(
                'primary_color'   => '#0B63D8',
                'secondary_color' => '#18D6D8',
                'bg_color'        => '#f8fafc',
                'text_color'      => '#1e293b',
                'accent_color'    => '#FF8A00',
                'font_family'     => 'Vazirmatn',
                'border_radius'   => '20px',
                'container_width' => '1280px',
            ),
            'typography' => array(
                'h1' => array(
                    'desktop' => array('size' => '36px', 'weight' => '900', 'line_height' => '1.4', 'letter_spacing' => '0px'),
                    'tablet'  => array('size' => '28px', 'weight' => '900', 'line_height' => '1.4', 'letter_spacing' => '0px'),
                    'mobile'  => array('size' => '22px', 'weight' => '900', 'line_height' => '1.4', 'letter_spacing' => '0px'),
                ),
                'h2' => array(
                    'desktop' => array('size' => '24px', 'weight' => '800', 'line_height' => '1.5', 'letter_spacing' => '0px'),
                    'tablet'  => array('size' => '20px', 'weight' => '800', 'line_height' => '1.5', 'letter_spacing' => '0px'),
                    'mobile'  => array('size' => '18px', 'weight' => '800', 'line_height' => '1.5', 'letter_spacing' => '0px'),
                ),
                'body' => array(
                    'desktop' => array('size' => '16px', 'weight' => '400', 'line_height' => '1.6', 'letter_spacing' => '0px'),
                    'tablet'  => array('size' => '15px', 'weight' => '400', 'line_height' => '1.6', 'letter_spacing' => '0px'),
                    'mobile'  => array('size' => '14px', 'weight' => '400', 'line_height' => '1.6', 'letter_spacing' => '0px'),
                )
            ),
            'spacing' => array(
                'hero' => array(
                    'desktop' => array('padding_top' => '24px', 'padding_bottom' => '24px', 'margin_bottom' => '176px'),
                    'tablet'  => array('padding_top' => '24px', 'padding_bottom' => '24px', 'margin_bottom' => '176px'),
                    'mobile'  => array('padding_top' => '16px', 'padding_bottom' => '16px', 'margin_bottom' => '144px'),
                ),
                'search' => array(
                    'desktop' => array('padding' => '24px', 'margin_bottom' => '64px'),
                    'tablet'  => array('padding' => '24px', 'margin_bottom' => '64px'),
                    'mobile'  => array('padding' => '16px', 'margin_bottom' => '48px'),
                )
            ),
            'woocommerce' => array(
                'card_bg'            => '#ffffff',
                'card_border_radius' => '16px',
                'button_bg'          => '#0B63D8',
                'button_text_color'  => '#ffffff',
                'show_rating'        => true,
                'show_price'         => true,
            ),
            'custom_css' => '',
            'custom_html_1_code' => '<div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm text-center"><h3>محتوای سفارشی ۱</h3><p>شما می‌توانید این بخش را به دلخواه خود در پنل مدیریت استایل‌دهی و محتواگذاری کنید.</p></div>',
            'custom_html_2_code' => '<div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm text-center"><h3>محتوای سفارشی ۲</h3><p>شما می‌توانید این بخش را به دلخواه خود در پنل مدیریت استایل‌دهی و محتواگذاری کنید.</p></div>',
            'custom_selectors' => array()
        );
    }

    /**
     * Get settings from options, merges with defaults
     */
    public static function get_settings() {
        $saved = get_option(KHD_OPTION_KEY, array());
        $defaults = self::get_default_settings();
        return self::deep_merge_arrays($defaults, $saved);
    }

    /**
     * Deep merge helper to preserve defaults
     */
    private static function deep_merge_arrays($default, $saved) {
        if (!is_array($saved)) {
            return $default;
        }
        foreach ($saved as $key => $val) {
            if (isset($default[$key]) && is_array($val) && is_array($default[$key])) {
                $default[$key] = self::deep_merge_arrays($default[$key], $val);
            } else {
                $default[$key] = $val;
            }
        }
        return $default;
    }

    /**
     * Sanitize layout sections
     */
    public static function sanitize_sections($sections) {
        if (!is_array($sections)) {
            return array();
        }
        $sanitized = array();
        foreach ($sections as $section) {
            if (isset($section['id']) && isset($section['name'])) {
                $sanitized[] = array(
                    'id'     => sanitize_key($section['id']),
                    'name'   => sanitize_text_field($section['name']),
                    'active' => isset($section['active']) ? (bool)$section['active'] : false
                );
            }
        }
        return $sanitized;
    }

    /**
     * Clean and secure Custom CSS
     */
    public static function sanitize_css($css) {
        return wp_strip_all_tags(wp_unslash($css));
    }

    /**
     * Sanitize Custom HTML blocks responsibly
     */
    public static function sanitize_html($html) {
        if (current_user_can('unfiltered_html')) {
            return $html;
        }
        return wp_kses_post($html);
    }

    /**
     * Get list of locally supported Persian fonts
     */
    public static function get_available_fonts() {
        return array(
            'Vazirmatn' => array(
                'name' => 'وزیر متن (پیش‌فرض)',
                'css'  => "'Vazirmatn', sans-serif"
            ),
            'Shabnam' => array(
                'name' => 'شبنم',
                'css'  => "'Shabnam', sans-serif"
            ),
            'Samim' => array(
                'name' => 'صمیم',
                'css'  => "'Samim', sans-serif"
            )
        );
    }
}
