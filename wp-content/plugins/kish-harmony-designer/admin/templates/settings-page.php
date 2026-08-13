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

$hdr              = $settings['header'] ?? array();
$hero_banner      = $settings['hero_banner'] ?? array();
$categories_settings = $settings['categories_settings'] ?? array();
$category_items   = $settings['category_items'] ?? array();

$available_fonts = \KishHarmonyDesigner\Helpers::get_available_fonts();
$menus = wp_get_nav_menus();
?>
<div class="khd-admin-container">
    <!-- Top Header Ribbon Panel -->
    <div class="khd-header-panel">
        <div>
            <h1>کیش هارمونی | پنل تنظیمات پیشرفته طراحی نسخه پرو</h1>
            <p>ظاهر کل سایت، چیدمان سکشن‌ها، هدر، بنر آبی، دسته‌بندی‌های ایجکس، رنگ‌ها، تایپوگرافی پیکسلی و فواصل را بدون نیاز به کدنویسی مدیریت کنید.</p>
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
                <button class="khd-tab-btn active" data-tab="layout">چیدمان سکشن‌ها</button>
                <button class="khd-tab-btn" data-tab="header">تنظیمات هدر</button>
                <button class="khd-tab-btn" data-tab="hero">بنر آبی (هیرو)</button>
                <button class="khd-tab-btn" data-tab="categories">دسته‌بندی‌ها (ایمرسیو)</button>
                <button class="khd-tab-btn" data-tab="global">تنظیمات سراسری</button>
                <button class="khd-tab-btn" data-tab="typography">تایپوگرافی کامل</button>
                <button class="khd-tab-btn" data-tab="spacing">فاصله‌ها (پدینگ و مارجین)</button>
                <button class="khd-tab-btn" data-tab="woocommerce">ووکامرس</button>
                <button class="khd-tab-btn" data-tab="elements">المان‌های سفارشی</button>
                <button class="khd-tab-btn" data-tab="preset">پریست و بکاپ</button>
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

                <!-- Tab 2: Header Customization (New!) -->
                <div class="khd-tab-content" id="tab-header">
                    <h2>تنظیمات میکرومتری هدر سایت</h2>
                    <p class="description">تنظیمات منوها، رنگ بخش‌ها، لوگو و انیمیشن‌های هدر را شخصی‌سازی کنید.</p>

                    <div class="khd-field-row">
                        <label>انتخاب فهرست فعال هدر (WordPress Nav Menu)</label>
                        <select id="khd-header-menu">
                            <option value="0" <?php selected($hdr['menu_id'] ?? '0', '0'); ?>>-- عدم انتخاب منو (استفاده از آیکون همبرگری سفارشی) --</option>
                            <?php if (!empty($menus)) : foreach ($menus as $menu) : ?>
                                <option value="<?php echo esc_attr($menu->term_id); ?>" <?php selected($hdr['menu_id'] ?? '0', $menu->term_id); ?>><?php echo esc_html($menu->name); ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>

                    <div class="khd-field-row" style="flex-direction:row; gap:20px; margin-top:10px;">
                        <label style="cursor:pointer;">
                            <input type="checkbox" id="khd-header-hamburger-desktop" <?php checked($hdr['hamburger_on_desktop'] ?? false); ?>>
                            نمایش منوی همبرگری در دسکتاپ (به همراه لوگو در وسط و المان‌ها در طرفین)
                        </label>
                    </div>

                    <div class="khd-responsive-group">
                        <div class="khd-responsive-group-title"><strong>رنگ پس‌زمینه ستون‌های هدر</strong></div>
                        <div class="khd-field-row-row">
                            <div class="khd-field-row">
                                <label>پس‌زمینه بخش چپ</label>
                                <input type="color" id="khd-header-bg-left" value="<?php echo esc_attr($hdr['bg_left'] ?? '#ffffff'); ?>">
                            </div>
                            <div class="khd-field-row">
                                <label>پس‌زمینه بخش وسط</label>
                                <input type="color" id="khd-header-bg-center" value="<?php echo esc_attr($hdr['bg_center'] ?? '#ffffff'); ?>">
                            </div>
                            <div class="khd-field-row">
                                <label>پس‌زمینه بخش راست</label>
                                <input type="color" id="khd-header-bg-right" value="<?php echo esc_attr($hdr['bg_right'] ?? '#ffffff'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="khd-field-row-row">
                        <div class="khd-field-row">
                            <label>رنگ حاشیه (Border Color)</label>
                            <input type="color" id="khd-header-border-color" value="<?php echo esc_attr($hdr['border_color'] ?? '#cbd5e1'); ?>">
                        </div>
                        <div class="khd-field-row">
                            <label>گردی لبه‌های هدر (Border Radius)</label>
                            <input type="text" id="khd-header-border-radius" value="<?php echo esc_attr($hdr['border_radius'] ?? '12px'); ?>" placeholder="12px">
                        </div>
                    </div>

                    <div class="khd-field-row-row">
                        <div class="khd-field-row">
                            <label>سرعت انیمیشن/انتقال (در میلی‌ثانیه یا ثانیه)</label>
                            <input type="text" id="khd-header-animation-speed" value="<?php echo esc_attr($hdr['animation_speed'] ?? '300ms'); ?>" placeholder="300ms">
                        </div>
                        <div class="khd-field-row">
                            <label>لوگوی اختصاصی هدر (تصویر آپلود شده)</label>
                            <div style="display:flex; gap:10px; align-items:center;">
                                <input type="text" id="khd-header-custom-logo" value="<?php echo esc_attr($hdr['custom_logo'] ?? ''); ?>" style="flex:1;" placeholder="آدرس تصویر لوگو">
                                <button class="button khd-media-upload-btn" data-target="khd-header-custom-logo">آپلود</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 3: Blue Banner / Hero (New!) -->
                <div class="khd-tab-content" id="tab-hero">
                    <h2>تنظیمات بنر آبی و هیرو اصلی سایت</h2>
                    <p class="description">رنگ بک‌گراند، لوگوی شناور، تغییردهنده زبان و متون روی بنر را با جزئیات کامل کنترل کنید.</p>

                    <div class="khd-field-row-row">
                        <div class="khd-field-row">
                            <label>رنگ بک‌گراند بنر هیرو (Hero BG)</label>
                            <input type="color" id="khd-hero-bg-color" value="<?php echo esc_attr($hero_banner['bg_color'] ?? '#0B63D8'); ?>">
                        </div>
                        <div class="khd-field-row">
                            <label>جایگاه تغییر دهنده زبان</label>
                            <select id="khd-hero-lang-pos">
                                <option value="right-top" <?php selected($hero_banner['lang_switcher_position'] ?? 'right-top', 'right-top'); ?>>راست - بالا (پیش‌فرض)</option>
                                <option value="left-top" <?php selected($hero_banner['lang_switcher_position'] ?? 'right-top', 'left-top'); ?>>چپ - بالا</option>
                                <option value="none" <?php selected($hero_banner['lang_switcher_position'] ?? 'right-top', 'none'); ?>>غیرفعال و مخفی</option>
                            </select>
                        </div>
                    </div>

                    <div class="khd-field-row">
                        <label>متن دکمه زبان (اتصال به افزونه ترجمه یا متن دستی)</label>
                        <input type="text" id="khd-hero-lang-text" value="<?php echo esc_attr($hero_banner['lang_switcher_text'] ?? 'فارسی | IRAN'); ?>" style="width:100%;">
                    </div>

                    <div class="khd-responsive-group">
                        <div class="khd-responsive-group-title"><strong>تنظیمات عنوان بنر اصلی</strong></div>
                        <div class="khd-field-row" style="flex-direction:row; gap:10px; margin-bottom: 10px;">
                            <label><input type="checkbox" id="khd-hero-show-title" <?php checked($hero_banner['show_title'] ?? true); ?>> نمایش عنوان اصلی</label>
                        </div>
                        <div class="khd-field-row">
                            <label>متن عنوان اصلی</label>
                            <input type="text" id="khd-hero-title-text" value="<?php echo esc_attr($hero_banner['title_text'] ?? ''); ?>" style="width:100%;">
                        </div>
                        <div class="khd-field-row-row" style="margin-top:10px;">
                            <div class="khd-field-row">
                                <label>رنگ عنوان</label>
                                <input type="color" id="khd-hero-title-color" value="<?php echo esc_attr($hero_banner['title_color'] ?? '#ffffff'); ?>">
                            </div>
                            <div class="khd-field-row">
                                <label>سایز دسکتاپ</label>
                                <input type="text" id="khd-hero-title-size-desktop" value="<?php echo esc_attr($hero_banner['title_size_desktop'] ?? '40px'); ?>">
                            </div>
                            <div class="khd-field-row">
                                <label>سایز موبایل</label>
                                <input type="text" id="khd-hero-title-size-mobile" value="<?php echo esc_attr($hero_banner['title_size_mobile'] ?? '24px'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="khd-responsive-group">
                        <div class="khd-responsive-group-title"><strong>تنظیمات توضیحات بنر اصلی</strong></div>
                        <div class="khd-field-row" style="flex-direction:row; gap:10px; margin-bottom: 10px;">
                            <label><input type="checkbox" id="khd-hero-show-desc" <?php checked($hero_banner['show_desc'] ?? true); ?>> نمایش توضیحات اصلی</label>
                        </div>
                        <div class="khd-field-row">
                            <label>متن توضیحات اصلی</label>
                            <textarea id="khd-hero-desc-text" rows="3" style="width:100%;"><?php echo esc_textarea($hero_banner['desc_text'] ?? ''); ?></textarea>
                        </div>
                        <div class="khd-field-row-row" style="margin-top:10px;">
                            <div class="khd-field-row">
                                <label>رنگ توضیحات</label>
                                <input type="color" id="khd-hero-desc-color" value="<?php echo esc_attr($hero_banner['desc_color'] ?? '#dbeafe'); ?>">
                            </div>
                            <div class="khd-field-row">
                                <label>سایز دسکتاپ</label>
                                <input type="text" id="khd-hero-desc-size-desktop" value="<?php echo esc_attr($hero_banner['desc_size_desktop'] ?? '16px'); ?>">
                            </div>
                            <div class="khd-field-row">
                                <label>سایز موبایل</label>
                                <input type="text" id="khd-hero-desc-size-mobile" value="<?php echo esc_attr($hero_banner['desc_size_mobile'] ?? '12px'); ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 4: Categories Repeater & Behavior (New!) -->
                <div class="khd-tab-content" id="tab-categories">
                    <h2>مدیریت هوشمند و همه‌جانبه دسته‌بندی‌ها</h2>
                    <p class="description">آیتم‌های دسته‌بندی را اضافه، مرتب یا حذف کنید. به راحتی نوع نمایش (آیکون، تصویر، ایموجی) و عملکرد کلیک (لینک یا پاپ‌آپ AJAX) را مشخص کنید.</p>

                    <div class="khd-field-row" style="margin-bottom:20px;">
                        <label>موقعیت قرارگیری کل باکس دسته‌بندی</label>
                        <select id="khd-categories-position-mode">
                            <option value="absolute" <?php selected($categories_settings['position_mode'] ?? 'absolute', 'absolute'); ?>>شناور روی بنر هیرو (پوشش مطلق با مارجین منفی)</option>
                            <option value="relative" <?php selected($categories_settings['position_mode'] ?? 'absolute', 'relative'); ?>>ساده / چسبیده به محتوای عادی سایت</option>
                        </select>
                    </div>

                    <h3>آیتم‌های دسته‌بندی (Repeater Builder)</h3>
                    <div id="khd-category-items-container" class="khd-sortable-list">
                        <?php foreach ($category_items as $index => $item) : ?>
                            <div class="khd-category-item-row" data-id="<?php echo esc_attr($item['id']); ?>" style="background: #f8fafc; border: 1px solid #cbd5e1; border-radius: 12px; padding: 15px; margin-bottom: 15px; position:relative;">
                                <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid #e2e8f0; padding-bottom:8px; margin-bottom:10px;">
                                    <strong>دسته‌بندی: <span class="khd-item-label-preview"><?php echo esc_html($item['label']); ?></span></strong>
                                    <div style="display:flex; gap:10px; align-items:center;">
                                        <span class="khd-sortable-handle" style="cursor:move; font-size:18px;" title="ترتیب">☰</span>
                                        <button class="khd-delete-item-btn" style="background:#ef4444; color:#fff; border:none; padding:4px 8px; border-radius:4px; font-size:11px; cursor:pointer;">حذف آیتم</button>
                                    </div>
                                </div>

                                <div class="khd-field-row-row">
                                    <div class="khd-field-row">
                                        <label>شناسه یکتا (ID)</label>
                                        <input type="text" class="khd-item-id" value="<?php echo esc_attr($item['id']); ?>" readonly style="background:#e2e8f0; opacity:0.7;">
                                    </div>
                                    <div class="khd-field-row">
                                        <label>عنوان آیتم</label>
                                        <input type="text" class="khd-item-label" value="<?php echo esc_attr($item['label']); ?>" placeholder="مثلاً: قطار">
                                    </div>
                                </div>

                                <div class="khd-field-row-row" style="margin-top:10px;">
                                    <div class="khd-field-row">
                                        <label>نوع نمایش المان</label>
                                        <select class="khd-item-type">
                                            <option value="icon" <?php selected($item['type'], 'icon'); ?>>آیکون FontAwesome</option>
                                            <option value="image" <?php selected($item['type'], 'image'); ?>>تصویر سفارشی</option>
                                            <option value="emoji" <?php selected($item['type'], 'emoji'); ?>>ایموجی (Emoji)</option>
                                        </select>
                                    </div>

                                    <!-- Dynamic Inputs depending on type selected -->
                                    <div class="khd-field-row khd-type-panel khd-type-icon" style="<?php echo $item['type'] === 'icon' ? '' : 'display:none;'; ?>">
                                        <label>کلاس آیکون FontAwesome</label>
                                        <input type="text" class="khd-item-icon-val" value="<?php echo esc_attr($item['icon_val'] ?? ''); ?>" placeholder="fa-train">
                                    </div>
                                    <div class="khd-field-row khd-type-panel khd-type-image" style="<?php echo $item['type'] === 'image' ? '' : 'display:none;'; ?>">
                                        <label>تصویر سفارشی</label>
                                        <div style="display:flex; gap:5px;">
                                            <input type="text" class="khd-item-image-url" value="<?php echo esc_attr($item['image_url'] ?? ''); ?>" placeholder="آدرس تصویر" style="flex:1;">
                                            <button class="button khd-media-upload-btn-dynamic">آپلود</button>
                                        </div>
                                    </div>
                                    <div class="khd-field-row khd-type-panel khd-type-emoji" style="<?php echo $item['type'] === 'emoji' ? '' : 'display:none;'; ?>">
                                        <label>ایموجی دلخواه</label>
                                        <input type="text" class="khd-item-emoji-val" value="<?php echo esc_attr($item['emoji_val'] ?? ''); ?>" placeholder="🌊" style="font-size:18px; text-align:center;">
                                    </div>
                                </div>

                                <div class="khd-field-row-row" style="margin-top:10px; border-top:1px dashed #cbd5e1; padding-top:10px;">
                                    <div class="khd-field-row">
                                        <label>رفتار کلیک</label>
                                        <select class="khd-item-behavior">
                                            <option value="redirect" <?php selected($item['behavior'] ?? 'redirect', 'redirect'); ?>>هدایت به لینک آدرس</option>
                                            <option value="popup" <?php selected($item['behavior'] ?? 'redirect', 'popup'); ?>>نمایش پاپ‌آپ AJAX مدرن</option>
                                        </select>
                                    </div>
                                    <div class="khd-field-row khd-behavior-panel khd-behavior-redirect" style="<?php echo ($item['behavior'] ?? 'redirect') === 'redirect' ? '' : 'display:none;'; ?>">
                                        <label>لینک مقصد / هش</label>
                                        <input type="text" class="khd-item-target-url" value="<?php echo esc_attr($item['target_url'] ?? ''); ?>" placeholder="#train">
                                    </div>
                                </div>

                                <div class="khd-field-row khd-behavior-panel khd-behavior-popup" style="margin-top:10px; <?php echo ($item['behavior'] ?? 'redirect') === 'popup' ? '' : 'display:none;'; ?>">
                                    <label>محتوای پاپ‌آپ سفارشی (HTML یا کد کوتاه / Shortcode)</label>
                                    <textarea class="khd-item-popup-html" rows="3" placeholder="اینجا کدهای HTML یا شورتکد فرم‌ها را بنویسید..."><?php echo esc_textarea($item['popup_html'] ?? ''); ?></textarea>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button id="khd-add-category-item-btn" class="button button-primary" style="margin-top:15px; background: #10b981; border-color: #10b981; text-shadow:none;">+ افزودن دسته‌بندی جدید</button>
                </div>

                <!-- Tab 5: Global Configuration -->
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

                <!-- Tab 6: Responsive Typography Settings -->
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

                <!-- Tab 7: Responsive Spacing Overrides -->
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

                <!-- Tab 8: WooCommerce Specific Config -->
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

                <!-- Tab 9: Custom Elements & Custom select styler -->
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

                <!-- Tab 10: Templates / Presets Import-Export -->
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
