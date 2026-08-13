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
        body { font-family: 'Vazirmatn', sans-serif !important; direction: rtl; text-align: right; background-color: #f8fafc; }
        .custom-scrollbar::-webkit-scrollbar { height: 6px; width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #18D6D8; border-radius: 10px; }

        /* Dynamic Header Column Styling */
        .header {
            transition: all <?php echo esc_attr($anim_speed); ?> ease-in-out;
            border-radius: <?php echo esc_attr($hdr['border_radius'] ?? '12px'); ?> !important;
            border: 1px solid <?php echo esc_attr($hdr['border_color'] ?? '#cbd5e1'); ?> !important;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background: #ffffff;
            margin: 10px auto;
            max-width: 95%;
            z-index: 50;
        }

        .header__left {
            background-color: <?php echo esc_attr($hdr['bg_left'] ?? '#ffffff'); ?>;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 6px 12px;
            border-radius: 8px;
        }

        .header__center {
            background-color: <?php echo esc_attr($hdr['bg_center'] ?? '#ffffff'); ?>;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
            padding: 6px 12px;
            border-radius: 8px;
        }

        .header__right {
            background-color: <?php echo esc_attr($hdr['bg_right'] ?? '#ffffff'); ?>;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 12px;
            border-radius: 8px;
        }

        /* Responsive menu styling */
        .hamburger {
            display: <?php echo $hamburger_on_desktop ? 'flex' : 'none'; ?>;
            flex-direction: column;
            gap: 4px;
            background: none;
            border: none;
            cursor: pointer;
        }
        @media (max-width: 768px) {
            .hamburger {
                display: flex !important;
            }
            .header-nav-menu-container {
                display: none !important;
            }
        }

        .hamburger span {
            display: block;
            width: 24px;
            height: 2px;
            background-color: #334155;
            transition: 0.3s;
        }

        /* Header link hover states with transitions */
        .header__icon svg {
            width: 24px;
            height: 24px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            transition: transform <?php echo esc_attr($anim_speed); ?> ease;
        }

        .header__icon:hover svg {
            transform: scale(1.1);
        }
    </style>
</head>
<body <?php body_class('bg-slate-50 font-sans text-slate-800 antialiased selection:bg-[#18D6D8] selection:text-slate-900'); ?>>
<?php wp_body_open(); ?>

<?php if (is_front_page() || is_home()) : ?>
    <!-- ========================================== -->
    <!-- 1. FIRST PAGE HEADER (Floating/Glassy)      -->
    <!-- ========================================== -->
    <header class="header" id="header">
        <div class="header__left">
            <button class="hamburger" aria-label="منو" id="mobile-menu-btn" style="display: <?php echo $hamburger_on_desktop ? 'flex' : 'none'; ?>;">
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
            <!-- Floating Logo scrolls here if it is the home page -->
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

    <!-- Floating Logo Markup -->
    <a href="<?php echo esc_url(home_url('/')); ?>" class="floating-logo" id="floatingLogo">
        <?php if (!empty($logo_url)) : ?>
            <img src="<?php echo esc_url($logo_url); ?>" alt="کیش هارمونی" style="max-height: 50px; object-fit: contain; transition: all <?php echo esc_attr($anim_speed); ?> ease;" class="logo-image-file">
        <?php else : ?>
            <span class="logo-icon">✦</span>
            <span class="logo-text">کیش هارمونی</span>
        <?php endif; ?>
    </a>

    <!-- Floating Logo Scroll and Transition Logic -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.getElementById('header');
        const floatingLogo = document.getElementById('floatingLogo');
        const logoIcon = floatingLogo.querySelector('.logo-icon');
        const logoText = floatingLogo.querySelector('.logo-text');
        const logoImg = floatingLogo.querySelector('.logo-image-file');
        const banner = document.querySelector('.banner');

        if (!header || !floatingLogo || !banner) return;

        let bannerCenterY = 0;
        let headerCenterY = 0;

        const LARGE_ICON_SIZE = 56;
        const SMALL_ICON_SIZE = 36;
        const LARGE_TEXT_SIZE_REM = 2.2;
        const SMALL_TEXT_SIZE_REM = 1.3;

        function updatePositions() {
            const bannerRect = banner.getBoundingClientRect();
            bannerCenterY = window.scrollY + bannerRect.top + (bannerRect.height / 2);

            const width = window.innerWidth;
            let scrolledTop, scrolledHeight;
            if (width <= 480) {
                scrolledTop = 6;
                scrolledHeight = 52;
            } else if (width <= 768) {
                scrolledTop = 8;
                scrolledHeight = 52;
            } else {
                scrolledTop = 14;
                scrolledHeight = 58;
            }
            headerCenterY = scrolledTop + (scrolledHeight / 2);

            if (window.scrollY <= 10) {
                floatingLogo.style.top = bannerCenterY + 'px';
            }
        }

        function easeInOutCubic(t) {
            return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
        }

        function getScrollProgress() {
            const maxScroll = 200;
            const raw = Math.min(window.scrollY / maxScroll, 1.0);
            return easeInOutCubic(raw);
        }

        function updateLogo(progress) {
            const currentY = bannerCenterY + (headerCenterY - bannerCenterY) * progress;
            floatingLogo.style.top = currentY + 'px';

            if (logoIcon && logoText) {
                const iconSize = LARGE_ICON_SIZE + (SMALL_ICON_SIZE - LARGE_ICON_SIZE) * progress;
                const textSizeRem = LARGE_TEXT_SIZE_REM + (SMALL_TEXT_SIZE_REM - LARGE_TEXT_SIZE_REM) * progress;

                logoIcon.style.width = iconSize + 'px';
                logoIcon.style.height = iconSize + 'px';
                logoIcon.style.fontSize = (iconSize * 0.55) + 'px';
                logoText.style.fontSize = textSizeRem + 'rem';
                logoIcon.style.borderRadius = (18 + (12 - 18) * progress) + 'px';
            }

            if (logoImg) {
                const imgScale = 1.3 - (0.4 * progress);
                logoImg.style.transform = `scale(${imgScale})`;
            }

            // Text color changes as it enters the glassy header
            if (progress > 0.8) {
                floatingLogo.style.color = '#1e1e2f';
            } else {
                floatingLogo.style.color = 'white';
            }
        }

        let ticking = false;
        function onScroll() {
            if (window.scrollY > 10) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }

            if (!ticking) {
                window.requestAnimationFrame(() => {
                    const progress = getScrollProgress();
                    updateLogo(progress);
                    ticking = false;
                });
                ticking = true;
            }
        }

        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', () => {
            updatePositions();
            const progress = getScrollProgress();
            updateLogo(progress);
        });

        // Initialize positions
        updatePositions();
        updateLogo(getScrollProgress());
        window.addEventListener('load', () => {
            updatePositions();
            updateLogo(getScrollProgress());
        });
    });
    </script>

<?php else : ?>
    <!-- ========================================== -->
    <!-- 2. INNER PAGES HEADER (Static/Central Logo)-->
    <!-- ========================================== -->
    <header class="header" id="header">
        <div class="header__left">
            <button class="hamburger" aria-label="منو" id="mobile-menu-btn" style="display: <?php echo $hamburger_on_desktop ? 'flex' : 'none'; ?>;">
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
            <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo">
                <?php if (!empty($logo_url)) : ?>
                    <img src="<?php echo esc_url($logo_url); ?>" alt="کیش هارمونی" style="max-height: 40px; object-fit: contain;">
                <?php else : ?>
                    <span class="logo-icon">✦</span>
                    <span class="logo-text">کیش هارمونی</span>
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.getElementById('header');
        if (!header) return;

        function updateHeaderClass() {
            if (window.scrollY > 10) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        }

        window.addEventListener('scroll', updateHeaderClass, { passive: true });
        updateHeaderClass();
    });
    </script>
<?php endif; ?>

<!-- React Root Container - Mounted automatically by app-bundle.js -->
<div id="root">
