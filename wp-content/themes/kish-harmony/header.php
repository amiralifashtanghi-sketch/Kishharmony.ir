<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-slate-50 font-sans text-slate-800 antialiased selection:bg-[#18D6D8] selection:text-slate-900'); ?>>
<?php wp_body_open(); ?>

<?php get_template_part('parts/section-header'); ?>
