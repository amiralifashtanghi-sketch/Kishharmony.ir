<?php
// template-parts/product-card.php
?>
<div class="car-card" style="display:flex;align-items:center;gap:14px;background:#fff;border-radius:12px;padding:12px;margin:8px;box-shadow:0 4px 12px rgba(0,0,0,0.06);">
    <div class="car-img grad1" style="width:90px;height:90px;border-radius:16px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:32px;">
        <?php if(has_post_thumbnail()) the_post_thumbnail('thumbnail'); else echo '&#128663;'; ?>
    </div>
    <div class="car-info" style="flex:1;min-width:0;">
        <h3 style="margin:0;font-family:'Vazirmatn',sans-serif; font-weight:800;color:#0a2540;"><?php the_title(); ?></h3>
        <div class="car-meta" style="display:flex;gap:6px;font-size:12px;margin-top:6px;color:#5a6f80;">
            <?php
            // sample meta display
            $price = get_post_meta(get_the_ID(),'_price',true);
            if(!$price) $price = get_post_meta(get_the_ID(),'_kish_price',true);
            if ($price) echo '<span style="background:#f0f7fc;padding:4px 8px;border-radius:8px;">قیمت: '.esc_html(number_format((int)$price)).' تومان</span>';
            ?>
        </div>
    </div>
    <div class="car-action" style="display:flex;flex-direction:column;align-items:flex-end;gap:8px;">
        <div class="car-price"><small style="font-size:9px;color:#5a6f80;">از</small><div style="font-weight:900;color:#0B63D8;"><?php echo $price? number_format((int)$price):'—'; ?></div></div>
        <a class="btn-book" href="<?php the_permalink(); ?>" style="background:#FF8A00;color:#fff;padding:8px 12px;border-radius:18px;text-decoration:none;">رزرو</a>
    </div>
</div>
