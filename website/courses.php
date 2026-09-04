<?php
$page_title = "Paramedical Courses & Academics";
$page_description = "Explore Paramedical & Allied Healthcare Courses at SRIOMS Siwan - DMLT, BMLT, DMRT, BPT, ANM Nursing, and OT Technology. Course duration, eligibility, and fees.";
$current_page = "courses";

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/db.php';

$courses = get_courses_list();
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <div>
            <h1>Paramedical Programs & Academics</h1>
            <p>Career-focused Diploma and Bachelor Degree programs designed with comprehensive clinical training and modern laboratory practicals.</p>
        </div>
        <div class="breadcrumbs">
            <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            <span>/</span>
            <span class="current">Courses</span>
        </div>
    </div>
</section>

<!-- Courses Catalog -->
<section class="section-py">
    <div class="container">
        <div class="cards-grid-3">
            <?php foreach ($courses as $c): ?>
            <div class="med-card" id="<?php echo strtolower(preg_replace('/[^a-z0-9]/', '', $c['code'])); ?>">
                <div class="med-card-body">
                    <span class="med-card-badge"><?php echo htmlspecialchars($c['level']); ?></span>
                    <h3 class="med-card-title"><?php echo htmlspecialchars($c['name']); ?> (<?php echo htmlspecialchars($c['code']); ?>)</h3>
                    <p style="font-size: 0.88rem; color: var(--text-muted); flex: 1; margin-bottom: 16px;"><?php echo htmlspecialchars($c['description']); ?></p>

                    <ul class="med-meta-list">
                        <li><i class="fa-regular fa-clock"></i> <strong>Duration:</strong> <?php echo htmlspecialchars($c['duration']); ?></li>
                        <li><i class="fa-solid fa-graduation-cap"></i> <strong>Eligibility:</strong> <?php echo htmlspecialchars($c['eligibility']); ?></li>
                        <li><i class="fa-solid fa-users"></i> <strong>Seat Intake:</strong> <?php echo htmlspecialchars($c['seats'] ?? '40-60'); ?> Seats</li>
                        <li><i class="fa-solid fa-indian-rupee-sign"></i> <strong>Estimated Fee:</strong> <?php echo htmlspecialchars($c['fees'] ?? 'On Request'); ?></li>
                    </ul>

                    <div style="margin-top: 14px; padding-top: 14px; border-top: 1px solid var(--border-subtle);">
                        <a href="contact.php?course=<?php echo urlencode($c['code']); ?>" class="btn btn-primary btn-block">Inquire & Apply &rarr;</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
