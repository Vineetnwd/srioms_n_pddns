<?php
$page_title = "Clinical Labs & Hospital Facilities";
$page_description = "Explore state-of-the-art Nursing Skill Labs, Maternal Child Health (MCH) Simulators, Nutrition Labs, Anatomy Museum, and 100+ Bed Hospital at PDDNS Siwan.";
$current_page = "facilities";

require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <div>
            <h1>Clinical Labs & Infrastructure</h1>
            <p>Advanced practical training facilities, modern nursing simulation labs, and parent teaching hospital rotations.</p>
        </div>
        <div class="breadcrumbs">
            <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            <span>/</span>
            <span class="current">Facilities</span>
        </div>
    </div>
</section>

<!-- Facilities Grid -->
<section class="section-py">
    <div class="container">
        <div class="cards-grid-3">
            <div class="nursing-card">
                <div class="nursing-card-body">
                    <div style="font-size: 2.2rem; color: var(--primary-600); margin-bottom: 12px;"><i class="fa-solid fa-bed-pulse"></i></div>
                    <h3 style="font-size: 1.25rem; color: var(--primary-800); margin-bottom: 8px;">Nursing Foundation & Skill Lab</h3>
                    <p style="font-size: 0.88rem; color: var(--text-muted);">Equipped with multi-purpose adult and pediatric manikins, CPR simulators, hospital beds, oxygen administration kits, and injection simulators for mastery of core nursing procedures.</p>
                </div>
            </div>

            <div class="nursing-card">
                <div class="nursing-card-body">
                    <div style="font-size: 2.2rem; color: var(--primary-600); margin-bottom: 12px;"><i class="fa-solid fa-person-breastfeeding"></i></div>
                    <h3 style="font-size: 1.25rem; color: var(--primary-800); margin-bottom: 8px;">Maternal & Child Health (MCH) Lab</h3>
                    <p style="font-size: 0.88rem; color: var(--text-muted);">Specialized labor room simulators, birthing manikins, radiant warmers, pediatric resuscitation models, and fetal heart rate monitors for hands-on midwifery training.</p>
                </div>
            </div>

            <div class="nursing-card">
                <div class="nursing-card-body">
                    <div style="font-size: 2.2rem; color: var(--primary-600); margin-bottom: 12px;"><i class="fa-solid fa-apple-whole"></i></div>
                    <h3 style="font-size: 1.25rem; color: var(--primary-800); margin-bottom: 8px;">Nutrition & Dietetics Lab</h3>
                    <p style="font-size: 0.88rem; color: var(--text-muted);">Equipped for planning and preparing therapeutic diets, baby weaning foods, diabetic menus, and enteral feeding solutions essential for clinical patient recovery.</p>
                </div>
            </div>

            <div class="nursing-card">
                <div class="nursing-card-body">
                    <div style="font-size: 2.2rem; color: var(--primary-600); margin-bottom: 12px;"><i class="fa-solid fa-house-medical"></i></div>
                    <h3 style="font-size: 1.25rem; color: var(--primary-800); margin-bottom: 8px;">Community Health Nursing Lab</h3>
                    <p style="font-size: 0.88rem; color: var(--text-muted);">Dedicated bag technique kits, family planning displays, rural survey tools, and immunization charts for preparing nurses for village outreach and primary healthcare center postings.</p>
                </div>
            </div>

            <div class="nursing-card">
                <div class="nursing-card-body">
                    <div style="font-size: 2.2rem; color: var(--primary-600); margin-bottom: 12px;"><i class="fa-solid fa-book-open-reader"></i></div>
                    <h3 style="font-size: 1.25rem; color: var(--primary-800); margin-bottom: 8px;">Medical & Nursing Library</h3>
                    <p style="font-size: 0.88rem; color: var(--text-muted);">Hundreds of latest nursing textbooks, national & international healthcare journals, research periodicals, and high-speed internet e-learning terminals.</p>
                </div>
            </div>

            <div class="nursing-card">
                <div class="nursing-card-body">
                    <div style="font-size: 2.2rem; color: var(--primary-600); margin-bottom: 12px;"><i class="fa-solid fa-hospital"></i></div>
                    <h3 style="font-size: 1.25rem; color: var(--primary-800); margin-bottom: 8px;">100+ Bed Teaching Hospital</h3>
                    <p style="font-size: 0.88rem; color: var(--text-muted);">Parent Shri Ram Multi-Speciality Hospital offering direct ward postings in General Medicine, Surgery, ICU, Pediatrics, Orthopedics, and Emergency Triage.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
