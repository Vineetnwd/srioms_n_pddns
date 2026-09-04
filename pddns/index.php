<?php
$page_title = "Home";
$page_description = "Pt. Deen Dayal Nursing School (PDDNS), Siwan - Best Nursing College in Bihar for ANM, GNM, and B.Sc Nursing. 100% Practical Clinical Hospital Training.";
$current_page = "home";

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/db.php';

$courses = get_pddns_courses_list();
$gallery_items = get_pddns_gallery_items('all');
?>

<!-- Hero & Page Responsive Styles (Self-contained & Cache-Proof) -->
<style>
.hero-section {
    background: linear-gradient(135deg, #042f2e 0%, #064e3b 50%, #07192f 100%);
    color: #ffffff;
    padding: 64px 0;
    position: relative;
    overflow: hidden;
}
.hero-section::before {
    content: '';
    position: absolute;
    top: -100px;
    right: -100px;
    width: 400px;
    height: 400px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(45, 212, 191, 0.15) 0%, transparent 70%);
    pointer-events: none;
}
.hero-grid {
    display: grid;
    grid-template-columns: 1.18fr 0.82fr;
    gap: 40px;
    align-items: center;
}
.hero-content {
    display: flex;
    flex-direction: column;
}
.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(45, 212, 191, 0.18);
    color: #2dd4bf;
    border: 1px solid rgba(45, 212, 191, 0.35);
    font-size: 0.82rem;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 9999px;
    margin-bottom: 16px;
    align-self: flex-start;
    max-width: 100%;
}
.hero-title {
    font-size: clamp(1.85rem, 3.2vw + 0.8rem, 2.75rem);
    line-height: 1.18;
    color: #ffffff;
    margin-bottom: 16px;
    font-weight: 800;
}
.hero-desc {
    font-size: clamp(0.92rem, 1vw + 0.55rem, 1.05rem);
    color: rgba(255, 255, 255, 0.88);
    line-height: 1.65;
    margin-bottom: 26px;
}
.hero-cta-group {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}
.hero-btn-main {
    background: #0d9488;
    color: #ffffff !important;
    font-size: 0.95rem;
    padding: 12px 22px;
    border-radius: 6px;
    border: 1px solid transparent;
}
.hero-btn-main:hover {
    background: #0f766e;
}
.hero-btn-outline {
    background: transparent;
    border: 1.5px solid rgba(255, 255, 255, 0.5);
    color: #ffffff !important;
    font-size: 0.95rem;
    padding: 12px 20px;
    border-radius: 6px;
}
.hero-btn-outline:hover {
    background: rgba(255, 255, 255, 0.15);
    border-color: #ffffff;
}
.hero-form-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 28px;
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.35);
    border: 1px solid rgba(255, 255, 255, 0.15);
    color: #334155;
}
.hero-form-header {
    text-align: center;
    margin-bottom: 18px;
}
.hero-form-tag {
    font-size: 0.74rem;
    font-weight: 800;
    color: #0d9488;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    display: block;
}
.hero-form-title {
    font-size: 1.35rem;
    color: #07192f;
    margin-top: 4px;
    font-weight: 700;
}
.btn-submit-inquiry {
    background: #0d9488;
    color: #ffffff !important;
    padding: 12px;
    font-size: 0.95rem;
    font-weight: 700;
    width: 100%;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    transition: all 0.25s ease;
}
.btn-submit-inquiry:hover {
    background: #0f766e;
}
.hospital-feature-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    align-items: center;
}
.feature-subgrid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 24px;
}
.feature-box {
    background: #ffffff;
    padding: 14px;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
}
.hospital-feature-img {
    border-radius: 16px;
    box-shadow: 0 12px 28px -4px rgba(15, 23, 42, 0.12);
    width: 100%;
    max-height: 400px;
    object-fit: cover;
}
.cards-grid-4 {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}
.cards-grid-3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}

