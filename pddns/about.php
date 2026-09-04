<?php
$page_title = "About Us";
$page_description = "Learn about Pt. Deen Dayal Nursing School (PDDNS) - Vision, Mission, Affiliation with Bihar Nurses Registration Council (BNRC), and Leadership Message.";
$current_page = "about";

require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <div>
            <h1>About Pt. Deen Dayal Nursing School</h1>
            <p>Nurturing compassionate healthcare leaders, dedicated clinical nurses, and community healthcare pioneers in Bihar.</p>
        </div>
        <div class="breadcrumbs">
            <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            <span>/</span>
            <span class="current">About Us</span>
        </div>
    </div>
</section>

<!-- About Institute Overview -->
<section class="section-py">
    <div class="container">
        <div class="cards-grid-2" style="align-items: center;">
            <div>
                <span class="section-badge">Institutional Profile</span>
                <h2 class="section-heading" style="margin-top: 8px;">A Tradition of Healthcare Excellence & Nursing Dedication</h2>
                <p style="font-size: 0.95rem; color: var(--text-body); line-height: 1.6; margin-bottom: 14px;">
                    Established with the noble objective of bridging the healthcare professional shortage in North Bihar, <strong>Pt. Deen Dayal Nursing School (PDDNS)</strong> stands as a premier educational establishment for nursing, clinical midwifery, and allied health sciences.
                </p>
                <p style="font-size: 0.95rem; color: var(--text-body); line-height: 1.6; margin-bottom: 20px;">
                    Our nursing curriculum integrates rigorous academic coursework with intensive bedside rotations in medical, surgical, pediatric, obstetric, and intensive care units at our parent multi-speciality hospital and MRI diagnostic center.
                </p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                    <div style="background: var(--primary-50); padding: 14px; border-radius: 8px; border: 1px solid var(--primary-100);">
                        <strong style="color: var(--primary-700);"><i class="fa-solid fa-certificate"></i> BNRC Approved</strong>
                        <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 4px;">Recognized by Bihar Nurses Registration Council.</p>
                    </div>
                    <div style="background: var(--primary-50); padding: 14px; border-radius: 8px; border: 1px solid var(--primary-100);">
                        <strong style="color: var(--primary-700);"><i class="fa-solid fa-hospital-user"></i> Hospital Rotations</strong>
                        <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 4px;">100+ Bed parent teaching hospital.</p>
                    </div>
                </div>
            </div>

            <div>
                <img src="assets/images/campus-building.jpg" alt="PDDNS Campus" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-lg); width: 100%; object-fit: cover;">
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission -->
<section class="section-py section-bg">
    <div class="container">
        <div class="cards-grid-2">
            <div class="nursing-card">
                <div class="nursing-card-body">
                    <div style="font-size: 2.2rem; color: var(--primary-600); margin-bottom: 12px;"><i class="fa-solid fa-eye"></i></div>
                    <h3 style="font-size: 1.4rem; color: var(--primary-800); margin-bottom: 10px;">Our Vision</h3>
                    <p style="font-size: 0.92rem; color: var(--text-body); line-height: 1.6;">
                        To be an internationally recognized center of excellence in nursing education, known for producing ethically grounded, highly skilled, and compassionate nurses who elevate patient care standards across the globe.
                    </p>
                </div>
            </div>

            <div class="nursing-card">
                <div class="nursing-card-body">
                    <div style="font-size: 2.2rem; color: var(--primary-600); margin-bottom: 12px;"><i class="fa-solid fa-bullseye"></i></div>
                    <h3 style="font-size: 1.4rem; color: var(--primary-800); margin-bottom: 10px;">Our Mission</h3>
                    <p style="font-size: 0.92rem; color: var(--text-body); line-height: 1.6;">
                        To provide high-quality, evidence-based nursing instruction, hands-on clinical simulation training, and holistic personal development that empowers students to serve communities with empathy and professional proficiency.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
