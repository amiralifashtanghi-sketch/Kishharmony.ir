<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>کیش هارمونی | سامانه جامع رزرو تفریحات و اجاره خودرو در کیش</title>

    <!-- Tailwind CSS CDN Engine -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ['Vazirmatn', 'sans-serif'],
            },
            colors: {
              brand: {
                blue: '#0B63D8',
                cyan: '#18D6D8',
                orange: '#FF8A00',
                dark: '#071E3D',
              }
            }
          }
        }
      }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <?php wp_head(); ?>
    <style>
        body { font-family: 'Vazirmatn', sans-serif !important; direction: rtl; text-align: right; background-color: #f8fafc; }
        .custom-scrollbar::-webkit-scrollbar { height: 6px; width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #18D6D8; border-radius: 10px; }
    </style>
</head>
<body <?php body_class('bg-slate-50 font-sans text-slate-800 antialiased selection:bg-[#18D6D8] selection:text-slate-900'); ?>>
<?php wp_body_open(); ?>

<!-- React Root Container - Mounted automatically by app-bundle.js -->
<div id="root">
