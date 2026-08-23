<?php
/**
 * Module 5: Special Offers
 */

$title = kishharmony_get_option('special_offers_title', 'پیشنهادهای ویژه و بلیط‌های لحظه آخری کیش');
$count = intval(kishharmony_get_option('special_offers_count', '6'));

// Check if WooCommerce active and query products
$wc_products = array();
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
            global $product;
            $wc_products[] = array(
                'title'       => get_the_title(),
                'link'        => get_permalink(),
                'price'       => $product->get_price_html(),
                'img'         => get_the_post_thumbnail_url(get_the_ID(), 'medium') ? get_the_post_thumbnail_url(get_the_ID(), 'medium') : 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80',
                'description' => get_the_excerpt() ? get_the_excerpt() : 'توضیحات و مشخصات پکیج ویژه تفریحات کیش با کیفیت عالی و تضمین قیمت.',
            );
        }
        wp_reset_postdata();
    }
}

// Fallback dummy products if wc empty
if (empty($wc_products)) {
    $wc_products = array(
        array(
            'title'       => 'پکیج طلایی غواصی وی‌آی‌پی کیش',
            'link'        => '#',
            'price'       => '۹۰۰,۰۰۰ تومان',
            'img'         => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80',
            'description' => 'شامل عکاسی و فیلم‌برداری زیر آب، مربی اختصاصی و تجهیزات کامل برند Mares',
        ),
        array(
            'title'       => 'پرواز پاراسل بالای خلیج فارس',
            'link'        => '#',
            'price'       => '۶۵۰,۰۰۰ تومان',
            'img'         => 'https://images.unsplash.com/photo-1569263979104-865ab7cd8d13?auto=format&fit=crop&w=800&q=80',
            'description' => 'ارتفاع ۱۵۰ متری با چشم‌انداز کل جزیره کیش، قایق تندرو مدرن و ایمنی ۱۰۰٪',
        ),
        array(
            'title'       => 'گشت VIP با یات اختصاصی کیش',
            'link'        => '#',
            'price'       => '۱,۲۰۰,۰۰۰ تومان',
            'img'         => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80',
            'description' => 'گشت ۲ ساعته دریایی روی آب‌های نیلگون خلیج فارس همراه با پذیرایی لایت و موسیقی',
        ),
    );
}
?>

<section id="special-offers" class="bg-gradient-to-br from-amber-500/10 via-orange-500/5 to-transparent p-6 sm:p-8 rounded-3xl border border-amber-500/20 shadow-sm max-w-7xl mx-auto my-10">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-fire text-3xl text-[#FF8A00]"></i>
            <div>
                <h2 class="text-2xl font-black text-[#071E3D]"><?php echo esc_html($title); ?></h2>
                <p class="text-xs text-slate-500">تخفیف‌های محدود تفریحات آبی و بسته‌های رزرو آنلاین</p>
            </div>
        </div>
        <span class="bg-[#FF8A00] text-white text-xs font-black px-3 py-1.5 rounded-full shadow-sm hidden sm:inline-block">انقضا تا پایان امروز</span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php foreach ($wc_products as $item) : ?>
            <div class="bg-white rounded-2xl overflow-hidden shadow-md border border-slate-100 flex flex-col group hover:shadow-xl transition-all">
                <div class="relative h-48 overflow-hidden">
                    <img src="<?php echo esc_url($item['img']); ?>" alt="<?php echo esc_attr($item['title']); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <span class="absolute top-3 right-3 bg-[#FF8A00] text-white text-xs font-black px-3 py-1 rounded-full shadow-md">پیشنهاد ویژه</span>
                </div>
                <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                    <div>
                        <h3 class="font-black text-slate-900 text-base mb-2"><?php echo esc_html($item['title']); ?></h3>
                        <p class="text-xs text-slate-500 leading-relaxed"><?php echo esc_html($item['description']); ?></p>
                    </div>
                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                        <div>
                            <span class="text-base font-black text-[#0B63D8]"><?php echo $item['price']; ?></span>
                        </div>
                        <a href="<?php echo esc_url($item['link']); ?>" class="btn-reserve bg-[#0B63D8] hover:bg-[#084bb3] text-white px-4 py-2 rounded-xl text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer shadow-md">
                            <i class="fa-solid fa-ticket"></i>
                            <span>رزرو فوری</span>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
