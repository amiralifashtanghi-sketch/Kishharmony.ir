<?php
// front-page.php - simple front page template to show widgets and test blocks
get_header();
?>
<div class="kish-container" style="max-width:1200px;margin:40px auto;padding:0 20px;">
    <?php // Weather widget ?>
    <section class="kish-weather-section">
        <?php get_template_part('template-parts/weather-widget'); ?>
    </section>

    <?php // Banners slider ?>
    <section class="kish-banners" style="margin-top:30px;">
        <?php
        $banners = new WP_Query(array('post_type'=>'kish_banner','posts_per_page'=>5));
        if ($banners->have_posts()):
            echo '<div class="kish-banner-slider">';
            while($banners->have_posts()): $banners->the_post();
                $overlay = get_post_meta(get_the_ID(),'_kish_overlay_text',true);
                $btn_text = get_post_meta(get_the_ID(),'_kish_button_text',true);
                $btn_url = get_post_meta(get_the_ID(),'_kish_button_url',true);
                echo '<div class="kish-slide">';
                if (has_post_thumbnail()) the_post_thumbnail('large');
                echo '<div class="kish-slide-overlay"><h3>'.esc_html($overlay).'</h3>';
                if($btn_text) echo '<a class="kish-btn" href="'.esc_url($btn_url).'">'.esc_html($btn_text).'</a>';
                echo '</div></div>';
            endwhile;
            echo '</div>';
            wp_reset_postdata();
        endif;
        ?>
    </section>

    <?php // Categories (product_cat with term meta show_on_home) ?>
    <section class="kish-categories" style="margin-top:30px;">
        <h2>دسته‌بندی تفریحات</h2>
        <div class="kish-cat-grid">
            <?php
            $terms = get_terms(array('taxonomy'=>'product_cat','hide_empty'=>false));
            if (!empty($terms) && !is_wp_error($terms)){
                foreach($terms as $t){
                    $show = get_term_meta($t->term_id,'_kish_term_show_on_home',true);
                    if(!$show) continue;
                    $img = get_term_meta($t->term_id,'_kish_term_image',true);
                    echo '<a class="card-soft" href="'.get_term_link($t).'" style="background-image:url('.esc_url($img).')">';
                    echo '<i class="fa-solid fa-umbrella-beach"></i>';
                    echo '<div class="card-label">'.esc_html($t->name).'</div>';
                    echo '</a>';
                }
            }
            ?>
        </div>
    </section>

    <?php // Featured products from meta _kish_show_on_home ?>
    <section class="kish-featured-products" style="margin-top:30px;">
        <h2>محصولات ویژه</h2>
        <div class="kish-products-grid">
            <?php
            $args = array('post_type'=>'product','meta_key'=>'_kish_show_on_home','meta_value'=>'on','posts_per_page'=>8);
            $fp = new WP_Query($args);
            if ($fp->have_posts()){
                while($fp->have_posts()): $fp->the_post();
                    get_template_part('template-parts/product-card');
                endwhile;
                wp_reset_postdata();
            } else {
                echo '<p>هیچ محصول ویژه‌ای تنظیم نشده است.</p>';
            }
            ?>
        </div>
    </section>

    <?php // Rentals sample section ?>
    <section style="margin-top:30px;">
        <h2>خودروهای رنت</h2>
        <?php echo do_shortcode('[rental_list]'); ?>
    </section>

    <?php // Gallery ?>
    <section style="margin-top:30px;">
        <?php get_template_part('template-parts/gallery'); ?>
    </section>

</div>

<?php get_footer(); ?>
