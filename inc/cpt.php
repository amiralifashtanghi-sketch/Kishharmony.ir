<?php
// inc/cpt.php

if(!function_exists('kishharmony_register_cpts')){
    function kishharmony_register_cpts(){
        // Banners
        register_post_type('kish_banner', array(
            'labels'=>array('name'=>'بنرها','singular_name'=>'بنر'),
            'public'=>false,
            'show_ui'=>true,
            'supports'=>array('title','thumbnail','custom-fields','page-attributes'),
            'menu_icon'=>'dashicons-format-image',
        ));

        // Rental cars
        register_post_type('rental_car', array(
            'labels'=>array('name'=>'خودروهای رنت','singular_name'=>'خودرو'),
            'public'=>true,
            'has_archive'=>true,
            'show_ui'=>true,
            'supports'=>array('title','editor','thumbnail','custom-fields','excerpt'),
            'menu_icon'=>'dashicons-car',
        ));
    }
    add_action('init','kishharmony_register_cpts');
}
