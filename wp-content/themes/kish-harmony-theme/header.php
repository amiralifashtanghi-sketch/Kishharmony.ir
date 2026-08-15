<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>

    <!-- FontAwesome & Font Definitions -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <?php wp_head(); ?>

    <?php
    $has_designer = class_exists('\KishHarmonyDesigner\Helpers');
    $settings = $has_designer ? \KishHarmonyDesigner\Helpers::get_settings() : array();
    $hdr = $settings['header'] ?? array();
    $hero_banner = $settings['hero_banner'] ?? array();
    $logo_url = !empty($hdr['custom_logo']) ? $hdr['custom_logo'] : '';
    $brand_title = !empty($hero_banner['title_text']) ? $hero_banner['title_text'] : 'برند شما';
    ?>

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Vazirmatn', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif !important;
            background-color: #ffffff;
            color: #1e293b;
            line-height: 1.5;
            min-height: 200vh;
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.8rem;
            background: transparent;
            border: 1px solid transparent;
            border-radius: 0;
            box-shadow: none;
            backdrop-filter: none;
            -webkit-backdrop-filter: none;
            transition: all <?php echo esc_attr(!empty($hdr['animation_speed']) ? $hdr['animation_speed'] : '0.8s'); ?> cubic-bezier(0.45, 0, 0.55, 1.0);
        }

        .header.scrolled {
            background: rgba(255, 255, 255, 0.18) !important;
            backdrop-filter: blur(28px) saturate(200%) !important;
            -webkit-backdrop-filter: blur(28px) saturate(200%) !important;
            border-radius: <?php echo esc_attr(!empty($hdr['border_radius']) ? $hdr['border_radius'] : '50px'); ?> !important;
            top: 14px !important;
            left: 3% !important;
            width: 94% !important;
            height: 58px !important;
            padding: 0 2.2rem !important;
            border: 1px solid <?php echo esc_attr(!empty($hdr['border_color']) ? $hdr['border_color'] : 'rgba(255, 255, 255, 0.35)'); ?> !important;
            box-shadow:
                0 20px 40px -12px rgba(0, 0, 0, 0.15),
                0 4px 12px rgba(0, 0, 0, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.5) !important;
        }

        .header__left {
            flex: 1;
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }

        .header__center {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .header__right {
            flex: 1;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 1rem;
        }

        .hamburger {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            width: 36px;
            height: 28px;
            padding: 0.5rem;
            background: none;
            border: none;
            cursor: pointer;
            gap: 5px;
        }

        .hamburger span {
            display: block;
            height: 2.5px;
            background-color: #2d2d2d;
            border-radius: 3px;
        }

        .header__icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: transparent;
            color: #2d2d2d;
            transition: background 0.3s ease, color 0.3s ease;
            text-decoration: none;
        }

        .header__icon svg {
            width: 22px;
            height: 22px;
            fill: none;
            stroke: currentColor;
            stroke-width: 1.8;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .header__icon:hover {
            background: rgba(255, 255, 255, 0.4);
            color: #1a1a1a;
        }

        /* Floating Logo CSS */
        .floating-logo {
            position: fixed;
            z-index: 2000;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            color: white;
            text-decoration: none;
            white-space: nowrap;
            left: 50%;
            top: 0;
            transform: translate(-50%, -50%);
            will-change: top;
        }

        .logo-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            border-radius: 18px;
            font-size: 1.8rem;
            width: 56px;
            height: 56px;
        }

        .logo-text {
            font-weight: 800;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            font-size: 2.2rem;
        }

        @media screen and (max-width: 768px) {
            .header {
                height: 62px;
                padding: 0 1rem;
            }
            .header.scrolled {
                border-radius: 35px !important;
                top: 8px !important;
                left: 2% !important;
                width: 96% !important;
                height: 52px !important;
                padding: 0 1.5rem !important;
            }
            .logo-icon {
                width: 46px;
                height: 46px;
                font-size: 1.4rem;
            }
            .logo-text {
                font-size: 1.6rem;
            }
        }

        @media screen and (max-width: 480px) {
            .header.scrolled {
                border-radius: 28px !important;
                top: 6px !important;
            }
            .logo-icon {
                width: 38px;
                height: 38px;
                font-size: 1.1rem;
                border-radius: 12px;
            }
            .logo-text {
                font-size: 1.3rem;
            }
        }
    </style>
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
