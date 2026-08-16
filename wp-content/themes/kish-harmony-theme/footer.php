</div> <!-- #root -->

<?php
$has_designer = class_exists('\KishHarmonyDesigner\Helpers');
$settings = $has_designer ? \KishHarmonyDesigner\Helpers::get_settings() : array();
$category_items = $settings['category_items'] ?? array();

$category_popups = array();
foreach ($category_items as $item) {
    if (($item['behavior'] ?? 'redirect') === 'popup') {
        $category_popups[$item['id']] = do_shortcode($item['popup_html'] ?? '');
    }
}
?>

<!-- Modern Glassmorphic Popup Modal for AJAX Categories -->
<div id="khd-ajax-modal" class="khd-modal-overlay fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md opacity-0 pointer-events-none transition-all duration-300">
    <div class="khd-modal-card relative bg-white rounded-3xl shadow-2xl border border-slate-100 max-w-lg w-full overflow-hidden transform scale-95 transition-all duration-300" id="khd-modal-card">
        <!-- Modal Header -->
        <div class="khd-modal-header flex items-center justify-between p-5 border-b border-slate-100 bg-slate-50/50">
            <h3 class="khd-modal-title text-lg font-black text-slate-800" id="khd-modal-title">عنوان پاپ‌آپ</h3>
            <button id="khd-modal-close-btn" class="khd-modal-close w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-700 flex items-center justify-center transition-all cursor-pointer">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>
        <!-- Modal Content -->
        <div class="khd-modal-body p-6 text-sm text-slate-600 leading-relaxed custom-scrollbar max-h-[70vh] overflow-y-auto" id="khd-modal-body">
            <!-- Dynamic Content -->
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const popupData = <?php echo json_encode($category_popups); ?>;
    const modal = document.getElementById('khd-ajax-modal');
    const card = document.getElementById('khd-modal-card');
    const mTitle = document.getElementById('khd-modal-title');
    const mBody = document.getElementById('khd-modal-body');
    const closeBtn = document.getElementById('khd-modal-close-btn');

    if (!modal) return;

    // Click handler for popup categories
    document.addEventListener('click', function(e) {
        const trigger = e.target.closest('.khd-trigger-popup-btn');
        if (trigger) {
            e.preventDefault();
            const id = trigger.getAttribute('data-id');
            const label = trigger.getAttribute('data-label');

            if (popupData && id in popupData) {
                mTitle.textContent = label || 'جزئیات دسته‌بندی';
                mBody.innerHTML = popupData[id] || '<p class="text-center text-slate-400">محتوایی برای نمایش وجود ندارد.</p>';

                // Show modal with animation
                modal.classList.remove('opacity-0', 'pointer-events-none');
                modal.classList.add('khd-modal-active');
                if (card) {
                    card.classList.remove('scale-95');
                    card.classList.add('scale-100');
                }
            }
        }
    });

    // Close Modal helper
    function closeModal() {
        modal.classList.add('opacity-0', 'pointer-events-none');
        modal.classList.remove('khd-modal-active');
        if (card) {
            card.classList.remove('scale-100');
            card.classList.add('scale-95');
        }
    }

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Close on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
});
</script>

<?php wp_footer(); ?>
</body>
</html>
