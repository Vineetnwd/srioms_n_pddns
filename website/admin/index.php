<?php
$page_title = "Dashboard";
$page_heading = "Dashboard Overview";
$current_admin_page = "dashboard";

require_once __DIR__ . '/includes/header.php';

$gallery_items = get_gallery_items('all');
$inquiries = get_inquiries_list();
$courses = get_courses_list();
$services = get_services_list();
$settings = get_site_settings();

// Calculate pending inquiries
$pending_inquiries = count(array_filter($inquiries, function($inq) {
    return ($inq['status'] ?? 'New') === 'New';
}));
?>

<!-- Metrics Stats Grid -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card-icon icon-blue"><i class="fa-solid fa-images"></i></div>
        <div class="stat-card-info">
            <h3><?php echo count($gallery_items); ?></h3>
            <p>Gallery Photos</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon icon-orange"><i class="fa-solid fa-user-graduate"></i></div>
        <div class="stat-card-info">
            <h3><?php echo count($inquiries); ?></h3>
            <p>Total Inquiries</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon icon-teal"><i class="fa-solid fa-graduation-cap"></i></div>
        <div class="stat-card-info">
            <h3><?php echo count($courses); ?></h3>
            <p>Active Courses</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-card-icon icon-green"><i class="fa-solid fa-x-ray"></i></div>
        <div class="stat-card-info">
            <h3><?php echo count($services); ?></h3>
            <p>Diagnostic Services</p>
        </div>
    </div>
</div>

<!-- Quick Actions Banner -->
<div class="admin-card mb-4">
    <div class="admin-card-header">
        <h2 class="admin-card-title"><i class="fa-solid fa-bolt text-primary"></i> Quick Management Shortcuts</h2>
    </div>
    <div class="admin-card-body" style="display: flex; gap: 12px; flex-wrap: wrap;">
        <a href="gallery.php#addPhoto" class="admin-btn admin-btn-accent"><i class="fa-solid fa-cloud-arrow-up"></i> Upload New Gallery Photo</a>
        <a href="inquiries.php" class="admin-btn admin-btn-primary"><i class="fa-solid fa-envelope-open-text"></i> View Inquiries (<?php echo $pending_inquiries; ?> New)</a>
        <a href="courses.php" class="admin-btn admin-btn-outline"><i class="fa-solid fa-plus"></i> Add / Edit Course</a>
        <a href="settings.php" class="admin-btn admin-btn-outline"><i class="fa-solid fa-bullhorn"></i> Update Notice Ticker</a>
    </div>
</div>

<!-- Recent Inquiries & Admissions Table -->
<div class="admin-card">
    <div class="admin-card-header">
        <h2 class="admin-card-title"><i class="fa-solid fa-clock-rotate-left text-primary"></i> Recent Inquiries & Admission Leads</h2>
        <a href="inquiries.php" class="admin-btn admin-btn-outline admin-btn-sm">View All Inquiries &rarr;</a>
    </div>
    <div class="admin-card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Applicant / Patient</th>
                        <th>Phone</th>
                        <th>Inquiry Type</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($inquiries)): ?>
                        <tr><td colspan="6" style="text-align: center; color: var(--admin-text-muted); padding: 30px;">No inquiries registered yet.</td></tr>
                    <?php else: ?>
                        <?php foreach (array_slice($inquiries, 0, 5) as $inq): 
                            $status_cls = 'badge-new';
                            if (($inq['status'] ?? '') === 'Contacted') $status_cls = 'badge-contacted';
                            if (($inq['status'] ?? '') === 'Completed') $status_cls = 'badge-completed';
                        ?>
                        <tr>
                            <td><i class="fa-regular fa-clock" style="color: var(--admin-text-muted);"></i> <?php echo htmlspecialchars($inq['date'] ?? 'Recent'); ?></td>
                            <td>
                                <strong><?php echo htmlspecialchars($inq['name']); ?></strong>
                                <?php if (!empty($inq['guardian_name'])): ?>
                                    <span style="display: block; font-size: 0.75rem; color: var(--admin-text-muted);">C/o <?php echo htmlspecialchars($inq['guardian_name']); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $inq['phone']); ?>" style="font-weight: 600;">
                                    <i class="fa-solid fa-phone"></i> <?php echo htmlspecialchars($inq['phone']); ?>
                                </a>
                            </td>
                            <td>
                                <span class="badge badge-active"><?php echo htmlspecialchars($inq['type']); ?></span>
                                <?php if (!empty($inq['course'])): ?>
                                    <span style="font-size: 0.76rem; color: var(--admin-accent); font-weight: 600;">(<?php echo htmlspecialchars($inq['course']); ?>)</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="badge <?php echo $status_cls; ?>"><?php echo htmlspecialchars($inq['status'] ?? 'New'); ?></span>
                            </td>
                            <td>
                                <a href="inquiries.php?id=<?php echo $inq['id']; ?>" class="admin-btn admin-btn-outline admin-btn-sm">Review</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