@media (max-width: 992px) {
    .hero-grid { grid-template-columns: 1fr; gap: 36px; }
    .hospital-feature-grid { grid-template-columns: 1fr; gap: 30px; }
    .cards-grid-4 { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 640px) {
    .hero-section { padding: 40px 0; }
    .hero-cta-group { flex-direction: column; width: 100%; }
    .hero-cta-group .btn { width: 100%; text-align: center; }
    .hero-form-card { padding: 20px 16px; }
    .hero-form-title { font-size: 1.2rem; }
    .form-input { font-size: 16px !important; }
    .cards-grid-4 { grid-template-columns: 1fr; gap: 16px; }
    .cards-grid-3 { grid-template-columns: 1fr; gap: 18px; }
    .feature-subgrid-2 { grid-template-columns: 1fr; gap: 12px; }
    .btn-hospital-action { width: 100%; text-align: center; }
}
</style>

<!-- Notice Ticker -->
<div class="notice-ticker">
    <div class="container ticker-container">
        <div class="ticker-badge">
            <i class="fa-solid fa-bullhorn"></i> <span>Notice</span>
        </div>
        <div class="ticker-content">
            <div class="ticker-marquee">
                <span><?php echo $notice_ticker; ?></span>
            </div>
        </div>
    </div>
</div>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content">
                <div class="hero-badge">
                    <i class="fa-solid fa-award"></i> Approved by BNRC, Govt. of Bihar & INC Standards
                </div>
                <h1 class="hero-title">
                    Empowering Healthcare Through <span class="text-teal">Excellence in Nursing</span>
                </h1>
                <p class="hero-desc">
                    Pt. Deen Dayal Nursing School (PDDNS) delivers world-class clinical nursing education with state-of-the-art simulation laboratories and 100% practical hospital ward postings at Shri Ram Multi-Speciality Hospital.
                </p>
                <div class="hero-cta-group">
                    <a href="admissions.php" class="btn btn-primary hero-btn-main">
                        <i class="fa-solid fa-user-graduate"></i> Apply for 2026-27 Admissions
                    </a>
                    <a href="courses.php" class="btn btn-outline hero-btn-outline">
                        <i class="fa-solid fa-book-medical"></i> Explore Nursing Courses
                    </a>
                </div>
            </div>

            <!-- Quick Inquiry Form Card -->
            <div class="hero-form-col">
                <div class="form-card hero-form-card">
                    <div class="hero-form-header">
                        <span class="hero-form-tag">Quick Admissions Helpdesk</span>
                        <h3 class="hero-form-title">Get Course Details & Prospectus</h3>
                    </div>

                    <form class="ajax-inquiry-form" method="POST">
                        <input type="hidden" name="type" value="Nursing Admission Inquiry">
                        
                        <div class="form-group">
                            <label class="form-label">Applicant Full Name *</label>
                            <input type="text" name="name" class="form-input" placeholder="e.g. Ananya Kumari" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">WhatsApp Mobile Number *</label>
                            <input type="tel" name="phone" class="form-input" placeholder="10-digit mobile number" required pattern="[0-9]{10}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Interested Program *</label>
                            <select name="course" class="form-input" required>
                                <option value="">-- Select Nursing Course --</option>
                                <option value="ANM Nursing (2 Years)">ANM Nursing (2 Years)</option>
                                <option value="GNM Nursing (3 Years)">GNM Nursing (3 Years)</option>
                                <option value="B.Sc Nursing (4 Years)">B.Sc Nursing (4 Years)</option>
                                <option value="Post Basic B.Sc Nursing">Post Basic B.Sc Nursing</option>
                                <option value="DMLT Paramedical">DMLT (Lab Technology)</option>
                                <option value="OT Technology">OT Technology</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">City / District (Bihar)</label>
                            <input type="text" name="address" class="form-input" placeholder="e.g. Siwan / Gopalganj / Chapra">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-submit-inquiry">
                            <i class="fa-solid fa-paper-plane"></i> Submit Inquiry Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Strip -->
<div class="stats-strip">
    <div class="container">
        <div class="stats-grid-4">
            <div class="stat-item">
                <h3 class="stat-count" data-target="1500" data-suffix="+">1500+</h3>
                <p>Nurses Trained</p>
            </div>
            <div class="stat-item">
                <h3 class="stat-count" data-target="100" data-suffix="%">100%</h3>
                <p>Hospital Clinical Postings</p>
            </div>
            <div class="stat-item">
                <h3 class="stat-count" data-target="6" data-suffix="+">6+</h3>
                <p>Advanced Nursing Labs</p>
            </div>
            <div class="stat-item">
                <h3 class="stat-count" data-target="100" data-suffix="+">100+</h3>
                <p>Bed Multi-Speciality Hospital</p>
            </div>
        </div>
    </div>
</div>

<!-- Why Choose PDDNS -->
<section class="section-py section-bg">
    <div class="container">
        <div class="section-title-wrap">
            <span class="section-badge">Why Choose Us</span>
            <h2 class="section-heading">Setting Benchmarks in Nursing Education</h2>
            <p class="section-subtitle">We equip future nurses with hands-on clinical skills, ethical compassion, and recognized credentials.</p>
        </div>

        <div class="cards-grid-4">
            <div class="nursing-card feature-why-card">
                <div class="nursing-card-body">
                    <div class="feature-card-icon"><i class="fa-solid fa-stamp"></i></div>
                    <h3 class="feature-card-title">Govt. & BNRC Approved</h3>
                    <p class="feature-card-desc">Affiliated with Bihar Nurses Registration Council (BNRC), Health Dept. Bihar, following Indian Nursing Council guidelines.</p>
                </div>
            </div>

            <div class="nursing-card feature-why-card">
                <div class="nursing-card-body">
                    <div class="feature-card-icon"><i class="fa-solid fa-hospital-user"></i></div>
                    <h3 class="feature-card-title">Parent Multi-Speciality Hospital</h3>
                    <p class="feature-card-desc">Direct bedside clinical rotations at 100+ Beded Shri Ram Multi-Speciality Hospital & 1.5T MRI Diagnostic Center.</p>
                </div>
            </div>

            <div class="nursing-card feature-why-card">
                <div class="nursing-card-body">
                    <div class="feature-card-icon"><i class="fa-solid fa-flask-vial"></i></div>
                    <h3 class="feature-card-title">Simulation & Skill Labs</h3>
                    <p class="feature-card-desc">Advanced mannequins, maternal-child health simulators, nutrition labs, and computerized anatomy models.</p>
                </div>
            </div>

            <div class="nursing-card feature-why-card">
                <div class="nursing-card-body">
                    <div class="feature-card-icon"><i class="fa-solid fa-user-check"></i></div>
                    <h3 class="feature-card-title">100% Placement Support</h3>
                    <p class="feature-card-desc">Strong career network with top private hospitals, government healthcare centers, and nursing institutions.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Nursing Programs -->
<section class="section-py">
    <div class="container">
        <div class="section-title-wrap">
            <span class="section-badge">Academic Programs</span>
            <h2 class="section-heading">Featured Nursing & Healthcare Courses</h2>
            <p class="section-subtitle">Explore comprehensive diploma, degree, and paramedical programs designed for healthcare careers.</p>
        </div>

        <div class="cards-grid-3">
            <?php foreach (array_slice($courses, 0, 3) as $c): ?>
            <div class="nursing-card">
                <div class="nursing-card-body">
                    <span class="nursing-card-badge"><?php echo htmlspecialchars($c['level']); ?></span>
                    <h3 class="nursing-card-title"><?php echo htmlspecialchars($c['name']); ?> (<?php echo htmlspecialchars($c['code']); ?>)</h3>
                    <p class="nursing-card-desc"><?php echo htmlspecialchars($c['description']); ?></p>

                    <ul class="nursing-meta-list">
                        <li><i class="fa-regular fa-clock"></i> <strong>Duration:</strong> <span><?php echo htmlspecialchars($c['duration']); ?></span></li>
                        <li><i class="fa-solid fa-graduation-cap"></i> <strong>Eligibility:</strong> <span><?php echo htmlspecialchars($c['eligibility']); ?></span></li>
                        <li><i class="fa-solid fa-users"></i> <strong>Intake:</strong> <span><?php echo htmlspecialchars($c['seats']); ?></span></li>
                    </ul>

                    <div class="nursing-card-footer">
                        <span class="nursing-card-price"><?php echo htmlspecialchars($c['fees']); ?></span>
                        <a href="admissions.php" class="btn btn-primary btn-compact">Apply Now &rarr;</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="section-bottom-action">
            <a href="courses.php" class="btn btn-outline btn-catalog-view">View Full Courses Catalog &rarr;</a>
        </div>
    </div>
</section>

<!-- Clinical Training Hospital Feature -->
<section class="section-py section-bg">
    <div class="container">
        <div class="hospital-feature-grid">
            <div class="hospital-feature-text">
                <span class="section-badge">Hospital Affiliation</span>
                <h2 class="section-heading mt-2">Direct Clinical Hospital Ward Training at Shri Ram Multi-Speciality</h2>
                <p class="hospital-feature-desc">
                    Nursing students at PDDNS gain extensive hands-on experience under senior consultant doctors and nursing superintendents in real inpatient and ICU wards.
                </p>
                <div class="feature-subgrid-2">
                    <div class="feature-box">
                        <strong class="feature-box-title"><i class="fa-solid fa-bed-pulse"></i> ICU & Emergency</strong>
                        <p class="feature-box-desc">Ventilator patient management, critical vitals, trauma triage.</p>
                    </div>
                    <div class="feature-box">
                        <strong class="feature-box-title"><i class="fa-solid fa-person-breastfeeding"></i> Maternity & MCH</strong>
                        <p class="feature-box-desc">Antenatal, labor room delivery assistance, neonatal care.</p>
                    </div>
                </div>
                <a href="facilities.php" class="btn btn-primary btn-hospital-action">Discover All Labs & Hospital Facilities</a>
            </div>
            <div class="hospital-feature-media">
                <img src="assets/images/ct-scan.jpg" alt="Clinical Hospital Training" class="hospital-feature-img" onerror="this.src='assets/images/campus-building.jpg'">
            </div>
        </div>
    </div>
</section>

<!-- Photo Gallery Highlights -->
<section class="section-py">
    <div class="container">
        <div class="section-title-wrap">
            <span class="section-badge">Life at PDDNS</span>
            <h2 class="section-heading">Campus & Clinical Gallery</h2>
            <p class="section-subtitle">A glimpse into student life, capping ceremonies, laboratory practicals, and institutional milestones.</p>
        </div>

        <div class="gallery-grid">
            <?php foreach (array_slice($gallery_items, 0, 8) as $item): 
                $img_src = resolve_gallery_image_src($item['image_url'] ?? '');
            ?>
            <div class="gallery-item" data-category="<?php echo htmlspecialchars($item['category']); ?>">
                <img src="<?php echo htmlspecialchars($img_src); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" loading="lazy" onerror="this.src='assets/images/slider-1.jpg'">
                <div class="gallery-overlay">
                    <h5 class="gallery-title"><?php echo htmlspecialchars($item['title']); ?></h5>
                    <span class="gallery-cat"><?php echo htmlspecialchars($item['category_name']); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="section-bottom-action">
            <a href="gallery.php" class="btn btn-outline btn-catalog-view">Explore Complete Gallery (<?php echo count($gallery_items); ?>+ Photos) &rarr;</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
