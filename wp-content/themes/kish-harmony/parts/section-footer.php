<?php
/**
 * Blue Island Footer Template Part (Dual Wave SVG Architecture)
 */
if (!defined('ABSPATH')) exit;
?>
<footer class="footer-blue-island w-full mt-20 relative text-white overflow-hidden">
    <!-- Top Wave Separator -->
    <div class="wave-container relative w-full leading-none overflow-hidden" style="background-color: #18D6D8; padding-top: 50px;">
        <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between py-6">
            <div class="flex items-center gap-4 text-slate-900 font-black text-xl">
                <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center text-[#0B63D8] shadow-md">
                    ✦
                </div>
                <span>سامانه رزرو کیش هارمونی</span>
            </div>
            <span class="bg-[#6C3FBF] text-white text-xs font-bold px-4 py-2 rounded-full shadow-md mt-4 sm:mt-0">
                پشتیبانی VIP اختصاصی ۲۴/۷
            </span>
        </div>

        <!-- Wave SVG -->
        <svg viewBox="0 0 1200 120" preserveAspectRatio="none" class="relative block w-full h-16 text-[#0B63D8] fill-current">
            <path d="M0,0 C150,90 350,-40 500,50 C650,140 900,-20 1200,40 L1200,120 L0,120 Z"></path>
        </svg>
    </div>

    <!-- Deep Blue Content Footer Area -->
    <div class="bg-[#0B63D8] py-12 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-lg font-black mb-4">درباره کیش هارمونی</h3>
                <p class="text-xs text-blue-100 leading-relaxed">
                    مرجع تخصصی رزرو تفریحات آبی، جنگ‌های شبانه، گشت‌های دریایی با یات لاکچری و اجاره خودروهای سوپراسپرت در جزیره کیش با مجوز رسمی و ضمانت بهترین قیمت.
                </p>
            </div>
            <div>
                <h3 class="text-lg font-black mb-4">دسترسی سریع</h3>
                <ul class="text-xs text-blue-100 space-y-2">
                    <li><a href="#special-offers" class="hover:underline">پیشنهادهای ویژه</a></li>
                    <li><a href="#car-rent" class="hover:underline">رنت خودرو</a></li>
                    <li><a href="#weather" class="hover:underline">آب و هوای کیش</a></li>
                    <li><a href="#gallery" class="hover:underline">گالری تصاویر</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-black mb-4">تماس با پشتیبانی</h3>
                <p class="text-xs text-blue-100 leading-relaxed mb-2"><i class="fa-solid fa-phone text-[#FF8A00] ml-2"></i> تلفن پشتیبانی: ۰۷۶-۴۴۴۴۰۰۰۰</p>
                <p class="text-xs text-blue-100 leading-relaxed"><i class="fa-solid fa-location-dot text-[#FF8A00] ml-2"></i> دفتر مرکزی: کیش، میدان پردیس، مرکز تجاری</p>
            </div>
            <div>
                <h3 class="text-lg font-black mb-4">نمادهای اعتماد</h3>
                <div class="flex items-center gap-3 bg-white/10 p-3 rounded-2xl border border-white/20">
                    <span class="text-xs text-blue-100">دارای نماد اعتماد الکترونیکی و مجوز سازمان منطقه آزاد کیش</span>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto mt-12 pt-6 border-t border-white/20 text-center text-xs text-blue-200">
            © کلیه حقوق مادی و معنوی متعلق به سامانه کیش هارمونی می‌باشد.
        </div>
    </div>
</footer>

<!-- Booking Modal Overlay -->
<div id="booking-modal" class="fixed inset-0 bg-slate-950/70 backdrop-blur-md z-[4000] hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl p-6 max-w-md w-full shadow-2xl relative">
        <button id="close-modal-btn" class="absolute top-4 left-4 text-slate-400 hover:text-slate-800 text-2xl">&times;</button>
        <h3 class="text-xl font-black text-[#071E3D] mb-4">فرم ثبت رزرو آنلاین</h3>
        <form id="reservation-form" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">نام و نام خانوادگی</label>
                <input type="text" required class="w-full bg-slate-50 border border-slate-200 rounded-xl p-2.5 text-sm">
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">شماره تماس</label>
                <input type="tel" required class="w-full bg-slate-50 border border-slate-200 rounded-xl p-2.5 text-sm" placeholder="۰۹۱۲۰۰۰۰۰۰۰">
            </div>
            <button type="submit" class="w-full bg-[#0B63D8] text-white py-3 rounded-xl font-bold text-sm shadow-md">
                تایید و ادامه
            </button>
        </form>
    </div>
</div>
