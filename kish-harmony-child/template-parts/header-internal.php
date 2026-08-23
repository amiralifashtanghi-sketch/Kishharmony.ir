<?php
/**
 * Module 2: Internal Header
 */

$brand_fa = kishharmony_get_option('brand_name_fa', 'کیش هارمونی');

$cart_count = 0;
if (class_exists('WooCommerce') && !is_null(WC()->cart)) {
    $cart_count = WC()->cart->get_cart_contents_count();
}
$account_link = class_exists('WooCommerce') ? get_permalink(get_option('woocommerce_myaccount_page_id')) : '#';
?>

<header class="header" id="header">
    <div class="header__left">
        <button class="hamburger" id="hamburgerBtn" aria-label="منو">
            <span></span><span></span><span></span>
        </button>
    </div>
    <div class="header__center">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo">
            <span class="logo-icon">✦</span>
            <span class="logo-text"><?php echo esc_html($brand_fa); ?></span>
        </a>
    </div>
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
