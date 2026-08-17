<?php
/**
 * Car Rent Products Template Part (Formula Specification)
 */
if (!defined('ABSPATH')) exit;
?>
<section id="car-rent" class="car-rent-section max-w-7xl mx-auto my-12 px-4 sm:px-6 lg:px-8 dir="rtl"">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl sm:text-3xl font-black text-[#0B63D8] flex items-center gap-2">
                <i class="fa-solid fa-car text-[#FF8A00]"></i>
                <span>خودروهای ویژه رنت در کیش</span>
            </h2>
            <p class="text-xs text-[#5a6f80] mt-1 font-normal">
                اجاره مستقیم انواع ماشین‌های لوکس و سوپراسپرت با تحویل رایگان در فرودگاه کیش
            </p>
        </div>
        <div class="hidden sm:flex items-center gap-2">
            <span class="text-xs text-[#5a6f80]">تحویل در محل دلخواه</span>
        </div>
    </div>

    <!-- Cars Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Car 1: Porsche Cayenne -->
        <div class="car-card bg-white rounded-[20px] p-5 shadow-[0_2px_8px_rgba(11,99,216,0.06)] hover:shadow-[0_14px_38px_rgba(11,99,216,0.16)] hover:bg-[#fafeff] transition-all border border-slate-100 flex flex-col justify-between">
            <div>
                <div class="relative rounded-[16px] overflow-hidden mb-4 shadow-[0_6px_18px_rgba(11,99,216,0.2)] h-48">
                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=800&q=80" alt="پورشه کاین" class="w-full h-full object-cover">
                    <span class="absolute top-3 right-3 bg-[#FF8A00] text-white text-[10px] font-extrabold px-2.5 py-1 rounded-[10px] shadow-sm">ویژه</span>
                </div>
                <div class="flex items-center justify-between mb-2">
                    <h3 class="font-extrabold text-[#0a2540] text-base">پورشه کاین</h3>
                    <div class="flex items-center gap-1 text-[10px] text-[#f5a623] font-semibold">
                        <i class="fa-solid fa-star"></i>
                        <span>۴.۹</span>
                    </div>
                </div>
                <div class="flex flex-wrap gap-1.5 mb-4">
                    <span class="text-[10px] text-[#5a6f80] bg-[#f0f7fc] px-2 py-0.5 rounded-[8px] flex items-center gap-1"><i class="fa-solid fa-bolt text-[#18D6D8] text-[9px]"></i> هیبریدی</span>
                    <span class="text-[10px] text-[#5a6f80] bg-[#f0f7fc] px-2 py-0.5 rounded-[8px] flex items-center gap-1"><i class="fa-solid fa-[#18D6D8] text-[9px]"></i> اتوماتیک</span>
                </div>
            </div>
            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <div>
                    <span class="text-xs text-[#5a6f80] block text-left">هزار تومان/روز</span>
                    <span class="text-lg font-black text-[#0B63D8]">۴,۵۰۰</span>
                </div>
                <button class="bg-[#FF8A00] hover:bg-[#e07a00] text-white text-[11px] font-bold px-4 py-2.5 rounded-[18px] shadow-[0_4px_14px_rgba(255,138,0,0.25)] hover:shadow-[0_8px_24px_rgba(255,138,0,0.45)] transition-all">
                    رزرو خودرو
                </button>
            </div>
        </div>

        <!-- Car 2: BMW X5 -->
        <div class="car-card bg-white rounded-[20px] p-5 shadow-[0_2px_8px_rgba(11,99,216,0.06)] hover:shadow-[0_14px_38px_rgba(11,99,216,0.16)] hover:bg-[#fafeff] transition-all border border-slate-100 flex flex-col justify-between">
            <div>
                <div class="relative rounded-[16px] overflow-hidden mb-4 shadow-[0_6px_18px_rgba(11,99,216,0.2)] h-48">
                    <img src="https://images.unsplash.com/photo-1555215695-3004980ad54e?auto=format&fit=crop&w=800&q=80" alt="بی‌ام‌و X5" class="w-full h-full object-cover">
                </div>
                <div class="flex items-center justify-between mb-2">
                    <h3 class="font-extrabold text-[#0a2540] text-base">بی‌ام‌و X5</h3>
                    <div class="flex items-center gap-1 text-[10px] text-[#f5a623] font-semibold">
                        <i class="fa-solid fa-star"></i>
                        <span>۴.۸</span>
                    </div>
                </div>
                <div class="flex flex-wrap gap-1.5 mb-4">
                    <span class="text-[10px] text-[#5a6f80] bg-[#f0f7fc] px-2 py-0.5 rounded-[8px] flex items-center gap-1"><i class="fa-solid fa-car text-[#18D6D8] text-[9px]"></i> چهارچرخ</span>
                    <span class="text-[10px] text-[#5a6f80] bg-[#f0f7fc] px-2 py-0.5 rounded-[8px] flex items-center gap-1"><i class="fa-solid fa-location-dot text-[#18D6D8] text-[9px]"></i> تحویل فرودگاه</span>
                </div>
            </div>
            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <div>
                    <span class="text-xs text-[#5a6f80] block text-left">هزار تومان/روز</span>
                    <span class="text-lg font-black text-[#0B63D8]">۳,۸۰۰</span>
                </div>
                <button class="bg-[#FF8A00] hover:bg-[#e07a00] text-white text-[11px] font-bold px-4 py-2.5 rounded-[18px] shadow-[0_4px_14px_rgba(255,138,0,0.25)] hover:shadow-[0_8px_24px_rgba(255,138,0,0.45)] transition-all">
                    رزرو خودرو
                </button>
            </div>
        </div>

        <!-- Car 3: Mercedes C200 -->
        <div class="car-card bg-white rounded-[20px] p-5 shadow-[0_2px_8px_rgba(11,99,216,0.06)] hover:shadow-[0_14px_38px_rgba(11,99,216,0.16)] hover:bg-[#fafeff] transition-all border border-slate-100 flex flex-col justify-between">
            <div>
                <div class="relative rounded-[16px] overflow-hidden mb-4 shadow-[0_6px_18px_rgba(11,99,216,0.2)] h-48">
                    <img src="https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?auto=format&fit=crop&w=800&q=80" alt="مرسدس C200" class="w-full h-full object-cover">
                </div>
                <div class="flex items-center justify-between mb-2">
                    <h3 class="font-extrabold text-[#0a2540] text-base">مرسدس بنز C200</h3>
                    <div class="flex items-center gap-1 text-[10px] text-[#f5a623] font-semibold">
                        <i class="fa-solid fa-star"></i>
                        <span>۴.۷</span>
                    </div>
                </div>
                <div class="flex flex-wrap gap-1.5 mb-4">
                    <span class="text-[10px] text-[#5a6f80] bg-[#f0f7fc] px-2 py-0.5 rounded-[8px] flex items-center gap-1"><i class="fa-solid fa-shield text-[#18D6D8] text-[9px]"></i> بیمه کامل</span>
                    <span class="text-[10px] text-[#5a6f80] bg-[#f0f7fc] px-2 py-0.5 rounded-[8px] flex items-center gap-1"><i class="fa-solid fa-gears text-[#18D6D8] text-[9px]"></i> اتوماتیک</span>
                </div>
            </div>
            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <div>
                    <span class="text-xs text-[#5a6f80] block text-left">هزار تومان/روز</span>
                    <span class="text-lg font-black text-[#0B63D8]">۳,۲۰۰</span>
                </div>
                <button class="bg-[#FF8A00] hover:bg-[#e07a00] text-white text-[11px] font-bold px-4 py-2.5 rounded-[18px] shadow-[0_4px_14px_rgba(255,138,0,0.25)] hover:shadow-[0_8px_24px_rgba(255,138,0,0.45)] transition-all">
                    رزرو خودرو
                </button>
            </div>
        </div>
    </div>
</section>
