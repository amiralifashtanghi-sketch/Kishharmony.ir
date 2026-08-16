<?php
/**
 * Dynamic Layout Builder & Custom Block Renderer
 */

if (!defined('ABSPATH')) {
    exit;
}

class Kish_Layout_Builder {
    private static $instance = null;
    private $option_key = 'kish_harmony_layout_sections';

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get_sections() {
        $defaults = array(
            'hero' => array('enabled' => true, 'order' => 10, 'title' => 'هدر و بنر بنر و کارت‌های دسته‌بندی'),
            'search' => array('enabled' => true, 'order' => 20, 'title' => 'جستجو و فیلتر سریع'),
            'sea_categories' => array('enabled' => true, 'order' => 30, 'title' => 'دسته‌بندی تفریحات دریایی'),
            'special_offers' => array('enabled' => true, 'order' => 40, 'title' => 'پیشنهادهای ویژه و لحظه آخری'),
            'weather' => array('enabled' => true, 'order' => 50, 'title' => 'ویجت آب و هوای کیش'),
            'car_rent' => array('enabled' => true, 'order' => 60, 'title' => 'رنت خودروهای لوکس'),
            'gallery' => array('enabled' => true, 'order' => 70, 'title' => 'گالری تصاویر کیش هارمونی'),
            'travel_guide' => array('enabled' => true, 'order' => 80, 'title' => 'راهنمای سفر و برنامه‌ریزی'),
            'footer' => array('enabled' => true, 'order' => 90, 'title' => 'فوتر جزیره آبی'),
        );

        $saved = get_option($this->option_key, array());
        return wp_parse_args($saved, $defaults);
    }

    public function render_section($section_id) {
        $sections = $this->get_sections();
        if (isset($sections[$section_id]) && !empty($sections[$section_id]['enabled'])) {
            $file = get_stylesheet_directory() . "/parts/section-{$section_id}.php";
            if (file_exists($file)) {
                include $file;
            }
        }
    }
}

Kish_Layout_Builder::get_instance();
