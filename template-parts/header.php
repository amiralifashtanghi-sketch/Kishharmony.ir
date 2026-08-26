<?php
// template-parts/header.php - minimal header part
?>
<div class="site-header">
    <div class="site-branding">
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    </div>
    <nav class="site-navigation">
        <?php wp_nav_menu(array('theme_location'=>'header_menu')); ?>
    </nav>
    <div class="user-link">
        <?php $account_url = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : site_url('/my-account/'); ?>
        <a href="<?php echo esc_url($account_url); ?>">حساب کاربری</a>
    </div>
</div>
