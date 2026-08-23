/**
 * Kish Harmony Native JS Engine
 */

document.addEventListener('DOMContentLoaded', function() {
    // 1. Floating Logo Animation & Header Scroll
    const header = document.getElementById('header');
    const floatingLogo = document.getElementById('floatingLogo');
    const banner = document.getElementById('banner');
    const logoIcon = floatingLogo ? floatingLogo.querySelector('.logo-icon') : null;
    const logoText = floatingLogo ? floatingLogo.querySelector('.logo-text') : null;

    let bannerCenterY = 0;
    let headerCenterY = 0;

    function updatePositions() {
        if (!banner || !floatingLogo) return;
        const bannerRect = banner.getBoundingClientRect();
        bannerCenterY = window.scrollY + bannerRect.top + bannerRect.height / 2;

        const width = window.innerWidth;
        let scrolledTop = 14;
        let scrolledHeight = 58;
        if (width <= 480) {
            scrolledTop = 6;
            scrolledHeight = 52;
        } else if (width <= 768) {
            scrolledTop = 8;
            scrolledHeight = 52;
        }
        headerCenterY = scrolledTop + scrolledHeight / 2;

        if (window.scrollY <= 10) {
            floatingLogo.style.top = bannerCenterY + 'px';
        }
    }

    function easeInOutCubic(t) {
        return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
    }

    function getScrollProgress() {
        const maxScroll = 200;
        const raw = Math.min(window.scrollY / maxScroll, 1.0);
        return easeInOutCubic(raw);
    }

    function updateLogo(progress) {
        if (!floatingLogo || !logoIcon || !logoText) return;
        const currentY = bannerCenterY + (headerCenterY - bannerCenterY) * progress - window.scrollY;
        floatingLogo.style.top = currentY + 'px';

        const iconSize = 56 + (36 - 56) * progress;
        const textSizeRem = 2.2 + (1.3 - 2.2) * progress;

        logoIcon.style.width = iconSize + 'px';
        logoIcon.style.height = iconSize + 'px';
        logoIcon.style.fontSize = (iconSize * 0.55) + 'px';
        logoText.style.fontSize = textSizeRem + 'rem';

        floatingLogo.style.color = progress > 0.8 ? '#1e1e2f' : 'white';
        logoIcon.style.borderRadius = (18 + (12 - 18) * progress) + 'px';
    }

    let ticking = false;
    function onScroll() {
        if (header) {
            if (window.scrollY > 10) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
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
        updateLogo(getScrollProgress());
    });

    updatePositions();
    if (floatingLogo) updateLogo(0);

    // 2. Mobile Menu & Accordion Engine
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    const closeMobileMenuBtn = document.getElementById('closeMobileMenu');

    function openMobileMenu() {
        if (mobileMenu) mobileMenu.classList.add('active');
        if (mobileMenuOverlay) mobileMenuOverlay.classList.add('active');
        if (hamburgerBtn) hamburgerBtn.classList.add('active');
    }

    function closeMobileMenu() {
        if (mobileMenu) mobileMenu.classList.remove('active');
        if (mobileMenuOverlay) mobileMenuOverlay.classList.remove('active');
        if (hamburgerBtn) hamburgerBtn.classList.remove('active');
    }

    if (hamburgerBtn) hamburgerBtn.addEventListener('click', openMobileMenu);
    if (closeMobileMenuBtn) closeMobileMenuBtn.addEventListener('click', closeMobileMenu);
    if (mobileMenuOverlay) mobileMenuOverlay.addEventListener('click', closeMobileMenu);

    // Submenu Toggle for Mobile Nav
    const mobileMenuItems = document.querySelectorAll('.mobile-nav .menu-item-has-children');
    mobileMenuItems.forEach(item => {
        const toggleBtn = document.createElement('button');
        toggleBtn.className = 'submenu-toggle';
        toggleBtn.innerHTML = '▼';
        toggleBtn.setAttribute('type', 'button');

        const mainLink = item.querySelector(':scope > a');
        if (mainLink) mainLink.after(toggleBtn);

        const subMenu = item.querySelector(':scope > .sub-menu');
        toggleBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            toggleBtn.classList.toggle('active');
            if (subMenu) subMenu.classList.toggle('open');
        });
    });

    // 3. WooCommerce Slide-out Cart Drawer
    const cartIcon = document.getElementById('cartIcon');
    const cartPanel = document.getElementById('cartPanel');
    const cartPanelOverlay = document.getElementById('cartPanelOverlay');
    const closeCartPanelBtn = document.getElementById('closeCartPanel');

    function openCartPanel() {
        if (cartPanel) cartPanel.classList.add('active');
        if (cartPanelOverlay) cartPanelOverlay.classList.add('active');
    }

    function closeCartPanel() {
        if (cartPanel) cartPanel.classList.remove('active');
        if (cartPanelOverlay) cartPanelOverlay.classList.remove('active');
    }

    if (cartIcon) {
        cartIcon.addEventListener('click', (e) => {
            e.preventDefault();
            openCartPanel();
        });
    }
    if (closeCartPanelBtn) closeCartPanelBtn.addEventListener('click', closeCartPanel);
    if (cartPanelOverlay) cartPanelOverlay.addEventListener('click', closeCartPanel);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeMobileMenu();
            closeCartPanel();
        }
    });

    // 4. Banner Slider Engine
    const sliderContainer = document.getElementById('heroSlider');
    const sliderTrack = document.getElementById('sliderTrack');
    const slides = sliderTrack ? sliderTrack.children : [];
    const prevBtn = document.getElementById('sliderPrev');
    const nextBtn = document.getElementById('sliderNext');
    const dotsContainer = document.getElementById('sliderDots');

    if (sliderContainer && sliderTrack && slides.length > 0) {
        let currentIndex = 0;
        const totalSlides = slides.length;
        const intervalTime = parseInt(sliderContainer.getAttribute('data-interval')) || 4000;
        let autoInterval = null;

        function goToSlide(index) {
            if (index < 0) index = totalSlides - 1;
            if (index >= totalSlides) index = 0;
            currentIndex = index;

            sliderTrack.style.transform = `translateX(${currentIndex * 100}%)`;

            if (dotsContainer) {
                const dots = dotsContainer.children;
                for (let i = 0; i < dots.length; i++) {
                    if (i === currentIndex) {
                        dots[i].classList.add('bg-white', 'w-6');
                        dots[i].classList.remove('bg-white/50');
                    } else {
                        dots[i].classList.remove('bg-white', 'w-6');
                        dots[i].classList.add('bg-white/50');
                    }
                }
            }
        }

        function resetAuto() {
            if (autoInterval) clearInterval(autoInterval);
            autoInterval = setInterval(() => {
                goToSlide(currentIndex + 1);
            }, intervalTime);
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                goToSlide(currentIndex - 1);
                resetAuto();
            });
        }
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                goToSlide(currentIndex + 1);
                resetAuto();
            });
        }

        sliderContainer.addEventListener('mouseenter', () => clearInterval(autoInterval));
        sliderContainer.addEventListener('mouseleave', resetAuto);

        resetAuto();
    }

    // 5. Photo Gallery & Lightbox Engine
    const galleryImages = document.querySelectorAll('.gallery-item img');
    galleryImages.forEach(img => {
        const item = img.closest('.gallery-item');
        if (img.complete) {
            img.style.opacity = '1';
            if (item) item.classList.add('loaded');
        } else {
            img.addEventListener('load', () => {
                img.style.opacity = '1';
                if (item) item.classList.add('loaded');
            });
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

    // 6. Open-Meteo Weather API Fetcher
    const tempEl = document.getElementById('wt-temp');
    const windEl = document.getElementById('wt-wind');

    if (tempEl) {
        fetch('https://api.open-meteo.com/v1/forecast?latitude=26.5578&longitude=53.9747&current_weather=true')
            .then(res => res.json())
            .then(data => {
                if (data && data.current_weather) {
                    tempEl.textContent = Math.round(data.current_weather.temperature) + '°C';
                    if (windEl) windEl.textContent = Math.round(data.current_weather.windspeed) + ' km/h';
                }
            })
            .catch(() => {});
    }
});
