<?php
// inc/setup-sample-data.php
// Create sample products, banners, rentals when theme is activated

function kishharmony_create_sample_data($old_name, $new_name) {
    // Only run when our child theme is activated
    if (wp_get_theme()->get('TextDomain') !== 'kishharmony-child') return;

    // Helper: create post if not exists
    function kishharmony_create_post_if_missing($args) {
        $exists = get_page_by_title($args['post_title'], OBJECT, $args['post_type']);
        if ($exists) return $exists->ID;
        $id = wp_insert_post($args);
        return $id;
    }

    // Create sample rental_car CPT posts
    $rentals = array(
        array('post_title'=>'پورشه کاین','post_content'=>'پورشه کاین — خودروی ویژه با امکانات لوکس.','meta'=>array('price'=>'4500000','capacity'=>5,'featured'=>'1')),
        array('post_title'=>'بی‌ام‌و X5','post_content'=>'بی‌ام‌و X5 — مناسب خانواده و سفرهای طولانی.','meta'=>array('price'=>'3800000','capacity'=>5)),
        array('post_title'=>'مرسدس C200','post_content'=>'مرسدس C200 — راحت و کلاسیک.','meta'=>array('price'=>'3200000','capacity'=>4)),
    );
    foreach($rentals as $r) {
        $post_id = kishharmony_create_post_if_missing(array(
            'post_title'=>$r['post_title'],
            'post_content'=>$r['post_content'],
            'post_status'=>'publish',
            'post_type'=>'rental_car'
        ));
        if (!empty($r['meta']) && $post_id) {
            foreach($r['meta'] as $k=>$v) update_post_meta($post_id,'_kish_'.$k,$v);
        }
    }

    // Create sample banners (kish_banner CPT)
    $banners = array(
        array('post_title'=>'بنر ساحل','meta'=>array('button_text'=>'بیشتر بدانید','button_url'=>'#','overlay_text'=>'تعطیلات در کیش')),
        array('post_title'=>'بنر تخفیف','meta'=>array('button_text'=>'رزرو کن','button_url'=>'#','overlay_text'=>'تخفیف ویژه')),
        array('post_title'=>'بنر تجربه','meta'=>array('button_text'=>'مشاهده','button_url'=>'#','overlay_text'=>'تجربه‌های ناب')),
    );
    foreach($banners as $b) {
        $post_id = kishharmony_create_post_if_missing(array(
            'post_title'=>$b['post_title'],'post_type'=>'kish_banner','post_status'=>'publish'
        ));
        if (!empty($b['meta']) && $post_id) {
            foreach($b['meta'] as $k=>$v) update_post_meta($post_id,'_kish_'.$k,$v);
        }
    }

    // Create sample WooCommerce products (if WooCommerce active)
    if (function_exists('wc_get_product')) {
        $products = array(
            array('post_title'=>'تور دریایی کیش','price'=>'1200000','content'=>'تور یک روزه‌ی دریایی'),
            array('post_title'=>'تفریح پاراسل','price'=>'450000','content'=>'هیجان پرواز روی آب'),
            array('post_title'=>'قایق خصوصی','price'=>'900000','content'=>'قایق خصوصی به همراه راهنما'),
        );
        foreach($products as $p) {
            $exists = get_page_by_title($p['post_title'], OBJECT, 'product');
            if ($exists) continue;
            $post_id = wp_insert_post(array(
                'post_title'=>$p['post_title'],
                'post_content'=>$p['content'],
                'post_status'=>'publish',
                'post_type'=>'product'
            ));
            if ($post_id) {
                // set price meta
                update_post_meta($post_id,'_regular_price',$p['price']);
                update_post_meta($post_id,'_price',$p['price']);
                // set product type
                wp_set_object_terms($post_id,'simple','product_type');
            }
        }
    }

}
add_action('after_switch_theme','kishharmony_create_sample_data',10,2);

