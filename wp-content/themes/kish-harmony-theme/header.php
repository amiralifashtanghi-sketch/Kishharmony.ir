<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>

    <!-- Tailwind CSS CDN Engine -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ['Vazirmatn', 'sans-serif'],
            },
            colors: {
              brand: {
                blue: '#0B63D8',
                cyan: '#18D6D8',
                orange: '#FF8A00',
                dark: '#071E3D',
              }
            }
          }
        }
      }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <?php wp_head(); ?>

    <?php
    $has_designer = class_exists('\KishHarmonyDesigner\Helpers');
    $settings = $has_designer ? \KishHarmonyDesigner\Helpers::get_settings() : array();
    $hdr = $settings['header'] ?? array();
    $logo_url = !empty($hdr['custom_logo']) ? $hdr['custom_logo'] : '';
    $menu_id = !empty($hdr['menu_id']) ? intval($hdr['menu_id']) : 0;
    $hamburger_on_desktop = !empty($hdr['hamburger_on_desktop']);
    $anim_speed = !empty($hdr['animation_speed']) ? $hdr['animation_speed'] : '300ms';
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

        /* User's Exact Glassy Header CSS Spec */
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
            transition: all <?php echo esc_attr($anim_speed); ?> cubic-bezier(0.45, 0, 0.55, 1.0);
        }

        .header.scrolled {
            background: rgba(255, 255, 255, 0.18) !important;
            backdrop-filter: blur(28px) saturate(200%) !important;
            -webkit-backdrop-filter: blur(28px) saturate(200%) !important;
            border-radius: <?php echo esc_attr($hdr['border_radius'] ?? '50px'); ?> !important;
            top: 14px !important;
            left: 3% !important;
            width: 94% !important;
            height: 58px !important;
            padding: 0 2.2rem !important;
            border: 1px solid <?php echo esc_attr($hdr['border_color'] ?? 'rgba(255, 255, 255, 0.35)'); ?> !important;
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
            background-color: <?php echo esc_attr($hdr['bg_left'] ?? 'transparent'); ?>;
            border-radius: 8px;
        }

        .header__center {
            flex: 1;
            background-color: <?php echo esc_attr($hdr['bg_center'] ?? 'transparent'); ?>;
            border-radius: 8px;
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
            background-color: <?php echo esc_attr($hdr['bg_right'] ?? 'transparent'); ?>;
            border-radius: 8px;
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

        /* Floating Logo Styles */
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

        /* Fallbacks */
        .custom-scrollbar::-webkit-scrollbar { height: 6px; width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #18D6D8; border-radius: 10px; }
    </style>
</head>
<body <?php body_class('bg-white font-sans text-slate-800 antialiased selection:bg-[#18D6D8] selection:text-slate-900'); ?>>
<?php wp_body_open(); ?>

<?php if (is_front_page() || is_home()) : ?>
    <!-- ========================================== -->
    <!-- 1. FIRST PAGE HEADER (Floating/Glassy)      -->
    <!-- ========================================== -->
    <header class="header" id="header">
        <div class="header__left">
            <button class="hamburger" aria-label="منو" id="mobile-menu-btn" style="display: <?php echo ($hamburger_on_desktop || $menu_id == 0) ? 'flex' : 'none'; ?>;">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <?php if (!$hamburger_on_desktop && $menu_id > 0) : ?>
                <?php wp_nav_menu(array(
                    'menu' => $menu_id,
                    'container' => 'nav',
                    'container_class' => 'header-nav-menu-container hidden md:block',
                    'menu_class' => 'header-nav-menu flex gap-6 text-sm font-bold text-slate-700',
                    'depth' => 1
                )); ?>
            <?php endif; ?>
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

    <a href="<?php echo esc_url(home_url('/')); ?>" class="floating-logo" id="floatingLogo">
        <?php if (!empty($logo_url)) : ?>
            <img src="<?php echo esc_url($logo_url); ?>" alt="لوگو" style="max-height: 56px; object-fit: contain; border-radius: 12px;" class="logo-image-file">
        <?php else : ?>
            <span class="logo-icon">✦</span>
            <span class="logo-text"><?php echo esc_html(!empty($settings['hero_banner']['lang_switcher_text']) ? 'کیش هارمونی' : 'کیش هارمونی'); ?></span>
        <?php endif; ?>
    </a>

<?php else : ?>
    <!-- ========================================== -->
    <!-- 2. INNER PAGES HEADER (Static/Central Logo)-->
    <!-- ========================================== -->
    <header class="header scrolled" id="header" style="position: sticky; top: 14px; margin-bottom: 30px;">
        <div class="header__left">
            <button class="hamburger" aria-label="منو" id="mobile-menu-btn" style="display: <?php echo ($hamburger_on_desktop || $menu_id == 0) ? 'flex' : 'none'; ?>;">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <?php if (!$hamburger_on_desktop && $menu_id > 0) : ?>
                <?php wp_nav_menu(array(
                    'menu' => $menu_id,
                    'container' => 'nav',
                    'container_class' => 'header-nav-menu-container hidden md:block',
                    'menu_class' => 'header-nav-menu flex gap-6 text-sm font-bold text-slate-700',
                    'depth' => 1
                )); ?>
            <?php endif; ?>
        </div>
        <div class="header__center">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo" style="display: flex; align-items: center; gap: 0.6rem; color: #1e1e2f; text-decoration: none;">
                <?php if (!empty($logo_url)) : ?>
                    <img src="<?php echo esc_url($logo_url); ?>" alt="لوگو" style="max-height: 40px; object-fit: contain;">
                <?php else : ?>
                    <span class="logo-icon" style="display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.05); border-radius: 12px; width: 36px; height: 36px; font-size: 1.1rem;">✦</span>
                    <span class="logo-text" style="font-weight: 800; font-size: 1.3rem;">کیش هارمونی</span>
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

<!-- React Root Container - Mounted automatically by app-bundle.js -->
<div id="root">
