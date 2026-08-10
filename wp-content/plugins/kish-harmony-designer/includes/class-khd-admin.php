<?php
namespace KishHarmonyDesigner;

if (!defined('ABSPATH')) {
    exit;
}

class Admin {
    private static $instance = null;

    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
        add_action('wp_ajax_khd_save_settings', array($this, 'ajax_save_settings'));
        add_action('add_meta_boxes', array($this, 'register_page_override_metabox'));
        add_action('save_post', array($this, 'save_page_override_meta'));
    }

    /**
     * Add theme options page
     */
    public function add_admin_menu() {
        add_menu_page(
            __('تنظیمات طراحی هارمونی', 'kish-harmony-designer'),
            __('تنظیمات طراحی', 'kish-harmony-designer'),
            'manage_options',
            'kish-harmony-designer',
            array($this, 'render_settings_page'),
            'dashicons-admin-customizer',
            59
        );
    }

    /**
     * Enqueue Admin CSS/JS
     */
    public function enqueue_admin_assets($hook) {
        if ($hook !== 'toplevel_page_kish-harmony-designer') {
            return;
        }

        wp_enqueue_media();

        wp_enqueue_style(
            'khd-admin-style',
            KHD_PLUGIN_URL . 'admin/css/admin-style.css',
            array(),
            KHD_VERSION
        );

        wp_enqueue_script(
            'khd-admin-script',
            KHD_PLUGIN_URL . 'admin/js/admin-script.js',
            array('jquery', 'jquery-ui-sortable'),
            KHD_VERSION,
            true
        );

        // Localize settings data
        wp_localize_script('khd-admin-script', 'khdAdmin', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('khd_save_nonce'),
            'settings' => Helpers::get_settings(),
            'site_url' => home_url('/')
        ));
    }

    /**
     * Render the admin panel template
     */
    public function render_settings_page() {
        include KHD_PLUGIN_DIR . 'admin/templates/settings-page.php';
    }

    /**
     * AJax Save Settings securely
     */
    public function ajax_save_settings() {
        check_ajax_referer('khd_save_nonce', 'nonce');

        if (!current_user_can('manage_options')) {
            wp_send_json_error(array('message' => __('شما اجازه دسترسی به این تنظیمات را ندارید.', 'kish-harmony-designer')));
        }

        $posted_settings = isset($_POST['settings']) ? $_POST['settings'] : '';
        if (empty($posted_settings)) {
            wp_send_json_error(array('message' => __('اطلاعاتی ارسال نشده است.', 'kish-harmony-designer')));
        }

        $decoded = json_decode(stripslashes($posted_settings), true);
        if (!$decoded) {
            wp_send_json_error(array('message' => __('ساختار داده معتبر نیست.', 'kish-harmony-designer')));
        }

        // Deep Sanitization
        $sanitized_settings = array();

        // 1. Sections reorder & status
        if (isset($decoded['sections'])) {
            $sanitized_settings['sections'] = Helpers::sanitize_sections($decoded['sections']);
        }

        // 2. Global settings
        if (isset($decoded['global'])) {
            $sanitized_settings['global'] = array(
                'primary_color'   => sanitize_hex_color($decoded['global']['primary_color']),
                'secondary_color' => sanitize_hex_color($decoded['global']['secondary_color']),
                'bg_color'        => sanitize_hex_color($decoded['global']['bg_color']),
                'text_color'      => sanitize_hex_color($decoded['global']['text_color']),
                'accent_color'    => sanitize_hex_color($decoded['global']['accent_color']),
                'font_family'     => sanitize_text_field($decoded['global']['font_family']),
                'border_radius'   => sanitize_text_field($decoded['global']['border_radius']),
                'container_width' => sanitize_text_field($decoded['global']['container_width']),
            );
        }

        // 3. Typography
        if (isset($decoded['typography'])) {
            foreach (array('h1', 'h2', 'body') as $tag) {
                if (isset($decoded['typography'][$tag])) {
                    foreach (array('desktop', 'tablet', 'mobile') as $device) {
                        if (isset($decoded['typography'][$tag][$device])) {
                            $sanitized_settings['typography'][$tag][$device] = array(
                                'size'           => sanitize_text_field($decoded['typography'][$tag][$device]['size']),
                                'weight'         => sanitize_text_field($decoded['typography'][$tag][$device]['weight']),
                                'line_height'    => sanitize_text_field($decoded['typography'][$tag][$device]['line_height']),
                                'letter_spacing' => sanitize_text_field($decoded['typography'][$tag][$device]['letter_spacing']),
                            );
                        }
                    }
                }
            }
        }

        // 4. Spacing (Paddings / margins)
        if (isset($decoded['spacing'])) {
            foreach ($decoded['spacing'] as $key => $devices) {
                $safe_key = sanitize_key($key);
                foreach ($devices as $device => $fields) {
                    $safe_device = sanitize_key($device);
                    foreach ($fields as $field => $val) {
                        $safe_field = sanitize_key($field);
                        $sanitized_settings['spacing'][$safe_key][$safe_device][$safe_field] = sanitize_text_field($val);
                    }
                }
            }
        }

        // 5. WooCommerce
        if (isset($decoded['woocommerce'])) {
            $sanitized_settings['woocommerce'] = array(
                'card_bg'            => sanitize_hex_color($decoded['woocommerce']['card_bg']),
                'card_border_radius' => sanitize_text_field($decoded['woocommerce']['card_border_radius']),
                'button_bg'          => sanitize_hex_color($decoded['woocommerce']['button_bg']),
                'button_text_color'  => sanitize_hex_color($decoded['woocommerce']['button_text_color']),
                'show_rating'        => isset($decoded['woocommerce']['show_rating']) ? (bool)$decoded['woocommerce']['show_rating'] : false,
                'show_price'         => isset($decoded['woocommerce']['show_price']) ? (bool)$decoded['woocommerce']['show_price'] : false,
            );
        }

        // 6. Custom CSS & HTML Block content
        $sanitized_settings['custom_css'] = Helpers::sanitize_css($decoded['custom_css'] ?? '');
        $sanitized_settings['custom_html_1_code'] = Helpers::sanitize_html($decoded['custom_html_1_code'] ?? '');
        $sanitized_settings['custom_html_2_code'] = Helpers::sanitize_html($decoded['custom_html_2_code'] ?? '');

        // 7. Custom CSS Selectors / styling
        if (isset($decoded['custom_selectors'])) {
            $sanitized_settings['custom_selectors'] = array();
            foreach ($decoded['custom_selectors'] as $sel_style) {
                if (isset($sel_style['selector'])) {
                    $sanitized_settings['custom_selectors'][] = array(
                        'selector'      => sanitize_text_field($sel_style['selector']),
                        'color'         => sanitize_hex_color($sel_style['color'] ?? ''),
                        'bg_color'      => sanitize_hex_color($sel_style['bg_color'] ?? ''),
                        'font_size'     => sanitize_text_field($sel_style['font_size'] ?? ''),
                        'padding'       => sanitize_text_field($sel_style['padding'] ?? ''),
                        'margin'        => sanitize_text_field($sel_style['margin'] ?? ''),
                        'border_radius' => sanitize_text_field($sel_style['border_radius'] ?? ''),
                    );
                }
            }
        }

        // Save and clear transient caches
        update_option(KHD_OPTION_KEY, $sanitized_settings);
        delete_transient('khd_generated_css');

        wp_send_json_success(array('message' => __('تنظیمات با موفقیت ذخیره شد!', 'kish-harmony-designer')));
    }

    /**
     * Metabox for Page level overrides
     */
    public function register_page_override_metabox() {
        add_meta_box(
            'khd_page_override',
            __('تنظیمات استایل اختصاصی برگه', 'kish-harmony-designer'),
            array($this, 'render_override_metabox'),
            array('page', 'post', 'product'),
            'normal',
            'high'
        );
    }

    public function render_override_metabox($post) {
        wp_nonce_field('khd_save_override', 'khd_override_nonce');
        $current_override = get_post_meta($post->ID, '_khd_page_override', true);
        if (!is_array($current_override)) {
            $current_override = array();
        }

        $primary = $current_override['primary_color'] ?? '';
        $bg = $current_override['bg_color'] ?? '';
        $custom_css = $current_override['custom_css'] ?? '';
        $disable_header = isset($current_override['disable_header']) ? (bool)$current_override['disable_header'] : false;
        $disable_footer = isset($current_override['disable_footer']) ? (bool)$current_override['disable_footer'] : false;
        ?>
        <div class="khd-meta-box-wrapper" style="font-family: Tahoma, sans-serif; direction: rtl; text-align: right; padding: 10px 0;">
            <p><strong>تنظیمات زیر استایل‌های سراسری سایت را فقط روی این صفحه لغو (Override) می‌کنند:</strong></p>
            <table class="form-table" style="width: 100%;">
                <tr>
                    <th style="width: 200px;"><label for="khd_meta_primary"><?php _e('رنگ اصلی این صفحه', 'kish-harmony-designer'); ?></label></th>
                    <td>
                        <input type="color" id="khd_meta_primary" name="khd_override[primary_color]" value="<?php echo esc_attr($primary); ?>">
                        <span class="description"><?php _e('رنگ اصلی برند را برای این صفحه تغییر دهید', 'kish-harmony-designer'); ?></span>
                    </td>
                </tr>
                <tr>
                    <th><label for="khd_meta_bg"><?php _e('رنگ پس‌زمینه این صفحه', 'kish-harmony-designer'); ?></label></th>
                    <td>
                        <input type="color" id="khd_meta_bg" name="khd_override[bg_color]" value="<?php echo esc_attr($bg); ?>">
                    </td>
                </tr>
                <tr>
                    <th><label><?php _e('کنترل نمایش بخش‌ها', 'kish-harmony-designer'); ?></label></th>
                    <td>
                        <label style="margin-left: 15px;">
                            <input type="checkbox" name="khd_override[disable_header]" value="1" <?php checked($disable_header); ?>>
                            <?php _e('غیرفعال کردن هدر', 'kish-harmony-designer'); ?>
                        </label>
                        <label>
                            <input type="checkbox" name="khd_override[disable_footer]" value="1" <?php checked($disable_footer); ?>>
                            <?php _e('غیرفعال کردن فوتر', 'kish-harmony-designer'); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th><label for="khd_meta_css"><?php _e('کدهای CSS سفارشی این صفحه', 'kish-harmony-designer'); ?></label></th>
                    <td>
                        <textarea id="khd_meta_css" name="khd_override[custom_css]" rows="5" style="width: 100%; font-family: monospace; direction: ltr; text-align: left;"><?php echo esc_textarea($custom_css); ?></textarea>
                    </td>
                </tr>
            </table>
        </div>
        <?php
    }

    public function save_page_override_meta($post_id) {
        if (!isset($_POST['khd_override_nonce']) || !wp_verify_nonce($_POST['khd_override_nonce'], 'khd_save_override')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (isset($_POST['khd_override'])) {
            $data = $_POST['khd_override'];
            $sanitized = array(
                'primary_color'  => sanitize_hex_color($data['primary_color'] ?? ''),
                'bg_color'       => sanitize_hex_color($data['bg_color'] ?? ''),
                'disable_header' => isset($data['disable_header']) ? true : false,
                'disable_footer' => isset($data['disable_footer']) ? true : false,
                'custom_css'     => Helpers::sanitize_css($data['custom_css'] ?? ''),
            );
            update_post_meta($post_id, '_khd_page_override', $sanitized);
        } else {
            delete_post_meta($post_id, '_khd_page_override');
        }
    }
}
