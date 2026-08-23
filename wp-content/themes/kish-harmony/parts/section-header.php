<?php
/**
 * Header Section Template Part - Glassmorphic Header & Floating Logo Animation
 */
if (!defined('ABSPATH')) exit;
?>
<header class="header fixed top-0 right-0 left-0 z-50 transition-all duration-300" id="header">
    <div class="header__left">
        <button class="hamburger" id="mobile-menu-btn" aria-label="منو">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <div class="header__center">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo">
            <span class="logo-icon">✦</span>
            <span class="logo-text">کیش هارمونی</span>
        </a>
    </div>

    <div class="header__right flex items-center gap-2">
        <?php if (class_exists('WooCommerce') && WC()->cart) : ?>
            <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="header__icon" id="cart-toggle-btn" aria-label="سبد خرید">
                <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4zM3 6h18" />
                    <circle cx="8" cy="10" r="2" />
                    <circle cx="16" cy="10" r="2" />
                </svg>
            </a>
        <?php endif; ?>
        <a href="<?php echo esc_url(wp_login_url()); ?>" class="header__icon" aria-label="حساب کاربری">
            <svg viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="8" r="4" />
                <path d="M20 21a8 8 0 10-16 0" />
            </svg>
        </a>
    </div>
</header>

<!-- Mobile Drawer Container -->
<div id="mobile-drawer" class="fixed inset-0 bg-slate-950/70 backdrop-blur-md z-[3500] hidden flex justify-start">
    <div class="bg-white w-72 h-full p-6 shadow-2xl flex flex-col justify-between">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <span class="font-black text-[#0B63D8] text-lg">کیش <span class="text-[#18D6D8]">هارمونی</span></span>
            <button id="close-drawer-btn" class="text-slate-400 hover:text-slate-800 text-2xl cursor-pointer">&times;</button>
        </div>
        <nav class="space-y-3 text-sm font-bold text-slate-700 mt-6">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="block p-2 hover:bg-slate-100 rounded-xl">صفحه اصلی</a>
            <a href="#special-offers" class="block p-2 hover:bg-slate-100 rounded-xl">پیشنهادهای ویژه</a>
            <a href="#car-rent" class="block p-2 hover:bg-slate-100 rounded-xl">اجاره خودرو</a>
            <a href="#weather" class="block p-2 hover:bg-slate-100 rounded-xl">آب و هوا</a>
            <a href="#travel-guide" class="block p-2 hover:bg-slate-100 rounded-xl">راهنمای سفر</a>
        </nav>
        <div class="mt-auto pt-6 border-t border-slate-100 text-xs text-slate-500">
            پشتیبانی ۲۴ ساعته: ۰۷۶-۴۴۴۲۰۰۰۰
        </div>
    </div>
</div>
