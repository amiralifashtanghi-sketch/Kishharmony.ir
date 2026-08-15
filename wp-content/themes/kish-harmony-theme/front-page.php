<?php get_header();

// Fetch settings from the designer plugin helper if it exists
$has_designer = class_exists('\KishHarmonyDesigner\Helpers');
$settings = $has_designer ? \KishHarmonyDesigner\Helpers::get_settings() : array();

$sections = isset($settings['sections']) ? $settings['sections'] : array(
    array('id' => 'hero', 'active' => true),
    array('id' => 'categories', 'active' => true),
    array('id' => 'search', 'active' => true),
    array('id' => 'sea_category', 'active' => true),
    array('id' => 'special_offers', 'active' => true),
    array('id' => 'weather', 'active' => true),
);

$hero_banner         = $settings['hero_banner'] ?? array();
$categories_settings = $settings['categories_settings'] ?? array();
$category_items      = $settings['category_items'] ?? array();

$categories_active = false;
foreach ($sections as $sec) {
    if ($sec['id'] === 'categories' && !empty($sec['active'])) {
        $categories_active = true;
        break;
    }
}

$hero_bg_color = !empty($hero_banner['bg_color']) ? $hero_banner['bg_color'] : '#1a56db';
?>

<style>
    /* Exact Hero & Categories CSS Spec from User */
    .hero {
        width: 100%;
        background-color: <?php echo esc_attr($hero_bg_color); ?>;
        padding-top: 70px;
        position: relative;
        height: 542px;
        overflow: visible;
    }

    .banner {
        height: 360px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        padding: 0 1.5rem;
    }

    .categories-wrapper {
        max-width: 820px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        border: 1px solid #e5e7eb;
        border-radius: 28px;
        overflow: hidden;
        background-color: #ffffff;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.06);
    }

    .category-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.9rem 1.2rem;
        background-color: #ffffff;
        border-right: 1px solid #e5e7eb;
        border-bottom: 1px solid #e5e7eb;
        min-height: 56px;
        transition: background-color 0.2s ease;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
    }

    .category-item:nth-child(2n) {
        border-right: none;
    }

    .category-item:nth-last-child(-n+2) {
        border-bottom: none;
    }

    .category-item:hover {
        background-color: #f8fafc;
    }

    .category-emoji {
        font-size: 1.3rem;
        width: 1.8rem;
        text-align: center;
        flex-shrink: 0;
    }

    .category-text {
        font-size: 0.95rem;
        font-weight: 500;
        color: #1e293b;
    }

    .badge {
        font-size: 0.55rem;
        background: #fcd34d;
        color: #1e293b;
        padding: 0.1rem 0.6rem;
        border-radius: 20px;
        font-weight: 700;
        margin-right: auto;
    }

    .category-item.special .category-text {
        color: #1a56db;
    }

    .below-hero {
        background: #ffffff;
        min-height: 500px;
        padding-top: 40px;
    }

    @media screen and (max-width: 768px) {
        .banner {
            height: 260px;
        }
        .categories-grid {
            border-radius: 20px;
        }
        .category-item {
            padding: 0.6rem 0.8rem;
        }
        .category-emoji {
            font-size: 1.1rem;
        }
        .category-text {
            font-size: 0.8rem;
        }
        .hero {
            height: calc(62px + 260px + 112px);
            padding-top: 62px;
        }
    }

    @media screen and (max-width: 480px) {
        .banner {
            height: 200px;
        }
        .categories-grid {
            border-radius: 16px;
        }
        .category-item {
            padding: 0.5rem 0.6rem;
        }
        .category-emoji {
            font-size: 0.95rem;
        }
        .category-text {
            font-size: 0.72rem;
        }
        .hero {
            height: calc(62px + 200px + 112px);
            padding-top: 62px;
        }
    }
</style>

