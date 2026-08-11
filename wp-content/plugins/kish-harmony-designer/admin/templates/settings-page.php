<?php
if (!defined('ABSPATH')) {
    exit;
}

$settings = \KishHarmonyDesigner\Helpers::get_settings();
$sections = $settings['sections'];
$global   = $settings['global'];
$typo     = $settings['typography'];
$spacing  = $settings['spacing'];
$woo      = $settings['woocommerce'];
$available_fonts = \KishHarmonyDesigner\Helpers::get_available_fonts();
?>
<div class="khd-admin-container">
    <!-- Top Header Ribbon Panel -->
    <div class="khd-header-panel">
        <div>
            <h1>کیش هارمونی | پنل تنظیمات پیشرفته طراحی</h1>
            <p>ظاهر کل سایت، چیدمان سکشن‌ها، رنگ‌ها، تایپوگرافی پیکسلی و فواصل را از این بخش بدون نیاز به کدنویسی مدیریت کنید.</p>
        </div>
        <div>
            <button id="khd-save-settings-btn" class="khd-save-btn">ذخیره نهایی تنظیمات</button>
        </div>
    </div>

    <!-- Main Workspace Side-by-Side Wrapper -->
    <div class="khd-main-wrapper">
        <!-- Controls Left Column -->
        <div class="khd-controls-column">
            <nav class="khd-tabs-nav">
                <button class="khd-tab-btn active" data-tab="layout">سازنده چیدمان صفحه اصلی</button>
                <button class="khd-tab-btn" data-tab="global">تنظیمات سراسری</button>
                <button class="khd-tab-btn" data-tab="typography">تایپوگرافی کامل</button>
                <button class="khd-tab-btn" data-tab="spacing">فاصله‌ها (پدینگ و مارجین)</button>
                <button class="khd-tab-btn" data-tab="woocommerce">ووکامرس</button>
                <button class="khd-tab-btn" data-tab="elements">المان‌های دلخواه</button>
                <button class="khd-tab-btn" data-tab="preset">پریست و ایمپورت/اکسپورت</button>
            </nav>

            <div class="khd-tabs-content">
                <!-- Tab 1: Layout Builder (Reordering) -->
                <div class="khd-tab-content active" id="tab-layout">
                    <h2>چیدمان و ترتیب نمایش سکشن‌ها</h2>
                    <p class="description" style="margin-bottom: 15px;">سکشن‌ها را بکشید و رها کنید تا جابجا شوند یا آن‌ها را خاموش/روشن کنید.</p>

                    <ul class="khd-sortable-list">
                        <?php foreach ($sections as $section) : ?>
                            <li class="khd-sortable-item" data-id="<?php echo esc_attr($section['id']); ?>">
                                <div>
                                    <span class="khd-sortable-handle">☰</span>
                                    <span class="khd-section-title-label" style="font-weight: bold;"><?php echo esc_html($section['name']); ?></span>
                                </div>
                                <label class="khd-toggle-switch">
                                    <input type="checkbox" class="khd-section-toggle" <?php checked($section['active']); ?>>
                                    <span class="khd-toggle-slider"></span>
                                </label>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Tab 2: Global Configuration -->
                <div class="khd-tab-content" id="tab-global">
                    <h2>رنگ‌ها و المان‌های سراسری</h2>

                    <div class="khd-field-row-row">
                        <div class="khd-field-row">
                            <label>رنگ اصلی برند (Primary Color)</label>
                            <input type="color" id="khd-primary-color" value="<?php echo esc_attr($global['primary_color']); ?>">
                        </div>
                        <div class="khd-field-row">
                            <label>رنگ ثانویه برند (Secondary Color)</label>
                            <input type="color" id="khd-secondary-color" value="<?php echo esc_attr($global['secondary_color']); ?>">
                        </div>
                    </div>

                    <div class="khd-field-row-row">
                        <div class="khd-field-row">
                            <label>رنگ دکمه‌ها و المان‌های شاخص (Accent)</label>
                            <input type="color" id="khd-accent-color" value="<?php echo esc_attr($global['accent_color']); ?>">
                        </div>
                        <div class="khd-field-row">
                            <label>رنگ پس‌زمینه سایت (Background Color)</label>
                            <input type="color" id="khd-bg-color" value="<?php echo esc_attr($global['bg_color']); ?>">
                        </div>
                    </div>

                    <div class="khd-field-row">
                        <label>رنگ متون اصلی سایت (Text Color)</label>
                        <input type="color" id="khd-text-color" value="<?php echo esc_attr($global['text_color']); ?>" style="width: 100px;">
                    </div>

                    <div class="khd-field-row">
                        <label>فونت سراسری سایت (بارگذاری لوکال بدون نیاز به اینترنت)</label>
                        <select id="khd-font-family">
                            <?php foreach ($available_fonts as $key => $f_info) : ?>
                                <option value="<?php echo esc_attr($key); ?>" <?php selected($global['font_family'], $key); ?>><?php echo esc_html($f_info['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="khd-field-row-row">
                        <div class="khd-field-row">
                            <label>گردی کلی گوشه‌ها (Border Radius)</label>
                            <input type="text" id="khd-border-radius" value="<?php echo esc_attr($global['border_radius']); ?>" placeholder="20px">
                        </div>
                        <div class="khd-field-row">
                            <label>عرض کانتینر اصلی سایت (Container Max-Width)</label>
                            <input type="text" id="khd-container-width" value="<?php echo esc_attr($global['container_width']); ?>" placeholder="1280px">
                        </div>
                    </div>
                </div>

                <!-- Tab 3: Responsive Typography Settings -->
                <div class="khd-tab-content" id="tab-typography">
                    <h2>کنترل تایپوگرافی کامل به تفکیک دستگاه</h2>

                    <!-- Heading 1 (H1) -->
                    <div class="khd-responsive-group">
                        <div class="khd-responsive-group-title">
                            <span>تنظیمات سربرگ بزرگ (Heading 1)</span>
                        </div>

                        <div style="margin-bottom: 10px;">
                            <strong>دسکتاپ:</strong>
                            <div class="khd-field-row-row" style="margin-top: 5px;">
                                <input type="text" id="khd-h1-size-desktop" value="<?php echo esc_attr($typo['h1']['desktop']['size']); ?>" placeholder="سایز فونت (مثلا 36px)" style="width:50%;">
                                <input type="text" id="khd-h1-weight-desktop" value="<?php echo esc_attr($typo['h1']['desktop']['weight']); ?>" placeholder="وزن (مثلا 900)" style="width:50%;">
                            </div>
                            <div class="khd-field-row-row" style="margin-top: 5px;">
                                <input type="text" id="khd-h1-lh-desktop" value="<?php echo esc_attr($typo['h1']['desktop']['line_height']); ?>" placeholder="Line Height" style="width:50%;">
                                <input type="text" id="khd-h1-ls-desktop" value="<?php echo esc_attr($typo['h1']['desktop']['letter_spacing']); ?>" placeholder="Letter Spacing" style="width:50%;">
                            </div>
                        </div>

                        <div style="margin-bottom: 10px; border-top: 1px solid #e2e8f0; padding-top: 10px;">
                            <strong>تبلت:</strong>
                            <div class="khd-field-row-row" style="margin-top: 5px;">
                                <input type="text" id="khd-h1-size-tablet" value="<?php echo esc_attr($typo['h1']['tablet']['size']); ?>" placeholder="سایز فونت" style="width:50%;">
                                <input type="text" id="khd-h1-lh-tablet" value="<?php echo esc_attr($typo['h1']['tablet']['line_height']); ?>" placeholder="Line Height" style="width:50%;">
                            </div>
                        </div>

                        <div style="border-top: 1px solid #e2e8f0; padding-top: 10px;">
                            <strong>موبایل:</strong>
                            <div class="khd-field-row-row" style="margin-top: 5px;">
                                <input type="text" id="khd-h1-size-mobile" value="<?php echo esc_attr($typo['h1']['mobile']['size']); ?>" placeholder="سایز فونت" style="width:50%;">
                                <input type="text" id="khd-h1-lh-mobile" value="<?php echo esc_attr($typo['h1']['mobile']['line_height']); ?>" placeholder="Line Height" style="width:50%;">
                            </div>
                        </div>
                    </div>

                    <!-- Heading 2 (H2) -->
                    <div class="khd-responsive-group">
                        <div class="khd-responsive-group-title">
                            <span>تنظیمات سربرگ متوسط (Heading 2)</span>
                        </div>

                        <div>
                            <strong>دسکتاپ:</strong>
                            <div class="khd-field-row-row" style="margin-top: 5px;">
                                <input type="text" id="khd-h2-size-desktop" value="<?php echo esc_attr($typo['h2']['desktop']['size']); ?>" placeholder="سایز فونت (مثلا 24px)" style="width:50%;">
                                <input type="text" id="khd-h2-weight-desktop" value="<?php echo esc_attr($typo['h2']['desktop']['weight']); ?>" placeholder="وزن (مثلا 800)" style="width:50%;">
                            </div>
                        </div>
                        <div style="margin-top:10px;">
                            <strong>تبلت:</strong>
                            <input type="text" id="khd-h2-size-tablet" value="<?php echo esc_attr($typo['h2']['tablet']['size']); ?>" placeholder="سایز فونت تبلت" style="margin-top:5px; width:100%;">
                        </div>
                        <div style="margin-top:10px;">
                            <strong>موبایل:</strong>
                            <input type="text" id="khd-h2-size-mobile" value="<?php echo esc_attr($typo['h2']['mobile']['size']); ?>" placeholder="سایز فونت موبایل" style="margin-top:5px; width:100%;">
                        </div>
                    </div>

                    <!-- Body Paragraph Text -->
                    <div class="khd-responsive-group">
                        <div class="khd-responsive-group-title">
                            <span>تنظیمات متن بدنه (Body Text)</span>
                        </div>
                        <div class="khd-field-row-row">
                            <input type="text" id="khd-body-size-desktop" value="<?php echo esc_attr($typo['body']['desktop']['size']); ?>" placeholder="دسکتاپ (مثلا 16px)">
                            <input type="text" id="khd-body-size-tablet" value="<?php echo esc_attr($typo['body']['tablet']['size']); ?>" placeholder="تبلت (مثلا 15px)">
                            <input type="text" id="khd-body-size-mobile" value="<?php echo esc_attr($typo['body']['mobile']['size']); ?>" placeholder="موبایل (مثلا 14px)">
                        </div>
                    </div>
                </div>

                <!-- Tab 4: Responsive Spacing Overrides -->
                <div class="khd-tab-content" id="tab-spacing">
                    <h2>کنترل پدینگ و مارجین سکشن‌های اصلی</h2>
                    <p class="description">برای به هم نخوردن ساختار، فواصل به صورت پیکسلی و مجزا برای دستگاه‌های موبایل، تبلت و دسکتاپ قابل بازنشانی هستند.</p>

                    <!-- Section Hero Spacing -->
                    <div class="khd-responsive-group">
                        <div class="khd-responsive-group-title"><strong>فاصله‌های بخش هیرو (Hero Banner)</strong></div>
                        <div style="margin-bottom: 10px;">
                            <strong>دسکتاپ:</strong>
                            <div class="khd-field-row-row" style="margin-top:5px;">
                                <input type="text" id="khd-hero-pt-desktop" value="<?php echo esc_attr($spacing['hero']['desktop']['padding_top'] ?? '24px'); ?>" placeholder="Padding Top (مثلا 24px)">
                                <input type="text" id="khd-hero-pb-desktop" value="<?php echo esc_attr($spacing['hero']['desktop']['padding_bottom'] ?? '24px'); ?>" placeholder="Padding Bottom">
                                <input type="text" id="khd-hero-mb-desktop" value="<?php echo esc_attr($spacing['hero']['desktop']['margin_bottom'] ?? '176px'); ?>" placeholder="Margin Bottom">
                            </div>
                        </div>
                        <div style="margin-bottom: 10px;">
                            <strong>موبایل:</strong>
                            <div class="khd-field-row-row" style="margin-top:5px;">
                                <input type="text" id="khd-hero-pt-mobile" value="<?php echo esc_attr($spacing['hero']['mobile']['padding_top'] ?? '16px'); ?>" placeholder="Padding Top">
                                <input type="text" id="khd-hero-pb-mobile" value="<?php echo esc_attr($spacing['hero']['mobile']['padding_bottom'] ?? '16px'); ?>" placeholder="Padding Bottom">
                                <input type="text" id="khd-hero-mb-mobile" value="<?php echo esc_attr($spacing['hero']['mobile']['margin_bottom'] ?? '144px'); ?>" placeholder="Margin Bottom">
                            </div>
                        </div>
                    </div>

                    <!-- Search section Spacing -->
                    <div class="khd-responsive-group">
                        <div class="khd-responsive-group-title"><strong>فاصله‌های بخش جستجو (Search Section)</strong></div>
                        <div class="khd-field-row-row">
                            <input type="text" id="khd-search-p-desktop" value="<?php echo esc_attr($spacing['search']['desktop']['padding'] ?? '24px'); ?>" placeholder="Padding دسکتاپ">
                            <input type="text" id="khd-search-mb-desktop" value="<?php echo esc_attr($spacing['search']['desktop']['margin_bottom'] ?? '64px'); ?>" placeholder="Margin Bottom">
                        </div>
                    </div>
                </div>

                <!-- Tab 5: WooCommerce Specific Config -->
                <div class="khd-tab-content" id="tab-woocommerce">
                    <h2>تنظیمات استایل ووکامرس</h2>
                    <p class="description">استایل صفحات آرشیو، سبد خرید، حساب کاربری و محصول ووکامرس را تغییر دهید.</p>

                    <div class="khd-field-row-row">
                        <div class="khd-field-row">
                            <label>پس‌زمینه کارت‌های محصول (Product Card Background)</label>
                            <input type="color" id="khd-woo-card-bg" value="<?php echo esc_attr($woo['card_bg']); ?>">
                        </div>
                        <div class="khd-field-row">
                            <label>گردی گوشه‌های کارت محصول (Card Border-Radius)</label>
                            <input type="text" id="khd-woo-card-radius" value="<?php echo esc_attr($woo['card_border_radius']); ?>" placeholder="16px">
                        </div>
                    </div>

                    <div class="khd-field-row-row">
                        <div class="khd-field-row">
                            <label>رنگ بک‌گراند دکمه خرید ووکامرس (Button Color)</label>
                            <input type="color" id="khd-woo-btn-bg" value="<?php echo esc_attr($woo['button_bg']); ?>">
                        </div>
                        <div class="khd-field-row">
                            <label>رنگ متن دکمه خرید</label>
                            <input type="color" id="khd-woo-btn-text" value="<?php echo esc_attr($woo['button_text_color']); ?>">
                        </div>
                    </div>

                    <div class="khd-field-row" style="flex-direction:row; gap:20px; margin-top:15px;">
                        <label style="cursor:pointer;">
                            <input type="checkbox" id="khd-woo-rating" <?php checked($woo['show_rating']); ?>>
                            نمایش امتیاز ستاره‌ای در کارت‌های محصول ووکامرس
                        </label>
                    </div>
                    <div class="khd-field-row" style="flex-direction:row; gap:20px;">
                        <label style="cursor:pointer;">
                            <input type="checkbox" id="khd-woo-price" <?php checked($woo['show_price']); ?>>
                            نمایش قیمت در کارت‌های محصول ووکامرس
                        </label>
                    </div>
                </div>

                <!-- Tab 6: Custom Elements & Custom select styler -->
                <div class="khd-tab-content" id="tab-elements">
                    <h2>تعریف استایل برای کلاس‌ها یا شناسه‌های خاص (Custom Elements)</h2>
                    <p class="description">یک سلکتور (مانند `.btn-reserve` یا `#booking-modal`) بنویسید و ظاهر پیکسلی آن را به صورت دستی مدیریت کنید.</p>

                    <div id="khd-custom-selectors-container">
                        <?php
                        $custom_sel = $settings['custom_selectors'] ?? array();
                        foreach ($custom_sel as $index => $sel) :
                        ?>
                            <div class="khd-custom-sel-row" style="background:#f1f5f9; padding: 15px; border-radius: 8px; margin-bottom: 12px; border: 1px solid #cbd5e1;">
                                <div style="display:flex; gap:10px; margin-bottom: 8px;">
                                    <input type="text" class="khd-sel-input" value="<?php echo esc_attr($sel['selector']); ?>" placeholder="سلکتور CSS مانند .btn-custom یا #my-box" style="flex:2;">
                                    <button class="button khd-remove-sel-btn" style="background:#ef4444; color:#fff; border:none; padding:5px 12px; border-radius:4px; cursor:pointer;">حذف</button>
                                </div>
                                <div style="display:grid; grid-template-columns: repeat(3, 1fr); gap:10px;">
                                    <div>
                                        <label style="font-size:11px; display:block; margin-bottom:2px;">رنگ متن</label>
                                        <input type="color" class="khd-sel-color" value="<?php echo esc_attr($sel['color'] ?? ''); ?>" style="width:100%; height:30px;">
                                    </div>
                                    <div>
                                        <label style="font-size:11px; display:block; margin-bottom:2px;">رنگ پس‌زمینه</label>
                                        <input type="color" class="khd-sel-bg" value="<?php echo esc_attr($sel['bg_color'] ?? ''); ?>" style="width:100%; height:30px;">
                                    </div>
                                    <div>
                                        <label style="font-size:11px; display:block; margin-bottom:2px;">سایز فونت</label>
                                        <input type="text" class="khd-sel-size" value="<?php echo esc_attr($sel['font_size'] ?? ''); ?>" placeholder="16px">
                                    </div>
                                    <div>
                                        <label style="font-size:11px; display:block; margin-bottom:2px;">فاصله داخلی (Padding)</label>
                                        <input type="text" class="khd-sel-padding" value="<?php echo esc_attr($sel['padding'] ?? ''); ?>" placeholder="10px">
                                    </div>
                                    <div>
                                        <label style="font-size:11px; display:block; margin-bottom:2px;">فاصله خارجی (Margin)</label>
                                        <input type="text" class="khd-sel-margin" value="<?php echo esc_attr($sel['margin'] ?? ''); ?>" placeholder="0 0 10px 0">
                                    </div>
                                    <div>
                                        <label style="font-size:11px; display:block; margin-bottom:2px;">گردی گوشه‌ها</label>
                                        <input type="text" class="khd-sel-radius" value="<?php echo esc_attr($sel['border_radius'] ?? ''); ?>" placeholder="12px">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button id="khd-add-selector-btn" class="button button-primary" style="margin-top: 10px;">+ افزودن المان سفارشی جدید</button>

                    <h2 style="margin-top: 30px;">کدنویسی استایل اختصاصی رایگان (CSS)</h2>
                    <textarea id="khd-custom-css" rows="6" style="width:100%; font-family:monospace; direction:ltr; text-align:left;"><?php echo esc_textarea($settings['custom_css']); ?></textarea>

                    <h2 style="margin-top: 30px;">محتوای سفارشی سکشن ۱ (HTML / Text)</h2>
                    <textarea id="khd-html-1" rows="4" style="width:100%; font-family:monospace; direction:ltr; text-align:left;"><?php echo esc_textarea($settings['custom_html_1_code']); ?></textarea>

                    <h2 style="margin-top: 30px;">محتوای سفارشی سکشن ۲ (HTML / Text)</h2>
                    <textarea id="khd-html-2" rows="4" style="width:100%; font-family:monospace; direction:ltr; text-align:left;"><?php echo esc_textarea($settings['custom_html_2_code']); ?></textarea>
                </div>

                <!-- Tab 7: Templates / Presets Import-Export -->
                <div class="khd-tab-content" id="tab-preset">
                    <h2>مدیریت قالب‌های آماده و استایل‌ها (Preset Templates)</h2>
                    <p class="description">استایل‌های فعلی خود را دانلود کنید یا یک پریست آماده ایمپورت کنید.</p>

                    <div class="khd-preset-card">
                        <h3>اکسپورت تنظیمات (ذخیره تمپلیت)</h3>
                        <p>روی دکمه زیر کلیک کنید تا تنظیمات پیکسلی قالب به صورت فایل JSON دانلود شود.</p>
                        <button id="khd-export-btn" class="button button-secondary">دانلود فایل تنظیمات (JSON)</button>
                    </div>

                    <div class="khd-preset-card" style="margin-top: 20px;">
                        <h3>ایمپورت تنظیمات (بارگذاری تمپلیت)</h3>
                        <p>متن فایل JSON قبلی را در پنجره ایمپورت کپی کنید تا تنظیمات بارگذاری شوند.</p>
                        <button id="khd-import-btn" class="button button-primary">بارگذاری تنظیمات سفارشی (JSON)</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Live Preview Sticky Frame Column -->
        <div class="khd-preview-column" style="display:flex; flex-direction:column; align-items:center;">
            <div class="khd-preview-header" style="width:100%; display:flex; justify-content: space-between; align-items: center; background: #e2e8f0; padding: 12px; border-bottom: 1px solid #cbd5e1;">
                <span class="khd-preview-title">👁️ پیش‌نمایش زنده و پیکسلی فرانت‌اند</span>
                <div class="khd-device-switcher" style="display:flex; gap:6px; align-items:center;">
                    <button id="khd-picker-toggle-btn" title="انتخاب‌گر زنده المان" style="background:#fff; color:#0f172a; border:1px solid #cbd5e1; padding:6px 12px; border-radius:6px; cursor:pointer; font-weight:bold; margin-left:15px; display:flex; align-items:center; gap:6px;"><i class="fa-solid fa-crosshairs text-red-500 animate-pulse"></i> <span>انتخاب‌گر زنده</span></button>

                    <button class="khd-device-btn active" data-device="desktop" title="دسکتاپ" style="background:#0b63d8; color:#fff; border:1px solid #cbd5e1; padding:6px 12px; border-radius:6px; cursor:pointer;"><i class="fa-solid fa-desktop"></i> دسکتاپ</button>
                    <button class="khd-device-btn" data-device="tablet" title="تبلت" style="background:#fff; color:#000; border:1px solid #cbd5e1; padding:6px 12px; border-radius:6px; cursor:pointer;"><i class="fa-solid fa-tablet-screen-button"></i> تبلت</button>
                    <button class="khd-device-btn" data-device="mobile" title="موبایل" style="background:#fff; color:#000; border:1px solid #cbd5e1; padding:6px 12px; border-radius:6px; cursor:pointer;"><i class="fa-solid fa-mobile-screen-button"></i> موبایل</button>
                </div>
            </div>
            <!-- Live iframe connected to front page -->
            <iframe id="khd-live-preview-iframe" class="khd-preview-iframe" style="width:100%; height:100%; border:none; transition: width 0.3s ease;" src="<?php echo esc_url(add_query_arg('khd_preview', '1', home_url('/'))); ?>"></iframe>
        </div>
    </div>
</div>
