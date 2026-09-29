<?php
$page_title = "Leading Paramedical Institute & 24x7 Diagnostic Center in Siwan";
$page_description = "Shri Ram Institute of Medical Sciences (SRIOMS) offers Paramedical Courses (DMLT, BMLT, DMRT, BPT, ANM Nursing) and 24x7 Advanced Diagnostics (1.5T MRI, CT Scan, Ultrasound, Digital X-Ray) in Siwan, Bihar.";
$current_page = "home";

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/db.php';

$courses = get_courses_list();
$services = get_services_list();
$gallery_items = get_gallery_items('all');
?>

<!-- Admission & Emergency Notice Ticker -->
<div class="notice-ticker">
    <div class="container ticker-container">
        <div class="ticker-badge">
            <i class="fa-solid fa-bullhorn"></i> Notice
        </div>
        <div class="ticker-content">
            <div class="ticker-marquee">
                <span><?php echo $notice_ticker; ?></span>
            </div>
        </div>
    </div>
</div>

<!-- Full-Width 3:1 Ratio Hero Slider (Original Images - Pure Visual) -->
<section class="hero-slider-section">
    <div class="hero-slider-wrapper">
        <!-- Slide 1: Original Campus View -->
        <div class="hero-slide active">
            <img src="assets/images/slider1.png" alt="SRIOMS Campus" class="hero-slide-bg">
        </div>

        <!-- Slide 2: Original Panoramic Campus Building -->
        <div class="hero-slide">
            <img src="assets/images/slider2.png" alt="SRIOMS Campus Panoramic" class="hero-slide-bg">
        </div>

        <!-- Slide 3: Original Laboratory -->
        <div class="hero-slide">
            <img src="assets/images/slider3.png" alt="SRIOMS Laboratory" class="hero-slide-bg">
        </div>

        <!-- Slide 4: Original Practical Lab -->
        <div class="hero-slide">
            <img src="assets/images/dsc.webp" alt="SRIOMS Practical Lab" class="hero-slide-bg">
        </div>

        <!-- Slide 5: Original Clinical Training Facility -->
        <div class="hero-slide">
            <img src="assets/images/ev.webp" alt="SRIOMS Clinical Training" class="hero-slide-bg">
        </div>

        <!-- Slider Controls -->
        <button class="hero-slider-prev" aria-label="Previous Slide"><i class="fa-solid fa-chevron-left"></i></button>
        <button class="hero-slider-next" aria-label="Next Slide"><i class="fa-solid fa-chevron-right"></i></button>

        <!-- Slider Dots -->
        <div class="hero-slider-dots">
            <button class="hero-dot active" aria-label="Slide 1"></button>
            <button class="hero-dot" aria-label="Slide 2"></button>
            <button class="hero-dot" aria-label="Slide 3"></button>
            <button class="hero-dot" aria-label="Slide 4"></button>
            <button class="hero-dot" aria-label="Slide 5"></button>
        </div>
    </div>
</section>

<!-- Floating Stats Counter Bar -->
<section class="stats-section">
    <div class="container">
        <div class="stats-card-wrap">
            <div class="stat-item">
                <div class="stat-icon"><i class="fa-solid fa-user-doctor"></i></div>
                <div class="stat-info">
                    <h3 class="stat-count" data-target="25" data-suffix="+">25+</h3>
                    <p>Doctors & Faculty</p>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><i class="fa-solid fa-graduation-cap"></i></div>
                <div class="stat-info">
                    <h3 class="stat-count" data-target="8" data-suffix="+">8+</h3>
                    <p>Healthcare Courses</p>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><i class="fa-solid fa-hospital-user"></i></div>
                <div class="stat-info">
                    <h3 class="stat-count" data-target="50000" data-suffix="+">50,000+</h3>
                    <p>Diagnostic Patients</p>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><i class="fa-solid fa-calendar-check"></i></div>
                <div class="stat-info">
                    <h3 class="stat-count" data-target="2018">2018</h3>
                    <p>Established Year</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Core Pillars Section -->
