<?php
// inc/meta.php - basic metaboxes for products and terms

// Add product meta: show_on_home, discount, capacity
function kishharmony_add_product_metabox(){
    add_meta_box('kish_home_meta','نمایش در صفحه اصلی','kishharmony_home_meta_callback','product','side','high');
}
add_action('add_meta_boxes','kishharmony_add_product_metabox');

function kishharmony_home_meta_callback($post){
    wp_nonce_field('kishharmony_save_meta','kishharmony_meta_nonce');
    $show = get_post_meta($post->ID,'_kish_show_on_home',true);
    $discount = get_post_meta($post->ID,'_kish_discount',true);
    $capacity = get_post_meta($post->ID,'_kish_capacity',true);
    echo '<label><input type="checkbox" name="kish_show_on_home" '.checked($show,'on',false).' /> نمایش در محصولات ویژه صفحه اصلی</label><br/>';
    echo '<label>درصد تخفیف: <input type="number" name="kish_discount" value="'.esc_attr($discount).'" style="width:70px"/>%</label><br/>';
    echo '<label>ظرفیت: <input type="number" name="kish_capacity" value="'.esc_attr($capacity).'" style="width:70px"/></label>';
}

function kishharmony_save_product_meta($post_id){
    if(!isset($_POST['kishharmony_meta_nonce']) || !wp_verify_nonce($_POST['kishharmony_meta_nonce'],'kishharmony_save_meta')) return;
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if(get_post_type($post_id) !== 'product') return;

    if(isset($_POST['kish_show_on_home'])) update_post_meta($post_id,'_kish_show_on_home','on');
    else delete_post_meta($post_id,'_kish_show_on_home');

    if(isset($_POST['kish_discount'])) update_post_meta($post_id,'_kish_discount',sanitize_text_field($_POST['kish_discount']));
    if(isset($_POST['kish_capacity'])) update_post_meta($post_id,'_kish_capacity',sanitize_text_field($_POST['kish_capacity']));
}
add_action('save_post','kishharmony_save_product_meta');

// Term meta: show_on_home for product_cat
function kishharmony_add_term_fields($term){
    $show = get_term_meta($term->term_id,'_kish_term_show_on_home',true);
    $image = get_term_meta($term->term_id,'_kish_term_image',true);
    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label>نمایش در صفحه اصلی</label></th>
        <td>
            <input type="checkbox" name="kish_term_show_on_home" <?php checked($show,'on'); ?> />
        </td>
    </tr>
    <tr class="form-field">
        <th scope="row" valign="top"><label>عکس دسته</label></th>
        <td>
            <input type="text" name="kish_term_image" id="kish_term_image" value="<?php echo esc_attr($image); ?>" />
            <p class="description">آدرس تصویر یا ID رسانه</p>
        </td>
    </tr>
    <?php
}
add_action('product_cat_edit_form_fields','kishharmony_add_term_fields',10,2);

function kishharmony_save_term_fields($term_id){
    if(isset($_POST['kish_term_show_on_home'])) update_term_meta($term_id,'_kish_term_show_on_home','on');
    else delete_term_meta($term_id,'_kish_term_show_on_home');

    if(isset($_POST['kish_term_image'])) update_term_meta($term_id,'_kish_term_image',sanitize_text_field($_POST['kish_term_image']));
}
add_action('edited_product_cat','kishharmony_save_term_fields',10,2);
