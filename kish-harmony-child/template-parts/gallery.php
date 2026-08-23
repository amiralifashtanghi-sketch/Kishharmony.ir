<?php
/**
 * Module 6: Photo Gallery & Lightbox
 */

$gallery_title = kishharmony_get_option('gallery_title', 'گالری تصاویر کیش هارمونی');
$share_text    = kishharmony_get_option('gallery_share_text', '📸 عکس‌هایتان را با ما به اشتراک بگذارین');
$raw_images    = kishharmony_get_option('gallery_images', "https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80\nhttps://images.unsplash.com/photo-1580273916550-e323be2ae537?auto=format&fit=crop&w=800&q=80\nhttps://images.unsplash.com/photo-1569263979104-865ab7cd8d13?auto=format&fit=crop&w=800&q=80\nhttps://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80");

$images_list = array_filter(array_map('trim', explode("\n", $raw_images)));
if (empty($images_list)) {
    $images_list = array('https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80');
}
?>

<section class="gallery-section max-w-[900px] mx-auto my-12 px-4 text-center">
    <h2 class="gallery-title text-2xl font-bold text-[#0a3144] mb-6"><?php echo esc_html($gallery_title); ?></h2>

    <div class="gallery-grid grid grid-cols-2 gap-3.5 mb-6" id="galleryGrid">
        <?php foreach ($images_list as $img_url) : ?>
            <div class="gallery-item relative rounded-xl overflow-hidden cursor-pointer shadow-sm bg-[#e0e6ed] transition-transform duration-300 hover:scale-[1.02]">
                <img src="<?php echo esc_url($img_url); ?>" alt="تصویر کیش هارمونی" loading="lazy" class="w-full h-auto block opacity-0 transition-opacity duration-500 relative z-10">
            </div>
        <?php endforeach; ?>
    </div>

    <p class="share-text text-base text-[#2f4f6e] italic mt-2"><?php echo esc_html($share_text); ?></p>
</section>

<!-- Lightbox Element -->
<div class="lightbox fixed inset-0 bg-black/92 z-[2000] flex flex-col justify-center items-center opacity-0 visibility-hidden transition-all duration-350 touch-none" id="lightbox">
    <button class="lightbox__close absolute top-5 right-8 text-4xl text-white bg-none border-none cursor-pointer z-[2002]" id="lightboxClose">&times;</button>
    <button class="lightbox__nav lightbox__prev absolute left-5 top-1/2 -translate-y-1/2 text-3xl text-white bg-black/50 backdrop-blur-md border border-white/30 w-14 h-14 rounded-full flex items-center justify-center cursor-pointer z-[2001]" id="lightboxPrev">&#8249;</button>
    <button class="lightbox__nav lightbox__next absolute right-5 top-1/2 -translate-y-1/2 text-3xl text-white bg-black/50 backdrop-blur-md border border-white/30 w-14 h-14 rounded-full flex items-center justify-center cursor-pointer z-[2001]" id="lightboxNext">&#8250;</button>
    <div class="lightbox__content-wrapper max-w-[90%] max-h-[85vh] relative flex items-center justify-center">
        <img class="lightbox__image max-w-full max-h-[85vh] object-contain rounded-lg transition-opacity duration-250" id="lightboxImage" src="" alt="">
    </div>
    <div class="lightbox__counter absolute bottom-8 left-1/2 -translate-x-1/2 text-white/80 bg-black/50 backdrop-blur-md px-4 py-1.5 rounded-full text-sm z-[2001]" id="lightboxCounter"></div>
</div>
