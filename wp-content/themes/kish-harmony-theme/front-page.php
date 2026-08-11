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

// Determine if Category cards overlap the Hero banner (default state)
$categories_active = false;
foreach ($sections as $sec) {
    if ($sec['id'] === 'categories' && !empty($sec['active'])) {
        $categories_active = true;
        break;
    }
}
$hero_margin_class = $categories_active ? 'mb-44 sm:mb-52 md:mb-60' : 'mb-8';

// Function mapping to render sections dynamically
if (!function_exists('kh_render_hero_section')) {
    function kh_render_hero_section($settings, $hero_margin_class) {
        ?>
        <!-- 1. Hero Section -->
        <section class="hero bg-[#0B63D8] w-full pt-6 relative overflow-visible shadow-xl <?php echo esc_attr($hero_margin_class); ?>">
            <!-- Top Right Language Switcher Badge -->
            <div class="absolute top-4 right-4 sm:right-8 z-20 flex items-center gap-2">
                <span class="text-white text-xs font-bold bg-white/20 backdrop-blur-md px-3.5 py-1.5 rounded-full border border-white/30 flex items-center gap-2 shadow-sm cursor-pointer">
                    <i class="fa-solid fa-globe text-amber-300"></i>
                    <span>فارسی | IRAN</span>
                    <i class="fa-solid fa-chevron-down text-[10px] text-white/80"></i>
                </span>
            </div>

            <!-- Main Banner Content -->
            <div class="banner min-h-[140px] sm:min-h-[160px] md:min-h-[190px] flex flex-col items-center justify-center relative px-6 text-center text-white mt-6 sm:mt-8 md:mt-10 mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center text-[#18D6D8] text-2xl sm:text-3xl border border-white/20 shadow-inner">
                        <i class="fa-solid fa-umbrella-beach"></i>
                    </div>
                    <h1 class="text-2xl sm:text-4xl md:text-5xl font-black tracking-tight drop-shadow-md">سامانه آنلاین رزرو کیش هارمونی</h1>
                </div>
                <p class="text-xs sm:text-sm md:text-base text-blue-100 font-medium mt-3 max-w-2xl leading-relaxed">
                    رزرو مستقیم تفریحات آبی، اجاره ماشین‌های سوپراسپرت و اقامتگاه‌های لوکس با تخفیف روزانه و پشتیبانی ۲۴ ساعته در کیش
                </p>
            </div>

            <!-- Bottom Curve SVG -->
            <div class="hero-bottom-curve absolute -bottom-1 left-0 w-full overflow-hidden leading-none z-0">
                <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-10 sm:h-16 text-slate-50 fill-current">
                    <path d="M0,0 C150,90 350,-40 500,50 C650,140 900,-20 1200,40 L1200,120 L0,120 Z"></path>
                </svg>
            </div>
        </section>
        <?php
    }
}

