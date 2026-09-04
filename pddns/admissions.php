<?php
$page_title = "Admissions 2026-27";
$page_description = "Apply online for Nursing Admissions 2026-27 at Pt. Deen Dayal Nursing School (PDDNS) Siwan - ANM, GNM, B.Sc Nursing. Eligibility and online application form.";
$current_page = "admissions";

require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <div>
            <h1>Admissions Open (Session 2026-27)</h1>
            <p>Join Bihar's premier nursing school. Secure your admission in ANM, GNM, and B.Sc Nursing programs today.</p>
        </div>
        <div class="breadcrumbs">
            <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            <span>/</span>
            <span class="current">Admissions</span>
        </div>
    </div>
</section>

<!-- Admissions Content & Form -->
<section class="section-py">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; align-items: flex-start;">
            <!-- Left: Guidelines & Document Checklist -->
            <div>
                <span class="section-badge">Eligibility & Procedure</span>
                <h2 class="section-heading" style="margin-top: 8px;">Admission Guidelines (2026-27)</h2>
                <p style="font-size: 0.92rem; color: var(--text-body); line-height: 1.6; margin-bottom: 20px;">
                    Admissions are open for eligible candidates seeking a dedicated career in nursing and healthcare. Please review the criteria below before submitting your application.
                </p>

                <div class="nursing-card mb-4" style="margin-bottom: 20px;">
                    <div class="nursing-card-body" style="padding: 20px;">
                        <h4 style="color: var(--primary-800); margin-bottom: 10px;"><i class="fa-solid fa-clipboard-check text-primary"></i> Required Documents for Verification</h4>
                        <ul style="padding-left: 20px; font-size: 0.85rem; line-height: 1.8; color: var(--text-body);">
                            <li>10th (Matric) Marksheet & Passing Certificate (Original & 3 Photocopies)</li>
                            <li>12th (Intermediate) Marksheet & Admit Card</li>
                            <li>School/College Leaving Certificate (SLC/CLC) & Migration Certificate</li>
                            <li>Caste / Residential / Income Certificate (if applicable)</li>
                            <li>Aadhaar Card (UID) copy</li>
                            <li>6 Passport-size recent color photographs</li>
                        </ul>
                    </div>
                </div>

                <div class="nursing-card" style="background: var(--primary-50); border-color: var(--primary-200);">
                    <div class="nursing-card-body" style="padding: 20px;">
                        <h4 style="color: var(--primary-700); margin-bottom: 6px;"><i class="fa-solid fa-phone-volume"></i> Need Counseling Assistance?</h4>
                        <p style="font-size: 0.85rem; color: var(--text-body);">Call our admission counseling cell directly:</p>
                        <p style="font-size: 1.1rem; font-weight: 800; color: var(--primary-800); margin-top: 6px;">
                            <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $site_phone); ?>" style="color: inherit;"><?php echo $site_phone; ?></a> / <?php echo $site_phone_alt; ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right: Online Application Form -->
            <div class="form-card" id="applyNow">
                <div style="margin-bottom: 20px; border-bottom: 1px solid var(--border-subtle); padding-bottom: 14px;">
                    <span style="font-size: 0.72rem; font-weight: 800; color: var(--primary-600); text-transform: uppercase;">Online Application Form</span>
                    <h3 style="font-size: 1.35rem; color: var(--primary-800); margin-top: 2px;">Register for Admission (2026-27)</h3>
                </div>

                <form class="ajax-inquiry-form" method="POST">
                    <input type="hidden" name="type" value="Online Admission Application">
                    
                    <div class="form-group">
                        <label class="form-label">Applicant Full Name *</label>
                        <input type="text" name="name" class="form-input" placeholder="Full name as per 10th certificate" required>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Mobile Number *</label>
                            <input type="tel" name="phone" class="form-input" placeholder="10-digit phone" required pattern="[0-9]{10}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-input" placeholder="applicant@gmail.com">
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Father's / Guardian's Name</label>
                            <input type="text" name="guardian_name" class="form-input" placeholder="Guardian's name">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Desired Nursing Course *</label>
                            <select name="course" class="form-input" required>
                                <option value="">-- Choose Course --</option>
                                <option value="ANM (2 Years)">ANM Nursing (2 Years)</option>
                                <option value="GNM (3 Years)">GNM Nursing (3 Years)</option>
                                <option value="B.Sc Nursing (4 Years)">B.Sc Nursing (4 Years)</option>
                                <option value="Post Basic B.Sc Nursing">Post Basic B.Sc Nursing</option>
                                <option value="DMLT Paramedical">DMLT (Lab Technology)</option>
                                <option value="OT Technology">OT Technology</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Highest Qualification & Marks %</label>
                        <input type="text" name="qualification" class="form-input" placeholder="e.g. 12th PCB - 65% / Arts - 60%">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Permanent Address / District</label>
                        <input type="text" name="address" class="form-input" placeholder="Village / Town, District, State">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Additional Questions / Hostel Requirement</label>
                        <textarea name="message" class="form-input" rows="3" placeholder="Mention if you require hostel accommodation or transportation..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" style="padding: 12px; font-size: 1rem;">
                        <i class="fa-solid fa-file-signature"></i> Submit Admission Application
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
