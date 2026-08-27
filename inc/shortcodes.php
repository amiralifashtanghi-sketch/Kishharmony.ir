<?php
// inc/shortcodes.php - rental list shortcode
function kishharmony_rental_list_shortcode($atts){
    $atts = shortcode_atts(array('posts_per_page'=>6), $atts);
    $q = new WP_Query(array('post_type'=>'rental_car','posts_per_page'=>$atts['posts_per_page']));
    ob_start();
    if($q->have_posts()){
        echo '<div class="rental-list" style="display:flex;flex-wrap:wrap;gap:12px;">';
        while($q->have_posts()): $q->the_post();
            echo '<div class="rental-item" style="flex:1 1 300px;background:#fff;padding:12px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.06);">';
            if(has_post_thumbnail()) the_post_thumbnail('medium');
            echo '<h3 style="margin:8px 0;">'.get_the_title().'</h3>';
            echo '<p>'.wp_trim_words(get_the_content(),20).'</p>';
            echo '</div>';
        endwhile;
        echo '</div>';
        wp_reset_postdata();
    } else {
        echo '<p>هیچ خودرویی یافت نشد.</p>';
    }
    return ob_get_clean();
}
add_shortcode('rental_list','kishharmony_rental_list_shortcode');
