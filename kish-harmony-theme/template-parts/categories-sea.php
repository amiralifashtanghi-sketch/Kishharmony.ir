<?php
/**
 * Module 4: Sea Categories
 */

$title = kishharmony_get_option('sea_cats_title', 'دسته‌بندی تفریحات دریایی و ساحلی');
$desc  = kishharmony_get_option('sea_cats_desc', 'بهترین تجربه کلوپ‌های دریایی، تفریحات هوایی و سفرهای ساحلی کیش با تضمین قیمت');
?>

<section class="sea-category-bar space-y-4 my-10 max-w-7xl mx-auto px-4">
    <div class="flex items-center gap-3">
        <span class="text-3xl">🌊</span>
        <div>
            <h2 class="text-2xl font-black text-[#071E3D]"><?php echo esc_html($title); ?></h2>
            <p class="text-xs text-slate-500"><?php echo esc_html($desc); ?></p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Sea Card 1 -->
        <a href="#sea-tour" class="bg-teal-500 text-white p-5 rounded-2xl shadow-md relative overflow-hidden flex flex-col justify-between h-36 group cursor-pointer hover:scale-[1.02] transition-transform">
            <i class="fa-solid fa-ship text-5xl absolute -left-2 -bottom-2 text-white/20 group-hover:scale-110 transition-transform"></i>
            <span class="text-xs bg-white/20 backdrop-blur-md px-2.5 py-1 rounded-full font-bold w-fit">گشت‌های VIP</span>
            <div>
                <h3 class="text-lg font-black mb-1">تور دریایی</h3>
                <span class="text-xs font-semibold text-teal-100">از ۴۵۰,۰۰۰ تومان</span>
            </div>
        </a>

        <!-- Sea Card 2 -->
        <a href="#parasail" class="bg-amber-500 text-white p-5 rounded-2xl shadow-md relative overflow-hidden flex flex-col justify-between h-36 group cursor-pointer hover:scale-[1.02] transition-transform">
            <i class="fa-solid fa-parachute-box text-5xl absolute -left-2 -bottom-2 text-white/20 group-hover:scale-110 transition-transform"></i>
            <span class="text-xs bg-white/20 backdrop-blur-md px-2.5 py-1 rounded-full font-bold w-fit text-amber-100">داغ 🔥</span>
            <div>
                <h3 class="text-lg font-black mb-1">پاراسل</h3>
                <span class="text-xs font-semibold text-amber-100">از ۶۵۰,۰۰۰ تومان</span>
            </div>
        </a>

        <!-- Sea Card 3 -->
        <a href="#diving" class="bg-blue-600 text-white p-5 rounded-2xl shadow-md relative overflow-hidden flex flex-col justify-between h-36 group cursor-pointer hover:scale-[1.02] transition-transform">
            <i class="fa-solid fa-water text-5xl absolute -left-2 -bottom-2 text-white/20 group-hover:scale-110 transition-transform"></i>
            <span class="text-xs bg-white/20 backdrop-blur-md px-2.5 py-1 rounded-full font-bold w-fit">کلوپ‌های ۵ ستاره</span>
            <div>
                <h3 class="text-lg font-black mb-1">غواصی</h3>
                <span class="text-xs font-semibold text-blue-100">از ۷۸۰,۰۰۰ تومان</span>
            </div>
        </a>

        <!-- Sea Card 4 -->
        <a href="#aerial" class="bg-orange-600 text-white p-5 rounded-2xl shadow-md relative overflow-hidden flex flex-col justify-between h-36 group cursor-pointer hover:scale-[1.02] transition-transform">
            <i class="fa-solid fa-plane text-5xl absolute -left-2 -bottom-2 text-white/20 group-hover:scale-110 transition-transform"></i>
            <span class="text-xs bg-white/20 backdrop-blur-md px-2.5 py-1 rounded-full font-bold w-fit">هیجان مطلق</span>
            <div>
                <h3 class="text-lg font-black mb-1">تفریحات هوایی</h3>
                <span class="text-xs font-semibold text-orange-100">از ۸۹۰,۰۰۰ تومان</span>
            </div>
        </a>
    </div>
</section>
