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

$hero_bg_color = !empty($hero_banner['bg_color']) ? $hero_banner['bg_color'] : '#0B63D8';
?>

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
                            <i class="fa-solid <?php echo esc_attr($item['icon_val'] ?? 'fa-circle-question'); ?> category-emoji" style="color:#0B63D8;"></i>
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
    <main class="khd-main-container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8 py-8">
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
                        <div class="search-header-row flex flex-col md:flex-row items-start md:items-center justify-between gap-3 mb-5">
                            <div>
                                <h2 class="search-title text-xl sm:text-2xl font-black text-[#071E3D] flex items-center gap-2">
                                    <i class="fa-solid fa-magnifying-glass search-title-icon text-[#0B63D8]"></i>
                                    <span>جستجوی سریع تفریحات هیجان‌انگیز کیش</span>
                                </h2>
                                <p class="search-subtitle text-xs text-slate-500 mt-1">جستجو در بین ده‌ها کلوپ، خودرو و گشت دریایی</p>
                            </div>
                        </div>

                        <div class="search-input-wrapper relative w-full">
                            <i class="fa-solid fa-search search-input-icon absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                            <input id="main-search-input" type="text" placeholder="جستجو (مثلاً پاراسل، غواصی، جت‌اسکی، رنت موستانگ...)" class="search-input-field w-full bg-slate-50 border border-slate-200 focus:border-[#0B63D8] focus:bg-white rounded-2xl py-3.5 pr-12 pl-28 text-sm text-slate-800 placeholder-slate-400 outline-none transition-all shadow-inner">
                            <button id="main-search-btn" class="search-submit-btn absolute left-2 top-1/2 -translate-y-1/2 bg-[#0B63D8] hover:bg-[#084bb3] text-white px-5 py-2.5 rounded-xl text-xs font-bold transition-all shadow-md">
                                <span>جستجو</span>
                            </button>
                        </div>
                    </section>
                    <?php
                    break;
                case 'sea_category':
                    ?>
                    <section class="sea-category-bar bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-sm">
                        <div class="sea-category-content flex items-center gap-4">
                            <span class="sea-emoji text-3xl">🌊</span>
                            <div>
                                <h2 class="sea-title text-xl sm:text-2xl font-black text-[#071E3D]">دسته‌بندی تفریحات دریایی و ساحلی</h2>
                                <p class="sea-subtitle text-xs text-slate-500 mt-1">بهترین تجربه کلوپ‌های دریایی، تفریحات هوایی و سفرهای ساحلی کیش با تضمین قیمت</p>
                            </div>
                        </div>
                    </section>
                    <?php
                    break;
                case 'special_offers':
                    ?>
                    <section id="special-offers" class="special-offers-section bg-gradient-to-br from-amber-500/10 via-orange-500/5 to-transparent p-6 sm:p-8 rounded-3xl border border-amber-500/20 shadow-sm">
                        <div class="special-offers-content flex items-center gap-4">
                            <i class="fa-solid fa-fire special-icon text-3xl text-[#FF8A00]"></i>
                            <div>
                                <h2 class="special-title text-xl sm:text-2xl font-black text-[#071E3D]">پیشنهادهای ویژه و بلیط‌های لحظه آخری کیش</h2>
                                <p class="special-subtitle text-xs text-slate-500 mt-1">تخفیف‌های محدود تفریحات آبی و رنت خودرو</p>
                            </div>
                        </div>
                    </section>
                    <?php
                    break;
                case 'custom_html_1':
                    if (!empty($settings['custom_html_1_code'])) {
                        echo '<div class="khd-custom-block-1 mb-8">' . $settings['custom_html_1_code'] . '</div>';
                    }
                    break;
                case 'custom_html_2':
                    if (!empty($settings['custom_html_2_code'])) {
                        echo '<div class="khd-custom-block-2 mb-8">' . $settings['custom_html_2_code'] . '</div>';
                    }
                    break;
            }
        }
        ?>
    </main>
</div>

<!-- Floating Logo Physics Scroll Easing Script -->
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
