<?php
/**
 * Module 3: Banner Slider (Strictly based on "بنر سایت.txt")
 * 6 Architectural Layers: Viewport DOM, GPU cubic-bezier motion, Frosted Glass, JS Auto-play loop, HCI hover/keyboard, Responsive Breakpoints
 */

$slider_interval = kishharmony_get_option('slider_interval', '4000');
?>

<div class="slider-wrapper max-w-[1400px] mx-auto my-8 px-4">
    <!-- Layer 1: Viewport Container -->
    <div class="slider-container relative rounded-[18px] overflow-hidden shadow-[0_12px_30px_rgba(0,0,0,0.25)]" id="heroSlider" data-interval="<?php echo esc_attr($slider_interval); ?>">

        <!-- Layer 2: Slider Flex Track (GPU Compositor Layer with cubic-bezier physics) -->
        <div class="slider flex width-full transition-transform duration-700 ease-[cubic-bezier(0.25,0.46,0.45,0.94)] will-change-transform" id="sliderTrack">
            <?php for ($s = 1; $s <= 3; $s++) {
                $title    = kishharmony_get_option("slide_{$s}_title", "تخفیف ویژه تفریحات کیش {$s}");
                $desc     = kishharmony_get_option("slide_{$s}_desc", "تجربه‌ای فراموش‌نشدنی با تضمین قیمت کیش هارمونی");
                $img      = kishharmony_get_option("slide_{$s}_img", "https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=1200&q=80");
                $btn_text = kishharmony_get_option("slide_{$s}_btn_text", "رزرو آنلاین");
                $btn_link = kishharmony_get_option("slide_{$s}_btn_link", "#");
                ?>
                <!-- Layer 3: Slide Item -->
                <div class="slide min-w-full h-[260px] sm:h-[320px] md:h-[420px] bg-cover bg-center relative flex items-center justify-center p-6 text-white" style="background-image: url('<?php echo esc_url($img); ?>');">
                    <!-- Brightness filter overlay for WCAG contrast (15% brightness reduction) -->
                    <div class="absolute inset-0 bg-black/30 backdrop-brightness-[0.85]"></div>

                    <!-- Layer 3.2: Text Content Box (Frosted Glass with 4px Blur & Light Border Highlights) -->
                    <div class="slide-content relative z-10 text-center max-w-xl bg-white/10 backdrop-blur-[4px] p-6 rounded-2xl border border-white/15 shadow-[0_12px_30px_rgba(0,0,0,0.25)]">
                        <h2 class="text-xl sm:text-3xl font-black mb-2 text-white drop-shadow-md"><?php echo esc_html($title); ?></h2>
                        <p class="text-xs sm:text-base text-blue-100 font-medium mb-4 leading-relaxed"><?php echo esc_html($desc); ?></p>
                        <a href="<?php echo esc_url($btn_link); ?>" class="inline-block bg-[#FF8A00] hover:bg-[#e07800] text-white text-xs sm:text-sm font-bold px-6 py-2.5 rounded-full shadow-[0_4px_14px_rgba(255,138,0,0.25)] hover:shadow-[0_8px_24px_rgba(255,138,0,0.45)] transition-all">
                            <?php echo esc_html($btn_text); ?> ←
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Layer 3.1: Frosted Glass Navigation Buttons (8px Blur) -->
        <button id="sliderPrev" aria-label="قبلی" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/20 backdrop-blur-[8px] text-white border border-white/30 flex items-center justify-center cursor-pointer hover:bg-white/40 transition-all z-20">
            ❮
        </button>
        <button id="sliderNext" aria-label="بعدی" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-white/20 backdrop-blur-[8px] text-white border border-white/30 flex items-center justify-center cursor-pointer hover:bg-white/40 transition-all z-20">
            ❯
        </button>

        <!-- Navigation Dots -->
        <div class="slider-dots absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-20" id="sliderDots">
            <span data-index="0" class="dot w-3 h-3 rounded-full bg-white/50 cursor-pointer transition-all active bg-white w-6"></span>
            <span data-index="1" class="dot w-3 h-3 rounded-full bg-white/50 cursor-pointer transition-all"></span>
            <span data-index="2" class="dot w-3 h-3 rounded-full bg-white/50 cursor-pointer transition-all"></span>
        </div>
    </div>
</div>
