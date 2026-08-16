<?php
/**
 * Header Template Part - Glassmorphic Header & Logo
 */
if (!defined('ABSPATH')) exit;
?>
<header class="kh-header fixed top-0 right-0 left-0 z-50 transition-all duration-300" id="kh-main-header">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 sm:h-20 flex items-center justify-between">
        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-3">
            <div class="w-10 h-10 sm:w-12 sm:h-12 bg-[#0B63D8] text-white rounded-2xl flex items-center justify-center font-black text-xl shadow-md">
                ✦
            </div>
            <span class="text-lg sm:text-2xl font-black text-[#071E3D] tracking-tight">کیش هارمونی</span>
        </a>

        <!-- Navigation Menu -->
        <nav class="hidden md:flex items-center gap-6 text-sm font-bold text-slate-700">
            <?php
            if (has_nav_menu('primary-menu')) {
                wp_nav_menu(array(
                    'theme_location' => 'primary-menu',
                    'container' => false,
                    'menu_class' => 'flex items-center gap-6',
                ));
            } else {
                echo '<a href="' . esc_url(home_url('/')) . '" class="hover:text-[#0B63D8] transition-colors">صفحه اصلی</a>';
                echo '<a href="#special-offers" class="hover:text-[#0B63D8] transition-colors">پیشنهادهای ویژه</a>';
                echo '<a href="#car-rent" class="hover:text-[#0B63D8] transition-colors">اجاره خودرو</a>';
                echo '<a href="#travel-guide" class="hover:text-[#0B63D8] transition-colors">راهنمای سفر</a>';
            }
            ?>
        </nav>

        <!-- Actions -->
        <div class="flex items-center gap-3">
            <?php if (class_exists('WooCommerce') && WC()->cart) : ?>
                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="w-10 h-10 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center transition-colors relative">
                    <i class="fa-solid fa-shopping-bag"></i>
                    <span class="absolute -top-1 -right-1 bg-[#FF8A00] text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center">
                        <?php echo WC()->cart->get_cart_contents_count(); ?>
                    </span>
                </a>
            <?php endif; ?>
            <a href="<?php echo esc_url(wp_login_url()); ?>" class="bg-[#0B63D8] hover:bg-[#084bb3] text-white px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-md">
                ورود / ثبت نام
            </a>
        </div>
    </div>
</header>