<section class="section-py section-bg" style="padding-top: 90px;">
    <div class="container">
        <div class="section-title-wrap">
            <span class="section-badge">Why Choose SRIOMS</span>
            <h2 class="section-heading">Setting High Standards in Paramedical Education</h2>
            <p class="section-subtitle">We empower students with real-world clinical experience, cutting-edge diagnostic
                equipment, and career opportunities.</p>
        </div>

        <div class="cards-grid-4">
            <div class="med-card">
                <div class="med-card-body">
                    <div style="font-size: 2.2rem; color: var(--primary-600); margin-bottom: 14px;"><i
                            class="fa-solid fa-stamp"></i></div>
                    <h3 style="font-size: 1.2rem; color: var(--primary-900); margin-bottom: 8px;">Recognized Curriculum
                    </h3>
                    <p style="font-size: 0.88rem; color: var(--text-muted);">Affiliated and approved courses designed to
                        meet national paramedical and nursing educational standards.</p>
                </div>
            </div>

            <div class="med-card">
                <div class="med-card-body">
                    <div style="font-size: 2.2rem; color: var(--primary-600); margin-bottom: 14px;"><i
                            class="fa-solid fa-magnet"></i></div>
                    <h3 style="font-size: 1.2rem; color: var(--primary-900); margin-bottom: 8px;">In-House Diagnostic
                        Center</h3>
                    <p style="font-size: 0.88rem; color: var(--text-muted);">Direct training on real patient cases using
                        1.5 Tesla MRI, Helical CT Scan, and Automated Pathology machines.</p>
                </div>
            </div>

            <div class="med-card">
                <div class="med-card-body">
                    <div style="font-size: 2.2rem; color: var(--primary-600); margin-bottom: 14px;"><i
                            class="fa-solid fa-flask-vial"></i></div>
                    <h3 style="font-size: 1.2rem; color: var(--primary-900); margin-bottom: 8px;">High-Tech Laboratories
                    </h3>
                    <p style="font-size: 0.88rem; color: var(--text-muted);">Fully equipped clinical biochemistry,
                        hematology, microbiology, and radiography training labs.</p>
                </div>
            </div>

            <div class="med-card">
                <div class="med-card-body">
                    <div style="font-size: 2.2rem; color: var(--primary-600); margin-bottom: 14px;"><i
                            class="fa-solid fa-hand-holding-medical"></i></div>
                    <h3 style="font-size: 1.2rem; color: var(--primary-900); margin-bottom: 8px;">Hospital Clinical
                        Postings</h3>
                    <p style="font-size: 0.88rem; color: var(--text-muted);">Compulsory rotatory internship in
                        multi-speciality hospital wards, trauma centers, and clinical ICUs.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Courses Section -->
<section class="section-py">
    <div class="container">
        <div class="section-title-wrap">
            <span class="section-badge">Academic Offerings</span>
            <h2 class="section-heading">Featured Paramedical Programs</h2>
            <p class="section-subtitle">Career-focused diplomas and bachelor degrees delivering hands-on technical
                skills and recognized certification.</p>
        </div>

        <div class="cards-grid-3">
            <?php foreach (array_slice($courses, 0, 3) as $c): ?>
                <div class="med-card">
                    <div class="med-card-body">
                        <span class="med-card-badge"><?php echo htmlspecialchars($c['level']); ?></span>
                        <h3 class="med-card-title"><?php echo htmlspecialchars($c['name']); ?>
                            (<?php echo htmlspecialchars($c['code']); ?>)</h3>
                        <p style="font-size: 0.88rem; color: var(--text-muted); flex: 1;">
                            <?php echo htmlspecialchars($c['description']); ?></p>

                        <ul class="med-meta-list">
                            <li><i class="fa-regular fa-clock"></i> <strong>Duration:</strong>
                                <?php echo htmlspecialchars($c['duration']); ?></li>
                            <li><i class="fa-solid fa-graduation-cap"></i> <strong>Eligibility:</strong>
                                <?php echo htmlspecialchars($c['eligibility']); ?></li>
                            <li><i class="fa-solid fa-users"></i> <strong>Intake:</strong>
                                <?php echo htmlspecialchars($c['seats'] ?? '40-60'); ?> Seats</li>
                        </ul>

                        <div
                            style="margin-top: 14px; padding-top: 14px; border-top: 1px solid var(--border-subtle); display: flex; justify-content: space-between; align-items: center;">
                            <span
                                style="font-weight: 700; color: var(--primary-700); font-size: 0.95rem;"><?php echo htmlspecialchars($c['fees'] ?? 'On Request'); ?></span>
                            <a href="contact.php?course=<?php echo urlencode($c['code']); ?>"
                                class="btn btn-primary btn-compact">Inquire Now &rarr;</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div style="text-align: center; margin-top: 36px;">
            <a href="courses.php" class="btn btn-outline" style="padding: 11px 26px;">Explore All Paramedical Programs
                &rarr;</a>
        </div>
    </div>
</section>

