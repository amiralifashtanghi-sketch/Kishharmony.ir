<?php
/**
 * Module 10: Animated SVG Dual-Wave Footer ("جزیره‌ی آبی / کیش هارمونی")
 * Strictly implemented based on "فوتر.txt"
 */

$brand_fa = kishharmony_get_option('brand_name_fa', 'کیش هارمونی');
$brand_en = kishharmony_get_option('brand_name_en', 'Kish Harmony');
$phone    = kishharmony_get_option('footer_phone', '۰۷۶ - ۴۴۴۴۰۰۰۰');
$address  = kishharmony_get_option('footer_address', 'جزیره کیش، برج صدف، طبقه ۳');
$namads   = kishharmony_get_option('footer_namads', '<div style="color:#fff;font-size:12px;">[نماد اعتماد الکترونیکی eNamad]</div>');
?>

<div class="footer-wrapper bg-[#18D6D8] relative shrink-0">

    <!-- 1. Top Wave (White fill, Wave pointing UP) -->
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

    <!-- 2. Logo Strip (Centered Distinct Brand Strip) -->
    <div class="logo-strip pt-[10px] px-6 pb-[35px] flex justify-center items-center relative z-[1]">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="logo-link flex items-center gap-3 no-underline text-[#0B63D8]">
            <span class="logo-icon text-[3.2rem] drop-shadow-[0_8px_14px_rgba(0,0,0,0.2)] transition-transform hover:scale-[1.08] hover:-rotate-4">🏝️</span>
            <div class="logo-text flex flex-col gap-[2px]">
                <span class="logo-name text-[2rem] font-[800] text-[#0B63D8] leading-[1.2]"><?php echo esc_html($brand_fa); ?></span>
                <span class="logo-tagline text-[0.85rem] font-[500] text-[#0B63D8]/80"><?php echo esc_html($brand_en); ?></span>
            </div>
        </a>
    </div>

    <!-- 3. Middle Wave (Deep Blue fill #0B63D8) -->
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

    <!-- 4. Main Footer Content Body (#0B63D8) -->
    <div class="main-content bg-[#0B63D8] text-white relative isolate overflow-hidden pt-[10px]">

        <!-- Glow Scanner Line -->
        <div class="glow-line absolute top-0 left-1/2 -translate-x-1/2 w-[65%] h-[1px] z-[3] bg-gradient-to-r from-transparent via-[#18D6D8] to-transparent opacity-40"></div>

        <!-- Floating Water Particles -->
        <div class="particles absolute inset-0 z-0 pointer-events-none">
            <span class="particle p1 absolute rounded-full bg-[#18D6D8] opacity-5 w-[150px] h-[150px] -bottom-[70px] left-[8%]"></span>
            <span class="particle p2 absolute rounded-full bg-[#6C3FBF] opacity-5 w-[100px] h-[100px] -bottom-[50px] left-[32%]"></span>
            <span class="particle p3 absolute rounded-full bg-[#AEEBFF] opacity-5 w-[170px] h-[170px] -bottom-[85px] right-[6%]"></span>
            <span class="particle p4 absolute rounded-full bg-[#18D6D8] opacity-5 w-[80px] h-[80px] -bottom-[40px] right-[28%]"></span>
        </div>

        <div class="footer-inner relative z-[1] max-w-[1100px] mx-auto pt-[25px] px-6 pb-[10px] grid grid-cols-1 md:grid-cols-2 gap-[30px]">

            <!-- Link Group Sub-Grid (Always 2 Columns) -->
            <div class="link-group grid grid-cols-2 gap-[20px]">
                <div>
                    <h4 class="col-title text-[1rem] font-[700] text-white mb-[14px] relative inline-block">دسترسی سریع</h4>
                    <ul class="footer-links list-none flex flex-col gap-[9px] text-[0.85rem] text-white/65">
                        <li><a href="#" class="footer-link hover:text-white hover:-translate-x-1 transition-all">درباره ما</a></li>
                        <li><a href="#" class="footer-link hover:text-white hover:-translate-x-1 transition-all">خدمات ما</a></li>
                        <li><a href="#" class="footer-link hover:text-white hover:-translate-x-1 transition-all">نمونه کارها</a></li>
                        <li><a href="#" class="footer-link hover:text-white hover:-translate-x-1 transition-all">وبلاگ</a></li>
                        <li><a href="#special-offers" class="footer-link highlight text-[#FF8A00] font-[600] hover:text-white hover:-translate-x-1 transition-all">پیشنهاد ویژه ✨</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="col-title text-[1rem] font-[700] text-white mb-[14px] relative inline-block">پشتیبانی</h4>
                    <ul class="footer-links list-none flex flex-col gap-[9px] text-[0.85rem] text-white/65">
                        <li><a href="#" class="footer-link hover:text-white hover:-translate-x-1 transition-all">مرکز راهنمایی</a></li>
                        <li><a href="#" class="footer-link hover:text-white hover:-translate-x-1 transition-all">سوالات متداول</a></li>
                        <li><a href="#" class="footer-link hover:text-white hover:-translate-x-1 transition-all">قوانین و مقررات</a></li>
                        <li><a href="#" class="footer-link hover:text-white hover:-translate-x-1 transition-all">حریم خصوصی</a></li>
                        <li>
                            <span class="badge inline-flex items-center gap-[5px] mt-[4px] bg-[#6C3FBF]/20 border border-[#6C3FBF]/40 text-[#c9b8f0] text-[0.7rem] font-[600] px-[9px] py-[3px] rounded-[20px]">
                                <span class="badge-dot w-[7px] h-[7px] rounded-full bg-[#b794f4]"></span> پشتیبانی VIP
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Contact Column & CTA -->
            <div class="space-y-[12px] text-[0.85rem] text-white/65">
                <h4 class="col-title text-[1rem] font-[700] text-white mb-[14px] relative inline-block">تماس با ما</h4>

                <div class="contact-item flex items-center gap-[10px]">
                    <span class="contact-icon w-[32px] h-[32px] rounded-full bg-white/10 flex items-center justify-center text-[#18D6D8] shrink-0">📍</span>
                    <span><?php echo esc_html($address); ?></span>
                </div>

                <div class="contact-item flex items-center gap-[10px]">
                    <span class="contact-icon w-[32px] h-[32px] rounded-full bg-white/10 flex items-center justify-center text-[#18D6D8] shrink-0">📞</span>
                    <span><?php echo esc_html($phone); ?></span>
                </div>

                <div class="contact-item flex items-center gap-[10px]">
                    <span class="contact-icon w-[32px] h-[32px] rounded-full bg-white/10 flex items-center justify-center text-[#18D6D8] shrink-0">✉️</span>
                    <span>info@kishharmony.ir</span>
                </div>

                <!-- CTA Button -->
                <a href="#consultation" class="cta-button inline-flex items-center gap-[8px] bg-[#FF8A00] color-white text-white font-[700] text-[0.85rem] px-[20px] py-[10px] rounded-[28px] shadow-[0_6px_20px_rgba(255,138,0,0.3)] hover:bg-[#ff9d22] hover:-translate-y-[3px] hover:shadow-[0_12px_28px_rgba(255,138,0,0.45)] transition-all no-underline mt-[8px]">
                    مشاوره رایگان ←
                </a>

                <!-- Trust Badges (eNamad) -->
                <div class="namads-container pt-2">
                    <?php echo $namads; ?>
                </div>

                <!-- Social Links -->
                <div class="socials flex gap-[8px] mt-[16px]">
                    <a href="#" class="social-link w-[32px] h-[32px] rounded-full bg-white/10 flex items-center justify-center text-[#AEEBFF] hover:bg-[#18D6D8] hover:text-[#0B63D8] hover:-translate-y-[3px] transition-all no-underline">📷</a>
                    <a href="#" class="social-link w-[32px] h-[32px] rounded-full bg-white/10 flex items-center justify-center text-[#AEEBFF] hover:bg-[#18D6D8] hover:text-[#0B63D8] hover:-translate-y-[3px] transition-all no-underline">🐦</a>
                    <a href="#" class="social-link w-[32px] h-[32px] rounded-full bg-white/10 flex items-center justify-center text-[#AEEBFF] hover:bg-[#18D6D8] hover:text-[#0B63D8] hover:-translate-y-[3px] transition-all no-underline">✈️</a>
                </div>
            </div>

        </div>

        <!-- 5. Copyright Bar -->
        <div class="footer-bottom border-t border-white/10 mt-[35px] px-[24px] py-[16px] flex flex-col sm:flex-row justify-between items-center gap-[8px] text-[0.75rem] text-white/65 bg-black/15 text-center">
            <span>© ۱۴۰۴ <?php echo esc_html($brand_fa); ?>. تمامی حقوق محفوظ است.</span>
            <ul class="bottom-links flex gap-[16px] list-none">
                <li><a href="#" class="hover:text-[#18D6D8] transition-colors">نقشه سایت</a></li>
                <li><a href="#" class="hover:text-[#18D6D8] transition-colors">کوکی‌ها</a></li>
                <li><a href="#" class="hover:text-[#18D6D8] transition-colors">تنظیمات</a></li>
            </ul>
            <span>ساخته شده با <span class="heart text-[#ff5e7a] inline-block animate-bounce">♥</span> در ایران</span>
        </div>
    </div>
</div>
