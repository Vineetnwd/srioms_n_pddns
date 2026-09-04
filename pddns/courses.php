<?php
$page_title = "Nursing Programs";
$page_description = "Explore recognized Nursing Programs at Pt. Deen Dayal Nursing School (PDDNS) - ANM (2 Yrs), GNM (3 Yrs), B.Sc Nursing (4 Yrs), Post Basic B.Sc, DMLT and OT Tech.";
$current_page = "courses";

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/db.php';

$courses = get_pddns_courses_list();
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <div>
            <h1>Nursing & Healthcare Programs</h1>
            <p>Government recognized nursing diploma, degree, and paramedical programs designed with comprehensive clinical curricula.</p>
        </div>
        <div class="breadcrumbs">
            <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            <span>/</span>
            <span class="current">Nursing Programs</span>
        </div>
    </div>
</section>

<!-- Courses List -->
<section class="section-py">
    <div class="container">
        <div class="cards-grid-3">
            <?php foreach ($courses as $c): ?>
            <div class="nursing-card" id="<?php echo strtolower(preg_replace('/[^a-z0-9]/', '', $c['code'])); ?>">
                <div class="nursing-card-body">
                    <span class="nursing-card-badge"><?php echo htmlspecialchars($c['level']); ?></span>
                    <h3 class="nursing-card-title"><?php echo htmlspecialchars($c['name']); ?> (<?php echo htmlspecialchars($c['code']); ?>)</h3>
                    <p style="font-size: 0.88rem; color: var(--text-muted); flex: 1; margin-bottom: 14px;"><?php echo htmlspecialchars($c['description']); ?></p>

                    <ul class="nursing-meta-list">
                        <li><i class="fa-regular fa-clock"></i> <strong>Duration:</strong> <?php echo htmlspecialchars($c['duration']); ?></li>
                        <li><i class="fa-solid fa-graduation-cap"></i> <strong>Eligibility:</strong> <?php echo htmlspecialchars($c['eligibility']); ?></li>
                        <li><i class="fa-solid fa-users"></i> <strong>Seat Intake:</strong> <?php echo htmlspecialchars($c['seats']); ?></li>
                        <li><i class="fa-solid fa-indian-rupee-sign"></i> <strong>Estimated Fee:</strong> <?php echo htmlspecialchars($c['fees']); ?></li>
                    </ul>

                    <div style="margin-top: 14px; padding-top: 14px; border-top: 1px solid var(--border-subtle); display: flex; justify-content: space-between; align-items: center;">
                        <a href="admissions.php?course=<?php echo urlencode($c['name']); ?>" class="btn btn-primary btn-block">Apply for Admission &rarr;</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
