<?php
/**
 * Module 6: Photo Gallery & Lightbox
 * Strictly implemented based on "ظاهر گالری تصاو.txt"
 */

$gallery_title = kishharmony_get_option('gallery_title', 'گالری تصاویر کیش هارمونی');
$share_text    = kishharmony_get_option('gallery_share_text', '📸 عکس‌هایتان را با ما به اشتراک بگذارین');
$raw_images    = kishharmony_get_option('gallery_images', "https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80\nhttps://images.unsplash.com/photo-1580273916550-e323be2ae537?auto=format&fit=crop&w=800&q=80\nhttps://images.unsplash.com/photo-1569263979104-865ab7cd8d13?auto=format&fit=crop&w=800&q=80\nhttps://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80");

$images_list = array_filter(array_map('trim', explode("\n", $raw_images)));
if (empty($images_list)) {
    $images_list = array(
        'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1580273916550-e323be2ae537?auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1569263979104-865ab7cd8d13?auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80',
    );
}
?>

<!-- Gallery Section Container (max-width: 900px, 2 columns grid) -->
<section class="gallery-section max-w-[900px] mx-auto my-[40px] px-5 text-center">
    <h2 class="gallery-title text-[2rem] text-[#0a3144] mb-5 font-bold"><?php echo esc_html($gallery_title); ?></h2>

    <!-- Permanent 2-Column Grid -->
    <div class="gallery-grid grid grid-cols-2 gap-[14px] mb-[25px]" id="galleryGrid">
        <?php foreach ($images_list as $img_url) : ?>
            <div class="gallery-item relative rounded-[12px] overflow-hidden cursor-pointer shadow-[0_4px_10px_rgba(0,0,0,0.08)] bg-[#e0e6ed] transition-transform duration-300 hover:scale-[1.02]">
                <img src="<?php echo esc_url($img_url); ?>" alt="تصویر کیش هارمونی" loading="lazy" class="w-full h-auto block opacity-0 transition-opacity duration-500 relative z-10">
            </div>
        <?php endforeach; ?>
    </div>

    <p class="share-text text-[1.1rem] text-[#2f4f6e] mt-[10px] italic"><?php echo esc_html($share_text); ?></p>
</section>

<!-- Lightbox Modal -->
<div class="lightbox fixed inset-0 bg-black/92 z-[3000] flex flex-col justify-center items-center opacity-0 visibility-hidden transition-all duration-350 touch-none" id="lightbox">
    <button class="lightbox__close absolute top-5 right-[30px] text-[3rem] text-white bg-none border-none cursor-pointer z-[1002] transition-transform hover:scale-125" id="lightboxClose">&times;</button>
    <button class="lightbox__nav lightbox__prev absolute left-5 top-1/2 -translate-y-1/2 text-[2.8rem] text-white bg-black/50 backdrop-blur-[10px] border-2 border-white/30 w-[60px] h-[60px] rounded-full flex items-center justify-center cursor-pointer z-[1001] shadow-lg transition-all" id="lightboxPrev">&#8249;</button>
    <button class="lightbox__nav lightbox__next absolute right-5 top-1/2 -translate-y-1/2 text-[2.8rem] text-white bg-black/50 backdrop-blur-[10px] border-2 border-white/30 w-[60px] h-[60px] rounded-full flex items-center justify-center cursor-pointer z-[1001] shadow-lg transition-all" id="lightboxNext">&#8250;</button>

    <div class="lightbox__content-wrapper max-w-[90%] max-h-[85vh] relative flex items-center justify-center">
        <img class="lightbox__image max-w-full max-h-[85vh] object-contain rounded-[6px] transition-opacity duration-250" id="lightboxImage" src="" alt="">
    </div>

    <div class="lightbox__counter absolute bottom-[30px] left-1/2 -translate-x-1/2 text-white/80 bg-black/50 backdrop-blur-[10px] px-[18px] py-[6px] rounded-[20px] text-[0.95rem] z-[1001]" id="lightboxCounter"></div>
</div>
