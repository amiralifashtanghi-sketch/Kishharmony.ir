<?php
/**
 * Module 4: Sea & Recreation Categories
 * Strictly implemented based on "دسته‌بندی سایت.txt"
 */

$title = kishharmony_get_option('sea_cats_title', 'دسته‌بندی تفریحات کیش هارمونی');
$desc  = kishharmony_get_option('sea_cats_desc', 'بهترین تجربه کلوپ‌های دریایی، تفریحات هوایی و سفرهای ساحلی کیش با تضمین قیمت');
?>

<section class="sea-category-bar space-y-4 my-10 max-w-7xl mx-auto px-4">
    <div class="flex items-center gap-3 mb-6">
        <span class="text-3xl">🌊</span>
        <div>
            <h2 class="text-2xl font-black text-[#071E3D]"><?php echo esc_html($title); ?></h2>
            <p class="text-xs text-slate-500"><?php echo esc_html($desc); ?></p>
        </div>
    </div>

    <!-- Container .grid-soft strictly implemented based on "دسته‌بندی سایت.txt" -->
    <div class="grid-soft">
        <a href="#sea-tour" class="card-soft">
            <i class="fa-solid fa-ship"></i>
            <div class="card-label">تور دریایی</div>
        </a>

        <a href="#parasail" class="card-soft">
            <i class="fa-solid fa-parachute-box"></i>
            <div class="card-label">پاراسل</div>
        </a>

        <a href="#diving" class="card-soft">
            <i class="fa-solid fa-water"></i>
            <div class="card-label">غواصی VIP</div>
        </a>

        <a href="#aerial" class="card-soft">
            <i class="fa-solid fa-plane"></i>
            <div class="card-label">تفریحات هوایی</div>
        </a>

        <a href="#jetski" class="card-soft">
            <i class="fa-solid fa-bolt"></i>
            <div class="card-label">جت اسکی</div>
        </a>

        <a href="#yacht" class="card-soft">
            <i class="fa-solid fa-anchor"></i>
            <div class="card-label">یات لاکچری</div>
        </a>

        <a href="#shuttle" class="card-soft">
            <i class="fa-solid fa-life-ring"></i>
            <div class="card-label">شاتل و بنانا</div>
        </a>
    </div>
</section>
