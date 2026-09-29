<?php
$page_title = "Staff Management";
$page_heading = "Teaching & Non-Teaching Staff";
$current_admin_page = "staff";

require_once __DIR__ . '/includes/header.php';

$message = '';
$error = '';

$pdo = srioms_db_connect();
if (!$pdo) {
    die('<div class="alert alert-danger">Database connection failed.</div>');
}

// Handle Add / Edit Staff
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save_staff') {
    $staff_id = intval($_POST['staff_id'] ?? 0);
    $name = trim($_POST['name'] ?? '');
    $type = trim($_POST['type'] ?? 'Teaching');
    $designation = trim($_POST['designation'] ?? '');
    $details = trim($_POST['details'] ?? '');
    $status = 'Active';

    // Handle Image Upload
    $image = trim($_POST['existing_image'] ?? '');
    if (!empty($_FILES['image_file']['name'])) {
        $upload_dir = __DIR__ . '/../assets/images/staff/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $file_info = pathinfo($_FILES['image_file']['name']);
        $ext = strtolower($file_info['extension']);
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $new_name = 'staff_' . time() . '_' . rand(100, 999) . '.' . $ext;
            if (move_uploaded_file($_FILES['image_file']['tmp_name'], $upload_dir . $new_name)) {
                $image = '/assets/images/staff/' . $new_name;
            }
        }
    }

    if (empty($name) || empty($designation)) {
        $error = 'Staff name and designation are required.';
    } else {
        try {
            if ($staff_id > 0) {
                $stmt = $pdo->prepare("UPDATE `srioms_staff` SET name = ?, type = ?, designation = ?, details = ?, image = ?, status = ? WHERE id = ?");
                $stmt->execute([$name, $type, $designation, $details, $image, $status, $staff_id]);
                $message = 'Staff member updated successfully!';
            } else {
                $stmt = $pdo->prepare("INSERT INTO `srioms_staff` (name, type, designation, details, image, status) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$name, $type, $designation, $details, $image, $status]);
                $message = 'Staff member added successfully!';
            }
        } catch (PDOException $e) {
            $error = "Database Error: " . $e->getMessage();
        }
    }
}

// Handle Delete Staff
if (isset($_GET['delete'])) {
    try {
        $delete_id = intval($_GET['delete']);
        $stmt = $pdo->prepare("DELETE FROM `srioms_staff` WHERE id = ?");
        $stmt->execute([$delete_id]);
        $message = 'Staff member deleted successfully.';
    } catch (PDOException $e) {
        $error = "Database Error: " . $e->getMessage();
    }
}

