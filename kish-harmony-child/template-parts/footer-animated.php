<?php
/**
 * Module 10: Animated SVG Footer
 */

$brand_fa = kishharmony_get_option('brand_name_fa', 'کیش هارمونی');
$brand_en = kishharmony_get_option('brand_name_en', 'Kish Harmony');
$phone    = kishharmony_get_option('footer_phone', '۰۷۶ - ۴۴۴۴۰۰۰۰');
$address  = kishharmony_get_option('footer_address', 'جزیره کیش، برج صدف، طبقه ۳');
$namads   = kishharmony_get_option('footer_namads', '<div style="color:#fff;font-size:12px;">[نماد اعتماد الکترونیکی eNamad]</div>');
?>

<div class="footer-wrapper bg-[#18D6D8] relative shrink-0">

    <!-- Top Wave (White, Wave pointing up) -->
    <div class="footer-top-wave w-full h-[70px] relative z-[2] -mb-[15px] pointer-events-none" aria-hidden="true">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full block">
            <path class="wave-fill fill-white" transform="scale(1, -1) translate(0, -80)"
                  d="M0,35 C80,10 160,65 240,35 C320,5 400,60 480,35 C560,10 640,70 720,35 C800,0 880,60 960,35 C1040,10 1120,65 1200,35 C1280,5 1360,55 1440,35 L1440,80 L0,80 Z">
                <animate attributeName="d" dur="4s" repeatCount="indefinite" values="
                    M0,35 C80,10 160,65 240,35 C320,5 400,60 480,35 C560,10 640,70 720,35 C800,0 880,60 960,35 C1040,10 1120,65 1200,35 C1280,5 1360,55 1440,35 L1440,80 L0,80 Z;
                    M0,45 C90,20 170,70 250,45 C330,20 410,65 490,40 C570,15 650,60 730,45 C810,30 890,55 970,40 C1050,25 1130,60 1210,45 C1290,30 1370,50 1440,45 L1440,80 L0,80 Z;
                    M0,25 C70,0 150,55 230,25 C310,-5 390,50 470,25 C550,0 630,55 710,25 C790,-5 870,50 950,25 C1030,0 1110,55 1190,25 C1270,-5 1350,45 1440,25 L1440,80 L0,80 Z;
                    M0,35 C80,10 160,65 240,35 C320,5 400,60 480,35 C560,10 640,70 720,35 C800,0 880,60 960,35 C1040,10 1120,65 1200,35 C1280,5 1360,55 1440,35 L1440,80 L0,80 Z
                " />
            </path>
        </svg>
    </div>

    <!-- Logo Strip -->
    <div class="logo-strip pt-[10px] px-6 pb-[35px] flex justify-center items-center relative z-[1]">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link flex items-center gap-3 no-underline text-[#0B63D8]">
            <span class="logo-icon text-5xl drop-shadow-[0_8px_14px_rgba(0,0,0,0.2)] transition-transform">🏝️</span>
            <div class="logo-text flex flex-col gap-0.5">
                <span class="logo-name text-3xl font-extrabold text-[#0B63D8] leading-tight"><?php echo esc_html($brand_fa); ?></span>
                <span class="logo-tagline text-xs font-medium text-[#0B63D8]/80"><?php echo esc_html($brand_en); ?></span>
            </div>
        </a>
    </div>

    <!-- Middle Wave (Deep Blue) -->
    <div class="middle-wave w-full h-[70px] -mb-[5px] relative z-[2] pointer-events-none" aria-hidden="true">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full block">
            <path class="wave-deep fill-[#0B63D8]"
                  d="M0,35 C80,10 160,65 240,35 C320,5 400,60 480,35 C560,10 640,70 720,35 C800,0 880,60 960,35 C1040,10 1120,65 1200,35 C1280,5 1360,55 1440,35 L1440,80 L0,80 Z">
                <animate attributeName="d" dur="4s" repeatCount="indefinite" values="
                    M0,35 C80,10 160,65 240,35 C320,5 400,60 480,35 C560,10 640,70 720,35 C800,0 880,60 960,35 C1040,10 1120,65 1200,35 C1280,5 1360,55 1440,35 L1440,80 L0,80 Z;
                    M0,45 C90,20 170,70 250,45 C330,20 410,65 490,40 C570,15 650,60 730,45 C810,30 890,55 970,40 C1050,25 1130,60 1210,45 C1290,30 1370,50 1440,45 L1440,80 L0,80 Z;
                    M0,25 C70,0 150,55 230,25 C310,-5 390,50 470,25 C550,0 630,55 710,25 C790,-5 870,50 950,25 C1030,0 1110,55 1190,25 C1270,-5 1350,45 1440,25 L1440,80 L0,80 Z;
                    M0,35 C80,10 160,65 240,35 C320,5 400,60 480,35 C560,10 640,70 720,35 C800,0 880,60 960,35 C1040,10 1120,65 1200,35 C1280,5 1360,55 1440,35 L1440,80 L0,80 Z
                " />
            </path>
        </svg>
    </div>

    <!-- Main Content -->
    <div class="main-content bg-[#0B63D8] text-white relative isolate overflow-hidden pt-[10px]">
        <div class="glow-line absolute top-0 left-1/2 -translate-x-1/2 w-[65%] h-[1px] z-[3] bg-gradient-to-r from-transparent via-white to-transparent opacity-40"></div>

        <!-- Floating Particles -->
        <div class="particles absolute inset-0 z-0 pointer-events-none">
            <span class="particle p1 absolute rounded-full bg-[#18D6D8] opacity-5 w-[150px] h-[150px] -bottom-[70px] left-[8%] animate-[floatUp_13s_infinite_ease-in-out]"></span>
            <span class="particle p2 absolute rounded-full bg-[#6C3FBF] opacity-5 w-[100px] h-[100px] -bottom-[50px] left-[32%] animate-[floatUp_13s_infinite_ease-in-out_3s]"></span>
            <span class="particle p3 absolute rounded-full bg-[#AEEBFF] opacity-5 w-[170px] h-[170px] -bottom-[85px] right-[6%] animate-[floatUp_13s_infinite_ease-in-out_6s]"></span>
        </div>

        <div class="footer-inner relative z-[1] max-w-[1100px] mx-auto pt-[25px] px-6 pb-[10px] grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="link-group grid grid-cols-2 gap-5">
                <div>
                    <h4 class="col-title text-base font-bold text-white mb-3.5 relative inline-block">دسترسی سریع</h4>
                    <ul class="footer-links list-none flex flex-col gap-2 text-xs text-white/70">
                        <li><a href="#" class="hover:text-white transition-colors">درباره ما</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">خدمات ما</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">نمونه کارها</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">وبلاگ</a></li>
                        <li><a href="#special-offers" class="text-[#FF8A00] font-semibold hover:underline">پیشنهاد ویژه ✨</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="col-title text-base font-bold text-white mb-3.5 relative inline-block">پشتیبانی</h4>
                    <ul class="footer-links list-none flex flex-col gap-2 text-xs text-white/70">
                        <li><a href="#" class="hover:text-white transition-colors">مرکز راهنمایی</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">سوالات متداول</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">قوانین و مقررات</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">حریم خصوصی</a></li>
                        <li><span class="badge inline-flex items-center gap-1.5 bg-[#6C3FBF]/20 border border-[#6C3FBF]/60 text-purple-200 text-[10px] font-semibold px-2.5 py-1 rounded-full"><span class="badge-dot w-1.5 h-1.5 rounded-full bg-purple-400 animate-pulse"></span> پشتیبانی VIP</span></li>
                    </ul>
                </div>
            </div>

            <!-- Contact & Namad -->
            <div class="space-y-3 text-xs text-white/80">
                <h4 class="col-title text-base font-bold text-white mb-3.5 relative inline-block">تماس با ما & نمادها</h4>
                <div class="contact-item flex items-center gap-2.5">
                    <span class="contact-icon w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-[#18D6D8]">📍</span>
                    <span><?php echo esc_html($address); ?></span>
                </div>
                <div class="contact-item flex items-center gap-2.5">
                    <span class="contact-icon w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-[#18D6D8]">📞</span>
                    <span><?php echo esc_html($phone); ?></span>
                </div>

                <div class="namads-container pt-3">
                    <?php echo $namads; ?>
                </div>

                <div class="socials flex gap-2 pt-2">
                    <a href="#" class="social-link w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-[#AEEBFF] hover:bg-[#18D6D8] hover:text-[#0B63D8] transition-all">📷</a>
                    <a href="#" class="social-link w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-[#AEEBFF] hover:bg-[#18D6D8] hover:text-[#0B63D8] transition-all">🐦</a>
                    <a href="#" class="social-link w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-[#AEEBFF] hover:bg-[#18D6D8] hover:text-[#0B63D8] transition-all">✈️</a>
                </div>
            </div>
        </div>

        <div class="footer-bottom border-t border-white/10 mt-8 py-4 px-6 flex flex-col sm:flex-row justify-between items-center gap-2 text-[11px] text-white/60 bg-black/15 text-center">
            <span>© ۱۴۰۴ <?php echo esc_html($brand_fa); ?>. تمامی حقوق محفوظ است.</span>
            <ul class="bottom-links flex gap-4 list-none">
                <li><a href="#" class="hover:text-[#18D6D8] transition-colors">نقشه سایت</a></li>
                <li><a href="#" class="hover:text-[#18D6D8] transition-colors">تنظیمات</a></li>
            </ul>
        </div>
    </div>
</div>