<!-- HERO CONTAINER AND CATEGORIES OVERLAY -->
<div class="hero" id="hero">
    <div class="banner" id="banner"></div>

    <?php if ($categories_active) : ?>
        <div class="categories-wrapper">
            <div class="categories-grid">
                <?php foreach ($category_items as $index => $item) :
                    $href = ($item['behavior'] ?? 'redirect') === 'popup' ? 'javascript:void(0)' : esc_url($item['target_url'] ?? '#');
                    $click_class = ($item['behavior'] ?? 'redirect') === 'popup' ? 'khd-trigger-popup-btn' : '';
                    $is_special = (isset($item['id']) && ($item['id'] === 'special' || $item['id'] === 'new' || strpos($item['id'], 'special') !== false));
                    $special_class = $is_special ? 'special' : '';
                    ?>
                    <a href="<?php echo $href; ?>" class="category-item <?php echo esc_attr($click_class); ?> <?php echo esc_attr($special_class); ?>" data-id="<?php echo esc_attr($item['id']); ?>" data-label="<?php echo esc_attr($item['label']); ?>">
                        <?php if (($item['type'] ?? 'icon') === 'icon') : ?>
                            <i class="fa-solid <?php echo esc_attr($item['icon_val'] ?? 'fa-circle-question'); ?> category-emoji" style="color:#1a56db;"></i>
                        <?php elseif ($item['type'] === 'image') : ?>
                            <img src="<?php echo esc_url($item['image_url']); ?>" class="category-emoji" style="max-height: 1.3rem; object-fit: contain;">
                        <?php else : ?>
                            <span class="category-emoji"><?php echo esc_html($item['emoji_val'] ?? '🌊'); ?></span>
                        <?php endif; ?>

                        <span class="category-text"><?php echo esc_html($item['label']); ?></span>

                        <?php if ($item['id'] === 'special' || (isset($item['badge_text']) && !empty($item['badge_text']))) : ?>
                            <span class="badge"><?php echo esc_html(!empty($item['badge_text']) ? $item['badge_text'] : 'جدید'); ?></span>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<div class="below-hero">
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 py-8">
        <?php
        // Loop and render all remaining active blocks from designer plugin
        foreach ($sections as $section) {
            if (empty($section['active']) || $section['id'] === 'hero' || $section['id'] === 'categories') {
                continue;
            }

            switch ($section['id']) {
                case 'search':
                    ?>
                    <!-- Search & Filter Bar -->
                    <section class="search-filter-section bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-sm">
                        <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-6">
                            <div>
                                <h2 class="text-xl sm:text-2xl font-black text-[#071E3D] flex items-center gap-2">
                                    <i class="fa-solid fa-magnifying-glass text-[#0B63D8]"></i>
                                    <span>جستجوی سریع تفریحات هیجان‌انگیز کیش</span>
                                </h2>
                                <p class="text-xs text-slate-500 mt-1">جستجو در بین ده‌ها کلوپ، خودرو و گشت دریایی</p>
                            </div>
                        </div>

                        <div class="relative mb-6">
                            <input id="main-search-input" type="text" placeholder="جستجو (مثلاً پاراسل، غواصی، جت‌اسکی، رنت موستانگ...)" class="w-full bg-slate-50 border border-slate-200 focus:border-[#0B63D8] focus:bg-white rounded-2xl py-3.5 pr-12 pl-28 text-sm text-slate-800 placeholder-slate-400 outline-none transition-all shadow-inner">
                            <i class="fa-solid fa-search absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                            <button id="main-search-btn" class="absolute left-2 top-1/2 -translate-y-1/2 bg-[#0B63D8] hover:bg-[#084bb3] text-white px-5 py-2 rounded-xl text-xs font-bold transition-all shadow-md">
                                جستجو
                            </button>
                        </div>
                    </section>
                    <?php
                    break;
                case 'sea_category':
                    ?>
                    <section class="sea-category-bar space-y-4">
                        <div class="flex items-center gap-3">
                            <span class="text-3xl">🌊</span>
                            <div>
                                <h2 class="text-2xl font-black text-[#071E3D]">دسته‌بندی تفریحات دریایی و ساحلی</h2>
                                <p class="text-xs text-slate-500">بهترین تجربه کلوپ‌های دریایی، تفریحات هوایی و سفرهای ساحلی کیش با تضمین قیمت</p>
                            </div>
                        </div>
                    </section>
                    <?php
                    break;
                case 'special_offers':
                    ?>
                    <section id="special-offers" class="bg-gradient-to-br from-amber-500/10 via-orange-500/5 to-transparent p-6 sm:p-8 rounded-3xl border border-amber-500/20 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-fire text-3xl text-[#FF8A00]"></i>
                                <div>
                                    <h2 class="text-2xl font-black text-[#071E3D]">پیشنهادهای ویژه و بلیط‌های لحظه آخری کیش</h2>
                                    <p class="text-xs text-slate-500">تخفیف‌های محدود تفریحات آبی و رنت خودرو</p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php
                    break;
                case 'custom_html_1':
                    if (!empty($settings['custom_html_1_code'])) {
                        echo '<div class="khd-custom-block-1">' . $settings['custom_html_1_code'] . '</div>';
                    }
                    break;
                case 'custom_html_2':
                    if (!empty($settings['custom_html_2_code'])) {
                        echo '<div class="khd-custom-block-2">' . $settings['custom_html_2_code'] . '</div>';
                    }
                    break;
            }
        }
        ?>
    </main>
</div>

<!-- User's Exact JS for Floating Logo Smooth Easing Scroll Transitions -->
<script>
    (function() {
        const header = document.getElementById('header');
        const floatingLogo = document.getElementById('floatingLogo');
        const banner = document.getElementById('banner');
        if (!header || !floatingLogo || !banner) return;

        const logoIcon = floatingLogo.querySelector('.logo-icon');
        const logoText = floatingLogo.querySelector('.logo-text');

        const SMALL_ICON_SIZE = 36;
        const SMALL_TEXT_SIZE_REM = 1.3;
        const LARGE_ICON_SIZE = 56;
        const LARGE_TEXT_SIZE_REM = 2.2;

        let bannerCenterY, headerCenterY;
        let ticking = false;

        function easeInOutCubic(t) {
            return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
        }

        function updatePositions() {
            const bannerRect = banner.getBoundingClientRect();
            bannerCenterY = bannerRect.top + bannerRect.height / 2;

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
            headerCenterY = scrolledTop + scrolledHeight / 2;

            if (window.scrollY <= 10) {
                floatingLogo.style.top = bannerCenterY + 'px';
            }
        }

        function getScrollProgress() {
            const maxScroll = 200;
            const raw = Math.min(window.scrollY / maxScroll, 1.0);
            return easeInOutCubic(raw);
        }

        function updateLogo(progress) {
            const currentY = bannerCenterY + (headerCenterY - bannerCenterY) * progress;
            floatingLogo.style.top = currentY + 'px';

            if (logoIcon) {
                const iconSize = LARGE_ICON_SIZE + (SMALL_ICON_SIZE - LARGE_ICON_SIZE) * progress;
                logoIcon.style.width = iconSize + 'px';
                logoIcon.style.height = iconSize + 'px';
                logoIcon.style.fontSize = (iconSize * 0.55) + 'px';
                const borderRadius = 18 + (12 - 18) * progress;
                logoIcon.style.borderRadius = borderRadius + 'px';
            }

            if (logoText) {
                const textSizeRem = LARGE_TEXT_SIZE_REM + (SMALL_TEXT_SIZE_REM - LARGE_TEXT_SIZE_REM) * progress;
                logoText.style.fontSize = textSizeRem + 'rem';
            }

            floatingLogo.style.color = progress > 0.8 ? '#1e1e2f' : 'white';
        }

        function onScroll() {
            if (window.scrollY > 10) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }

            if (!ticking) {
                requestAnimationFrame(() => {
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

        updatePositions();
        updateLogo(0);
        window.addEventListener('load', () => {
            updatePositions();
            updateLogo(getScrollProgress());
        });
    })();
</script>

<?php get_footer(); ?>
