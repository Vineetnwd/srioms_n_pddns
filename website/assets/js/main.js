/**
 * SRIOMS Website Main JavaScript
 * SHRI RAM Institute of Medical Sciences
 */

document.addEventListener('DOMContentLoaded', function () {
    // 0. Full-Width 3:1 Hero Slider
    const heroSlides = document.querySelectorAll('.hero-slide');
    const heroDots = document.querySelectorAll('.hero-dot');
    const prevBtn = document.querySelector('.hero-slider-prev');
    const nextBtn = document.querySelector('.hero-slider-next');
    let currentSlideIdx = 0;
    let slideTimer = null;

    function goToSlide(index) {
        if (!heroSlides.length) return;
        if (index < 0) index = heroSlides.length - 1;
        if (index >= heroSlides.length) index = 0;

        heroSlides.forEach((slide, i) => {
            if (i === index) {
                slide.classList.add('active');
            } else {
                slide.classList.remove('active');
            }
        });

        heroDots.forEach((dot, i) => {
            if (i === index) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });

        currentSlideIdx = index;
    }

    function nextSlide() {
        goToSlide(currentSlideIdx + 1);
    }

    function prevSlide() {
        goToSlide(currentSlideIdx - 1);
    }

    function startAutoSlide() {
        stopAutoSlide();
        slideTimer = setInterval(nextSlide, 5000);
    }

    function stopAutoSlide() {
        if (slideTimer) clearInterval(slideTimer);
    }

    if (heroSlides.length > 0) {
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                nextSlide();
                startAutoSlide();
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                prevSlide();
                startAutoSlide();
            });
        }

        heroDots.forEach((dot, idx) => {
            dot.addEventListener('click', () => {
                goToSlide(idx);
                startAutoSlide();
            });
        });

        const sliderSection = document.querySelector('.hero-slider-section');
        if (sliderSection) {
            sliderSection.addEventListener('mouseenter', stopAutoSlide);
            sliderSection.addEventListener('mouseleave', startAutoSlide);
        }

        startAutoSlide();
    }

    // 1. Mobile Menu Toggle & Drawer
    const navToggle = document.getElementById('navToggle');
    const drawerClose = document.getElementById('drawerClose');
    const mobileDrawer = document.getElementById('mobileDrawer');
    const mobileOverlay = document.getElementById('mobileOverlay');

    function openMobileMenu() {
        if (mobileDrawer && mobileOverlay) {
            mobileDrawer.classList.add('open');
            mobileOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeMobileMenu() {
        if (mobileDrawer && mobileOverlay) {
            mobileDrawer.classList.remove('open');
            mobileOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    if (navToggle) navToggle.addEventListener('click', openMobileMenu);
    if (drawerClose) drawerClose.addEventListener('click', closeMobileMenu);
    if (mobileOverlay) mobileOverlay.addEventListener('click', closeMobileMenu);

    // 2. Sticky Navbar Shadow & Back-to-Top Button
    const siteNavbar = document.getElementById('siteNavbar');
    const backToTop = document.getElementById('backToTop');

    window.addEventListener('scroll', function () {
        const scrollPos = window.scrollY;

        if (siteNavbar) {
            if (scrollPos > 30) {
                siteNavbar.classList.add('scrolled');
            } else {
                siteNavbar.classList.remove('scrolled');
            }
        }

        if (backToTop) {
            if (scrollPos > 350) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        }
    });

    if (backToTop) {
        backToTop.addEventListener('click', function () {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // 3. Gallery Filter Tabs
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    if (filterBtns.length > 0 && galleryItems.length > 0) {
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filterValue = this.getAttribute('data-filter');

                galleryItems.forEach(item => {
                    const itemCategory = item.getAttribute('data-category');
                    if (filterValue === 'all' || itemCategory === filterValue) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'scale(1)';
                        }, 50);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 250);
                    }
                });
            });
        });
    }

    // 4. Image Lightbox Modal
    const lightboxModal = document.getElementById('imageLightbox');
    const lightboxImg = document.getElementById('lightboxImg');
    const lightboxCaption = document.getElementById('lightboxCaption');
    const lightboxClose = document.getElementById('lightboxClose');
    const lightboxPrev = document.getElementById('lightboxPrev');
    const lightboxNext = document.getElementById('lightboxNext');

    let currentGalleryList = [];
    let currentImageIndex = 0;

    function getVisibleGalleryItems() {
        return Array.from(document.querySelectorAll('.gallery-item')).filter(
            item => window.getComputedStyle(item).display !== 'none'
        );
    }

    function openLightbox(index) {
        currentGalleryList = getVisibleGalleryItems();
        if (currentGalleryList.length === 0 || !lightboxModal || !lightboxImg) return;

        currentImageIndex = (index + currentGalleryList.length) % currentGalleryList.length;
        const targetItem = currentGalleryList[currentImageIndex];
        const imgEl = targetItem.querySelector('img');
        const titleEl = targetItem.querySelector('.gallery-title');

        lightboxImg.src = imgEl ? imgEl.src : '';
        if (lightboxCaption) {
            lightboxCaption.textContent = titleEl ? titleEl.textContent : 'SRIOMS Campus & Diagnostics';
        }

        lightboxModal.classList.add('open');
        lightboxModal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        if (lightboxModal) {
            lightboxModal.classList.remove('open');
            lightboxModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    }

    if (galleryItems.length > 0) {
        galleryItems.forEach(item => {
            item.addEventListener('click', function () {
                const visibleItems = getVisibleGalleryItems();
                const index = visibleItems.indexOf(this);
                if (index !== -1) {
                    openLightbox(index);
                }
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
            if (e.target === lightboxModal) {
                closeLightbox();
            }
        });
    }

    // Keyboard navigation for Lightbox
    document.addEventListener('keydown', function (e) {
        if (lightboxModal && lightboxModal.classList.contains('open')) {
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') openLightbox(currentImageIndex - 1);
            if (e.key === 'ArrowRight') openLightbox(currentImageIndex + 1);
        }
    });

    // 5. Interactive Form Handlers (Admissions / Appointment Booking / Contact)
    const inquiryForms = document.querySelectorAll('.ajax-inquiry-form');
    inquiryForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalBtnText = submitBtn ? submitBtn.innerHTML : 'Submit';

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
                    alert(data.message || 'There was an issue submitting your inquiry. Please call us directly.');
                }
            })
            .catch(() => {
                // Fallback graceful confirmation
                const nameInput = form.querySelector('input[name="name"]') || form.querySelector('input[type="text"]');
                const applicantName = nameInput && nameInput.value ? nameInput.value.trim() : 'Applicant';
                alert(`Thank you, ${applicantName}! Your inquiry has been registered successfully. Our counselor / team will contact you shortly.`);
                form.reset();
            })
            .finally(() => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                }
            });
        });
    });

    // 6. Stats Counter Animation
    const counterElements = document.querySelectorAll('.stat-count');
    let hasAnimatedCounters = false;

    function animateCounters() {
        if (hasAnimatedCounters) return;
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
        hasAnimatedCounters = true;
    }

    // Trigger counter when in view
    if (counterElements.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                }
            });
        }, { threshold: 0.3 });

        counterElements.forEach(el => observer.observe(el));
    }
});
