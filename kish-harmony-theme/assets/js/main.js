/**
 * Kish Harmony WordPress Theme JS
 */
document.addEventListener('DOMContentLoaded', function() {
    console.log('Kish Harmony WordPress Theme JS initialized');

    // Mobile Drawer Logic
    var mobileBtn = document.getElementById('mobile-menu-btn');
    var mobileDrawer = document.getElementById('mobile-drawer');
    var closeDrawerBtn = document.getElementById('close-drawer-btn');

    if (mobileBtn && mobileDrawer) {
        mobileBtn.addEventListener('click', function() {
            mobileDrawer.classList.remove('hidden');
            setTimeout(function() {
                mobileDrawer.classList.remove('opacity-0');
            }, 10);
        });
    }

    if (closeDrawerBtn && mobileDrawer) {
        closeDrawerBtn.addEventListener('click', function() {
            mobileDrawer.classList.add('opacity-0');
            setTimeout(function() {
                mobileDrawer.classList.add('hidden');
            }, 300);
        });
    }

    // Reservation Modal Logic
    var reserveButtons = document.querySelectorAll('.btn-reserve');
    var bookingModal = document.getElementById('booking-modal');
    var closeModalBtn = document.getElementById('close-modal-btn');
    var reservationForm = document.getElementById('reservation-form');

    reserveButtons.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            if (bookingModal) {
                bookingModal.classList.remove('hidden');
                setTimeout(function() {
                    bookingModal.classList.remove('opacity-0');
                }, 10);
            }
        });
    });

    if (closeModalBtn && bookingModal) {
        closeModalBtn.addEventListener('click', function() {
            bookingModal.classList.add('opacity-0');
            setTimeout(function() {
                bookingModal.classList.add('hidden');
            }, 300);
        });
    }

    if (reservationForm) {
        reservationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('درخواست رزرو شما با موفقیت ثبت شد! کارشناسان کیش هارمونی به زودی با شما تماس خواهند گرفت.');
            if (bookingModal) {
                bookingModal.classList.add('opacity-0');
                setTimeout(function() {
                    bookingModal.classList.add('hidden');
                }, 300);
            }
        });
    }

    // Cart Button Logic
    var cartBtn = document.getElementById('cart-toggle-btn');
    if (cartBtn) {
        cartBtn.addEventListener('click', function() {
            alert('سبد رزروهای شما در حال حاضر خالی است. برای افزودن، روی کلید رزرو هر خدمت کلیک کنید.');
        });
    }
});