<!-- Diagnostic Center Highlights -->
<section class="section-py section-bg">
    <div class="container">
        <div class="section-title-wrap">
            <span class="section-badge">Diagnostic Center</span>
            <h2 class="section-heading">24x7 Shri Ram MRI & Advanced Diagnostics</h2>
            <p class="section-subtitle">Delivering high-definition diagnostic imaging and automated clinical laboratory
                testing under one roof.</p>
        </div>

        <div class="cards-grid-3">
            <div class="diag-card">
                <img src="assets/images/mri-scan.jpg" alt="1.5T MRI" class="diag-card-thumb"
                    onerror="this.src='assets/images/campus-building.jpg'">
                <div class="diag-card-body">
                    <span class="med-card-badge"
                        style="background: var(--primary-50); color: var(--primary-600);">Radiology</span>
                    <h3 style="font-size: 1.25rem; color: var(--primary-900); margin-bottom: 6px;">1.5 Tesla Supercon
                        MRI</h3>
                    <p style="font-size: 0.85rem; color: var(--text-muted); flex: 1;">Whole body, brain, spine, MRCP,
                        joint imaging with high clinical contrast and 24x7 emergency service.</p>
                    <div
                        style="margin-top: 14px; padding-top: 12px; border-top: 1px solid var(--border-subtle); display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.8rem; font-weight: 700; color: var(--emerald-600);"><i
                                class="fa-solid fa-clock"></i> 24x7 Open</span>
                        <a href="our-services.php" class="btn btn-primary btn-compact">Details</a>
                    </div>
                </div>
            </div>

            <div class="diag-card">
                <img src="assets/images/ct-scan.jpg" alt="CT Scan" class="diag-card-thumb"
                    onerror="this.src='assets/images/campus-building.jpg'">
                <div class="diag-card-body">
                    <span class="med-card-badge"
                        style="background: var(--primary-50); color: var(--primary-600);">Radiology</span>
                    <h3 style="font-size: 1.25rem; color: var(--primary-900); margin-bottom: 6px;">Multi-Slice Helical
                        CT</h3>
                    <p style="font-size: 0.85rem; color: var(--text-muted); flex: 1;">Ultra-fast low-dose CT scanning
                        for head trauma, chest HRCT, abdominal scans, and 3D angiography.</p>
                    <div
                        style="margin-top: 14px; padding-top: 12px; border-top: 1px solid var(--border-subtle); display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.8rem; font-weight: 700; color: var(--emerald-600);"><i
                                class="fa-solid fa-clock"></i> 24x7 Open</span>
                        <a href="our-services.php" class="btn btn-primary btn-compact">Details</a>
                    </div>
                </div>
            </div>

            <div class="diag-card">
                <img src="assets/images/lab-facility.jpg" alt="Pathology Lab" class="diag-card-thumb"
                    onerror="this.src='assets/images/campus-building.jpg'">
                <div class="diag-card-body">
                    <span class="med-card-badge"
                        style="background: var(--teal-50); color: var(--teal-600);">Laboratory</span>
                    <h3 style="font-size: 1.25rem; color: var(--primary-900); margin-bottom: 6px;">Automated Pathology
                        Lab</h3>
                    <p style="font-size: 0.85rem; color: var(--text-muted); flex: 1;">5-part hematology analyzers, fully
                        automated biochemistry, hormonal assays, and microbiology with rapid reports.</p>
                    <div
                        style="margin-top: 14px; padding-top: 12px; border-top: 1px solid var(--border-subtle); display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.8rem; font-weight: 700; color: var(--emerald-600);"><i
                                class="fa-solid fa-clock"></i> 24x7 Open</span>
                        <a href="our-services.php" class="btn btn-primary btn-compact">Details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Photo Gallery Highlights -->
