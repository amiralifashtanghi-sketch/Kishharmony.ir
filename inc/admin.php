<?php
// inc/admin.php - simple admin page for banners management hints
add_action('admin_menu', 'kishharmony_admin_menu');
function kishharmony_admin_menu(){
    add_menu_page('Kishharmony','Kishharmony','manage_options','kishharmony-settings','kishharmony_settings_page','dashicons-admin-customizer',58);
}

function kishharmony_settings_page(){
    ?>
    <div class="wrap">
        <h1>تنظیمات Kishharmony</h1>
        <p>در اینجا بنرها (از CPT بنرها) و سایر تنظیمات قالب را مدیریت کنید.</p>
        <p>برای اضافه‌کردن بنر: از بخش "بنرها" در منوی سمت چپ استفاده کنید.</p>
    </div>
    <?php
}
