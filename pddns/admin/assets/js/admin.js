/**
 * SRIOMS Admin Panel JavaScript
 */

document.addEventListener('DOMContentLoaded', function () {
    // 1. Mobile Sidebar Toggle
    const sidebarToggleBtn = document.getElementById('sidebarToggle');
    const adminSidebar = document.getElementById('adminSidebar');

    if (sidebarToggleBtn && adminSidebar) {
        sidebarToggleBtn.addEventListener('click', function () {
            adminSidebar.classList.toggle('open');
        });
    }

    // 2. Table & Grid Live Search Filter
    const searchInput = document.getElementById('adminSearchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function () {
            const query = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('.searchable-row, .searchable-card');

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                if (text.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }

    // 3. Image File Upload Preview
    const imageUploadInput = document.getElementById('imageUploadInput');
    const imagePreviewEl = document.getElementById('imageUploadPreview');

    if (imageUploadInput && imagePreviewEl) {
        imageUploadInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreviewEl.src = e.target.result;
                    imagePreviewEl.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // 4. Modal Triggers
    const modalOpenBtns = document.querySelectorAll('[data-open-modal]');
    const modalCloseBtns = document.querySelectorAll('[data-close-modal]');

    modalOpenBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const targetId = this.getAttribute('data-open-modal');
            const targetModal = document.getElementById(targetId);
            if (targetModal) targetModal.style.display = 'flex';
        });
    });

    modalCloseBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const targetModal = this.closest('.admin-modal');
            if (targetModal) targetModal.style.display = 'none';
        });
    });
});
