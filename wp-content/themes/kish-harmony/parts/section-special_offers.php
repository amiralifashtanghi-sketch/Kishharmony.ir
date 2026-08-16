<?php
/**
 * Special Offers Product Cards Template Part (WooCommerce Real Data Binding)
 */
if (!defined('ABSPATH')) exit;
?>
<section id="special-offers" class="bg-gradient-to-br from-amber-500/10 via-orange-500/5 to-transparent p-6 sm:p-8 rounded-3xl border border-amber-500/20 shadow-sm max-w-7xl mx-auto my-8">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-fire text-3xl text-[#FF8A00]"></i>
            <div>
                <h2 class="text-2xl font-black text-[#071E3D]">پیشنهادهای ویژه و بلیط‌های لحظه آخری کیش</h2>
                <p class="text-xs text-slate-500">تخفیف‌های محدود تفریحات آبی و رنت خودرو</p>
            </div>
        </div>
        <span class="bg-[#FF8A00] text-white text-xs font-black px-3 py-1.5 rounded-full shadow-sm hidden sm:inline-block">انقضا تا پایان امروز</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php
        if (class_exists('WooCommerce')) {
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => 3,
                'meta_key' => '_sale_price',
                'post_status' => 'publish'
            );
            $loop = new WP_Query($args);
            if ($loop->have_posts()) {
                while ($loop->have_posts()) : $loop->the_post();
                    global $product;
                    ?>
                    <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100 flex flex-col group hover:shadow-xl transition-all">
                        <div class="relative h-48 overflow-hidden">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500')); ?>
                            <?php else : ?>
                                <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover">
                            <?php endif; ?>
                            <?php if ($product->is_on_sale()) : ?>
                                <span class="absolute top-3 right-3 bg-[#FF8A00] text-white text-xs font-black px-3 py-1 rounded-full shadow-md">تخفیف ویژه</span>
                            <?php endif; ?>
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                            <div>
                                <h3 class="font-black text-slate-900 text-base mb-2"><?php the_title(); ?></h3>
                                <p class="text-xs text-slate-500 leading-relaxed"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                            </div>
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                <div>
                                    <span class="text-base font-black text-[#0B63D8]"><?php echo $product->get_price_html(); ?></span>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="btn-reserve bg-[#0B63D8] hover:bg-[#084bb3] text-white px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-1.5 shadow-md">
                                    <i class="fa-solid fa-ticket"></i>
                                    <span>رزرو فوری</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            } else {
                render_fallback_special_offers();
            }
        } else {
            render_fallback_special_offers();
        }

        function render_fallback_special_offers() {
            ?>
            <!-- Fallback Static Product Cards -->
            <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100 flex flex-col group hover:shadow-xl transition-all">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <span class="absolute top-3 right-3 bg-[#FF8A00] text-white text-xs font-black px-3 py-1 rounded-full shadow-md">۴۰٪ تخفیف</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                    <div>
                        <h3 class="font-black text-slate-900 text-base mb-2">پکیج طلایی غواصی وی‌آی‌پی کیش</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">شامل عکاسی زیر آب، مربی اختصاصی و تجهیزات کامل</p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-xs text-slate-400 line-through block">۱,۵۰۰,۰۰۰</span>
                            <span class="text-base font-black text-[#0B63D8]">۹۰۰,۰۰۰ <span class="text-xs font-normal">تومان</span></span>
                        </div>
                        <button class="bg-[#0B63D8] text-white px-4 py-2 rounded-xl text-xs font-bold">رزرو فوری</button>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</section>
