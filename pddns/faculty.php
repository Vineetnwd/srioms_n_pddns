<?php
$page_title = "Faculty & Educators";
$page_description = "Experienced nursing educators, clinical instructors, and consultant doctors at Pt. Deen Dayal Nursing School (PDDNS) Siwan.";
$current_page = "faculty";

require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <div>
            <h1>Nursing Faculty & Clinical Mentors</h1>
            <p>Guided by qualified nursing educators (M.Sc / B.Sc Nursing) and visiting senior doctors committed to student clinical success.</p>
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
            <div class="nursing-card">
                <div style="height: 220px; overflow: hidden; background: #f1f5f9;">
                    <img src="assets/images/faculty1.jpg" alt="Faculty" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='assets/images/campus-building.jpg'">
                </div>
                <div class="nursing-card-body">
                    <span class="nursing-card-badge">Principal & Professor</span>
                    <h3 style="font-size: 1.2rem; color: var(--primary-800); margin-bottom: 4px;">Prof. (Mrs.) Sunita Verma</h3>
                    <p style="font-size: 0.8rem; color: var(--primary-600); font-weight: 600; margin-bottom: 8px;">M.Sc. Nursing (Medical Surgical Nursing)</p>
                    <p style="font-size: 0.84rem; color: var(--text-muted);">18+ Years of academic leadership and hospital clinical administration across leading nursing institutes.</p>
                </div>
            </div>

            <div class="nursing-card">
                <div style="height: 220px; overflow: hidden; background: #f1f5f9;">
                    <img src="assets/images/faculty2.jpg" alt="Faculty" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='assets/images/campus-building.jpg'">
                </div>
                <div class="nursing-card-body">
                    <span class="nursing-card-badge">Vice Principal</span>
                    <h3 style="font-size: 1.2rem; color: var(--primary-800); margin-bottom: 4px;">Mrs. Rekha Kumari</h3>
                    <p style="font-size: 0.8rem; color: var(--primary-600); font-weight: 600; margin-bottom: 8px;">M.Sc. Nursing (OBG / Midwifery)</p>
                    <p style="font-size: 0.84rem; color: var(--text-muted);">Specialist in labor room management, maternal health and community healthcare training.</p>
                </div>
            </div>

            <div class="nursing-card">
                <div style="height: 220px; overflow: hidden; background: #f1f5f9;">
                    <img src="assets/images/doctor-faculty.jpg" alt="Faculty" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='assets/images/campus-building.jpg'">
                </div>
                <div class="nursing-card-body">
                    <span class="nursing-card-badge">Medical Director</span>
                    <h3 style="font-size: 1.2rem; color: var(--primary-800); margin-bottom: 4px;">Dr. R. K. Singh</h3>
                    <p style="font-size: 0.8rem; color: var(--primary-600); font-weight: 600; margin-bottom: 8px;">MBBS, MD (General Medicine)</p>
                    <p style="font-size: 0.84rem; color: var(--text-muted);">Chief Consulting Physician at Shri Ram Hospital and senior medical preceptor for nursing students.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