// Fetch all staff
$stmt = $pdo->query("SELECT * FROM `srioms_staff` ORDER BY id DESC");
$staff_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    .admin-grid-layout {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    @media (min-width: 1024px) {
        .admin-grid-layout {
            flex-direction: row;
            align-items: flex-start;
        }
    }
    .premium-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }
    .premium-card-header {
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .premium-card-title {
        font-size: 1rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }
    .premium-card-body {
        padding: 16px;
    }
    .modern-input {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        padding: 8px 12px;
        width: 100%;
        font-size: 0.85rem;
        color: #1e293b;
    }
    .modern-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        outline: none;
    }
    .modern-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 4px;
        display: block;
    }
    .btn-gradient {
        background: #2563eb;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.85rem;
        cursor: pointer;
        transition: background 0.2s;
    }
    .btn-gradient:hover {
        background: #1d4ed8;
    }
    .staff-avatar {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: #e2e8f0;
        color: #475569;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1.2rem;
        object-fit: cover;
    }
    .table-row-hover:hover {
        background-color: #f1f5f9;
    }
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 12px;
    }
    .form-group-compact {
        margin-bottom: 0;
    }
    .badge-role {
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
        border: 1px solid #e2e8f0;
    }
    .badge-teaching { background: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
    .badge-nonteaching { background: #fef2f2; color: #b91c1c; border-color: #fecaca; }
    .badge-management { background: #fefce8; color: #a16207; border-color: #fef08a; }
    .text-muted {
        color: #64748b;
        font-size: 0.75rem;
    }
</style>

<?php if ($message): ?>
    <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> <?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>
<?php if ($error): ?>
    <div class="alert alert-danger"><i class="fa-solid fa-circle-exclamation"></i> <?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<div class="admin-grid-layout" style="gap: 24px;">
    <!-- Add / Edit Form -->
    <div class="admin-grid-col" style="flex: 1;">
        <div class="premium-card">
            <div class="premium-card-header">
                <div style="color: #3b82f6; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <h2 class="premium-card-title">Manage Staff</h2>
            </div>
            <div class="premium-card-body" style="padding: 16px;">
                <form method="POST" action="" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="save_staff">
                    <input type="hidden" name="staff_id" id="edit_staff_id" value="0">
                    <input type="hidden" name="existing_image" id="edit_existing_image" value="">
                    
                    <div class="form-grid">
                        <div class="form-group-compact">
                            <label class="modern-label">Full Name *</label>
                            <input type="text" name="name" id="edit_name" class="modern-input" placeholder="e.g. Dr. John Doe" required>
                        </div>
                        <div class="form-group-compact">
                            <label class="modern-label">Staff Category *</label>
                            <select name="type" id="edit_type" class="modern-input" required>
                                <option value="Teaching">Teaching Staff</option>
                                <option value="Non-Teaching">Non-Teaching Staff</option>
                                <option value="Management">Management Board</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-grid">
                        <div class="form-group-compact">
                            <label class="modern-label">Designation / Role *</label>
                            <input type="text" name="designation" id="edit_designation" class="modern-input" placeholder="e.g. Senior Lecturer" required>
                        </div>
                        <div class="form-group-compact">
                            <label class="modern-label">Upload Photo</label>
                            <input type="file" name="image_file" accept="image/*" class="modern-input" style="padding: 5px;">
                            <small id="current_image_hint" style="color: #64748b; font-size: 0.65rem; display: none;">Leave blank to keep existing image</small>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 12px;">
                        <label class="modern-label">Qualifications / Short Bio</label>
                        <textarea name="details" id="edit_details" class="modern-input" rows="2" placeholder="e.g. MBBS, MD with 10 years experience..."></textarea>
                    </div>

                    <div style="display: flex; gap: 8px;">
                        <button type="submit" class="btn-gradient" style="flex: 1;"><i class="fa-solid fa-floppy-disk"></i> Save Staff</button>
                        <button type="button" class="admin-btn admin-btn-outline" style="border-radius: 6px; padding: 0 12px; height: 33px; background: transparent; border: 1px solid #cbd5e1; color: #475569; cursor: pointer;" onclick="resetForm()" title="Cancel Edit">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Staff List -->
    <div class="admin-grid-col" style="flex: 2;">
        <div class="premium-card">
            <div class="premium-card-header" style="justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <div style="color: #10b981; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h2 class="premium-card-title">Staff Directory</h2>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <a href="../staff.php" target="_blank" style="font-size: 0.75rem; text-decoration: none; color: #3b82f6; font-weight: 600;"><i class="fa-solid fa-eye"></i> Public View</a>
                    <span style="background: #e2e8f0; color: #475569; padding: 2px 8px; border-radius: 12px; font-size: 0.7rem; font-weight: 600;">
                        <?php echo count($staff_list); ?> Total
                    </span>
                </div>
            </div>
            <div class="premium-card-body p-0">
                <div class="table-responsive" style="border: none;">
                    <table class="admin-table" style="margin: 0; width: 100%;">
                        <thead>
                            <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                                <th style="padding: 12px 16px; font-size: 0.7rem; text-transform: uppercase; color: #64748b; text-align: left;">Staff Profile</th>
                                <th style="padding: 12px 16px; font-size: 0.7rem; text-transform: uppercase; color: #64748b; text-align: left;">Qualifications & Role</th>
                                <th style="padding: 12px 16px; font-size: 0.7rem; text-transform: uppercase; color: #64748b; text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($staff_list)): ?>
                                <?php foreach ($staff_list as $s): ?>
                                    <tr class="table-row-hover" style="border-bottom: 1px solid #f1f5f9;">
                                        <td style="padding: 12px 16px;">
                                            <div style="display: flex; align-items: center; gap: 12px;">
                                                <?php if (!empty($s['image'])): ?>
                                                    <img src="<?php echo htmlspecialchars($s['image']); ?>" class="staff-avatar" alt="Avatar">
                                                <?php else: ?>
                                                    <div class="staff-avatar">
                                                        <?php echo strtoupper(substr($s['name'], 0, 1)); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <div>
                                                    <div style="font-weight: 700; color: #1e293b; font-size: 0.85rem;">
                                                        <?php echo htmlspecialchars($s['name']); ?>
                                                    </div>
                                                    <div class="text-muted" style="margin-top: 2px; font-weight: 500;">
                                                        <?php echo htmlspecialchars($s['designation']); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 12px 16px;">
                                            <div style="margin-bottom: 4px;">
                                                <?php 
                                                    $badgeClass = 'badge-teaching';
                                                    if($s['type'] == 'Non-Teaching') $badgeClass = 'badge-nonteaching';
                                                    if($s['type'] == 'Management') $badgeClass = 'badge-management';
                                                ?>
                                                <span class="badge-role <?php echo $badgeClass; ?>">
                                                    <?php echo htmlspecialchars($s['type']); ?>
                                                </span>
                                            </div>
                                            <?php if (!empty($s['details'])): ?>
                                                <div class="text-muted" style="font-size: 0.75rem; max-width: 250px; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                                    <?php echo htmlspecialchars($s['details']); ?>
                                                </div>
                                            <?php else: ?>
                                                <div class="text-muted" style="font-style: italic;">No bio added.</div>
                                            <?php endif; ?>
                                        </td>
                                        <td style="padding: 12px 16px; text-align: right; vertical-align: middle;">
                                            <div style="display: flex; gap: 6px; justify-content: flex-end;">
                                                <button onclick="editStaff(<?php echo $s['id']; ?>, '<?php echo addslashes($s['name']); ?>', '<?php echo addslashes($s['type']); ?>', '<?php echo addslashes($s['designation']); ?>', '<?php echo addslashes($s['image'] ?? ''); ?>', '<?php echo addslashes($s['details'] ?? ''); ?>')" 
                                                        style="background: transparent; color: #3b82f6; border: 1px solid #bfdbfe; width: 28px; height: 28px; border-radius: 6px; cursor: pointer; transition: 0.2s;" 
                                                        onmouseover="this.style.background='#eff6ff'" onmouseout="this.style.background='transparent'" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square" style="font-size: 0.75rem;"></i>
                                                </button>
                                                <a href="?delete=<?php echo $s['id']; ?>" 
                                                   style="background: transparent; color: #ef4444; border: 1px solid #fecaca; width: 28px; height: 28px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; transition: 0.2s;"
                                                   onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='transparent'"
                                                   onclick="return confirm('Are you sure you want to delete this staff member?');" title="Delete">
                                                    <i class="fa-solid fa-trash-can" style="font-size: 0.75rem;"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center" style="padding: 40px; color: #94a3b8;">
                                        <i class="fa-solid fa-user-slash" style="font-size: 2rem; margin-bottom: 12px; opacity: 0.5;"></i>
                                        <div style="font-weight: 500;">No staff members found.</div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function editStaff(id, name, type, designation, image, details) {
    document.getElementById('edit_staff_id').value = id;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_type').value = type;
    document.getElementById('edit_designation').value = designation;
    document.getElementById('edit_existing_image').value = image;
    document.getElementById('edit_details').value = details;
    
    if (image) {
        document.getElementById('current_image_hint').style.display = 'block';
    } else {
        document.getElementById('current_image_hint').style.display = 'none';
    }
    
    document.getElementById('edit_name').focus();
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
function resetForm() {
    document.getElementById('edit_staff_id').value = '0';
    document.getElementById('edit_name').value = '';
    document.getElementById('edit_type').value = 'Teaching';
    document.getElementById('edit_designation').value = '';
    document.getElementById('edit_existing_image').value = '';
    document.getElementById('edit_details').value = '';
    document.getElementById('current_image_hint').style.display = 'none';
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