if (!function_exists('kh_render_categories_section')) {
    function kh_render_categories_section() {
        ?>
        <!-- 8 Overlapping Floating Category Cards Grid -->
        <div class="max-w-6xl mx-auto px-4 absolute -bottom-36 sm:-bottom-44 md:-bottom-52 left-0 right-0 z-20 kh_categories_block">
            <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 p-3 sm:p-6 grid grid-cols-4 sm:grid-cols-8 gap-2 sm:gap-4 text-center">
                <!-- Item 1: Train -->
                <a href="#train" class="category-card group flex flex-col items-center justify-center p-3 sm:p-4 rounded-2xl bg-white hover:bg-blue-50 transition-all border border-slate-100 hover:border-blue-200 shadow-sm hover:shadow-md">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 text-[#0B63D8] flex items-center justify-center text-xl sm:text-2xl mb-2 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-train"></i>
                    </div>
                    <span class="text-xs sm:text-sm font-extrabold text-slate-800">قطار</span>
                </a>
                <!-- Item 2: Flight -->
                <a href="#flight" class="category-card group flex flex-col items-center justify-center p-3 sm:p-4 rounded-2xl bg-white hover:bg-blue-50 transition-all border border-slate-100 hover:border-blue-200 shadow-sm hover:shadow-md">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 text-[#0B63D8] flex items-center justify-center text-xl sm:text-2xl mb-2 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-plane-departure"></i>
                    </div>
                    <span class="text-xs sm:text-sm font-extrabold text-slate-800">پرواز</span>
                </a>

                <!-- Item 3: Hotel -->
                <a href="#hotel" class="category-card group flex flex-col items-center justify-center p-3 sm:p-4 rounded-2xl bg-white hover:bg-blue-50 transition-all border border-slate-100 hover:border-blue-200 shadow-sm hover:shadow-md">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 text-[#0B63D8] flex items-center justify-center text-xl sm:text-2xl mb-2 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-hotel"></i>
                    </div>
                    <span class="text-xs sm:text-sm font-extrabold text-slate-800">هتل</span>
                </a>

                <!-- Item 4: Bus -->
                <a href="#bus" class="category-card group flex flex-col items-center justify-center p-3 sm:p-4 rounded-2xl bg-white hover:bg-blue-50 transition-all border border-slate-100 hover:border-blue-200 shadow-sm hover:shadow-md">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 text-[#0B63D8] flex items-center justify-center text-xl sm:text-2xl mb-2 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-bus"></i>
                    </div>
                    <span class="text-xs sm:text-sm font-extrabold text-slate-800">اتوبوس</span>
                </a>

                <!-- Item 5: Special Offer (Star) -->
                <a href="#special-offers" class="category-card group flex flex-col items-center justify-center p-3 sm:p-4 rounded-2xl bg-amber-50/90 hover:bg-amber-100 transition-all border border-amber-200 shadow-sm hover:shadow-md relative">
                    <span class="absolute -top-2 bg-[#FF8A00] text-white text-[9px] font-black px-2 py-0.5 rounded-full shadow-md animate-bounce">جدید</span>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-amber-100 text-[#FF8A00] flex items-center justify-center text-xl sm:text-2xl mb-2 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <span class="text-xs sm:text-sm font-extrabold text-[#FF8A00]">ویژه</span>
                </a>

                <!-- Item 6: Villa -->
                <a href="#villa" class="category-card group flex flex-col items-center justify-center p-3 sm:p-4 rounded-2xl bg-white hover:bg-blue-50 transition-all border border-slate-100 hover:border-blue-200 shadow-sm hover:shadow-md">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 text-[#0B63D8] flex items-center justify-center text-xl sm:text-2xl mb-2 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-house-chimney"></i>
                    </div>
                    <span class="text-xs sm:text-sm font-extrabold text-slate-800">ویلا</span>
                </a>

                <!-- Item 7: Tour -->
                <a href="#tour" class="category-card group flex flex-col items-center justify-center p-3 sm:p-4 rounded-2xl bg-white hover:bg-blue-50 transition-all border border-slate-100 hover:border-blue-200 shadow-sm hover:shadow-md">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 text-[#0B63D8] flex items-center justify-center text-xl sm:text-2xl mb-2 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-suitcase-rolling"></i>
                    </div>
                    <span class="text-xs sm:text-sm font-extrabold text-slate-800">تور</span>
                </a>

                <!-- Item 8: New Version -->
                <a href="#new" class="category-card group flex flex-col items-center justify-center p-3 sm:p-4 rounded-2xl bg-cyan-50/60 hover:bg-cyan-100 transition-all border border-cyan-200 shadow-sm hover:shadow-md">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-cyan-100 text-[#18D6D8] flex items-center justify-center text-xl sm:text-2xl mb-2 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </div>
                    <span class="text-xs sm:text-sm font-extrabold text-[#0B63D8]">نسخه جدید</span>
                </a>
            </div>
        </div>
        <?php
    }
}

if (!function_exists('kh_render_search_section')) {
    function kh_render_search_section() {
        ?>
        <!-- 2. Search & Filter Bar with Popular Tags -->
        <section class="search-filter-section bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-sm">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-xl sm:text-2xl font-black text-[#071E3D] flex items-center gap-2">
                        <i class="fa-solid fa-magnifying-glass text-[#0B63D8]"></i>
                        <span>جستجوی سریع تفریحات هیجان‌انگیز کیش</span>
                    </h2>
                    <p class="text-xs text-slate-500 mt-1">جستجو در بین ده‌ها کلوپ، خودرو و گشت دریایی</p>
                </div>
                <button class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-xl text-xs font-bold transition-colors flex items-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-sliders text-[#0B63D8]"></i>
                    <span>جستجوی پیشرفته</span>
                    <i class="fa-solid fa-arrow-left text-[10px]"></i>
                </button>
            </div>

            <!-- Search Input -->
            <div class="relative mb-6">
                <input id="main-search-input" type="text" placeholder="جستجو (مثلاً پاراسل، غواصی، جت‌اسکی، رنت موستانگ...)" class="w-full bg-slate-50 border border-slate-200 focus:border-[#0B63D8] focus:bg-white rounded-2xl py-3.5 pr-12 pl-28 text-sm text-slate-800 placeholder-slate-400 outline-none transition-all shadow-inner">
                <i class="fa-solid fa-search absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
                <button id="main-search-btn" class="absolute left-2 top-1/2 -translate-y-1/2 bg-[#0B63D8] hover:bg-[#084bb3] text-white px-5 py-2 rounded-xl text-xs font-bold transition-all shadow-md">
                    جستجو
                </button>
            </div>

            <!-- Popular Hashtags -->
            <div class="flex flex-wrap items-center gap-2 text-xs">
                <span class="font-bold text-slate-500 flex items-center gap-1"><i class="fa-solid fa-fire text-[#FF8A00]"></i> محبوب‌ترین‌ها:</span>
                <a href="#water-sports" class="bg-slate-100 hover:bg-blue-50 hover:text-[#0B63D8] text-slate-600 px-3 py-1.5 rounded-xl font-bold transition-colors"># پاراسل</a>
                <a href="#water-sports" class="bg-slate-100 hover:bg-blue-50 hover:text-[#0B63D8] text-slate-600 px-3 py-1.5 rounded-xl font-bold transition-colors"># غواصی</a>
                <a href="#water-sports" class="bg-slate-100 hover:bg-blue-50 hover:text-[#0B63D8] text-slate-600 px-3 py-1.5 rounded-xl font-bold transition-colors"># جت اسکی</a>
                <a href="#water-sports" class="bg-slate-100 hover:bg-blue-50 hover:text-[#0B63D8] text-slate-600 px-3 py-1.5 rounded-xl font-bold transition-colors"># یات لاکچری</a>
                <a href="#water-sports" class="bg-slate-100 hover:bg-blue-50 hover:text-[#0B63D8] text-slate-600 px-3 py-1.5 rounded-xl font-bold transition-colors"># فلای بورد</a>
                <a href="#water-sports" class="bg-slate-100 hover:bg-blue-50 hover:text-[#0B63D8] text-slate-600 px-3 py-1.5 rounded-xl font-bold transition-colors"># شاتل</a>
            </div>
        </section>
        <?php
    }
}

if (!function_exists('kh_render_sea_category_section')) {
    function kh_render_sea_category_section() {
        ?>
        <!-- 3. Sea Categories Color Banner Bar -->
        <section class="sea-category-bar space-y-4">
            <div class="flex items-center gap-3">
                <span class="text-3xl">🌊</span>
                <div>
                    <h2 class="text-2xl font-black text-[#071E3D]">دسته‌بندی تفریحات دریایی و ساحلی</h2>
                    <p class="text-xs text-slate-500">بهترین تجربه کلوپ‌های دریایی، تفریحات هوایی و سفرهای ساحلی کیش با تضمین قیمت</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Sea Card 1 -->
                <div class="bg-teal-500 text-white p-5 rounded-2xl shadow-md relative overflow-hidden flex flex-col justify-between h-36 group cursor-pointer hover:scale-[1.02] transition-transform">
                    <i class="fa-solid fa-ship text-5xl absolute -left-2 -bottom-2 text-white/20 group-hover:scale-110 transition-transform"></i>
                    <span class="text-xs bg-white/20 backdrop-blur-md px-2.5 py-1 rounded-full font-bold w-fit">گشت‌های VIP</span>
                    <div>
                        <h3 class="text-lg font-black mb-1">تور دریایی</h3>
                        <span class="text-xs font-semibold text-teal-100">از ۴۵۰,۰۰۰ تومان</span>
                    </div>
                </div>

                <!-- Sea Card 2 -->
                <div class="bg-amber-500 text-white p-5 rounded-2xl shadow-md relative overflow-hidden flex flex-col justify-between h-36 group cursor-pointer hover:scale-[1.02] transition-transform">
                    <i class="fa-solid fa-parachute-box text-5xl absolute -left-2 -bottom-2 text-white/20 group-hover:scale-110 transition-transform"></i>
                    <span class="text-xs bg-white/20 backdrop-blur-md px-2.5 py-1 rounded-full font-bold w-fit text-amber-100">داغ 🔥</span>
                    <div>
                        <h3 class="text-lg font-black mb-1">پاراسل</h3>
                        <span class="text-xs font-semibold text-amber-100">از ۶۵۰,۰۰۰ تومان</span>
                    </div>
                </div>

                <!-- Sea Card 3 -->
                <div class="bg-blue-600 text-white p-5 rounded-2xl shadow-md relative overflow-hidden flex flex-col justify-between h-36 group cursor-pointer hover:scale-[1.02] transition-transform">
                    <i class="fa-solid fa-water text-5xl absolute -left-2 -bottom-2 text-white/20 group-hover:scale-110 transition-transform"></i>
                    <span class="text-xs bg-white/20 backdrop-blur-md px-2.5 py-1 rounded-full font-bold w-fit">کلوپ‌های ۵ ستاره</span>
                    <div>
                        <h3 class="text-lg font-black mb-1">غواصی</h3>
                        <span class="text-xs font-semibold text-blue-100">از ۷۸۰,۰۰۰ تومان</span>
                    </div>
                </div>

                <!-- Sea Card 4 -->
                <div class="bg-orange-600 text-white p-5 rounded-2xl shadow-md relative overflow-hidden flex flex-col justify-between h-36 group cursor-pointer hover:scale-[1.02] transition-transform">
                    <i class="fa-solid fa-plane text-5xl absolute -left-2 -bottom-2 text-white/20 group-hover:scale-110 transition-transform"></i>
                    <span class="text-xs bg-white/20 backdrop-blur-md px-2.5 py-1 rounded-full font-bold w-fit">هیجان مطلق</span>
                    <div>
                        <h3 class="text-lg font-black mb-1">تفریحات هوایی</h3>
                        <span class="text-xs font-semibold text-orange-100">از ۸۹۰,۰۰۰ تومان</span>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}

if (!function_exists('kh_render_special_offers_section')) {
    function kh_render_special_offers_section() {
        ?>
        <!-- 4. Special Offers Section -->
        <section id="special-offers" class="bg-gradient-to-br from-amber-500/10 via-orange-500/5 to-transparent p-6 sm:p-8 rounded-3xl border border-amber-500/20 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-fire text-3xl text-[#FF8A00]"></i>
                    <div>
                        <h2 class="text-2xl font-black text-[#071E3D]">پیشنهادهای ویژه و بلیط‌های لحظه آخری کیش</h2>
                        <p class="text-xs text-slate-500">تخفیف‌های محدود تفریحات آبی و رنت خودرو</p>
                    </div>
                </div>
                <span class="bg-[#FF8A00] text-white text-xs font-black px-3 py-1.5 rounded-full shadow-sm hidden sm:inline-block">انقضا تا پایان امروز</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Offer Card 1 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100 flex flex-col group hover:shadow-xl transition-all">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80" alt="پکیج طلایی غواصی" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 right-3 bg-[#FF8A00] text-white text-xs font-black px-3 py-1 rounded-full shadow-md">۴۰٪ تخفیف</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                        <div>
                            <h3 class="font-black text-slate-900 text-base mb-2">پکیج طلایی غواصی وی‌آی‌پی کیش</h3>
                            <p class="text-xs text-slate-500 leading-relaxed">شامل عکاسی و فیلم‌برداری زیر آب، مربی اختصاصی و تجهیزات کامل برند Mares</p>
                        </div>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-xs text-slate-400 line-through block">۱,۵۰۰,۰۰۰</span>
                                <span class="text-base font-black text-[#0B63D8]">۹۰۰,۰۰۰ <span class="text-xs font-normal">تومان</span></span>
                            </div>
                            <button class="btn-reserve bg-[#0B63D8] hover:bg-[#084bb3] text-white px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer shadow-md">
                                <i class="fa-solid fa-ticket"></i>
                                <span>رزرو فوری</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Offer Card 2 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100 flex flex-col group hover:shadow-xl transition-all">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1580273916550-e323be2ae537?auto=format&fit=crop&w=800&q=80" alt="فورد موستانگ کروک" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 right-3 bg-red-600 text-white text-xs font-black px-3 py-1 rounded-full shadow-md">پیشنهاد داغ</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                        <div>
                            <h3 class="font-black text-slate-900 text-base mb-2">رنت فورد موستانگ کروک ۲۰۲۳</h3>
                            <p class="text-xs text-slate-500 leading-relaxed">تحویل رایگان در فرودگاه کیش، بیمه بدنه کامل و بدون نیاز به چک و ودیعه سنگین</p>
                        </div>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-xs text-slate-400 line-through block">۴,۵۰۰,۰۰۰</span>
                                <span class="text-base font-black text-[#0B63D8]">۳,۸۰۰,۰۰۰ <span class="text-xs font-normal">تومان/روز</span></span>
                            </div>
                            <button class="btn-reserve bg-[#0B63D8] hover:bg-[#084bb3] text-white px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer shadow-md">
                                <i class="fa-solid fa-car"></i>
                                <span>اجاره ماشین</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Offer Card 3 -->
                <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100 flex flex-col group hover:shadow-xl transition-all">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1569263979104-865ab7cd8d13?auto=format&fit=crop&w=800&q=80" alt="پاراسل دو نفره" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 right-3 bg-emerald-600 text-white text-xs font-black px-3 py-1 rounded-full shadow-md">پرفروش‌ترین</span>
                    </div>
                    <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                        <div>
                            <h3 class="font-black text-slate-900 text-base mb-2">پرواز پاراسل بالای خلیج فارس</h3>
                            <p class="text-xs text-slate-500 leading-relaxed">ارتفاع ۱۵۰ متری با چشم‌انداز کل جزیره کیش، قایق تندرو مدرن و ایمنی ۱۰۰٪</p>
                        </div>
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-xs text-slate-400 line-through block">۹۵۰,۰۰۰</span>
                                <span class="text-base font-black text-[#0B63D8]">۶۵۰,۰۰۰ <span class="text-xs font-normal">تومان</span></span>
                            </div>
                            <button class="btn-reserve bg-[#0B63D8] hover:bg-[#084bb3] text-white px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer shadow-md">
                                <i class="fa-solid fa-ticket"></i>
                                <span>رزرو فوری</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}

if (!function_exists('kh_render_weather_section')) {
    function kh_render_weather_section() {
        ?>
        <!-- 5. Weather Widget Section -->
        <section class="weather-widget relative rounded-3xl p-6 sm:p-8 border border-white/40 shadow-lg bg-gradient-to-br from-sky-100/60 via-teal-50/40 to-[#18D6D8]/20 backdrop-blur-md">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-2xl font-black text-[#071E3D] flex items-center gap-2">
                        <span>آب و هوای</span>
                        <span class="text-[#FF8A00]">لحظه‌ای</span>
                        <span>کیش</span>
                    </h2>
                    <p class="text-xs text-slate-600 mt-1 font-medium">وضعیت پایداری امروز جزیره زیبای کیش برای تفریحات آبی</p>
                </div>
                <div class="flex items-center gap-2 text-xs font-bold text-[#0B63D8] bg-white/80 px-3 py-1.5 rounded-full shadow-sm w-fit">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>کیش، استان هرمزگان</span>
                </div>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3 sm:gap-4 text-center">
                <div class="bg-white/60 backdrop-blur-md p-4 rounded-2xl border border-white/60 shadow-sm">
                    <i class="fa-solid fa-sun-cloud text-2xl text-amber-500 mb-1"></i>
                    <span class="text-[11px] text-slate-500 block">دما</span>
                    <span class="text-base font-black text-slate-900">۲۸°C</span>
                </div>
                <div class="bg-white/60 backdrop-blur-md p-4 rounded-2xl border border-white/60 shadow-sm">
                    <i class="fa-solid fa-water text-2xl text-sky-500 mb-1"></i>
                    <span class="text-[11px] text-slate-500 block">وضعیت دریا</span>
                    <span class="text-base font-black text-slate-900">آرام و ملایم</span>
                </div>
                <div class="bg-white/60 backdrop-blur-md p-4 rounded-2xl border border-white/60 shadow-sm">
                    <i class="fa-solid fa-droplet text-2xl text-blue-500 mb-1"></i>
                    <span class="text-[11px] text-slate-500 block">رطوبت</span>
                    <span class="text-base font-black text-slate-900">۶۲٪</span>
                </div>
                <div class="bg-white/60 backdrop-blur-md p-4 rounded-2xl border border-white/60 shadow-sm">
                    <i class="fa-solid fa-wind text-2xl text-teal-500 mb-1"></i>
                    <span class="text-[11px] text-slate-500 block">سرعت باد</span>
                    <span class="text-base font-black text-slate-900">۱۲ km/h</span>
                </div>
                <div class="bg-white/60 backdrop-blur-md p-4 rounded-2xl border border-white/60 shadow-sm col-span-2 sm:col-span-1">
                    <i class="fa-solid fa-sun text-2xl text-orange-500 mb-1"></i>
                    <span class="text-[11px] text-slate-500 block">شاخص UV</span>
                    <span class="text-base font-black text-slate-900">متوسط (۴)</span>
                </div>
            </div>
        </section>
        <?php
    }
}

if (!function_exists('kh_render_custom_block_1')) {
    function kh_render_custom_block_1($settings) {
        if (!empty($settings['custom_html_1_code'])) {
            echo '<div class="khd-custom-block-1">' . $settings['custom_html_1_code'] . '</div>';
        }
    }
}

if (!function_exists('kh_render_custom_block_2')) {
    function kh_render_custom_block_2($settings) {
        if (!empty($settings['custom_html_2_code'])) {
            echo '<div class="khd-custom-block-2">' . $settings['custom_html_2_code'] . '</div>';
        }
    }
}

// ---------------------------------------------------------------------------------
// 1. Loop and Render the Hero Banner (Only if active and is not nested or is active)
// ---------------------------------------------------------------------------------
$hero_rendered_separately = false;
foreach ($sections as $section) {
    if ($section['id'] === 'hero' && !empty($section['active'])) {
        kh_render_hero_section($settings, $hero_margin_class);
        $hero_rendered_separately = true;
        break;
    }
}

// Render categories separately or nested
$categories_rendered_inside_hero = false;
if ($hero_rendered_separately && $categories_active) {
    // Render the categories overlapping absolute block
    kh_render_categories_section();
    $categories_rendered_inside_hero = true;
}
?>

<!-- Main Container -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16 py-8">

    <?php
    // 2. Loop and render all remaining active blocks in configured sorting order
    foreach ($sections as $section) {
        if (empty($section['active'])) {
            continue;
        }

        switch ($section['id']) {
            case 'hero':
                if (!$hero_rendered_separately) {
                    kh_render_hero_section($settings, 'mb-8');
                }
                break;
            case 'categories':
                if (!$categories_rendered_inside_hero) {
                    // Render simple container category block without negative overlap
                    echo '<div class="relative py-4">';
                    kh_render_categories_section();
                    echo '</div>';
                }
                break;
            case 'search':
                kh_render_search_section();
                break;
            case 'sea_category':
                kh_render_sea_category_section();
                break;
            case 'special_offers':
                kh_render_special_offers_section();
                break;
            case 'weather':
                kh_render_weather_section();
                break;
            case 'custom_html_1':
                kh_render_custom_block_1($settings);
                break;
            case 'custom_html_2':
                kh_render_custom_block_2($settings);
                break;
        }
    }
    ?>

</main>

<?php get_footer(); ?>
