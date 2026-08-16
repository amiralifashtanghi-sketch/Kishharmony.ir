<?php
/**
 * Hero & Overlapping Floating Categories Template Part
 */
if (!defined('ABSPATH')) exit;
?>
<section class="hero bg-[#0B63D8] w-full pt-24 sm:pt-28 relative overflow-visible shadow-xl mb-44 sm:mb-52 md:mb-60">
    <div class="banner min-h-[140px] sm:min-h-[160px] md:min-h-[190px] flex flex-col items-center justify-center relative px-6 text-center text-white mb-6">
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

    <!-- 8 Overlapping Floating Category Cards Grid -->
    <div class="max-w-6xl mx-auto px-4 absolute -bottom-36 sm:-bottom-44 md:-bottom-52 left-0 right-0 z-20">
        <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 p-3 sm:p-6 grid grid-cols-4 sm:grid-cols-8 gap-2 sm:gap-4 text-center">
            <a href="#train" class="category-card group flex flex-col items-center justify-center p-3 sm:p-4 rounded-2xl bg-white hover:bg-blue-50 transition-all border border-slate-100 hover:border-blue-200 shadow-sm hover:shadow-md">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 text-[#0B63D8] flex items-center justify-center text-xl sm:text-2xl mb-2 group-hover:scale-110 transition-transform"><i class="fa-solid fa-train"></i></div>
                <span class="text-xs sm:text-sm font-extrabold text-slate-800">قطار</span>
            </a>
            <a href="#flight" class="category-card group flex flex-col items-center justify-center p-3 sm:p-4 rounded-2xl bg-white hover:bg-blue-50 transition-all border border-slate-100 hover:border-blue-200 shadow-sm hover:shadow-md">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 text-[#0B63D8] flex items-center justify-center text-xl sm:text-2xl mb-2 group-hover:scale-110 transition-transform"><i class="fa-solid fa-plane-departure"></i></div>
                <span class="text-xs sm:text-sm font-extrabold text-slate-800">پرواز</span>
            </a>
            <a href="#hotel" class="category-card group flex flex-col items-center justify-center p-3 sm:p-4 rounded-2xl bg-white hover:bg-blue-50 transition-all border border-slate-100 hover:border-blue-200 shadow-sm hover:shadow-md">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 text-[#0B63D8] flex items-center justify-center text-xl sm:text-2xl mb-2 group-hover:scale-110 transition-transform"><i class="fa-solid fa-hotel"></i></div>
                <span class="text-xs sm:text-sm font-extrabold text-slate-800">هتل</span>
            </a>
            <a href="#bus" class="category-card group flex flex-col items-center justify-center p-3 sm:p-4 rounded-2xl bg-white hover:bg-blue-50 transition-all border border-slate-100 hover:border-blue-200 shadow-sm hover:shadow-md">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 text-[#0B63D8] flex items-center justify-center text-xl sm:text-2xl mb-2 group-hover:scale-110 transition-transform"><i class="fa-solid fa-bus"></i></div>
                <span class="text-xs sm:text-sm font-extrabold text-slate-800">اتوبوس</span>
            </a>
            <a href="#special-offers" class="category-card group flex flex-col items-center justify-center p-3 sm:p-4 rounded-2xl bg-amber-50/90 hover:bg-amber-100 transition-all border border-amber-200 shadow-sm hover:shadow-md relative">
                <span class="absolute -top-2 bg-[#FF8A00] text-white text-[9px] font-black px-2 py-0.5 rounded-full shadow-md animate-bounce">جدید</span>
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-amber-100 text-[#FF8A00] flex items-center justify-center text-xl sm:text-2xl mb-2 group-hover:scale-110 transition-transform"><i class="fa-solid fa-star"></i></div>
                <span class="text-xs sm:text-sm font-extrabold text-[#FF8A00]">ویژه</span>
            </a>
            <a href="#villa" class="category-card group flex flex-col items-center justify-center p-3 sm:p-4 rounded-2xl bg-white hover:bg-blue-50 transition-all border border-slate-100 hover:border-blue-200 shadow-sm hover:shadow-md">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 text-[#0B63D8] flex items-center justify-center text-xl sm:text-2xl mb-2 group-hover:scale-110 transition-transform"><i class="fa-solid fa-house-chimney"></i></div>
                <span class="text-xs sm:text-sm font-extrabold text-slate-800">ویلا</span>
            </a>
            <a href="#tour" class="category-card group flex flex-col items-center justify-center p-3 sm:p-4 rounded-2xl bg-white hover:bg-blue-50 transition-all border border-slate-100 hover:border-blue-200 shadow-sm hover:shadow-md">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 text-[#0B63D8] flex items-center justify-center text-xl sm:text-2xl mb-2 group-hover:scale-110 transition-transform"><i class="fa-solid fa-suitcase-rolling"></i></div>
                <span class="text-xs sm:text-sm font-extrabold text-slate-800">تور</span>
            </a>
            <a href="#new" class="category-card group flex flex-col items-center justify-center p-3 sm:p-4 rounded-2xl bg-cyan-50/60 hover:bg-cyan-100 transition-all border border-cyan-200 shadow-sm hover:shadow-md">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-cyan-100 text-[#18D6D8] flex items-center justify-center text-xl sm:text-2xl mb-2 group-hover:scale-110 transition-transform"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
                <span class="text-xs sm:text-sm font-extrabold text-[#0B63D8]">نسخه جدید</span>
            </a>
        </div>
    </div>
</section>
