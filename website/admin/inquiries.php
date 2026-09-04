<?php
$page_title = "Inquiries & Admissions";
$page_heading = "Student Admissions & Diagnostic Inquiries";
$current_admin_page = "inquiries";

require_once __DIR__ . '/includes/header.php';

$message = '';

// Handle Status Update
if (isset($_POST['action']) && $_POST['action'] === 'update_status') {
    $inq_id = intval($_POST['inquiry_id']);
    $new_status = trim($_POST['status']);
    update_inquiry_status($inq_id, $new_status);
    $message = 'Inquiry status updated to "' . htmlspecialchars($new_status) . '" successfully.';
}

// Handle Delete Inquiry
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    delete_inquiry($delete_id);
    $message = 'Inquiry lead deleted successfully.';
}

$inquiries = get_inquiries_list();
$filter_status = $_GET['status'] ?? 'all';

if ($filter_status !== 'all') {
    $inquiries = array_values(array_filter($inquiries, function($inq) use ($filter_status) {
        return ($inq['status'] ?? 'New') === $filter_status;
    }));
}
?>

<?php if ($message): ?>
    <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> <?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

<div class="admin-card">
    <div class="admin-card-header">
        <div style="display: flex; gap: 8px; flex-wrap: wrap; align-items: center;">
            <a href="inquiries.php?status=all" class="admin-btn <?php echo ($filter_status === 'all') ? 'admin-btn-primary' : 'admin-btn-outline'; ?> admin-btn-sm">All (<?php echo count(get_inquiries_list()); ?>)</a>
            <a href="inquiries.php?status=New" class="admin-btn <?php echo ($filter_status === 'New') ? 'admin-btn-danger' : 'admin-btn-outline'; ?> admin-btn-sm">New Leads</a>
            <a href="inquiries.php?status=Contacted" class="admin-btn <?php echo ($filter_status === 'Contacted') ? 'admin-btn-accent' : 'admin-btn-outline'; ?> admin-btn-sm">Contacted</a>
            <a href="inquiries.php?status=Completed" class="admin-btn <?php echo ($filter_status === 'Completed') ? 'admin-btn-primary' : 'admin-btn-outline'; ?> admin-btn-sm">Completed / Enrolled</a>
        </div>
        <input type="text" id="adminSearchInput" class="form-input" placeholder="Search applicant, phone, course..." style="width: 240px; padding: 6px 12px;">
    </div>

    <div class="admin-card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Date & Time</th>
                        <th>Applicant Details</th>
                        <th>Contact & WhatsApp</th>
                        <th>Purpose / Course</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($inquiries)): ?>
                        <tr><td colspan="6" style="text-align: center; color: var(--admin-text-muted); padding: 30px;">No inquiries found matching your filter.</td></tr>
                    <?php else: ?>
                        <?php foreach ($inquiries as $inq): 
                            $status_cls = 'badge-new';
                            if (($inq['status'] ?? '') === 'Contacted') $status_cls = 'badge-contacted';
                            if (($inq['status'] ?? '') === 'Completed') $status_cls = 'badge-completed';
                            $clean_phone = preg_replace('/[^0-9]/', '', $inq['phone']);
                        ?>
                        <tr class="searchable-row">
                            <td>
                                <span style="font-size: 0.8rem; color: var(--admin-text-muted); font-weight: 500;">
                                    <?php echo htmlspecialchars($inq['date'] ?? ''); ?>
                                </span>
                            </td>
                            <td>
                                <strong style="color: var(--admin-primary); font-size: 0.95rem;"><?php echo htmlspecialchars($inq['name']); ?></strong>
                                <?php if (!empty($inq['guardian_name'])): ?>
                                    <span style="display: block; font-size: 0.76rem; color: var(--admin-text-muted);">Father: <?php echo htmlspecialchars($inq['guardian_name']); ?></span>
                                <?php endif; ?>
                                <?php if (!empty($inq['address'])): ?>
                                    <span style="display: block; font-size: 0.74rem; color: var(--admin-text-muted);"><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($inq['address']); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="tel:<?php echo $clean_phone; ?>" style="font-weight: 600; display: block; color: var(--admin-primary);">
                                    <i class="fa-solid fa-phone"></i> <?php echo htmlspecialchars($inq['phone']); ?>
                                </a>
                                <a href="https://wa.me/91<?php echo $clean_phone; ?>?text=<?php echo urlencode('Hello ' . $inq['name'] . ', regarding your SRIOMS inquiry:'); ?>" target="_blank" style="font-size: 0.76rem; color: #16a34a; display: inline-flex; align-items: center; gap: 4px; font-weight: 600; margin-top: 2px;">
                                    <i class="fa-brands fa-whatsapp"></i> WhatsApp Chat
                                </a>
                            </td>
                            <td>
                                <span class="badge badge-active"><?php echo htmlspecialchars($inq['type']); ?></span>
                                <?php if (!empty($inq['course'])): ?>
                                    <div style="font-weight: 700; color: var(--admin-accent); font-size: 0.82rem; margin-top: 3px;"><?php echo htmlspecialchars($inq['course']); ?></div>
                                <?php endif; ?>
                                <?php if (!empty($inq['message'])): ?>
                                    <p style="font-size: 0.76rem; color: var(--admin-text-muted); margin-top: 4px; max-width: 250px;"><?php echo htmlspecialchars($inq['message']); ?></p>
                                <?php endif; ?>
                            </td>
                            <td>
                                <form method="POST" action="inquiries.php" style="display: flex; gap: 4px; align-items: center;">
                                    <input type="hidden" name="action" value="update_status">
                                    <input type="hidden" name="inquiry_id" value="<?php echo $inq['id']; ?>">
                                    <select name="status" class="form-input" style="padding: 4px 6px; font-size: 0.78rem; width: 110px;" onchange="this.form.submit()">
                                        <option value="New" <?php echo (($inq['status'] ?? '') === 'New') ? 'selected' : ''; ?>>New</option>
                                        <option value="Contacted" <?php echo (($inq['status'] ?? '') === 'Contacted') ? 'selected' : ''; ?>>Contacted</option>
                                        <option value="Completed" <?php echo (($inq['status'] ?? '') === 'Completed') ? 'selected' : ''; ?>>Completed</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <a href="inquiries.php?delete=<?php echo $inq['id']; ?>" class="admin-btn admin-btn-danger admin-btn-sm" onclick="return confirm('Delete this inquiry?');" title="Delete Inquiry">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
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
