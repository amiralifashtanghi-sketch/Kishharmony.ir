<?php
/**
 * Kish Weather Widget Section Template Part (Exact Formula Specification)
 */
if (!defined('ABSPATH')) exit;
?>
<section class="weather-widget max-w-[1200px] mx-auto my-[30px] px-[20px] py-[30px] rounded-[30px] border border-white/30 shadow-[0_8px_32px_0_rgba(31,38,135,0.2)] bg-white/20 backdrop-blur-[12px] dir="rtl" style="background-image: linear-gradient(135deg, rgba(255,255,255,0.4) 0%, rgba(186,230,253,0.3) 100%);">
    <!-- 1. Header -->
    <div class="mb-6 text-right">
        <h2 class="text-[2rem] sm:text-[2.8rem] font-bold text-[#0a2647] leading-tight">
            آب و هوای <span class="text-[#ff8c00]">لحظه‌ای</span> کیش
        </h2>
        <p class="text-[1.1rem] text-[#1a3b5c] mt-1 font-normal">
            وضعیت امروز جزیره زیبای کیش برای تفریحات آبی ≈
        </p>
    </div>

    <!-- 2. Body -->
    <div class="flex flex-col md:flex-row-reverse items-center justify-between gap-5 mb-8">
        <!-- Main Temperature Card (Right in RTL) -->
        <div class="main-weather-card bg-white/35 backdrop-blur-[8px] border border-white/40 rounded-[25px] px-[30px] py-[20px] flex-1 w-full flex items-center justify-between shadow-sm">
            <div>
                <div class="flex items-center gap-4">
                    <span class="text-[4.5rem] font-bold text-[#0a2647] leading-none">28°</span>
                    <i class="fa-solid fa-cloud-sun text-4xl text-[#ffca28]"></i>
                </div>
                <div class="text-[1.2rem] font-semibold text-[#0a2647] mt-2">آفتابی تا کمی ابری</div>
                <div class="text-[1.1rem] font-semibold text-[#1c3f6e] mt-1 flex items-center gap-2">
                    <i class="fa-solid fa-location-dot text-[#0a2647]"></i>
                    <span>کیش، خلیج فارس</span>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Bottom 5 Widget Items -->
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-[15px]">
        <div class="widget-item bg-white/35 backdrop-blur-[8px] border border-white/40 rounded-[20px] px-[20px] py-[15px] text-center shadow-[0_4px_15px_rgba(31,38,135,0.1)] hover:-translate-y-[5px] hover:bg-white/50 transition-all cursor-pointer">
            <i class="fa-solid fa-droplet text-2xl text-[#0284c7] mb-2"></i>
            <span class="text-[0.8rem] text-[#1a3b5c] block">رطوبت</span>
            <span class="text-[1.1rem] font-bold text-[#0a2647] block my-1">۶۲٪</span>
            <span class="text-[0.7rem] text-[#374151] block">مناسب تفریح</span>
        </div>
        <div class="widget-item bg-white/35 backdrop-blur-[8px] border border-white/40 rounded-[20px] px-[20px] py-[15px] text-center shadow-[0_4px_15px_rgba(31,38,135,0.1)] hover:-translate-y-[5px] hover:bg-white/50 transition-all cursor-pointer">
            <i class="fa-solid fa-wind text-2xl text-[#2563eb] mb-2"></i>
            <span class="text-[0.8rem] text-[#1a3b5c] block">سرعت باد</span>
            <span class="text-[1.1rem] font-bold text-[#0a2647] block my-1">۱۲ km/h</span>
            <span class="text-[0.7rem] text-[#374151] block">ملایم</span>
        </div>
        <div class="widget-item bg-white/35 backdrop-blur-[8px] border border-white/40 rounded-[20px] px-[20px] py-[15px] text-center shadow-[0_4px_15px_rgba(31,38,135,0.1)] hover:-translate-y-[5px] hover:bg-white/50 transition-all cursor-pointer">
            <i class="fa-solid fa-water text-2xl text-[#0ea5e9] mb-2"></i>
            <span class="text-[0.8rem] text-[#1a3b5c] block">وضعیت دریا</span>
            <span class="text-[1.1rem] font-bold text-[#0a2647] block my-1">آرام</span>
            <span class="text-[0.7rem] text-[#374151] block">مناسب شنا و قایق</span>
        </div>
        <div class="widget-item bg-white/35 backdrop-blur-[8px] border border-white/40 rounded-[20px] px-[20px] py-[15px] text-center shadow-[0_4px_15px_rgba(31,38,135,0.1)] hover:-translate-y-[5px] hover:bg-white/50 transition-all cursor-pointer">
            <i class="fa-solid fa-sun text-2xl text-[#eab308] mb-2"></i>
            <span class="text-[0.8rem] text-[#1a3b5c] block">طلوع آفتاب</span>
            <span class="text-[1.1rem] font-bold text-[#0a2647] block my-1">۰۶:۱۵</span>
            <span class="text-[0.7rem] text-[#374151] block">صبح</span>
        </div>
        <div class="widget-item bg-white/35 backdrop-blur-[8px] border border-white/40 rounded-[20px] px-[20px] py-[15px] text-center shadow-[0_4px_15px_rgba(31,38,135,0.1)] hover:-translate-y-[5px] hover:bg-white/50 transition-all cursor-pointer col-span-2 sm:col-span-1">
            <i class="fa-solid fa-sun-plant-wilt text-2xl text-[#f97316] mb-2"></i>
            <span class="text-[0.8rem] text-[#1a3b5c] block">غروب آفتاب</span>
            <span class="text-[1.1rem] font-bold text-[#0a2647] block my-1">۱۸:۰۵</span>
            <span class="text-[0.7rem] text-[#374151] block">عصر</span>
        </div>
    </div>
</section>
