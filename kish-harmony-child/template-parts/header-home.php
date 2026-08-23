<?php
/**
 * Module 1: Home Header & Hero Section with Floating Logo, Glassmorphism Header, Mobile Menu & Cart Drawer
 * Inspired strictly by "طراحی PHP هدر.txt"
 */

$brand_fa   = kishharmony_get_option('brand_name_fa', 'کیش هارمونی');
$brand_en   = kishharmony_get_option('brand_name_en', 'Kish Harmony');
$hero_bg    = kishharmony_get_option('hero_bg_color', '#1e3a8a');
$hero_title = kishharmony_get_option('hero_title', 'سامانه آنلاین رزرو کیش هارمونی');
$hero_desc  = kishharmony_get_option('hero_desc', 'رزرو مستقیم تفریحات آبی، اجاره ماشین‌های سوپراسپرت و اقامتگاه‌های لوکس با تخفیف روزانه و پشتیبانی ۲۴ ساعته در کیش');

$cart_count = 0;
if (class_exists('WooCommerce') && !is_null(WC()->cart)) {
    $cart_count = WC()->cart->get_cart_contents_count();
}
$account_link = class_exists('WooCommerce') ? get_permalink(get_option('woocommerce_myaccount_page_id')) : '#';
?>

<!-- 1. Floating Animated Logo -->
<a href="<?php echo esc_url(home_url('/')); ?>" class="floating-logo" id="floatingLogo">
    <span class="logo-icon">✦</span>
    <span class="logo-text"><?php echo esc_html($brand_fa); ?></span>
</a>

<!-- 2. Glassmorphism Main Header -->
<header class="header" id="header">
    <div class="header__nav-area">
        <button class="hamburger" id="hamburgerBtn" aria-label="منوی اصلی">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <?php
        if (has_nav_menu('primary-menu')) {
            wp_nav_menu(array(
                'theme_location' => 'primary-menu',
                'container'      => false,
                'menu_class'     => 'desktop-nav',
                'menu_id'        => 'desktopNav',
                'fallback_cb'    => false,
            ));
        } else {
            echo '<ul class="desktop-nav" id="desktopNav">';
            echo '<li class="current-menu-item"><a href="' . esc_url(home_url('/')) . '">صفحه اصلی</a></li>';
            echo '<li class="menu-item-has-children"><a href="#water-sports">تفریحات آبی</a>';
            echo '<ul class="sub-menu">';
            echo '<li><a href="#parasail">پاراسل</a></li>';
            echo '<li><a href="#diving">غواصی VIP</a></li>';
            echo '<li><a href="#jetski">جت اسکی</a></li>';
            echo '<li><a href="#flyboard">فلای بورد</a></li>';
            echo '</ul></li>';
            echo '<li><a href="#car-rent">اجاره خودرو</a></li>';
            echo '<li><a href="#hotels">هتل‌ها</a></li>';
            echo '<li><a href="#tours">تورهای کیش</a></li>';
            echo '<li><a href="#contact">تماس با ما</a></li>';
            echo '</ul>';
        }
        ?>
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

<!-- 3. Mobile Navigation Drawer Panel -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>
<div class="mobile-menu" id="mobileMenu">
    <div class="mobile-menu__header">
        <span class="mobile-menu__logo"><?php echo esc_html($brand_fa); ?></span>
        <button class="mobile-menu__close" id="closeMobileMenu" aria-label="بستن منو">✕</button>
    </div>
    <?php
    if (has_nav_menu('primary-menu')) {
        wp_nav_menu(array(
            'theme_location' => 'primary-menu',
            'container'      => false,
            'menu_class'     => 'mobile-nav',
            'menu_id'        => 'mobileNav',
            'fallback_cb'    => false,
        ));
    } else {
        echo '<ul class="mobile-nav" id="mobileNav">';
        echo '<li><a href="' . esc_url(home_url('/')) . '">صفحه اصلی</a></li>';
        echo '<li class="menu-item-has-children"><a href="#water-sports">تفریحات آبی</a>';
        echo '<ul class="sub-menu">';
        echo '<li><a href="#parasail">پاراسل</a></li>';
        echo '<li><a href="#diving">غواصی VIP</a></li>';
        echo '<li><a href="#jetski">جت اسکی</a></li>';
        echo '</ul></li>';
        echo '<li><a href="#car-rent">اجاره خودرو</a></li>';
        echo '<li><a href="#hotels">رزرو هتل</a></li>';
        echo '<li><a href="#contact">تماس با ما</a></li>';
        echo '</ul>';
    }
    ?>
</div>

