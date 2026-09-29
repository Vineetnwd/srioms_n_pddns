<?php
$page_title = "Diagnostic Services";
$page_heading = "Diagnostic Care & Services Management";
$current_admin_page = "services";

require_once __DIR__ . '/includes/header.php';

$message = '';
$error = '';

// Handle Add Service
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save_service') {
    $name = trim($_POST['name'] ?? '');
    $category = trim($_POST['category'] ?? 'Radiology');
    $timing = trim($_POST['timing'] ?? '24x7 Open');
    $description = trim($_POST['description'] ?? '');

    if (empty($name)) {
        $error = 'Service name is required.';
    } else {
        save_service_item([
            'id'          => intval($_POST['service_id'] ?? 0),
            'name'        => $name,
            'category'    => $category,
            'timing'      => $timing,
            'description' => $description,
            'featured'    => 1,
            'status'      => 'Active'
        ]);
        $message = 'Diagnostic service saved successfully!';
    }
}

// Handle Delete Service
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    delete_service_item($delete_id);
    $message = 'Diagnostic service removed successfully.';
}

$services = get_services_list();
?>

<?php if ($message): ?>
    <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> <?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert alert-danger"><i class="fa-solid fa-circle-exclamation"></i> <?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<!-- Add Service Form -->
<div class="admin-card mb-4">
    <div class="admin-card-header">
        <h2 class="admin-card-title"><i class="fa-solid fa-plus-circle text-primary"></i> Add Diagnostic Facility / Service</h2>
    </div>
    <div class="admin-card-body">
        <form method="POST" action="our-services.php" id="serviceForm">
            <input type="hidden" name="action" value="save_service">
            <input type="hidden" name="service_id" id="service_id" value="">
            
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Service / Scan Name *</label>
                    <input type="text" name="name" class="form-input" placeholder="e.g. 1.5 Tesla MRI Scan / Multi-slice CT" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Department / Category *</label>
                    <select name="category" class="form-input" required>
                        <option value="Radiology">Radiology & Imaging</option>
                        <option value="Laboratory">Pathology & Biochemistry Lab</option>
                        <option value="Sonography">Ultrasound & Doppler</option>
                        <option value="Cardiology">Cardiology & ECG</option>
                        <option value="Rehabilitation">Physiotherapy & Rehab</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Operational Hours</label>
                <input type="text" name="timing" class="form-input" placeholder="e.g. 24x7 Open / 8:00 AM - 8:00 PM">
            </div>

            <div class="form-group">
                <label class="form-label">Service Details & Key Tests</label>
                <textarea name="description" class="form-input" rows="2" placeholder="Describe scan capabilities, equipment model, and test scope..."></textarea>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" id="submitBtn" class="admin-btn admin-btn-accent"><i class="fa-solid fa-save"></i> Save Diagnostic Service</button>
                <button type="button" id="cancelEditBtn" class="admin-btn admin-btn-outline" style="display: none;" onclick="cancelEdit();">Cancel Edit</button>
            </div>
        </form>
    </div>
</div>

<!-- Services List -->
<div class="admin-card">
    <div class="admin-card-header">
        <h2 class="admin-card-title">Diagnostic Services Catalog (<?php echo count($services); ?> Total)</h2>
        <a href="../our-services.php" target="_blank" class="admin-btn admin-btn-outline admin-btn-sm"><i class="fa-solid fa-eye"></i> View Public Services</a>
    </div>
    <div class="admin-card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Service / Diagnostic Name</th>
                        <th>Department</th>
                        <th>Operating Hours</th>
                        <th>Overview</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($services as $s): ?>
                    <tr style="transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f8fafc';" onmouseout="this.style.backgroundColor='transparent';">
                        <td style="vertical-align: middle;">
                            <strong style="color: var(--admin-primary); font-size: 1.05rem;"><?php echo htmlspecialchars($s['name']); ?></strong>
                        </td>
                        <td><span class="badge badge-active"><?php echo htmlspecialchars($s['category']); ?></span></td>
                        <td><i class="fa-regular fa-clock" style="color: var(--admin-text-muted);"></i> <?php echo htmlspecialchars($s['timing']); ?></td>
                        <td><p style="font-size: 0.8rem; color: var(--admin-text-muted);"><?php echo htmlspecialchars($s['description']); ?></p></td>
                        <td style="vertical-align: middle;">
                            <div style="display: flex; gap: 6px;">
                                <button type="button" class="admin-btn admin-btn-primary admin-btn-sm" style="padding: 6px 10px;" onclick='editService(<?php echo json_encode($s); ?>)' title="Edit">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </button>
                                <a href="our-services.php?delete=<?php echo $s['id']; ?>" class="admin-btn admin-btn-danger admin-btn-sm" style="padding: 6px 10px;" onclick="return confirm('Are you sure you want to delete this diagnostic service?');" title="Delete">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function editService(service) {
    document.getElementById('service_id').value = service.id;
    document.querySelector('input[name="name"]').value = service.name;
    document.querySelector('select[name="category"]').value = service.category;
    document.querySelector('input[name="timing"]').value = service.timing || '';
    document.querySelector('textarea[name="description"]').value = service.description || '';
    
    document.querySelector('.admin-card-title').innerHTML = '<i class="fa-solid fa-pen text-primary"></i> Edit Diagnostic Service: ' + service.name;
    document.getElementById('submitBtn').innerHTML = '<i class="fa-solid fa-save"></i> Update Service';
    document.getElementById('cancelEditBtn').style.display = 'inline-block';
    
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function cancelEdit() {
    document.getElementById('serviceForm').reset();
    document.getElementById('service_id').value = '';
    
    document.querySelector('.admin-card-title').innerHTML = '<i class="fa-solid fa-plus-circle text-primary"></i> Add Diagnostic Facility / Service';
    document.getElementById('submitBtn').innerHTML = '<i class="fa-solid fa-save"></i> Save Diagnostic Service';
    document.getElementById('cancelEditBtn').style.display = 'none';
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
