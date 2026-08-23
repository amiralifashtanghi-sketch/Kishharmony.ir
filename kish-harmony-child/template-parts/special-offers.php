<?php
/**
 * Module 5: Special Offers Products Section
 * Strictly implemented based on "کارت محصول پیشنهاد ویژه.txt"
 */

$title = kishharmony_get_option('special_offers_title', 'پیشنهادهای ویژه');
$count = intval(kishharmony_get_option('special_offers_count', '6'));

// Query WooCommerce Products or Use Classic Special Offers
$offers = array();
if (class_exists('WooCommerce')) {
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => $count,
        'post_status'    => 'publish',
        'meta_query'     => array(
            array(
                'key'     => '_is_car_rental',
                'value'   => '1',
                'compare' => '!=',
            ),
        ),
    );
    $loop = new WP_Query($args);
    if ($loop->have_posts()) {
        while ($loop->have_posts()) {
            $loop->the_post();
            $product_id = get_the_ID();
            $product    = wc_get_product($product_id);
            if ($product) {
                $regular_price = $product->get_regular_price();
                $sale_price    = $product->get_sale_price();
                $discount      = '۲۰٪';
                if ($regular_price && $sale_price) {
                    $perc = round((($regular_price - $sale_price) / $regular_price) * 100);
                    $discount = "{$perc}٪";
                }

                $offers[] = array(
                    'name'            => get_the_title(),
                    'link'            => get_permalink(),
                    'oldPrice'        => $regular_price ? number_format($regular_price) . ' تومان' : '۱,۵۰۰,۰۰۰ تومان',
                    'newPrice'        => $product->get_price() ? number_format($product->get_price()) . ' تومان' : '۹۰۰,۰۰۰ تومان',
                    'discountPercent' => $discount,
                    'capacityPercent' => 12,
                    'capacityText'    => 'فقط ۳ سانس',
                    'img'             => get_the_post_thumbnail_url($product_id, 'medium') ? get_the_post_thumbnail_url($product_id, 'medium') : 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80',
                );
            }
        }
        wp_reset_postdata();
    }
}

// Fallback items based strictly on Formula spec
if (empty($offers)) {
    $offers = array(
        array(
            'name'            => 'پکیج طلایی غواصی VIP کیش',
            'link'            => '#',
            'oldPrice'        => '۱,۵۰۰,۰۰۰ تومان',
            'newPrice'        => '۹۰۰,۰۰۰ تومان',
            'discountPercent' => '۴۰٪',
            'capacityPercent' => 12,
            'capacityText'    => 'فقط ۳ سانس',
            'img'             => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80',
        ),
        array(
            'name'            => 'پرواز پاراسل بالای خلیج فارس',
            'link'            => '#',
            'oldPrice'        => '۹۵۰,۰۰۰ تومان',
            'newPrice'        => '۶۵۰,۰۰۰ تومان',
            'discountPercent' => '۳۱٪',
            'capacityPercent' => 25,
            'capacityText'    => 'فقط ۵ ظرفیت',
            'img'             => 'https://images.unsplash.com/photo-1569263979104-865ab7cd8d13?auto=format&fit=crop&w=800&q=80',
        ),
        array(
            'name'            => 'گشت VIP با یات اختصاصی',
            'link'            => '#',
            'oldPrice'        => '۱,۸۰۰,۰۰۰ تومان',
            'newPrice'        => '۱,۲۰۰,۰۰۰ تومان',
            'discountPercent' => '۳۳٪',
            'capacityPercent' => 10,
            'capacityText'    => 'فقط ۲ سانس',
            'img'             => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80',
        ),
        array(
            'name'            => 'جت اسکی هیجانی ۴۵ دقیقه‌ای',
            'link'            => '#',
            'oldPrice'        => '۸۵۰,۰۰۰ تومان',
            'newPrice'        => '۶۰۰,۰۰۰ تومان',
            'discountPercent' => '۲۹٪',
            'capacityPercent' => 40,
            'capacityText'    => 'موجودی محدود',
            'img'             => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80',
        ),
    );
}
?>

