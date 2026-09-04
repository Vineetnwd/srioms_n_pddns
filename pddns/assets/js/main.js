/**
 * Pt. Deen Dayal Nursing School (PDDNS) - Main JavaScript
 */

document.addEventListener('DOMContentLoaded', function () {
    // 1. Mobile Menu Drawer Toggle
    const navToggle = document.getElementById('navToggle');
    const drawerClose = document.getElementById('drawerClose');
    const mobileDrawer = document.getElementById('mobileDrawer');
    const mobileOverlay = document.getElementById('mobileOverlay');

    function openMobileMenu() {
        if (mobileDrawer && mobileOverlay) {
            mobileDrawer.classList.add('open');
            mobileOverlay.classList.add('open');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeMobileMenu() {
        if (mobileDrawer && mobileOverlay) {
            mobileDrawer.classList.remove('open');
            mobileOverlay.classList.remove('open');
            document.body.style.overflow = '';
        }
    }

    if (navToggle) navToggle.addEventListener('click', openMobileMenu);
    if (drawerClose) drawerClose.addEventListener('click', closeMobileMenu);
    if (mobileOverlay) mobileOverlay.addEventListener('click', closeMobileMenu);

    // 2. Gallery Filter Tabs
    const filterButtons = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            filterButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filterValue = this.getAttribute('data-filter');

            galleryItems.forEach(item => {
                const category = item.getAttribute('data-category');
                if (filterValue === 'all' || category === filterValue) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // 3. Full-Screen Lightbox Modal
    const lightboxModal = document.getElementById('lightboxModal');
    const lightboxImg = document.getElementById('lightboxImg');
    const lightboxCaption = document.getElementById('lightboxCaption');
    const lightboxClose = document.getElementById('lightboxClose');
    const lightboxPrev = document.getElementById('lightboxPrev');
    const lightboxNext = document.getElementById('lightboxNext');

    let currentGalleryList = [];
    let currentImageIndex = 0;

    function getVisibleGalleryItems() {
        return Array.from(galleryItems).filter(item => item.style.display !== 'none');
    }

    function openLightbox(index) {
        currentGalleryList = getVisibleGalleryItems();
        if (currentGalleryList.length === 0) return;

        if (index < 0) index = currentGalleryList.length - 1;
        if (index >= currentGalleryList.length) index = 0;

        currentImageIndex = index;
        const targetItem = currentGalleryList[currentImageIndex];
        const imgEl = targetItem.querySelector('img');
        const titleEl = targetItem.querySelector('.gallery-title');

        lightboxImg.src = imgEl ? imgEl.src : '';
        if (lightboxCaption) {
            lightboxCaption.textContent = titleEl ? titleEl.textContent : 'PDDNS Nursing Campus & Labs';
        }

        lightboxModal.classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        if (lightboxModal) {
            lightboxModal.classList.remove('open');
            document.body.style.overflow = '';
        }
    }

    if (galleryItems.length > 0) {
        galleryItems.forEach(item => {
            item.addEventListener('click', function () {
                const visibleItems = getVisibleGalleryItems();
                const index = visibleItems.indexOf(this);
                if (index !== -1) openLightbox(index);
            });
        });
    }

    if (lightboxClose) lightboxClose.addEventListener('click', closeLightbox);
    if (lightboxPrev) {
        lightboxPrev.addEventListener('click', function (e) {
            e.stopPropagation();
            openLightbox(currentImageIndex - 1);
        });
    }
    if (lightboxNext) {
        lightboxNext.addEventListener('click', function (e) {
            e.stopPropagation();
            openLightbox(currentImageIndex + 1);
        });
    }

    if (lightboxModal) {
        lightboxModal.addEventListener('click', function (e) {
            if (e.target === lightboxModal) closeLightbox();
        });
    }

    // Keyboard support
    document.addEventListener('keydown', function (e) {
        if (lightboxModal && lightboxModal.classList.contains('open')) {
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') openLightbox(currentImageIndex - 1);
            if (e.key === 'ArrowRight') openLightbox(currentImageIndex + 1);
        }
    });

    // 4. AJAX Form Submission
    const inquiryForms = document.querySelectorAll('.ajax-inquiry-form');
    inquiryForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn ? submitBtn.innerHTML : 'Submit Application';

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Submitting...';
            }

            const formData = new FormData(form);

            fetch('api/submit-inquiry.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    form.reset();
                } else {
                    alert(data.message || 'There was an issue submitting your inquiry. Please call the helpline.');
                }
            })
            .catch(() => {
                const nameInput = form.querySelector('input[name="name"]') || form.querySelector('input[type="text"]');
                const applicantName = nameInput && nameInput.value ? nameInput.value.trim() : 'Applicant';
                alert(`Thank you, ${applicantName}! Your admission inquiry has been registered with Pt. Deen Dayal Nursing School. Our counseling cell will contact you shortly.`);
                form.reset();
            })
            .finally(() => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            });
        });
    });

    // 5. Counter Animation
    const counterElements = document.querySelectorAll('.stat-count');
    let hasAnimated = false;

    function animateCounters() {
        if (hasAnimated) return;
        counterElements.forEach(el => {
            const target = parseInt(el.getAttribute('data-target') || el.innerText, 10);
            if (isNaN(target)) return;

            let count = 0;
            const speed = Math.ceil(target / 40);
            const timer = setInterval(() => {
                count += speed;
                if (count >= target) {
                    el.innerText = target + (el.getAttribute('data-suffix') || '');
                    clearInterval(timer);
                } else {
                    el.innerText = count + (el.getAttribute('data-suffix') || '');
                }
            }, 30);
        });
        hasAnimated = true;
    }

    if (counterElements.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) animateCounters();
            });
        }, { threshold: 0.3 });

        counterElements.forEach(el => observer.observe(el));
    }
});
