<?php
/**
 * Special Offers Product Cards Section Template
 */
if (!defined('ABSPATH')) exit;
?>
<section id="special-offers" class="special-offers-section max-w-7xl mx-auto my-12 px-4 sm:px-6 lg:px-8">
    <div class="section-header mb-8">
        <h2 class="text-2xl sm:text-3xl font-black text-[#1a1a2e] flex items-center gap-2 relative">
            <span class="text-3xl">🔥</span>
            <span>پیشنهادهای ویژه</span>
        </h2>
        <div class="w-24 h-1 bg-gradient-to-l from-[#e91e63] to-[#ff6f61] rounded-full mt-2"></div>
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
                    <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100 flex flex-col group hover:shadow-xl transition-all h-full">
                        <div class="relative h-48 overflow-hidden">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium', array('class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500')); ?>
                            <?php else : ?>
                                <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover">
                            <?php endif; ?>
                        </div>
                        <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                            <h3 class="font-black text-slate-900 text-center text-base mb-2"><?php the_title(); ?></h3>
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-auto">
                                <span class="text-base font-black text-[#0B63D8]"><?php echo $product->get_price_html(); ?></span>
                                <a href="<?php the_permalink(); ?>" class="btn-reserve bg-[#FF8A00] hover:bg-[#e07a00] text-white px-5 py-2.5 rounded-xl text-xs font-bold transition-all shadow-md">
                                    رزرو آنلاین
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            } else {
                kish_render_fallback_special_offers();
            }
        } else {
            kish_render_fallback_special_offers();
        }

        function kish_render_fallback_special_offers() {
            ?>
            <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100 flex flex-col group hover:shadow-xl transition-all h-full">
                <div class="relative h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                    <h3 class="font-black text-slate-900 text-center text-base mb-2">پکیج طلایی غواصی وی‌آی‌پی کیش</h3>
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between mt-auto">
                        <div>
                            <span class="text-xs text-slate-400 line-through block">۱,۵۰۰,۰۰۰</span>
                            <span class="text-base font-black text-[#0B63D8]">۹۰۰,۰۰۰ <span class="text-xs font-normal">تومان</span></span>
                        </div>
                        <button class="bg-[#FF8A00] hover:bg-[#e07a00] text-white px-5 py-2.5 rounded-xl text-xs font-bold shadow-md">رزرو آنلاین</button>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</section>