<section class="section-py">
    <div class="container">
        <div class="section-title-wrap">
            <span class="section-badge">Campus Life</span>
            <h2 class="section-heading">Campus & Diagnostic Photo Gallery</h2>
            <p class="section-subtitle">Real moments from student training, practical lab sessions, medical diagnostic
                suites, and celebrations.</p>
        </div>

        <div class="gallery-grid">
            <?php foreach (array_slice($gallery_items, 0, 8) as $item):
                $img_src = resolve_gallery_image_src($item['image_url'] ?? '');
                ?>
                <div class="gallery-item" data-category="<?php echo htmlspecialchars($item['category']); ?>">
                    <img src="<?php echo htmlspecialchars($img_src); ?>"
                        alt="<?php echo htmlspecialchars($item['title']); ?>" loading="lazy"
                        onerror="this.src='assets/images/slider-1.jpg'">
                    <div class="gallery-overlay">
                        <h5 class="gallery-title"><?php echo htmlspecialchars($item['title']); ?></h5>
                        <span
                            class="gallery-cat"><?php echo htmlspecialchars($item['category_name'] ?? ucfirst($item['category'])); ?></span>
                    </div>
                    <div class="gallery-zoom-icon"><i class="fa-solid fa-expand"></i></div>
                </div>
            <?php endforeach; ?>
        </div>

        <div style="text-align: center; margin-top: 36px;">
            <a href="gallery.php" class="btn btn-outline" style="padding: 11px 26px;">View Complete Gallery
                (<?php echo count($gallery_items); ?>+ Photos) &rarr;</a>
        </div>
    </div>
</section>

<!-- Quick Inquiry Lead Form Section -->
<section class="section-py section-bg">
    <div class="container">
        <div class="inquiry-layout-grid">
            <div>
                <span class="section-badge">Get in Touch</span>
                <h2 class="section-heading" style="margin-top: 8px;">Begin Your Healthcare Career or Book a Diagnostic
                    Scan</h2>
                <p style="font-size: 0.95rem; color: var(--text-body); line-height: 1.65; margin-bottom: 20px;">
                    Whether you are an aspiring student looking for course information or a patient needing an urgent
                    MRI / CT scan booking, our team is ready to assist you 24x7.
                </p>

                <div style="display: flex; flex-direction: column; gap: 14px;">
                    <div
                        style="display: flex; align-items: center; gap: 14px; background: #ffffff; padding: 14px 18px; border-radius: 10px; border: 1px solid var(--border-subtle);">
                        <div
                            style="width: 44px; height: 44px; border-radius: 50%; background: var(--primary-50); color: var(--primary-600); display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                            <i class="fa-solid fa-phone-volume"></i>
                        </div>
                        <div>
                            <span
                                style="font-size: 0.76rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">24x7
                                Emergency Scanner Hotline</span>
                            <h4 style="color: var(--primary-900); font-size: 1.1rem; margin: 0;">
                                <?php echo $site_emergency; ?></h4>
                        </div>
                    </div>

                    <div
                        style="display: flex; align-items: center; gap: 14px; background: #ffffff; padding: 14px 18px; border-radius: 10px; border: 1px solid var(--border-subtle);">
                        <div
                            style="width: 44px; height: 44px; border-radius: 50%; background: var(--teal-50); color: var(--teal-600); display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <span
                                style="font-size: 0.76rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">Location</span>
                            <h4 style="color: var(--primary-900); font-size: 0.95rem; margin: 0;">
                                <?php echo $site_address; ?></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-card">
                <div style="margin-bottom: 20px; border-bottom: 1px solid var(--border-subtle); padding-bottom: 14px;">
                    <span
                        style="font-size: 0.74rem; font-weight: 800; color: var(--primary-600); text-transform: uppercase;">Direct
                        Online Inquiry</span>
                    <h3 style="font-size: 1.4rem; color: var(--primary-900); margin-top: 2px;">Send Us a Message</h3>
                </div>

                <form class="ajax-inquiry-form" method="POST">
                    <input type="hidden" name="type" value="Homepage General Inquiry">

                    <div class="form-group">
                        <label class="form-label">Your Name *</label>
                        <input type="text" name="name" class="form-input" placeholder="Full name" required>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Phone Number *</label>
                            <input type="tel" name="phone" class="form-input" placeholder="10-digit phone" required
                                pattern="[0-9]{10}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Interested Course / Service</label>
                            <select name="course" class="form-input">
                                <option value="DMLT">DMLT (Medical Lab Tech)</option>
                                <option value="BMLT">BMLT (Bachelor Degree)</option>
                                <option value="DMRT">DMRT (Radiology Tech)</option>
                                <option value="BPT">BPT (Physiotherapy)</option>
                                <option value="ANM Nursing">ANM Nursing</option>
                                <option value="OT Tech">OT Technology</option>
                                <option value="1.5T MRI Scan">1.5T MRI Scan</option>
                                <option value="CT Scan">CT Scan</option>
                                <option value="Pathology Lab">Pathology Lab Test</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Message / Details</label>
                        <textarea name="message" class="form-input" rows="3"
                            placeholder="Tell us about your inquiry..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" style="padding: 12px; font-size: 1rem;">
                        <i class="fa-solid fa-paper-plane"></i> Submit Inquiry
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>