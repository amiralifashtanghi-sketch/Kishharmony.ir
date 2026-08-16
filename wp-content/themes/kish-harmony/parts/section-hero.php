<?php
/**
 * Hero & Overlapping Floating Categories Section
 */
if (!defined('ABSPATH')) exit;
?>
<section class="hero bg-[#0B63D8] w-full pt-24 sm:pt-28 relative overflow-visible shadow-xl mb-44 sm:mb-52 md:mb-60">
    <!-- Top Right Language Switcher Badge -->
    <div class="absolute top-4 right-4 sm:right-8 z-20 flex items-center gap-2">
        <span class="text-white text-xs font-bold bg-white/20 backdrop-blur-md px-3.5 py-1.5 rounded-full border border-white/30 flex items-center gap-2 shadow-sm cursor-pointer">
            <i class="fa-solid fa-globe text-amber-300"></i>
            <span>فارسی | IRAN</span>
        </span>
    </div>

    <!-- Main Banner Content -->
    <div class="banner min-h-[140px] sm:min-h-[160px] md:min-h-[190px] flex flex-col items-center justify-center relative px-6 text-center text-white mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center text-[#18D6D8] text-2xl sm:text-3xl border border-white/20 shadow-inner">
                ✦
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

    <!-- 8 Overlapping Categories Box -->
    <div class="categories-wrapper max-w-4xl mx-auto px-4 absolute -bottom-36 sm:-bottom-44 md:-bottom-52 left-0 right-0 z-20">
        <div class="categories-grid grid grid-cols-2 bg-white rounded-[28px] border border-gray-200 shadow-xl overflow-hidden">
            <a href="#train" class="category-item flex items-center gap-3 p-4 border-b border-r border-gray-200 hover:bg-slate-50 transition-colors">
                <span class="category-emoji text-xl">🚆</span>
                <span class="category-text text-sm font-semibold text-slate-800">قطار</span>
            </a>
            <a href="#flight" class="category-item flex items-center gap-3 p-4 border-b border-gray-200 hover:bg-slate-50 transition-colors">
                <span class="category-emoji text-xl">✈️</span>
                <span class="category-text text-sm font-semibold text-slate-800">پرواز</span>
            </a>
            <a href="#hotel" class="category-item flex items-center gap-3 p-4 border-b border-r border-gray-200 hover:bg-slate-50 transition-colors">
                <span class="category-emoji text-xl">🏨</span>
                <span class="category-text text-sm font-semibold text-slate-800">هتل</span>
            </a>
            <a href="#bus" class="category-item flex items-center gap-3 p-4 border-b border-gray-200 hover:bg-slate-50 transition-colors">
                <span class="category-emoji text-xl">🚌</span>
                <span class="category-text text-sm font-semibold text-slate-800">اتوبوس</span>
            </a>
            <a href="#special" class="category-item special flex items-center gap-3 p-4 border-b border-r border-gray-200 hover:bg-slate-50 transition-colors">
                <span class="category-emoji text-xl">⭐</span>
                <span class="category-text text-sm font-bold text-[#0B63D8]">ویژه</span>
                <span class="badge text-[10px] bg-amber-300 text-slate-900 font-bold px-2 py-0.5 rounded-full mr-auto">جدید</span>
            </a>
            <a href="#villa" class="category-item flex items-center gap-3 p-4 border-b border-gray-200 hover:bg-slate-50 transition-colors">
                <span class="category-emoji text-xl">🏡</span>
                <span class="category-text text-sm font-semibold text-slate-800">ویلا و اقامتگاه</span>
            </a>
            <a href="#tour" class="category-item flex items-center gap-3 p-4 border-r border-gray-200 hover:bg-slate-50 transition-colors">
                <span class="category-emoji text-xl">🧳</span>
                <span class="category-text text-sm font-semibold text-slate-800">تور</span>
            </a>
            <a href="#new" class="category-item special flex items-center gap-3 p-4 hover:bg-slate-50 transition-colors">
                <span class="category-emoji text-xl">✨</span>
                <span class="category-text text-sm font-bold text-[#0B63D8]">نسخه جدید</span>
            </a>
        </div>
    </div>
</section>
