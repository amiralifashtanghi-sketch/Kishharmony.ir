<?php
/**
 * Module 1: Home Header & Hero Section with Floating Logo, Glassmorphism Header, Mobile Menu & Cart Drawer
 * Strictly implemented based on the provided HTML/CSS/JS code
 */

$brand_fa   = kishharmony_get_option('brand_name_fa', 'برند شما');
$hero_bg    = kishharmony_get_option('hero_bg_color', '#1a56db');

$cart_count = 0;
if (class_exists('WooCommerce') && !is_null(WC()->cart)) {
    $cart_count = WC()->cart->get_cart_contents_count();
}
$account_link = class_exists('WooCommerce') ? get_permalink(get_option('woocommerce_myaccount_page_id')) : '#';
?>

<!-- 1. Fixed Glassmorphism Header -->
<header class="header" id="header">
    <div class="header__left">
        <button class="hamburger" id="hamburgerBtn" aria-label="منو">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <div class="header__center"></div>

    <div class="header__right">
        <a href="#" class="header__icon" id="cartIcon" aria-label="سبد خرید">
            <svg viewBox="0 0 24 24">
                <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4zM3 6h18" />
                <circle cx="8" cy="10" r="2" />
                <circle cx="16" cy="10" r="2" />
            </svg>
            <span class="cart-count custom-cart-count"><?php echo esc_html($cart_count); ?></span>
        </a>
        <a href="<?php echo esc_url($account_link); ?>" class="header__icon" aria-label="حساب کاربری">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="8" r="4" />
                <path d="M20 21a8 8 0 10-16 0" />
            </svg>
        </a>
    </div>
</header>

<!-- 2. Floating Animated Logo -->
<a href="<?php echo esc_url(home_url('/')); ?>" class="floating-logo" id="floatingLogo">
    <span class="logo-icon">✦</span>
    <span class="logo-text"><?php echo esc_html($brand_fa); ?></span>
</a>

<!-- 3. Blue Hero Container & Categories Wrapper -->
<div class="hero" id="hero" style="background-color: <?php echo esc_attr($hero_bg); ?>;">
    <div class="banner" id="banner"></div>
    <div class="categories-wrapper">
        <div class="categories-grid">
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
</div>

<!-- 4. Mobile Drawer Panel -->
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
        echo '<li><a href="#water-sports">تفریحات آبی</a></li>';
        echo '<li><a href="#car-rent">اجاره خودرو</a></li>';
        echo '<li><a href="#hotels">رزرو هتل</a></li>';
        echo '<li><a href="#contact">تماس با ما</a></li>';
        echo '</ul>';
    }
    ?>
</div>

<!-- 5. Cart Slide Panel -->
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