<section id="special-offers" class="special-offers-section max-w-7xl mx-auto my-12 px-4">
    <!-- Section Header with Emoji 🔥 & Decorative Underline -->
    <div class="special-offers-header flex items-center gap-3 mb-6 relative">
        <span class="text-[2.2rem]">🔥</span>
        <h2 class="special-offers-title text-[1.9rem] font-[800] text-[#1a1a2e] relative inline-block">
            <?php echo esc_html($title); ?>
        </h2>
    </div>

    <!-- Horizontal Scroll Container (height: 500px) -->
    <div class="special-offers-scroll flex gap-6 overflow-x-auto pb-7 h-[500px] custom-scrollbar">
        <?php foreach ($offers as $item) :
            $is_low_stock = ($item['capacityPercent'] <= 15);
            ?>
            <!-- Offer Card (width: 265px, height: 100%) -->
            <div class="offer-card w-[265px] h-full shrink-0 bg-white rounded-[1.2rem] shadow-[0_4px_10px_rgba(0,0,0,0.04),0_12px_28px_rgba(0,0,0,0.08)] border border-black/5 flex flex-col transition-all duration-350 hover:-translate-y-2 hover:shadow-[0_10px_24px_rgba(0,0,0,0.08),0_20px_44px_rgba(233,30,99,0.12)] hover:border-[#e91e63]/20 group">

                <!-- 4.1 Card Image Wrap (height: 175px) -->
                <div class="card-img-wrap h-[175px] w-full bg-[#f0f0f0] overflow-hidden rounded-t-[1.2rem]">
                    <img src="<?php echo esc_url($item['img']); ?>" alt="<?php echo esc_attr($item['name']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>

                <!-- 4.2 Card Body -->
                <div class="card-body p-4 flex-1 flex flex-col">
                    <!-- 4.2.1 Product Title -->
                    <h3 class="offer-name text-center text-[1.05rem] font-bold text-[#222] mb-2.5 leading-[1.5]">
                        <?php echo esc_html($item['name']); ?>
                    </h3>

                    <!-- 4.2.2 Price Block -->
                    <div class="price-block flex items-baseline justify-center gap-2.5 mb-2.5 flex-wrap">
                        <span class="new-price text-[1.2rem] font-[800] text-[#1a1a2e]"><?php echo esc_html($item['newPrice']); ?></span>
                        <span class="old-price text-[0.85rem] font-medium text-[#999] line-through"><?php echo esc_html($item['oldPrice']); ?></span>
                    </div>

                    <!-- 4.2.3 Discount Circle (42px) -->
                    <div class="discount-circle w-[42px] h-[42px] rounded-full bg-[#e91e63] text-white text-[0.8rem] font-[800] flex items-center justify-center shadow-[0_4px_12px_rgba(233,30,99,0.4)] mx-auto mb-3 shrink-0">
                        <?php echo esc_html($item['discountPercent']); ?>
                    </div>

                    <!-- 4.2.4 Capacity Row -->
                    <div class="capacity-row shrink-0 mb-2">
                        <div class="capacity-header flex justify-between items-center mb-1.5 text-xs">
                            <span class="capacity-text text-[#d32f2f] font-semibold flex items-center gap-1">
                                ⏳ <span><?php echo esc_html($item['capacityText']); ?></span>
                            </span>
                            <span class="capacity-count text-[#777] text-[0.7rem]"><?php echo $item['capacityPercent']; ?>٪</span>
                        </div>
                        <div class="capacity-bar w-full h-2 bg-[#f0f0f0] rounded-full overflow-hidden shadow-inner">
                            <div class="capacity-fill h-full bg-gradient-to-r from-[#ff3b3b] to-[#ff6f61] rounded-full shadow-[0_0_6px_rgba(255,59,59,0.4)] transition-all duration-600 <?php echo $is_low_stock ? 'low-stock' : ''; ?>" style="width: <?php echo esc_attr($item['capacityPercent']); ?>%;"></div>
                        </div>
                    </div>

                    <!-- 4.2.5 Reserve Button (Pill Shape) -->
                    <div class="reserve-btn-wrap mt-auto shrink-0 pt-2">
                        <a href="<?php echo esc_url($item['link']); ?>" class="reserve-btn w-full py-2.5 px-0 rounded-[2.5rem] bg-gradient-to-br from-[#1a1a2e] to-[#16213e] text-white text-[0.9rem] font-bold shadow-[0_4px_12px_rgba(0,0,0,0.12)] flex items-center justify-center gap-1.5 hover:from-[#e91e63] hover:to-[#ff6f61] hover:shadow-[0_8px_20px_rgba(233,30,99,0.35)] hover:-translate-y-0.5 active:scale-95 transition-all text-center no-underline">
                            🎟️ <span>رزرو با تخفیف</span>
                        </a>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