<!-- 4. WooCommerce Cart Slide Panel -->
<div class="cart-panel-overlay" id="cartPanelOverlay"></div>
<div class="cart-panel" id="cartPanel">
    <div class="cart-panel__header">
        <h3>سبد خرید</h3>
        <button class="cart-panel__close" id="closeCartPanel" aria-label="بستن سبد خرید">✕</button>
    </div>
    <div class="custom-cart-widget-area">
        <?php
        if (class_exists('WooCommerce')) {
            the_widget('WC_Widget_Cart', 'title=');
        } else {
            echo '<p style="padding:15px;color:#5a6f80;">افزونه ووکامرس فعال نیست.</p>';
        }
        ?>
    </div>
</div>

<!-- 5. Blue Hero Container -->
<section class="hero w-full pt-[70px] relative overflow-visible shadow-xl mb-44 sm:mb-52 md:mb-60" style="background-color: <?php echo esc_attr($hero_bg); ?>; height: 542px;">
    <!-- Language Switcher Badge -->
    <div class="absolute top-4 right-4 sm:right-8 z-20 flex items-center gap-2">
        <span class="text-white text-xs font-bold bg-white/20 backdrop-blur-md px-3.5 py-1.5 rounded-full border border-white/30 flex items-center gap-2 shadow-sm cursor-pointer">
            <i class="fa-solid fa-globe text-amber-300"></i>
            <span>فارسی | IRAN</span>
            <i class="fa-solid fa-chevron-down text-[10px] text-white/80"></i>
        </span>
    </div>

    <!-- Main Hero Banner Content -->
    <div class="banner h-[360px] flex flex-col items-center justify-center relative px-6 text-center text-white" id="banner">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center text-[#00b4d8] text-2xl sm:text-3xl border border-white/20 shadow-inner">
                <i class="fa-solid fa-umbrella-beach"></i>
            </div>
            <h1 class="text-2xl sm:text-4xl md:text-5xl font-black tracking-tight drop-shadow-md"><?php echo esc_html($hero_title); ?></h1>
        </div>
        <p class="text-xs sm:text-sm md:text-base text-blue-100 font-medium mt-3 max-w-2xl leading-relaxed">
            <?php echo esc_html($hero_desc); ?>
        </p>
    </div>

    <!-- Bottom Curve SVG Divider -->
    <div class="hero-bottom-curve absolute -bottom-1 left-0 w-full overflow-hidden leading-none z-0">
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-10 sm:h-16 text-slate-50 fill-current">
            <path d="M0,0 C150,90 350,-40 500,50 C650,140 900,-20 1200,40 L1200,120 L0,120 Z"></path>
        </svg>
    </div>

    <!-- 6. Categories Grid Box -->
    <div class="categories-wrapper max-w-[820px] mx-auto px-4 absolute -bottom-36 sm:-bottom-44 md:-bottom-52 left-0 right-0 z-20">
        <div class="categories-grid grid grid-cols-2 bg-white border border-[#e5e7eb] rounded-[28px] overflow-hidden shadow-[0_8px_30px_rgba(0,0,0,0.06)]">
            <?php
            $default_cats = array(
                1 => array('title' => 'قطار', 'emoji' => '🚆', 'link' => '#train'),
                2 => array('title' => 'پرواز', 'emoji' => '✈️', 'link' => '#flight'),
                3 => array('title' => 'هتل', 'emoji' => '🏨', 'link' => '#hotel'),
                4 => array('title' => 'اتوبوس', 'emoji' => '🚌', 'link' => '#bus'),
                5 => array('title' => 'ویژه', 'emoji' => '⭐', 'link' => '#special-offers'),
                6 => array('title' => 'ویلا و اقامتگاه', 'emoji' => '🏡', 'link' => '#villa'),
                7 => array('title' => 'تور', 'emoji' => '🧳', 'link' => '#tour'),
                8 => array('title' => 'نسخه جدید', 'emoji' => '✨', 'link' => '#new'),
            );
            for ($i = 1; $i <= 8; $i++) {
                $title = kishharmony_get_option("hero_cat_{$i}_title", $default_cats[$i]['title']);
                $emoji = isset($default_cats[$i]['emoji']) ? $default_cats[$i]['emoji'] : '✦';
                $link  = kishharmony_get_option("hero_cat_{$i}_link", $default_cats[$i]['link']);
                $is_special = ($i === 5 || $i === 8);
                ?>
                <a href="<?php echo esc_url($link); ?>" class="category-item <?php echo $is_special ? 'special' : ''; ?>">
                    <span class="category-emoji"><?php echo esc_html($emoji); ?></span>
                    <span class="category-text"><?php echo esc_html($title); ?></span>
                    <?php if ($i === 5) : ?>
                        <span class="badge">جدید</span>
                    <?php endif; ?>
                </a>
            <?php } ?>
        </div>
    </div>
</section>
