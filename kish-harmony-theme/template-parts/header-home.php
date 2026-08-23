<?php
/**
 * Module 1: Home Header & Hero
 */

$brand_fa   = kishharmony_get_option('brand_name_fa', 'کیش هارمونی');
$brand_en   = kishharmony_get_option('brand_name_en', 'Kish Harmony');
$hero_bg    = kishharmony_get_option('hero_bg_color', '#0B63D8');
$hero_title = kishharmony_get_option('hero_title', 'سامانه آنلاین رزرو کیش هارمونی');
$hero_desc  = kishharmony_get_option('hero_desc', 'رزرو مستقیم تفریحات آبی، اجاره ماشین‌های سوپراسپرت و اقامتگاه‌های لوکس با تخفیف روزانه و پشتیبانی ۲۴ ساعته در کیش');

$cart_count = 0;
if (class_exists('WooCommerce') && !is_null(WC()->cart)) {
    $cart_count = WC()->cart->get_cart_contents_count();
}
$account_link = class_exists('WooCommerce') ? get_permalink(get_option('woocommerce_myaccount_page_id')) : '#';
?>

<!-- Floating Logo element -->
<a href="<?php echo esc_url(home_url('/')); ?>" class="floating-logo" id="floatingLogo">
    <span class="logo-icon">✦</span>
    <span class="logo-text"><?php echo esc_html($brand_fa); ?></span>
</a>

<header class="header" id="header">
    <div class="header__left">
        <button class="hamburger" id="hamburgerBtn" aria-label="منو">
            <span></span><span></span><span></span>
        </button>
    </div>
    <div class="header__center"></div>
    <div class="header__right">
        <a href="#" class="header__icon" id="cartIcon" aria-label="سبد خرید">
            <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4zM3 6h18" /><circle cx="8" cy="10" r="2" /><circle cx="16" cy="10" r="2" /></svg>
            <span class="cart-count custom-cart-count"><?php echo esc_html($cart_count); ?></span>
        </a>
        <a href="<?php echo esc_url($account_link); ?>" class="header__icon" aria-label="حساب کاربری">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4" /><path d="M20 21a8 8 0 10-16 0" /></svg>
        </a>
    </div>
</header>

<!-- Hero Section with 8 Overlapping Floating Categories -->
<section class="hero w-full pt-6 relative overflow-visible shadow-xl mb-44 sm:mb-52 md:mb-60" style="background-color: <?php echo esc_attr($hero_bg); ?>;">
    <div class="banner min-h-[140px] sm:min-h-[160px] md:min-h-[190px] flex flex-col items-center justify-center relative px-6 text-center text-white mt-6 sm:mt-8 md:mt-10 mb-6" id="banner">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center text-[#18D6D8] text-2xl sm:text-3xl border border-white/20 shadow-inner">
                <i class="fa-solid fa-umbrella-beach"></i>
            </div>
            <h1 class="text-2xl sm:text-4xl md:text-5xl font-black tracking-tight drop-shadow-md"><?php echo esc_html($hero_title); ?></h1>
        </div>
        <p class="text-xs sm:text-sm md:text-base text-blue-100 font-medium mt-3 max-w-2xl leading-relaxed">
            <?php echo esc_html($hero_desc); ?>
        </p>
    </div>

    <!-- 8 Floating Category Cards -->
    <div class="categories-wrapper max-w-6xl mx-auto px-4 absolute -bottom-36 sm:-bottom-44 md:-bottom-52 left-0 right-0 z-20">
        <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 p-3 sm:p-6 grid grid-cols-4 sm:grid-cols-8 gap-2 sm:gap-4 text-center">
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
                $is_special = ($i === 5);
                ?>
                <a href="<?php echo esc_url($link); ?>" class="category-card group flex flex-col items-center justify-center p-3 sm:p-4 rounded-2xl <?php echo $is_special ? 'bg-amber-50/90 border-amber-200' : 'bg-white border-slate-100 hover:bg-blue-50'; ?> transition-all border shadow-sm hover:shadow-md relative">
                    <?php if ($is_special) : ?>
                        <span class="absolute -top-2 bg-[#FF8A00] text-white text-[9px] font-black px-2 py-0.5 rounded-full shadow-md animate-bounce">جدید</span>
                    <?php endif; ?>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl <?php echo $is_special ? 'bg-amber-100 text-[#FF8A00]' : 'bg-blue-50 text-[#0B63D8]'; ?> flex items-center justify-center text-xl sm:text-2xl mb-2 group-hover:scale-110 transition-transform">
                        <i class="fa-solid <?php echo esc_attr($icon); ?>"></i>
                    </div>
                    <span class="text-xs sm:text-sm font-extrabold <?php echo $is_special ? 'text-[#FF8A00]' : 'text-slate-800'; ?>"><?php echo esc_html($title); ?></span>
                </a>
            <?php } ?>
        </div>
    </div>
</section>
