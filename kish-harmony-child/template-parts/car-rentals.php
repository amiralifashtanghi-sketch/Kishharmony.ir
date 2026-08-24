<?php
/**
 * Module 7: Car Rentals Cards & Horizontal Snap Scroller
 * Strictly implemented based on "کارت محصول رنت خودرو.txt"
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
        $grad_index = 1;
        while ($loop->have_posts()) {
            $loop->the_post();
            $product_id = get_the_ID();
            $product    = wc_get_product($product_id);
            if ($product) {
                $gearbox   = get_post_meta($product_id, '_car_gearbox', true);
                $fuel      = get_post_meta($product_id, '_car_fuel', true);
                $insurance = get_post_meta($product_id, '_car_insurance', true);
                $badge     = get_post_meta($product_id, '_car_badge', true);

                $cars[] = array(
                    'title'     => get_the_title(),
                    'link'      => get_permalink(),
                    'price'     => $product->get_price_html() ? $product->get_price_html() : '۳,۸۰۰,۰۰۰ تومان/روز',
                    'gearbox'   => $gearbox ? $gearbox : 'اتوماتیک',
                    'fuel'      => $fuel ? $fuel : 'بنزینی',
                    'insurance' => $insurance ? $insurance : 'بیمه بدنه کامل',
                    'badge'     => $badge ? $badge : 'ویژه',
                    'gradClass' => 'grad' . (($grad_index % 5) + 1),
                    'icon'      => 'fa-car-side',
                );
                $grad_index++;
            }
        }
        wp_reset_postdata();
    }
}

// Fallback Car Groups based strictly on Formula specification
if (empty($cars)) {
    $cars = array(
        array('title' => 'پورشه کاین', 'link' => '#', 'price' => '۴,۵۰۰ هزار تومان/روز', 'gearbox' => 'اتوماتیک', 'fuel' => 'هیبریدی', 'insurance' => 'بیمه کامل', 'badge' => 'ویژه', 'gradClass' => 'grad1', 'icon' => 'fa-car-side'),
        array('title' => 'بی‌ام‌و X5', 'link' => '#', 'price' => '۳,۸۰۰ هزار تومان/روز', 'gearbox' => 'اتوماتیک', 'fuel' => 'چهارچرخ', 'insurance' => 'تحویل کیش', 'badge' => 'پرفروش', 'gradClass' => 'grad2', 'icon' => 'fa-truck'),
        array('title' => 'مرسدس C200', 'link' => '#', 'price' => '۳,۲۰۰ هزار تومان/روز', 'gearbox' => 'اتوماتیک', 'fuel' => 'بنزینی', 'insurance' => 'بیمه کامل', 'badge' => 'تخفیف دار', 'gradClass' => 'grad3', 'icon' => 'fa-car'),
        array('title' => 'تسلا مدل ۳', 'link' => '#', 'price' => '۵,۲۰۰ هزار تومان/روز', 'gearbox' => 'اتوپایلوت', 'fuel' => 'الکترییکی', 'insurance' => 'بیمه کامل', 'badge' => 'پرطرفدار', 'gradClass' => 'grad4', 'icon' => 'fa-bolt'),
        array('title' => 'تویوتا پرادو', 'link' => '#', 'price' => '۲,۹۰۰ هزار تومان/روز', 'gearbox' => 'اتوماتیک', 'fuel' => '۷ نفره', 'insurance' => 'آفرود', 'badge' => 'ویژه', 'gradClass' => 'grad5', 'icon' => 'fa-truck-monster'),
        array('title' => 'کیا سراتو', 'link' => '#', 'price' => '۱,۵۰۰ هزار تومان/روز', 'gearbox' => 'دنده‌ای', 'fuel' => 'اقتصادی', 'insurance' => 'بیمه بدنه', 'badge' => '', 'gradClass' => 'grad1', 'icon' => 'fa-car-side'),
    );
}

// Group cars into chunks of 3
$car_groups = array_chunk($cars, 3);
?>

<section class="car-rentals-section max-w-[1200px] mx-auto my-12 px-5">
    <!-- Section Head -->
    <div class="section-head flex items-center justify-between mb-[10px]">
        <h3 class="text-[20px] font-[800] text-[#0B63D8] flex items-center gap-2">
            <i class="fa-solid fa-[#FF8A00] fa-th-large text-[#FF8A00]"></i>
            <span>خودروهای ویژه رنت و اجاره در کیش</span>
        </h3>
    </div>

    <!-- Scroll Controls -->
    <div class="scroll-controls flex items-center justify-between mb-2 gap-2">
        <button onclick="document.getElementById('scroller').scrollBy({left:-1000,behavior:'smooth'})" class="scroll-btn w-10 h-10 rounded-full bg-white border-2 border-[#0B63D8] text-[#0B63D8] flex items-center justify-center cursor-pointer hover:bg-[#0B63D8] hover:text-white transition-all shadow-md shrink-0">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
        <span class="scroll-hint text-[12px] text-[#5a6f80] flex items-center gap-1.5 opacity-80 whitespace-nowrap hidden sm:flex">
            <i class="fa-solid fa-arrows-alt-h text-[#18D6D8]"></i>
            <span>جهت مشاهده سایر خودروها اسکرول کنید</span>
        </span>
        <button onclick="document.getElementById('scroller').scrollBy({left:1000,behavior:'smooth'})" class="scroll-btn w-10 h-10 rounded-full bg-white border-2 border-[#0B63D8] text-[#0B63D8] flex items-center justify-center cursor-pointer hover:bg-[#0B63D8] hover:text-white transition-all shadow-md shrink-0">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
    </div>

    <!-- Main Scroll Container with Scroll Snap -->
    <div class="scroll-container flex overflow-x-auto gap-0 py-2.5 pb-4 custom-scrollbar mb-5" id="scroller">
        <?php foreach ($car_groups as $group) : ?>
            <!-- Card Group (width: 100%, flex-shrink: 0, scroll-snap-align: start) -->
            <div class="card-group shrink-0 w-full flex gap-4 px-2.5 justify-center">
                <?php foreach ($group as $car) : ?>
                    <!-- Single Car Card -->
                    <div class="car-card <?php echo $car['badge'] ? 'featured' : ''; ?> bg-white rounded-[20px] p-3.5 px-4 flex items-center gap-3.5 shadow-[0_2px_8px_rgba(11,99,216,0.06)] border border-transparent hover:border-[#18D6D8] hover:shadow-[0_14px_38px_rgba(11,99,216,0.16)] transition-all cursor-pointer relative flex-1 min-w-0">

                        <!-- 90x90 Image Box with Gradient -->
                        <div class="car-img <?php echo esc_attr($car['gradClass']); ?> w-[90px] h-[90px] rounded-[16px] shrink-0 flex items-center justify-center text-[32px] text-white relative shadow-[0_6px_18px_rgba(11,99,216,0.2)] group-hover:scale-105 transition-transform">
                            <i class="fa-solid <?php echo esc_attr($car['icon']); ?>"></i>
                            <?php if (!empty($car['badge'])) : ?>
                                <span class="badge-special absolute -top-1.5 -right-1.5 bg-[#FF8A00] text-white text-[9px] font-[800] px-2 py-0.5 rounded-[10px] shadow-[0_2px_8px_rgba(255,138,0,0.4)]"><?php echo esc_html($car['badge']); ?></span>
                            <?php endif; ?>
                        </div>

                        <!-- Car Information -->
                        <div class="car-info flex-1 flex flex-col gap-1 min-w-0">
                            <h4 class="car-name font-[800] text-[#0a2540] text-[15px] truncate"><?php echo esc_html($car['title']); ?></h4>

                            <div class="car-meta flex flex-wrap gap-1 text-[10px]">
                                <span class="bg-[#f0f7fc] px-1.5 py-0.5 rounded-[8px] flex items-center gap-1"><i class="fa-solid fa-cog text-[#18D6D8]"></i> <?php echo esc_html($car['gearbox']); ?></span>
                                <span class="bg-[#f0f7fc] px-1.5 py-0.5 rounded-[8px] flex items-center gap-1"><i class="fa-solid fa-gas-pump text-[#18D6D8]"></i> <?php echo esc_html($car['fuel']); ?></span>
                                <span class="bg-[#f0f7fc] px-1.5 py-0.5 rounded-[8px] flex items-center gap-1"><i class="fa-solid fa-shield-alt text-[#18D6D8]"></i> <?php echo esc_html($car['insurance']); ?></span>
                            </div>

                            <div class="car-rating flex items-center gap-1 text-[10px] text-[#f5a623] mt-0.5">
                                <i class="fa-solid fa-star"></i>
                                <span class="font-[600] text-[#0a2540]">۴.۹</span>
                                <span class="text-[#5a6f80] font-normal">(۱۲ نظر)</span>
                            </div>
                        </div>

                        <!-- Car Price & CTA Button -->
                        <div class="car-action flex flex-col items-end gap-2 shrink-0">
                            <div class="car-price text-left">
                                <span class="text-[16px] font-[900] text-[#0B63D8]"><?php echo $car['price']; ?></span>
                            </div>
                            <a href="<?php echo esc_url($car['link']); ?>" class="btn-book bg-[#FF8A00] hover:bg-[#e07800] text-white border-none py-[7px] px-4 rounded-[18px] text-[11px] font-[700] cursor-pointer shadow-[0_4px_14px_rgba(255,138,0,0.25)] hover:shadow-[0_8px_24px_rgba(255,138,0,0.45)] transition-all whitespace-nowrap no-underline">
                                رزرو خودرو
                            </a>
                        </div>

                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
