<?php
/**
 * Module 9: Weather Widget
 */

$fallback_temp = kishharmony_get_option('weather_temp', '۲۸°C');
$fallback_sea  = kishharmony_get_option('weather_sea', 'آرام و ملایم');
?>

<section class="weather-widget max-w-7xl mx-auto my-10 px-4">
    <div class="relative rounded-3xl p-6 sm:p-8 border border-white/40 shadow-lg bg-gradient-to-br from-sky-100/60 via-teal-50/40 to-[#18D6D8]/20 backdrop-blur-md">
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

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3 sm:gap-4 text-center" id="weatherWidgetContainer">
            <div class="bg-white/60 backdrop-blur-md p-4 rounded-2xl border border-white/60 shadow-sm">
                <i class="fa-solid fa-sun text-2xl text-amber-500 mb-1"></i>
                <span class="text-[11px] text-slate-500 block">دما</span>
                <span class="text-base font-black text-slate-900" id="wt-temp"><?php echo esc_html($fallback_temp); ?></span>
            </div>
            <div class="bg-white/60 backdrop-blur-md p-4 rounded-2xl border border-white/60 shadow-sm">
                <i class="fa-solid fa-water text-2xl text-sky-500 mb-1"></i>
                <span class="text-[11px] text-slate-500 block">وضعیت دریا</span>
                <span class="text-base font-black text-slate-900" id="wt-sea"><?php echo esc_html($fallback_sea); ?></span>
            </div>
            <div class="bg-white/60 backdrop-blur-md p-4 rounded-2xl border border-white/60 shadow-sm">
                <i class="fa-solid fa-droplet text-2xl text-blue-500 mb-1"></i>
                <span class="text-[11px] text-slate-500 block">رطوبت</span>
                <span class="text-base font-black text-slate-900" id="wt-humidity">۶۲٪</span>
            </div>
            <div class="bg-white/60 backdrop-blur-md p-4 rounded-2xl border border-white/60 shadow-sm">
                <i class="fa-solid fa-wind text-2xl text-teal-500 mb-1"></i>
                <span class="text-[11px] text-slate-500 block">سرعت باد</span>
                <span class="text-base font-black text-slate-900" id="wt-wind">۱۲ km/h</span>
            </div>
            <div class="bg-white/60 backdrop-blur-md p-4 rounded-2xl border border-white/60 shadow-sm col-span-2 sm:col-span-1">
                <i class="fa-solid fa-sun text-2xl text-orange-500 mb-1"></i>
                <span class="text-[11px] text-slate-500 block">شاخص UV</span>
                <span class="text-base font-black text-slate-900" id="wt-uv">متوسط (۴)</span>
            </div>
        </div>
    </div>
</section>
