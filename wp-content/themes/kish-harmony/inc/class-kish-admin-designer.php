<?php
/**
 * Kish Harmony Visual Design Management System (WP Admin Panel)
 */

if (!defined('ABSPATH')) {
    exit;
}

class Kish_Admin_Designer {
    private static $instance = null;
    private $option_key = 'kish_harmony_design_options';

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function __construct() {
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('wp_ajax_kish_harmony_import_json', array($this, 'ajax_import_json'));
        add_action('wp_ajax_kish_harmony_export_json', array($this, 'ajax_export_json'));
    }

    public function add_admin_menu() {
        add_menu_page(
            __('طراحی کیش هارمونی', 'kish-harmony'),
            __('Kish Designer', 'kish-harmony'),
            'manage_options',
            'kish-harmony-designer',
            array($this, 'render_admin_page'),
            'dashicons-art',
            59
        );
    }

    public function register_settings() {
        register_setting('kish_harmony_design_group', $this->option_key, array($this, 'sanitize_options'));
    }

    public function sanitize_options($input) {
        $clean = array();
        if (is_array($input)) {
            foreach ($input as $key => $val) {
                if ($key === 'custom_css' || $key === 'custom_html') {
                    $clean[$key] = wp_kses_post($val);
                } else {
                    $clean[$key] = sanitize_text_field($val);
                }
            }
        }
        return $clean;
    }

    public function ajax_export_json() {
        check_ajax_referer('kish_harmony_designer_nonce', 'nonce');
        if (!current_user_can('manage_options')) {
            wp_send_json_error(__('دسترسی غیرمجاز', 'kish-harmony'));
        }

        $opts = get_option($this->option_key, array());
        $data = array(
            'version' => '1.0.0',
            'timestamp' => time(),
            'options' => $opts
        );

        wp_send_json_success($data);
    }

    public function ajax_import_json() {
        check_ajax_referer('kish_harmony_designer_nonce', 'nonce');
        if (!current_user_can('manage_options')) {
            wp_send_json_error(__('دسترسی غیرمجاز', 'kish-harmony'));
        }

        $json = isset($_POST['json_data']) ? wp_unslash($_POST['json_data']) : '';
        $data = json_decode($json, true);

        if (!$data || !is_array($data) || !isset($data['options']) || !is_array($data['options'])) {
            wp_send_json_error(__('فایل JSON نامعتبر است', 'kish-harmony'));
        }

        $clean_options = $this->sanitize_options($data['options']);
        update_option($this->option_key, $clean_options);
        delete_transient('kish_harmony_compiled_css');

        wp_send_json_success(__('تنظیمات با موفقیت بازیابی شدند', 'kish-harmony'));
    }

