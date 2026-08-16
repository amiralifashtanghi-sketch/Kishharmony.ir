<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>

    <!-- FontAwesome 6.5.1 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <?php wp_head(); ?>

    <?php
    $has_designer = class_exists('\KishHarmonyDesigner\Helpers');
    $settings = $has_designer ? \KishHarmonyDesigner\Helpers::get_settings() : array();
    $hdr = $settings['header'] ?? array();
    $hero_banner = $settings['hero_banner'] ?? array();
    $logo_url = !empty($hdr['custom_logo']) ? $hdr['custom_logo'] : '';
    $brand_title = !empty($hero_banner['title_text']) ? $hero_banner['title_text'] : 'کیش هارمونی';
    ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if (is_front_page() || is_home()) : ?>
    <!-- User Exact Home Glassy Header -->
    <header class="header" id="header">
        <div class="header__left">
            <button class="hamburger" aria-label="منو" id="mobile-menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        <div class="header__center"></div>
        <div class="header__right">
            <a href="#" class="header__icon" aria-label="سبد خرید" id="cart-toggle-btn">
                <svg viewBox="0 0 24 24">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4zM3 6h18" />
                    <circle cx="8" cy="10" r="2" />
                    <circle cx="16" cy="10" r="2" />
                </svg>
            </a>
            <a href="#" class="header__icon" aria-label="حساب کاربری">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M20 21a8 8 0 10-16 0" />
                </svg>
            </a>
        </div>
    </header>

    <!-- Only ONE Floating Logo on Home Page -->
    <a href="<?php echo esc_url(home_url('/')); ?>" class="floating-logo" id="floatingLogo">
        <?php if (!empty($logo_url)) : ?>
            <img src="<?php echo esc_url($logo_url); ?>" alt="لوگو" style="max-height: 56px; object-fit: contain;" class="logo-image-file">
        <?php else : ?>
            <span class="logo-icon">✦</span>
            <span class="logo-text"><?php echo esc_html($brand_title); ?></span>
        <?php endif; ?>
    </a>

<?php else : ?>
    <!-- Inner Pages Static Header -->
    <header class="header scrolled" id="header" style="position: sticky; top: 14px; margin-bottom: 30px;">
        <div class="header__left">
            <button class="hamburger" aria-label="منو" id="mobile-menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
        <div class="header__center">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo" style="display: flex; align-items: center; gap: 0.6rem; color: #1e1e2f; text-decoration: none;">
                <?php if (!empty($logo_url)) : ?>
                    <img src="<?php echo esc_url($logo_url); ?>" alt="لوگو" style="max-height: 40px; object-fit: contain;">
                <?php else : ?>
                    <span class="logo-icon" style="display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.05); border-radius: 12px; width: 36px; height: 36px; font-size: 1.1rem;">✦</span>
                    <span class="logo-text" style="font-weight: 800; font-size: 1.3rem;"><?php echo esc_html($brand_title); ?></span>
                <?php endif; ?>
            </a>
        </div>
        <div class="header__right">
            <a href="#" class="header__icon" aria-label="سبد خرید" id="cart-toggle-btn">
                <svg viewBox="0 0 24 24">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4zM3 6h18" />
                    <circle cx="8" cy="10" r="2" />
                    <circle cx="16" cy="10" r="2" />
                </svg>
            </a>
            <a href="#" class="header__icon" aria-label="حساب کاربری">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M20 21a8 8 0 10-16 0" />
                </svg>
            </a>
        </div>
    </header>
<?php endif; ?>

<div id="root">
