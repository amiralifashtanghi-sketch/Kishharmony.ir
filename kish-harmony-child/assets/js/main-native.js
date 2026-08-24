/**
 * Kish Harmony Native JS Engine
 * Strictly incorporating the provided IIFE Floating Logo scroll animation & gallery load handling
 */

(function() {
    document.addEventListener('DOMContentLoaded', function() {
        const header = document.getElementById('header');
        const floatingLogo = document.getElementById('floatingLogo');
        const banner = document.getElementById('banner');

        if (header && floatingLogo && banner) {
            const logoIcon = floatingLogo.querySelector('.logo-icon');
            const logoText = floatingLogo.querySelector('.logo-text');

            const SMALL_ICON_SIZE = 36;
            const SMALL_TEXT_SIZE_REM = 1.3;
            const LARGE_ICON_SIZE = 56;
            const LARGE_TEXT_SIZE_REM = 2.2;

            let bannerCenterY, headerCenterY;
            let ticking = false;

            function easeInOutCubic(t) {
                return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
            }

            function updatePositions() {
                const bannerRect = banner.getBoundingClientRect();
                bannerCenterY = bannerRect.top + bannerRect.height / 2;

                const width = window.innerWidth;
                let scrolledTop, scrolledHeight;
                if (width <= 480) {
                    scrolledTop = 6;
                    scrolledHeight = 52;
                } else if (width <= 768) {
                    scrolledTop = 8;
                    scrolledHeight = 52;
                } else {
                    scrolledTop = 14;
                    scrolledHeight = 58;
                }
                headerCenterY = scrolledTop + scrolledHeight / 2;

                if (window.scrollY <= 10) {
                    floatingLogo.style.top = (bannerRect.top + bannerRect.height / 2) + 'px';
                }
            }

            function getScrollProgress() {
                const maxScroll = 200;
                const raw = Math.min(window.scrollY / maxScroll, 1.0);
                return easeInOutCubic(raw);
            }

            function updateLogo(progress) {
                const bannerRect = banner.getBoundingClientRect();
                const currentBannerCenterY = bannerRect.top + bannerRect.height / 2;
                const currentY = currentBannerCenterY + (headerCenterY - currentBannerCenterY) * progress;
                floatingLogo.style.top = currentY + 'px';

                const iconSize = LARGE_ICON_SIZE + (SMALL_ICON_SIZE - LARGE_ICON_SIZE) * progress;
                const textSizeRem = LARGE_TEXT_SIZE_REM + (SMALL_TEXT_SIZE_REM - LARGE_TEXT_SIZE_REM) * progress;

                if (logoIcon) {
                    logoIcon.style.width = iconSize + 'px';
                    logoIcon.style.height = iconSize + 'px';
                    logoIcon.style.fontSize = (iconSize * 0.55) + 'px';
                    const borderRadius = 18 + (12 - 18) * progress;
                    logoIcon.style.borderRadius = borderRadius + 'px';
                }
                if (logoText) {
                    logoText.style.fontSize = textSizeRem + 'rem';
                }

                floatingLogo.style.color = progress > 0.8 ? '#1e1e2f' : 'white';
            }

            function onScroll() {
                if (window.scrollY > 10) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }

                if (!ticking) {
                    requestAnimationFrame(() => {
                        const progress = getScrollProgress();
                        updateLogo(progress);
                        ticking = false;
                    });
                    ticking = true;
                }
            }

            window.addEventListener('scroll', onScroll, { passive: true });
            window.addEventListener('resize', () => {
                updatePositions();
                const progress = getScrollProgress();
                updateLogo(progress);
            });

            updatePositions();
            updateLogo(0);
            window.addEventListener('load', () => {
                updatePositions();
                updateLogo(getScrollProgress());
            });
        }

        // Mobile Menu Drawer Controls
        const hamburgerBtn = document.getElementById('hamburgerBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const closeMobileMenuBtn = document.getElementById('closeMobileMenu');

        if (hamburgerBtn) {
            hamburgerBtn.addEventListener('click', () => {
                if (mobileMenu) mobileMenu.classList.add('active');
                if (mobileMenuOverlay) mobileMenuOverlay.classList.add('active');
            });
        }
        function closeMobileMenu() {
            if (mobileMenu) mobileMenu.classList.remove('active');
            if (mobileMenuOverlay) mobileMenuOverlay.classList.remove('active');
        }
        if (closeMobileMenuBtn) closeMobileMenuBtn.addEventListener('click', closeMobileMenu);
        if (mobileMenuOverlay) mobileMenuOverlay.addEventListener('click', closeMobileMenu);

        // Cart Drawer Controls
        const cartIcon = document.getElementById('cartIcon');
        const cartPanel = document.getElementById('cartPanel');
        const cartPanelOverlay = document.getElementById('cartPanelOverlay');
        const closeCartPanelBtn = document.getElementById('closeCartPanel');

        if (cartIcon) {
            cartIcon.addEventListener('click', (e) => {
                e.preventDefault();
                if (cartPanel) cartPanel.classList.add('active');
                if (cartPanelOverlay) cartPanelOverlay.classList.add('active');
            });
        }
        function closeCartPanel() {
            if (cartPanel) cartPanel.classList.remove('active');
            if (cartPanelOverlay) cartPanelOverlay.classList.remove('active');
        }
        if (closeCartPanelBtn) closeCartPanelBtn.addEventListener('click', closeCartPanel);
        if (cartPanelOverlay) cartPanelOverlay.addEventListener('click', closeCartPanel);

        // Photo Gallery Load & Lightbox Logic
        const galleryImages = document.querySelectorAll('.gallery-item img');
        galleryImages.forEach(img => {
            const item = img.closest('.gallery-item');
            function revealImg() {
                img.style.opacity = '1';
                img.classList.remove('opacity-0');
                if (item) item.classList.add('loaded');
            }
            if (img.complete) {
                revealImg();
            } else {
                img.addEventListener('load', revealImg);
                img.addEventListener('error', revealImg);
            }
        });

        const galleryGrid = document.getElementById('galleryGrid');
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightboxImage');
        const lightboxClose = document.getElementById('lightboxClose');
        const lightboxPrev = document.getElementById('lightboxPrev');
        const lightboxNext = document.getElementById('lightboxNext');
        const lightboxCounter = document.getElementById('lightboxCounter');

        if (galleryGrid && lightbox) {
            const items = Array.from(galleryGrid.querySelectorAll('.gallery-item'));
            let galleryIndex = 0;

            function showLightboxImg(idx) {
                if (idx < 0) idx = items.length - 1;
                if (idx >= items.length) idx = 0;
                galleryIndex = idx;

                const targetImg = items[galleryIndex].querySelector('img');
                if (targetImg && lightboxImage) {
                    lightboxImage.src = targetImg.src;
                    lightboxImage.alt = targetImg.alt;
                }
                if (lightboxCounter) {
                    lightboxCounter.textContent = `${galleryIndex + 1} / ${items.length}`;
                }
            }

            galleryGrid.addEventListener('click', (e) => {
                const item = e.target.closest('.gallery-item');
                if (!item) return;
                galleryIndex = items.indexOf(item);
                showLightboxImg(galleryIndex);
                lightbox.classList.add('active');
                lightbox.style.opacity = '1';
                lightbox.style.visibility = 'visible';
            });

            function closeLb() {
                lightbox.classList.remove('active');
                lightbox.style.opacity = '0';
                lightbox.style.visibility = 'hidden';
            }

            if (lightboxClose) lightboxClose.addEventListener('click', closeLb);
            if (lightboxPrev) lightboxPrev.addEventListener('click', () => showLightboxImg(galleryIndex - 1));
            if (lightboxNext) lightboxNext.addEventListener('click', () => showLightboxImg(galleryIndex + 1));
        }

        // Open-Meteo Weather Fetcher
        const tempEl = document.getElementById('wt-temp');
        if (tempEl) {
            fetch('https://api.open-meteo.com/v1/forecast?latitude=26.5578&longitude=53.9747&current_weather=true')
                .then(res => res.json())
                .then(data => {
                    if (data && data.current_weather) {
                        tempEl.textContent = Math.round(data.current_weather.temperature) + '°C';
                    }
                })
                .catch(() => {});
        }
    });
})();
