<?php
/**
 * Kish Harmony Theme Options & WooCommerce Metaboxes
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. Register Admin Menu Page
function kishharmony_add_admin_menu() {
    add_menu_page(
        'تنظیمات کیش هارمونی',
        'مدیریت کیش هارمونی',
        'manage_options',
        'kishharmony-options',
        'kishharmony_options_page_html',
        'dashicons-palmtree',
        2
    );
}
add_action('admin_menu', 'kishharmony_add_admin_menu');

// 2. Register Settings Groups
function kishharmony_register_settings() {
    register_setting('kishharmony_options_group', 'kishharmony_options');
}
add_action('admin_init', 'kishharmony_register_settings');

// Helper to get option
function kishharmony_get_option($key, $default = '') {
    $options = get_option('kishharmony_options', array());
    return isset($options[$key]) && $options[$key] !== '' ? $options[$key] : $default;
}

// Render Admin Page
function kishharmony_options_page_html() {
    if (!current_user_can('manage_options')) {
        return;
    }
    if (isset($_GET['settings-updated'])) {
        add_settings_error('kishharmony_messages', 'kishharmony_message', 'تنظیمات با موفقیت ذخیره شدند.', 'updated');
    }
    settings_errors('kishharmony_messages');
    $options = get_option('kishharmony_options', array());
    ?>
    <div class="wrap" dir="rtl" style="font-family: Tahoma, sans-serif;">
        <h1 style="background: #1e3a8a; color: #fff; padding: 15px 20px; border-radius: 10px; margin-bottom: 20px;">
            <span class="dashicons dashicons-palmtree" style="font-size: 30px; width: 30px; height: 30px;"></span>
            پنل جامع مدیریت قالب کیش هارمونی
        </h1>

        <form action="options.php" method="post" style="background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
            <?php
            settings_fields('kishharmony_options_group');
            ?>

            <h2>۱. تنظیمات هدر صفحه اصلی & هدر عمومی</h2>
            <table class="form-table">
                <tr>
                    <th scope="row">نام برند (فارسی)</th>
                    <td><input type="text" name="kishharmony_options[brand_name_fa]" value="<?php echo esc_attr(kishharmony_get_option('brand_name_fa', 'کیش هارمونی')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row">نام برند (انگلیسی)</th>
                    <td><input type="text" name="kishharmony_options[brand_name_en]" value="<?php echo esc_attr(kishharmony_get_option('brand_name_en', 'Kish Harmony')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row">رنگ پس‌زمینه بنر هیرو صفحه اصلی</th>
                    <td><input type="color" name="kishharmony_options[hero_bg_color]" value="<?php echo esc_attr(kishharmony_get_option('hero_bg_color', '#1e3a8a')); ?>"></td>
                </tr>
                <tr>
                    <th scope="row">عنوان هیرو صفحه اصلی</th>
                    <td><input type="text" name="kishharmony_options[hero_title]" value="<?php echo esc_attr(kishharmony_get_option('hero_title', 'سامانه آنلاین رزرو کیش هارمونی')); ?>" class="large-text"></td>
                </tr>
                <tr>
                    <th scope="row">توضیحات هیرو صفحه اصلی</th>
                    <td><textarea name="kishharmony_options[hero_desc]" class="large-text" rows="2"><?php echo esc_textarea(kishharmony_get_option('hero_desc', 'رزرو مستقیم تفریحات آبی، اجاره ماشین‌های سوپراسپرت و اقامتگاه‌های لوکس با تخفیف روزانه و پشتیبانی ۲۴ ساعته در کیش')); ?></textarea></td>
                </tr>
            </table>

            <hr>
            <h2>۲. تنظیمات ۸ دسته‌بندی بالای هدر صفحه اصلی</h2>
            <table class="form-table">
                <?php
                $default_cats = array(
                    1 => array('title' => 'قطار', 'icon' => 'fa-train', 'link' => '#train'),
                    2 => array('title' => 'پرواز', 'icon' => 'fa-plane-departure', 'link' => '#flight'),
                    3 => array('title' => 'هتل', 'icon' => 'fa-hotel', 'link' => '#hotel'),
                    4 => array('title' => 'اتوبوس', 'icon' => 'fa-bus', 'link' => '#bus'),
                    5 => array('title' => 'ویژه', 'icon' => 'fa-star', 'link' => '#special-offers'),
                    6 => array('title' => 'ویلا', 'icon' => 'fa-house-chimney', 'link' => '#villa'),
                    7 => array('title' => 'تور', 'icon' => 'fa-suitcase-rolling', 'link' => '#tour'),
                    8 => array('title' => 'نسخه جدید', 'icon' => 'fa-wand-magic-sparkles', 'link' => '#new'),
                );
                for ($i = 1; $i <= 8; $i++) {
                    $title = kishharmony_get_option("hero_cat_{$i}_title", $default_cats[$i]['title']);
                    $icon  = kishharmony_get_option("hero_cat_{$i}_icon", $default_cats[$i]['icon']);
                    $link  = kishharmony_get_option("hero_cat_{$i}_link", $default_cats[$i]['link']);
                    ?>
                    <tr>
                        <th scope="row">دسته‌بندی شماره <?php echo $i; ?></th>
                        <td>
                            عنوان: <input type="text" name="kishharmony_options[hero_cat_<?php echo $i; ?>_title]" value="<?php echo esc_attr($title); ?>" style="width: 120px;">
                            کلاس آیکون (FontAwesome): <input type="text" name="kishharmony_options[hero_cat_<?php echo $i; ?>_icon]" value="<?php echo esc_attr($icon); ?>" style="width: 150px;">
                            لینک/برگه: <input type="text" name="kishharmony_options[hero_cat_<?php echo $i; ?>_link]" value="<?php echo esc_attr($link); ?>" style="width: 200px;">
                        </td>
                    </tr>
                <?php } ?>
            </table>

            <hr>
            <h2>۳. تنظیمات اسلایدر بنر اصلی سایت</h2>
            <table class="form-table">
                <tr>
                    <th scope="row">زمان‌بندی تغییر خودکار (میلی‌ثانیه)</th>
                    <td><input type="number" name="kishharmony_options[slider_interval]" value="<?php echo esc_attr(kishharmony_get_option('slider_interval', '4000')); ?>" class="small-text"> م‌ث</td>
                </tr>
                <?php for ($s = 1; $s <= 3; $s++) { ?>
                    <tr>
                        <th scope="row">اسلاید <?php echo $s; ?></th>
                        <td>
                            عنوان: <input type="text" name="kishharmony_options[slide_<?php echo $s; ?>_title]" value="<?php echo esc_attr(kishharmony_get_option("slide_{$s}_title", "تخفیف ویژه تفریحات کیش {$s}")); ?>" class="regular-text"><br>
                            توضیح: <input type="text" name="kishharmony_options[slide_<?php echo $s; ?>_desc]" value="<?php echo esc_attr(kishharmony_get_option("slide_{$s}_desc", "تجربه‌ای فراموش‌نشدنی با تضمین قیمت کیش هارمونی")); ?>" class="regular-text"><br>
                            آدرس تصویر (URL): <input type="text" name="kishharmony_options[slide_<?php echo $s; ?>_img]" value="<?php echo esc_attr(kishharmony_get_option("slide_{$s}_img", "https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=1200&q=80")); ?>" class="large-text"><br>
                            متن دکمه: <input type="text" name="kishharmony_options[slide_<?php echo $s; ?>_btn_text]" value="<?php echo esc_attr(kishharmony_get_option("slide_{$s}_btn_text", "رزرو آنلاین")); ?>">
                            لینک دکمه: <input type="text" name="kishharmony_options[slide_<?php echo $s; ?>_btn_link]" value="<?php echo esc_attr(kishharmony_get_option("slide_{$s}_btn_link", "#")); ?>">
                        </td>
                    </tr>
                <?php } ?>
            </table>

            <hr>
            <h2>۴. تنظیمات دسته‌بندی دوم (تفریحات دریایی)</h2>
            <table class="form-table">
                <tr>
                    <th scope="row">عنوان بخش</th>
                    <td><input type="text" name="kishharmony_options[sea_cats_title]" value="<?php echo esc_attr(kishharmony_get_option('sea_cats_title', 'دسته‌بندی تفریحات کیش هارمونی')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row">توضیح بخش</th>
                    <td><input type="text" name="kishharmony_options[sea_cats_desc]" value="<?php echo esc_attr(kishharmony_get_option('sea_cats_desc', 'بهترین تجربه کلوپ‌های دریایی، تفریحات هوایی و سفرهای ساحلی کیش با تضمین قیمت')); ?>" class="large-text"></td>
                </tr>
            </table>

            <hr>
            <h2>۵. کارت محصولات ویژه و ووکامرس</h2>
            <table class="form-table">
                <tr>
                    <th scope="row">عنوان بخش پیشنهادات ویژه</th>
                    <td><input type="text" name="kishharmony_options[special_offers_title]" value="<?php echo esc_attr(kishharmony_get_option('special_offers_title', 'پیشنهادهای ویژه')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row">تعداد نمایش کارت‌ها</th>
                    <td><input type="number" name="kishharmony_options[special_offers_count]" value="<?php echo esc_attr(kishharmony_get_option('special_offers_count', '6')); ?>" class="small-text"></td>
                </tr>
            </table>

            <hr>
            <h2>۶. گالری تصاویر کیش هارمونی</h2>
            <table class="form-table">
                <tr>
                    <th scope="row">عنوان گالری</th>
                    <td><input type="text" name="kishharmony_options[gallery_title]" value="<?php echo esc_attr(kishharmony_get_option('gallery_title', 'گالری تصاویر کیش هارمونی')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row">متن دعوت پایین گالری</th>
                    <td><input type="text" name="kishharmony_options[gallery_share_text]" value="<?php echo esc_attr(kishharmony_get_option('gallery_share_text', '📸 عکس‌هایتان را با ما به اشتراک بگذارین')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row">تصاویر گالری (هر لینک تصویر در یک خط)</th>
                    <td>
                        <textarea name="kishharmony_options[gallery_images]" class="large-text" rows="5"><?php
                            echo esc_textarea(kishharmony_get_option('gallery_images',
                                "https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80\nhttps://images.unsplash.com/photo-1580273916550-e323be2ae537?auto=format&fit=crop&w=800&q=80\nhttps://images.unsplash.com/photo-1569263979104-865ab7cd8d13?auto=format&fit=crop&w=800&q=80\nhttps://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80"
                            ));
                        ?></textarea>
                    </td>
                </tr>
            </table>

            <hr>
            <h2>۷. بخش راهنمای سفر به کیش</h2>
            <table class="form-table">
                <tr>
                    <th scope="row">عنوان راهنما</th>
                    <td><input type="text" name="kishharmony_options[guide_title]" value="<?php echo esc_attr(kishharmony_get_option('guide_title', 'راهنمای سفر و برنامه‌ریزی برای جزیره کیش کامل')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row">توضیحات راهنما</th>
                    <td><textarea name="kishharmony_options[guide_desc]" class="large-text" rows="2"><?php echo esc_textarea(kishharmony_get_option('guide_desc', 'همه چیز برای یک سفر بی‌نظیر به کیش؛ اطلاعات کامل جاواطب، هتل‌ها، رستوران‌ها و مراکز خرید')); ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row">تصویر کاراکتر (URL)</th>
                    <td><input type="text" name="kishharmony_options[guide_char_img]" value="<?php echo esc_attr(kishharmony_get_option('guide_char_img', 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=500&q=80')); ?>" class="large-text"></td>
                </tr>
            </table>

            <hr>
            <h2>۸. تنظیمات آب و هوای کیش (API & Fallback)</h2>
            <table class="form-table">
                <tr>
                    <th scope="row">دمای دستی (در صورت عدم اتصال API)</th>
                    <td><input type="text" name="kishharmony_options[weather_temp]" value="<?php echo esc_attr(kishharmony_get_option('weather_temp', '۲۸°C')); ?>"></td>
                </tr>
                <tr>
                    <th scope="row">وضعیت دریا (Fallback)</th>
                    <td><input type="text" name="kishharmony_options[weather_sea]" value="<?php echo esc_attr(kishharmony_get_option('weather_sea', 'آرام و ملایم')); ?>"></td>
                </tr>
            </table>

            <hr>
            <h2>۹. تنظیمات فوتر و نمادهای اعتماد</h2>
            <table class="form-table">
                <tr>
                    <th scope="row">تلفن پشتیبانی</th>
                    <td><input type="text" name="kishharmony_options[footer_phone]" value="<?php echo esc_attr(kishharmony_get_option('footer_phone', '۰۷۶ - ۴۴۴۴۰۰۰۰')); ?>"></td>
                </tr>
                <tr>
                    <th scope="row">آدرس دفتر</th>
                    <td><input type="text" name="kishharmony_options[footer_address]" value="<?php echo esc_attr(kishharmony_get_option('footer_address', 'جزیره کیش، برج صدف، طبقه ۳')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th scope="row">کد HTML نمادهای اعتماد (ای‌نماد و سامانه)</th>
                    <td><textarea name="kishharmony_options[footer_namads]" class="large-text" rows="3"><?php echo esc_textarea(kishharmony_get_option('footer_namads', '<div style="color:#fff;font-size:12px;">[نماد اعتماد الکترونیکی eNamad]</div>')); ?></textarea></td>
                </tr>
            </table>

            <?php submit_button('ذخیره تمامی تنظیمات'); ?>
        </form>
    </div>
    <?php
}

// 3. WooCommerce Car Rental Custom Metabox
function kishharmony_add_car_metabox() {
    add_meta_box(
        'kishharmony_car_details',
        'مشخصات اختصاصی رنت خودرو (کیش هارمونی)',
        'kishharmony_car_metabox_html',
        'product',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'kishharmony_add_car_metabox');

function kishharmony_car_metabox_html($post) {
    wp_nonce_field('kishharmony_save_car_meta', 'kishharmony_car_nonce');
    $is_car   = get_post_meta($post->ID, '_is_car_rental', true);
    $gear     = get_post_meta($post->ID, '_car_gearbox', true);
    $fuel     = get_post_meta($post->ID, '_car_fuel', true);
    $insurance= get_post_meta($post->ID, '_car_insurance', true);
    $seats    = get_post_meta($post->ID, '_car_seats', true);
    $badge    = get_post_meta($post->ID, '_car_badge', true);
    ?>
    <div style="direction: rtl; text-align: right; padding: 10px;">
        <p>
            <label>
                <input type="checkbox" name="_is_car_rental" value="1" <?php checked($is_car, '1'); ?>>
                <strong>این محصول یک خودرو جهت رنت است</strong>
            </label>
        </p>
        <div style="display: flex; gap: 15px; flex-wrap: wrap;">
            <p>
                <label>نوع گیربکس:</label><br>
                <input type="text" name="_car_gearbox" value="<?php echo esc_attr($gear ? $gear : 'اتوماتیک'); ?>">
            </p>
            <p>
                <label>نوع سوخت / موتور:</label><br>
                <input type="text" name="_car_fuel" value="<?php echo esc_attr($fuel ? $fuel : 'بنزینی'); ?>">
            </p>
            <p>
                <label>نوع بیمه:</label><br>
                <input type="text" name="_car_insurance" value="<?php echo esc_attr($insurance ? $insurance : 'بیمه بدنه کامل'); ?>">
            </p>
            <p>
                <label>ظرفیت سرنشین:</label><br>
                <input type="text" name="_car_seats" value="<?php echo esc_attr($seats ? $seats : '۵ نفره'); ?>">
            </p>
            <p>
                <label>نشان ویژه (Badge):</label><br>
                <input type="text" name="_car_badge" value="<?php echo esc_attr($badge ? $badge : 'ویژه'); ?>">
            </p>
        </div>
    </div>
    <?php
}

function kishharmony_save_car_meta($post_id) {
    if (!isset($_POST['kishharmony_car_nonce']) || !wp_verify_nonce($_POST['kishharmony_car_nonce'], 'kishharmony_save_car_meta')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $is_car = isset($_POST['_is_car_rental']) ? '1' : '0';
    update_post_meta($post_id, '_is_car_rental', $is_car);
    if (isset($_POST['_car_gearbox'])) update_post_meta($post_id, '_car_gearbox', sanitize_text_field($_POST['_car_gearbox']));
    if (isset($_POST['_car_fuel'])) update_post_meta($post_id, '_car_fuel', sanitize_text_field($_POST['_car_fuel']));
    if (isset($_POST['_car_insurance'])) update_post_meta($post_id, '_car_insurance', sanitize_text_field($_POST['_car_insurance']));
    if (isset($_POST['_car_seats'])) update_post_meta($post_id, '_car_seats', sanitize_text_field($_POST['_car_seats']));
    if (isset($_POST['_car_badge'])) update_post_meta($post_id, '_car_badge', sanitize_text_field($_POST['_car_badge']));
}
add_action('save_post', 'kishharmony_save_car_meta');