    public function render_admin_page() {
        if (!current_user_can('manage_options')) {
            return;
        }

        $opts = Kish_CSS_Compiler::get_instance()->get_options();
        $nonce = wp_create_nonce('kish_harmony_designer_nonce');
        ?>
        <div class="wrap kish-designer-wrap" dir="rtl">
            <h1 style="display:flex;align-items:center;gap:10px;">
                <span class="dashicons dashicons-art" style="font-size:32px;width:32px;height:32px;color:#0B63D8;"></span>
                <span>سیستم مدیریت طراحی بصری کیش هارمونی (Visual Design Management System)</span>
            </h1>
            <p>تمام تنظیمات ظاهری، لایه‌بندی، متغیرها و بخش‌های سایت کیش هارمونی به صورت متمرکز از این پنل مدیریت می‌شوند.</p>

            <?php if (isset($_GET['settings-updated'])) : ?>
                <div class="notice notice-success is-dismissible"><p><strong>تنظیمات طراحی با موفقیت ذخیره شدند.</strong></p></div>
            <?php endif; ?>

            <form method="post" action="options.php" style="margin-top:20px;">
                <?php
                settings_fields('kish_harmony_design_group');
                ?>
                <div style="display:flex;gap:20px;background:#fff;padding:20px;border-radius:12px;box-shadow:0 4px 15px rgba(0,0,0,0.05);">
                    <!-- Tabs Sidebar -->
                    <div style="width:220px;border-left:1px solid #e5e7eb;padding-left:15px;">
                        <ul class="kish-tabs" style="list-style:none;padding:0;margin:0;">
                            <li style="margin-bottom:8px;"><a href="#tab-global" class="button button-secondary button-large" style="width:100%;text-align:right;">Global & Colors</a></li>
                            <li style="margin-bottom:8px;"><a href="#tab-typography" class="button button-secondary button-large" style="width:100%;text-align:right;">Typography & Local Fonts</a></li>
                            <li style="margin-bottom:8px;"><a href="#tab-responsive" class="button button-secondary button-large" style="width:100%;text-align:right;">Responsive Breakpoints</a></li>
                            <li style="margin-bottom:8px;"><a href="#tab-header" class="button button-secondary button-large" style="width:100%;text-align:right;">Header Options</a></li>
                            <li style="margin-bottom:8px;"><a href="#tab-footer" class="button button-secondary button-large" style="width:100%;text-align:right;">Footer Options</a></li>
                            <li style="margin-bottom:8px;"><a href="#tab-picker" class="button button-secondary button-large" style="width:100%;text-align:right;">Element Picker & CSS</a></li>
                            <li style="margin-bottom:8px;"><a href="#tab-import-export" class="button button-secondary button-large" style="width:100%;text-align:right;">Import / Export JSON</a></li>
                        </ul>
                    </div>

                    <!-- Tab Contents -->
                    <div style="flex:1;padding-right:15px;">
                        <!-- Tab: Global & Colors -->
                        <div id="tab-global" class="kish-tab-content">
                            <h2>رنگ‌های اصلی برند (Brand Design Tokens)</h2>
                            <table class="form-table">
                                <tr>
                                    <th>رنگ اصلی برند (Primary Blue)</th>
                                    <td><input type="color" name="<?php echo esc_attr($this->option_key); ?>[primary_color]" value="<?php echo esc_attr($opts['primary_color']); ?>"> <code><?php echo esc_html($opts['primary_color']); ?></code></td>
                                </tr>
                                <tr>
                                    <th>رنگ فیروزه‌ای (Secondary Cyan)</th>
                                    <td><input type="color" name="<?php echo esc_attr($this->option_key); ?>[secondary_color]" value="<?php echo esc_attr($opts['secondary_color']); ?>"> <code><?php echo esc_html($opts['secondary_color']); ?></code></td>
                                </tr>
                                <tr>
                                    <th>رنگ نارنجی تأکیدی (Accent Orange)</th>
                                    <td><input type="color" name="<?php echo esc_attr($this->option_key); ?>[accent_color]" value="<?php echo esc_attr($opts['accent_color']); ?>"> <code><?php echo esc_html($opts['accent_color']); ?></code></td>
                                </tr>
                                <tr>
                                    <th>رنگ سرمه‌ای تیره (Dark Navy)</th>
                                    <td><input type="color" name="<?php echo esc_attr($this->option_key); ?>[dark_color]" value="<?php echo esc_attr($opts['dark_color']); ?>"> <code><?php echo esc_html($opts['dark_color']); ?></code></td>
                                </tr>
                            </table>
                        </div>

                        <!-- Tab: Typography -->
                        <div id="tab-typography" class="kish-tab-content" style="display:none;">
                            <h2>تایپوگرافی و فونت‌های محلی</h2>
                            <table class="form-table">
                                <tr>
                                    <th>خانواده فونت اصلی</th>
                                    <td>
                                        <select name="<?php echo esc_attr($this->option_key); ?>[font_family]">
                                            <option value="Vazirmatn, sans-serif" <?php selected($opts['font_family'], 'Vazirmatn, sans-serif'); ?>>وزیرمتن (Vazirmatn - Local)</option>
                                            <option value="Shabnam, sans-serif" <?php selected($opts['font_family'], 'Shabnam, sans-serif'); ?>>شبنم (Shabnam - Local)</option>
                                            <option value="Samim, sans-serif" <?php selected($opts['font_family'], 'Samim, sans-serif'); ?>>صمیم (Samim - Local)</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <!-- Tab: Responsive -->
                        <div id="tab-responsive" class="kish-tab-content" style="display:none;">
                            <h2>تنظیمات Breakpointهای Responsive</h2>
                            <table class="form-table">
                                <tr>
                                    <th>عرض دسکتاپ (Desktop)</th>
                                    <td><input type="text" name="<?php echo esc_attr($this->option_key); ?>[breakpoint_desktop]" value="<?php echo esc_attr($opts['breakpoint_desktop']); ?>" class="regular-text"></td>
                                </tr>
                                <tr>
                                    <th>عرض تبلت (Tablet Breakpoint)</th>
                                    <td><input type="text" name="<?php echo esc_attr($this->option_key); ?>[breakpoint_tablet]" value="<?php echo esc_attr($opts['breakpoint_tablet']); ?>" class="regular-text"></td>
                                </tr>
                                <tr>
                                    <th>عرض موبایل (Mobile Breakpoint)</th>
                                    <td><input type="text" name="<?php echo esc_attr($this->option_key); ?>[breakpoint_mobile]" value="<?php echo esc_attr($opts['breakpoint_mobile']); ?>" class="regular-text"></td>
                                </tr>
                            </table>
                        </div>

                        <!-- Tab: Header -->
                        <div id="tab-header" class="kish-tab-content" style="display:none;">
                            <h2>تنظیمات هدر شیشه‌ای و لوگو</h2>
                            <p>کنترل کامل ظاهر هدر در حالت شفاف و حالت اسکرول شده.</p>
                            <table class="form-table">
                                <tr>
                                    <th>پس‌زمینه هدر</th>
                                    <td><input type="text" name="<?php echo esc_attr($this->option_key); ?>[header_bg]" value="<?php echo esc_attr($opts['header_bg']); ?>" class="regular-text"></td>
                                </tr>
                            </table>
                        </div>

                        <!-- Tab: Footer -->
                        <div id="tab-footer" class="kish-tab-content" style="display:none;">
                            <h2>تنظیمات فوتر «جزیره آبی»</h2>
                            <table class="form-table">
                                <tr>
                                    <th>رنگ بخش فیروزه‌ای بالای فوتر</th>
                                    <td><input type="color" name="<?php echo esc_attr($this->option_key); ?>[footer_turquoise]" value="<?php echo esc_attr($opts['footer_turquoise']); ?>"></td>
                                </tr>
                                <tr>
                                    <th>رنگ بخش آبی پررنگ پایین فوتر</th>
                                    <td><input type="color" name="<?php echo esc_attr($this->option_key); ?>[footer_deep_blue]" value="<?php echo esc_attr($opts['footer_deep_blue']); ?>"></td>
                                </tr>
                            </table>
                        </div>

                        <!-- Tab: Element Picker & Custom CSS -->
                        <div id="tab-picker" class="kish-tab-content" style="display:none;">
                            <h2>Element Picker & Custom CSS Selector Engine</h2>
                            <p>کدهای CSS سفارشی خود را وارد کنید. این استایل‌ها به‌صورت خودکار کامپایل و Cache می‌شوند.</p>
                            <textarea name="<?php echo esc_attr($this->option_key); ?>[custom_css]" rows="10" style="width:100%;font-family:monospace;direction:ltr;text-align:left;"><?php echo esc_textarea($opts['custom_css']); ?></textarea>
                        </div>

                        <!-- Tab: Import / Export -->
                        <div id="tab-import-export" class="kish-tab-content" style="display:none;">
                            <h2>خروجی و ورودی JSON تنظیمات (Backup & Preset)</h2>
                            <button type="button" id="btn-export-json" class="button button-primary">دریافت خروجی JSON</button>
                            <hr style="margin:20px 0;">
                            <h3>بازیابی تنظیمات از فایل JSON</h3>
                            <textarea id="json-import-input" rows="6" style="width:100%;font-family:monospace;direction:ltr;" placeholder="محتوای فایل JSON را اینجا وارد کنید..."></textarea>
                            <br><br>
                            <button type="button" id="btn-import-json" class="button button-secondary">بارگذاری و اعمال تنظیمات</button>
                        </div>

                        <div style="margin-top:20px;padding-top:15px;border-top:1px solid #e5e7eb;">
                            <?php submit_button('ذخیره تغییرات طراحی', 'primary', 'submit', false); ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <script>
        jQuery(document).ready(function($) {
            $('.kish-tabs a').on('click', function(e) {
                e.preventDefault();
                var target = $(this).attr('href');
                $('.kish-tab-content').hide();
                $(target).show();
            });

            $('#btn-export-json').on('click', function() {
                $.post(ajaxurl, {
                    action: 'kish_harmony_export_json',
                    nonce: '<?php echo $nonce; ?>'
                }, function(res) {
                    if (res.success) {
                        var blob = new Blob([JSON.stringify(res.data, null, 2)], {type: "application/json"});
                        var url = URL.createObjectURL(blob);
                        var a = document.createElement('a');
                        a.href = url;
                        a.download = "kish-harmony-settings.json";
                        a.click();
                    }
                });
            });

            $('#btn-import-json').on('click', function() {
                var json = $('#json-import-input').val();
                if (!json) { alert('لطفا JSON را وارد کنید'); return; }
                $.post(ajaxurl, {
                    action: 'kish_harmony_import_json',
                    nonce: '<?php echo $nonce; ?>',
                    json_data: json
                }, function(res) {
                    alert(res.data);
                    if (res.success) { location.reload(); }
                });
            });
        });
        </script>
        <?php
    }
}

Kish_Admin_Designer::get_instance();
