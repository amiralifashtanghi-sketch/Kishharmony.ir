<?php
/**
 * Module 8: Travel Guide Banner
 */

$title     = kishharmony_get_option('guide_title', 'راهنمای سفر و برنامه‌ریزی برای جزیره کیش کامل');
$desc      = kishharmony_get_option('guide_desc', 'همه چیز برای یک سفر بی‌نظیر به کیش؛ اطلاعات کامل جاواطب، هتل‌ها، رستوران‌ها و مراکز خرید');
$char_img  = kishharmony_get_option('guide_char_img', 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=500&q=80');
?>

<section class="travel-guide-section max-w-7xl mx-auto my-12 px-4">
    <div class="banner-container bg-gradient-to-l from-[#eef7ff] via-white to-sky-100/60 rounded-3xl p-6 sm:p-10 border border-slate-100 shadow-xl relative overflow-hidden flex flex-col lg:flex-row items-center justify-between gap-8">

        <!-- Left Side: Character Image -->
        <div class="character-wrapper w-full lg:w-2/5 flex justify-center shrink-0 order-2 lg:order-1">
            <div class="relative w-64 h-64 sm:w-80 sm:h-80 rounded-3xl overflow-hidden shadow-lg border-4 border-white">
                <img src="<?php echo esc_url($char_img); ?>" alt="کاراکتر راهنمای کیش" class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Right Side: Content -->
        <div class="guide-content w-full lg:w-3/5 space-y-6 order-1 lg:order-2 text-right">
            <div class="border-r-4 border-[#ff7e36] pr-4">
                <h2 class="text-2xl sm:text-3xl font-black text-[#005f9e] leading-snug"><?php echo esc_html($title); ?></h2>
                <p class="text-sm text-slate-600 mt-2 font-medium"><?php echo esc_html($desc); ?></p>
            </div>

            <!-- Feature Grid (6 Items) -->
            <div class="feature-grid grid grid-cols-2 sm:grid-cols-3 gap-4 text-xs font-bold text-slate-700">
                <div class="flex items-center gap-2 bg-white/80 backdrop-blur-sm p-2.5 rounded-xl border border-slate-100 shadow-sm">
                    <i class="fa-solid fa-camera text-[#005f9e] text-sm"></i>
                    <span>جاذبه‌ها و تفریحات</span>
                </div>
                <div class="flex items-center gap-2 bg-white/80 backdrop-blur-sm p-2.5 rounded-xl border border-slate-100 shadow-sm">
                    <i class="fa-solid fa-bed text-[#005f9e] text-sm"></i>
                    <span>هتل‌ها و اقامتگاه‌ها</span>
                </div>
                <div class="flex items-center gap-2 bg-white/80 backdrop-blur-sm p-2.5 rounded-xl border border-slate-100 shadow-sm">
                    <i class="fa-solid fa-ship text-[#005f9e] text-sm"></i>
                    <span>تور و بلیط</span>
                </div>
                <div class="flex items-center gap-2 bg-white/80 backdrop-blur-sm p-2.5 rounded-xl border border-slate-100 shadow-sm">
                    <i class="fa-solid fa-map-location-dot text-[#005f9e] text-sm"></i>
                    <span>نقشه و راهنما</span>
                </div>
                <div class="flex items-center gap-2 bg-white/80 backdrop-blur-sm p-2.5 rounded-xl border border-slate-100 shadow-sm">
                    <i class="fa-solid fa-bag-shopping text-[#005f9e] text-sm"></i>
                    <span>مراکز خرید کیش</span>
                </div>
                <div class="flex items-center gap-2 bg-white/80 backdrop-blur-sm p-2.5 rounded-xl border border-slate-100 shadow-sm">
                    <i class="fa-solid fa-utensils text-[#005f9e] text-sm"></i>
                    <span>رستوران‌ها و کافه‌ها</span>
                </div>
            </div>

            <!-- Pill Buttons -->
            <div class="flex flex-wrap items-center gap-3 pt-2">
                <a href="#booking" class="bg-[#ff7e36] hover:bg-[#e66b28] text-white text-xs font-bold px-6 py-2.5 rounded-full shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                    <span>رزرو تفریحات جزیره</span>
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                </a>
                <a href="#kishpedia" class="bg-white hover:bg-sky-50 text-[#005f9e] border border-[#005f9e] text-xs font-bold px-6 py-2.5 rounded-full shadow-sm transition-all flex items-center gap-2">
                    <i class="fa-solid fa-map"></i>
                    <span>کیش پدیا و نقشه</span>
                </a>
            </div>

            <!-- Bottom Badges -->
            <div class="border-t border-slate-200/60 pt-4 flex flex-wrap items-center gap-6 text-xs text-slate-600 font-semibold">
                <div class="flex items-center gap-2"><i class="fa-solid fa-headset text-[#005f9e]"></i> <span>پشتیبانی ۲۴ ساعته</span></div>
                <div class="flex items-center gap-2"><i class="fa-solid fa-shield-check text-[#005f9e]"></i> <span>تضمین بهترین قیمت</span></div>
                <div class="flex items-center gap-2"><i class="fa-solid fa-calendar-check text-[#005f9e]"></i> <span>رزرو سریع و آسان</span></div>
            </div>
        </div>

    </div>
</section>
