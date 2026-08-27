<?php
// template-parts/gallery.php
?>
<section class="gallery-section">
    <h2 class="gallery-title" style="text-align:center;font-size:24px;color:#0a3144;margin-bottom:16px;">گالری تصاویر کیش هارمونی</h2>
    <div class="gallery-grid" id="galleryGrid" style="display:grid;grid-template-columns:repeat(2,1fr);gap:14px;max-width:900px;margin:0 auto;">
        <?php
        // show some placeholder images for demo
        $images = array(
            'https://via.placeholder.com/800x600.png?text=Gallery+1',
            'https://via.placeholder.com/800x600.png?text=Gallery+2',
            'https://via.placeholder.com/800x600.png?text=Gallery+3',
            'https://via.placeholder.com/800x600.png?text=Gallery+4',
            'https://via.placeholder.com/800x600.png?text=Gallery+5',
            'https://via.placeholder.com/800x600.png?text=Gallery+6',
        );
        foreach($images as $idx=>$img){
            echo '<div class="gallery-item" style="position:relative;border-radius:12px;overflow:hidden;box-shadow:0 4px 10px rgba(0,0,0,0.08);cursor:pointer;background:#e0e6ed;">';
            echo '<img src="'.esc_url($img).'" alt="image-'.intval($idx).'" loading="lazy" style="width:100%;height:auto;display:block;opacity:1;"/>';
            echo '</div>';
        }
        ?>
    </div>
    <p class="share-text" style="text-align:center;margin-top:12px;color:#2f4f6e;font-style:italic;">📸 عکس‌هایتان را با ما به اشتراک بگذارین</p>

    <!-- simple lightbox markup -->
    <div class="lightbox" id="lightbox" style="position:fixed;inset:0;display:none;align-items:center;justify-content:center;background:rgba(0,0,0,0.92);z-index:9999;">
        <button id="lightboxClose" style="position:absolute;top:20px;right:30px;font-size:32px;color:#fff;background:none;border:none;">&times;</button>
        <button id="lightboxPrev" style="position:absolute;left:20px;top:50%;transform:translateY(-50%);font-size:28px;color:#fff;background:rgba(0,0,0,0.5);border:none;border-radius:50%;width:60px;height:60px;">&#8249;</button>
        <button id="lightboxNext" style="position:absolute;right:20px;top:50%;transform:translateY(-50%);font-size:28px;color:#fff;background:rgba(0,0,0,0.5);border:none;border-radius:50%;width:60px;height:60px;">&#8250;</button>
        <div class="lightbox__content-wrapper" style="max-width:90%;max-height:85vh;">
            <img id="lightboxImage" src="" alt="" style="max-width:100%;max-height:85vh;border-radius:6px;"/>
        </div>
        <div id="lightboxCounter" style="position:absolute;bottom:30px;left:50%;transform:translateX(-50%);color:rgba(255,255,255,0.8);background:rgba(0,0,0,0.5);padding:6px 18px;border-radius:20px;">0 / 0</div>
    </div>

    <script>
    (function(){
        const grid = document.getElementById('galleryGrid');
        const items = Array.from(grid.querySelectorAll('.gallery-item'));
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightboxImage');
        const lightboxClose = document.getElementById('lightboxClose');
        const lightboxPrev = document.getElementById('lightboxPrev');
        const lightboxNext = document.getElementById('lightboxNext');
        const lightboxCounter = document.getElementById('lightboxCounter');
        let current = 0;
        function open(idx){
            const img = items[idx].querySelector('img');
            lightboxImage.src = img.src;
            lightbox.style.display = 'flex';
            current = idx; updateCounter(); document.body.style.overflow='hidden';
        }
        function close(){ lightbox.style.display='none'; document.body.style.overflow=''; }
        function prev(){ current = (current-1+items.length)%items.length; lightboxImage.src = items[current].querySelector('img').src; updateCounter(); }
        function next(){ current = (current+1)%items.length; lightboxImage.src = items[current].querySelector('img').src; updateCounter(); }
        function updateCounter(){ lightboxCounter.textContent = (current+1) + ' / ' + items.length; }
        grid.addEventListener('click', function(e){ const item = e.target.closest('.gallery-item'); if(!item) return; const idx = items.indexOf(item); if(idx>-1) open(idx); });
        lightboxClose.addEventListener('click', close);
        lightboxPrev.addEventListener('click', prev);
        lightboxNext.addEventListener('click', next);
        document.addEventListener('keydown', function(e){ if(lightbox.style.display==='flex'){ if(e.key==='Escape') close(); if(e.key==='ArrowLeft') prev(); if(e.key==='ArrowRight') next(); }});
    })();
    </script>

</section>
