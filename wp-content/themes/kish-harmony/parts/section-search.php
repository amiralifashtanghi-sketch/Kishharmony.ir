<?php
/**
 * Search & Quick Filter Bar Template Part
 */
if (!defined('ABSPATH')) exit;
?>
<section class="search-filter-section bg-white p-6 sm:p-8 rounded-3xl border border-slate-100 shadow-sm max-w-7xl mx-auto my-8">
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
        </button>
    </div>

    <div class="relative mb-6">
        <input id="main-search-input" type="text" placeholder="جستجو (مثلاً پاراسل، غواصی، جت‌اسکی، رنت موستانگ...)" class="w-full bg-slate-50 border border-slate-200 focus:border-[#0B63D8] focus:bg-white rounded-2xl py-3.5 pr-12 pl-28 text-sm text-slate-800 outline-none transition-all shadow-inner">
        <i class="fa-solid fa-search absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
        <button id="main-search-btn" class="absolute left-2 top-1/2 -translate-y-1/2 bg-[#0B63D8] hover:bg-[#084bb3] text-white px-5 py-2 rounded-xl text-xs font-bold transition-all shadow-md">
            جستجو
        </button>
    </div>

    <div class="flex flex-wrap items-center gap-2 text-xs">
        <span class="font-bold text-slate-500 flex items-center gap-1"><i class="fa-solid fa-fire text-[#FF8A00]"></i> محبوب‌ترین‌ها:</span>
        <a href="#water-sports" class="bg-slate-100 hover:bg-blue-50 hover:text-[#0B63D8] text-slate-600 px-3 py-1.5 rounded-xl font-bold transition-colors"># پاراسل</a>
        <a href="#water-sports" class="bg-slate-100 hover:bg-blue-50 hover:text-[#0B63D8] text-slate-600 px-3 py-1.5 rounded-xl font-bold transition-colors"># غواصی</a>
        <a href="#water-sports" class="bg-slate-100 hover:bg-blue-50 hover:text-[#0B63D8] text-slate-600 px-3 py-1.5 rounded-xl font-bold transition-colors"># جت اسکی</a>
        <a href="#water-sports" class="bg-slate-100 hover:bg-blue-50 hover:text-[#0B63D8] text-slate-600 px-3 py-1.5 rounded-xl font-bold transition-colors"># یات لاکچری</a>
    </div>
</section>
