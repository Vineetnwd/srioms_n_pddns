<?php
$page_title = "Faculty & Doctors";
$page_description = "Meet the experienced medical faculty, radiologist consultants, pathologists, and paramedical educators at SRIOMS Siwan.";
$current_page = "faculty";

require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <div>
            <h1>Faculty & Medical Experts</h1>
            <p>Mentored by qualified medical doctors, senior radiologists, pathologists, and experienced paramedical educators.</p>
        </div>
        <div class="breadcrumbs">
            <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            <span>/</span>
            <span class="current">Faculty</span>
        </div>
    </div>
</section>

<!-- Faculty Grid -->
<section class="section-py">
    <div class="container">
        <div class="cards-grid-3">
            <div class="med-card">
                <div style="height: 220px; overflow: hidden; background: #f1f5f9;">
                    <img src="assets/images/doctor-faculty.jpg" alt="Medical Director" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='assets/images/campus-building.jpg'">
                </div>
                <div class="med-card-body">
                    <span class="med-card-badge">Medical Director</span>
                    <h3 style="font-size: 1.25rem; color: var(--primary-900); margin-bottom: 4px;">Dr. R. K. Singh</h3>
                    <p style="font-size: 0.82rem; color: var(--primary-600); font-weight: 600; margin-bottom: 8px;">MBBS, MD (General Medicine)</p>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">20+ Years clinical leadership, guiding paramedical students in internal medicine and emergency diagnostics.</p>
                </div>
            </div>

            <div class="med-card">
                <div style="height: 220px; overflow: hidden; background: #f1f5f9;">
                    <img src="assets/images/faculty1.jpg" alt="Senior Radiologist" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='assets/images/campus-building.jpg'">
                </div>
                <div class="med-card-body">
                    <span class="med-card-badge">Chief Radiologist</span>
                    <h3 style="font-size: 1.25rem; color: var(--primary-900); margin-bottom: 4px;">Dr. Gaurav Anand</h3>
                    <p style="font-size: 0.82rem; color: var(--primary-600); font-weight: 600; margin-bottom: 8px;">MBBS, DMRD (Radiodiagnosis)</p>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">Specialist in 1.5 Tesla Supercon MRI, Helical CT Scan, 3D/4D ultrasound, and cross-sectional imaging.</p>
                </div>
            </div>

            <div class="med-card">
                <div style="height: 220px; overflow: hidden; background: #f1f5f9;">
                    <img src="assets/images/faculty2.jpg" alt="Pathologist" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='assets/images/campus-building.jpg'">
                </div>
                <div class="med-card-body">
                    <span class="med-card-badge">Consultant Pathologist</span>
                    <h3 style="font-size: 1.25rem; color: var(--primary-900); margin-bottom: 4px;">Dr. Astha Priya</h3>
                    <p style="font-size: 0.82rem; color: var(--primary-600); font-weight: 600; margin-bottom: 8px;">MD (Pathology)</p>
                    <p style="font-size: 0.85rem; color: var(--text-muted);">Head of automated biochemistry, hematology, and clinical microbiology diagnostics.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
