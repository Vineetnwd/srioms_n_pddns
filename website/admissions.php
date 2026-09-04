<?php
$page_title = "Admissions 2026-27 - Apply Online";
$page_description = "Apply online for Paramedical Degree and Diploma admissions (2026-27) at Shri Ram Institute of Medical Sciences (SRIOMS) Siwan. DMLT, BMLT, DMRT, BPT, ANM Nursing, OT Tech.";
$current_page = "admissions";

require_once __DIR__ . '/includes/header.php';

$selected_course = isset($_GET['course']) ? htmlspecialchars($_GET['course']) : '';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <div>
            <h1>Admissions Session 2026-27</h1>
            <p>Take the first step toward a fulfilling medical career. Apply online for recognized paramedical and allied healthcare programs.</p>
        </div>
        <div class="breadcrumbs">
            <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            <span>/</span>
            <span class="current">Admissions</span>
        </div>
    </div>
</section>

<!-- Admission Details & Application Form -->
<section class="section-py" id="applyNow">
    <div class="container">
        <div class="admission-layout-grid">
            <!-- Left Information Column -->
            <div>
                <div class="admission-info-card mb-3">
                    <span class="section-tag">Admission Guidelines</span>
                    <h3 style="font-size: 1.5rem; color: var(--primary-900); margin-bottom: 12px;">Admission Process in 4 Simple Steps</h3>
                    <p style="color: var(--text-muted); font-size: 0.9rem;">
                        Admission to all paramedical courses is straightforward and transparent. Follow the steps below or contact our admission helpline for immediate assistance.
                    </p>

                    <div class="step-flow">
                        <div class="step-flow-item">
                            <div class="step-num">1</div>
                            <div class="step-content">
                                <h5>Online Registration / Campus Visit</h5>
                                <p>Fill the application form on this page or collect the registration kit from the SRIOMS campus in Siwan.</p>
                            </div>
                        </div>

                        <div class="step-flow-item">
                            <div class="step-num">2</div>
                            <div class="step-content">
                                <h5>Document Verification & Counseling</h5>
                                <p>Submit your 10th/12th marksheets, identity proof (Aadhaar), and passport photos for academic eligibility verification.</p>
                            </div>
                        </div>

                        <div class="step-flow-item">
                            <div class="step-num">3</div>
                            <div class="step-content">
                                <h5>Seat Allocation & Fee Confirmation</h5>
                                <p>Confirm your seat by depositing the admission fee via cash, UPI, bank transfer, or flexible installment schemes.</p>
                            </div>
                        </div>

                        <div class="step-flow-item">
                            <div class="step-num">4</div>
                            <div class="step-content">
                                <h5>Orientation & Clinical Classes Begin</h5>
                                <p>Receive your student ID, syllabus kit, lab coat, and join the orientation session to commence training.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Documents Checklist -->
                <div class="admission-info-card">
                    <h4 style="color: var(--primary-900); font-size: 1.15rem; margin-bottom: 12px;"><i class="fa-solid fa-folder-open text-primary"></i> Documents Required for Admission</h4>
                    <ul class="service-list-bullets" style="margin-bottom: 0;">
                        <li><i class="fa-solid fa-circle-check"></i> 10th (Matriculation) Marksheet & Passing Certificate</li>
                        <li><i class="fa-solid fa-circle-check"></i> 12th (Intermediate) Marksheet & Admit Card</li>
                        <li><i class="fa-solid fa-circle-check"></i> Aadhaar Card Copy (Identity Proof)</li>
                        <li><i class="fa-solid fa-circle-check"></i> 6 Recent Passport-sized Color Photographs</li>
                        <li><i class="fa-solid fa-circle-check"></i> School / College Leaving Certificate (CLC/SLC)</li>
                        <li><i class="fa-solid fa-circle-check"></i> Caste / Income Certificate (If applying for scholarship)</li>
                    </ul>
                </div>
            </div>

            <!-- Right Application Form -->
            <div>
                <div class="form-box">
                    <div class="form-box-header">
                        <span class="badge-pill badge-primary mb-1">Session 2026-27</span>
                        <h3>Online Admission Application</h3>
                        <p>Fill out your details accurately. Our counselor will call you within 2 hours.</p>
                    </div>

                    <form class="ajax-inquiry-form">
                        <div class="form-group">
                            <label class="form-label">Applicant Full Name *</label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Rahul Kumar" required>
                        </div>

                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="form-label">Mobile Number *</label>
                                <input type="tel" name="phone" class="form-control" placeholder="10-digit phone number" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email Address</label>
                                <input type="email" name="email" class="form-control" placeholder="e.g. name@example.com">
                            </div>
                        </div>

                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="form-label">Father's / Guardian's Name *</label>
                                <input type="text" name="guardian_name" class="form-control" placeholder="Father's name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Date of Birth *</label>
                                <input type="date" name="dob" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-row-2">
                            <div class="form-group">
                                <label class="form-label">Select Program / Course *</label>
                                <select name="course" class="form-control" required>
                                    <option value="">-- Choose Course --</option>
                                    <option value="DMLT" <?php echo ($selected_course == 'DMLT') ? 'selected' : ''; ?>>DMLT (Diploma in Medical Lab Tech)</option>
                                    <option value="BMLT" <?php echo ($selected_course == 'BMLT') ? 'selected' : ''; ?>>B.Sc MLT (Bachelor in Medical Lab Tech)</option>
                                    <option value="DMRT" <?php echo ($selected_course == 'DMRT') ? 'selected' : ''; ?>>DMRT (Diploma in Radiography / X-Ray)</option>
                                    <option value="BPT" <?php echo ($selected_course == 'BPT') ? 'selected' : ''; ?>>BPT (Bachelor of Physiotherapy)</option>
                                    <option value="ANM" <?php echo ($selected_course == 'ANM') ? 'selected' : ''; ?>>ANM (Nursing & Midwifery)</option>
                                    <option value="OT" <?php echo ($selected_course == 'OT') ? 'selected' : ''; ?>>Diploma in OT Technology</option>
                                    <option value="Dresser" <?php echo ($selected_course == 'Dresser') ? 'selected' : ''; ?>>Certified Dresser & First Aid</option>
                                    <option value="CCP" <?php echo ($selected_course == 'CCP') ? 'selected' : ''; ?>>Certificate in Clinical Pathology</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Highest Qualification *</label>
                                <select name="qualification" class="form-control" required>
                                    <option value="10th (Matric)">10th (Matriculation)</option>
                                    <option value="12th (PCB Science)">12th (PCB Science)</option>
                                    <option value="12th (PCM Science)">12th (PCM Science)</option>
                                    <option value="12th (Arts / Commerce)">12th (Arts / Commerce)</option>
                                    <option value="Graduation / Other">Graduation / Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Full Residential Address & City *</label>
                            <textarea name="address" class="form-control" rows="2" placeholder="Village / Street, Post, District, State, PIN" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg">
                            <i class="fa-solid fa-paper-plane"></i> Submit Admission Application
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
