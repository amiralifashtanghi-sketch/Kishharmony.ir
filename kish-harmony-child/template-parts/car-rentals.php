<?php
/**
 * Module 7: Car Rental Cards
 */

$cars = array();

if (class_exists('WooCommerce')) {
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 12,
        'post_status'    => 'publish',
        'meta_query'     => array(
            array(
                'key'   => '_is_car_rental',
                'value' => '1',
            ),
        ),
    );
    $loop = new WP_Query($args);
    if ($loop->have_posts()) {
        while ($loop->have_posts()) {
            $loop->the_post();
            global $product;
            $post_id   = get_the_ID();
            $gearbox   = get_post_meta($post_id, '_car_gearbox', true);
            $fuel      = get_post_meta($post_id, '_car_fuel', true);
            $insurance = get_post_meta($post_id, '_car_insurance', true);
            $badge     = get_post_meta($post_id, '_car_badge', true);

            $cars[] = array(
                'title'     => get_the_title(),
                'link'      => get_permalink(),
                'price'     => $product->get_price_html(),
                'gearbox'   => $gearbox ? $gearbox : 'اتوماتیک',
                'fuel'      => $fuel ? $fuel : 'بنزینی',
                'insurance' => $insurance ? $insurance : 'بیمه بدنه کامل',
                'badge'     => $badge ? $badge : 'ویژه',
                'icon'      => 'fa-car-side',
            );
        }
        wp_reset_postdata();
    }
}

// Fallback dummy cars
if (empty($cars)) {
    $cars = array(
        array('title' => 'پورشه کاین', 'link' => '#', 'price' => '۴,۵۰۰,۰۰۰ تومان/روز', 'gearbox' => 'اتوماتیک', 'fuel' => 'هیبریدی', 'insurance' => 'بیمه بدنه کامل', 'badge' => 'ویژه', 'icon' => 'fa-car-side'),
        array('title' => 'بی‌ام‌و X5', 'link' => '#', 'price' => '۳,۸۰۰,۰۰۰ تومان/روز', 'gearbox' => 'اتوماتیک', 'fuel' => 'بنزینی', 'insurance' => 'تحویل فرودگاه', 'badge' => 'پرفروش', 'icon' => 'fa-truck'),
        array('title' => 'مرسدس C200', 'link' => '#', 'price' => '۳,۲۰۰,۰۰۰ تومان/روز', 'gearbox' => 'اتوماتیک', 'fuel' => 'بنزینی', 'insurance' => 'بیمه کامل', 'badge' => 'تخفیف دار', 'icon' => 'fa-car'),
        array('title' => 'فورد موستانگ', 'link' => '#', 'price' => '۳,۸۰۰,۰۰۰ تومان/روز', 'gearbox' => 'اتوماتیک', 'fuel' => 'بنزینی', 'insurance' => 'کروک ۲۰۲۳', 'badge' => 'داغ', 'icon' => 'fa-bolt'),
    );
}
?>

<section class="car-rentals-section max-w-7xl mx-auto my-12 px-4">
    <div class="section-head flex items-center justify-between mb-4">
        <h3 class="text-xl font-extrabold text-[#0B63D8] flex items-center gap-2">
            <i class="fa-solid fa-car text-[#FF8A00]"></i>
            <span>خودروهای ویژه رنت و اجاره در کیش</span>
        </h3>
        <div class="scroll-controls flex items-center gap-2">
            <button onclick="document.getElementById('scroller').scrollBy({left:-300,behavior:'smooth'})" class="scroll-btn w-9 h-9 rounded-full bg-white border-2 border-[#0B63D8] text-[#0B63D8] flex items-center justify-center cursor-pointer hover:bg-[#0B63D8] hover:text-white transition-all">
                ❮
            </button>
            <span class="scroll-hint text-xs text-slate-500 hidden sm:inline">برای دیدن سایر خودروها بکشید</span>
            <button onclick="document.getElementById('scroller').scrollBy({left:300,behavior:'smooth'})" class="scroll-btn w-9 h-9 rounded-full bg-white border-2 border-[#0B63D8] text-[#0B63D8] flex items-center justify-center cursor-pointer hover:bg-[#0B63D8] hover:text-white transition-all">
                ❯
            </button>
        </div>
    </div>

    <div class="scroll-container flex overflow-x-auto gap-4 py-3 custom-scrollbar" id="scroller">
        <?php foreach ($cars as $car) : ?>
            <div class="car-card min-w-[280px] sm:min-w-[320px] bg-white rounded-2xl p-4 flex items-center gap-3.5 border border-slate-100 hover:border-[#18D6D8] shadow-sm hover:shadow-lg transition-all cursor-pointer relative group">
                <div class="car-img w-20 h-20 rounded-xl bg-gradient-to-br from-[#0B63D8] to-[#18D6D8] text-white flex items-center justify-center text-3xl shrink-0 relative shadow-md group-hover:scale-105 transition-transform">
                    <i class="fa-solid <?php echo esc_attr($car['icon']); ?>"></i>
                    <?php if ($car['badge']) : ?>
                        <span class="badge-special absolute -top-1.5 -right-1.5 bg-[#FF8A00] text-white text-[9px] font-extrabold px-2 py-0.5 rounded-full shadow-sm"><?php echo esc_html($car['badge']); ?></span>
                    <?php endif; ?>
                </div>

                <div class="car-info flex-1 flex flex-col gap-1 min-w-0">
                    <h4 class="car-name font-extrabold text-slate-900 text-sm truncate"><?php echo esc_html($car['title']); ?></h4>
                    <div class="car-meta flex flex-wrap gap-1 text-[10px] text-slate-500">
                        <span class="bg-slate-50 px-2 py-0.5 rounded-md flex items-center gap-1"><i class="fa-solid fa-cog text-[#18D6D8]"></i> <?php echo esc_html($car['gearbox']); ?></span>
                        <span class="bg-slate-50 px-2 py-0.5 rounded-md flex items-center gap-1"><i class="fa-solid fa-gas-pump text-[#18D6D8]"></i> <?php echo esc_html($car['fuel']); ?></span>
                        <span class="bg-slate-50 px-2 py-0.5 rounded-md flex items-center gap-1"><i class="fa-solid fa-shield-alt text-[#18D6D8]"></i> <?php echo esc_html($car['insurance']); ?></span>
                    </div>
                    <div class="car-price mt-1">
                        <span class="text-xs font-black text-[#0B63D8]"><?php echo $car['price']; ?></span>
                    </div>
                </div>

                <div class="car-action shrink-0">
                    <a href="<?php echo esc_url($car['link']); ?>" class="btn-book bg-[#FF8A00] hover:bg-[#e07800] text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-sm transition-all block">
                        رزرو
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
