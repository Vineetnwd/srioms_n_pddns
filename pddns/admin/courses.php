<?php
$page_title = "Nursing Programs";
$page_heading = "Nursing & Paramedical Programs Management";
$current_admin_page = "courses";

require_once __DIR__ . '/includes/header.php';

$message = '';
$error = '';

// Handle Add / Edit Course
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save_course') {
    $code = trim($_POST['code'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $level = trim($_POST['level'] ?? 'Diploma in Nursing');
    $duration = trim($_POST['duration'] ?? '');
    $eligibility = trim($_POST['eligibility'] ?? '');
    $fees = trim($_POST['fees'] ?? '');
    $seats = trim($_POST['seats'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if (empty($code) || empty($name)) {
        $error = 'Course code and course title are required.';
    } else {
        save_pddns_course_item([
            'id'          => intval($_POST['course_id'] ?? 0),
            'code'        => $code,
            'name'        => $name,
            'level'       => $level,
            'duration'    => $duration,
            'eligibility' => $eligibility,
            'fees'        => $fees,
            'seats'       => $seats,
            'description' => $description,
            'status'      => 'Active'
        ]);
        $message = 'Nursing program saved successfully!';
    }
}

// Handle Delete Course
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    delete_pddns_course_item($delete_id);
    $message = 'Program deleted.';
}

$courses = get_pddns_courses_list();
?>

<?php if ($message): ?>
    <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> <?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert alert-danger"><i class="fa-solid fa-circle-exclamation"></i> <?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<!-- Add New Program -->
<div class="admin-card mb-4">
    <div class="admin-card-header">
        <h2 class="admin-card-title"><i class="fa-solid fa-plus-circle text-primary"></i> Add New Nursing Program</h2>
    </div>
    <div class="admin-card-body">
        <form method="POST" action="courses.php">
            <input type="hidden" name="action" value="save_course">
            
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Program Code *</label>
                    <input type="text" name="code" class="form-input" placeholder="e.g. ANM / GNM / B.Sc Nursing" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Full Program Name *</label>
                    <input type="text" name="name" class="form-input" placeholder="e.g. General Nursing and Midwifery" required>
                </div>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Level *</label>
                    <select name="level" class="form-input" required>
                        <option value="Diploma in Nursing">Diploma in Nursing</option>
                        <option value="Undergraduate Degree">Undergraduate Degree</option>
                        <option value="Post Basic Degree">Post Basic Degree</option>
                        <option value="Paramedical Diploma">Paramedical Diploma</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Duration *</label>
                    <input type="text" name="duration" class="form-input" placeholder="e.g. 3 Years (Incl. 6M Internship)" required>
                </div>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Eligibility *</label>
                    <input type="text" name="eligibility" class="form-input" placeholder="e.g. 10+2 with English & PCB (40%+)" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Estimated Fee</label>
                    <input type="text" name="fees" class="form-input" placeholder="e.g. ₹75,000 / Year">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Seats Intake</label>
                <input type="text" name="seats" class="form-input" placeholder="e.g. 60 Seats">
            </div>

            <div class="form-group">
                <label class="form-label">Curriculum & Description</label>
                <textarea name="description" class="form-input" rows="2" placeholder="Clinical rotations, syllabus outline, ward postings..."></textarea>
            </div>

            <button type="submit" class="admin-btn admin-btn-accent"><i class="fa-solid fa-save"></i> Save Nursing Course</button>
        </form>
    </div>
</div>

<!-- Courses List -->
<div class="admin-card">
    <div class="admin-card-header">
        <h2 class="admin-card-title">Existing Nursing Courses (<?php echo count($courses); ?> Total)</h2>
        <a href="../courses.php" target="_blank" class="admin-btn admin-btn-outline admin-btn-sm"><i class="fa-solid fa-eye"></i> View Public Courses</a>
    </div>
    <div class="admin-card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Program Title</th>
                        <th>Level</th>
                        <th>Duration</th>
                        <th>Eligibility</th>
                        <th>Fee / Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courses as $c): ?>
                    <tr>
                        <td><strong style="color: var(--admin-accent);"><?php echo htmlspecialchars($c['code']); ?></strong></td>
                        <td>
                            <strong><?php echo htmlspecialchars($c['name']); ?></strong>
                            <p style="font-size: 0.76rem; color: var(--admin-text-muted); margin-top: 2px;"><?php echo htmlspecialchars($c['description'] ?? ''); ?></p>
                        </td>
                        <td><span class="badge badge-active"><?php echo htmlspecialchars($c['level']); ?></span></td>
                        <td><?php echo htmlspecialchars($c['duration']); ?></td>
                        <td><?php echo htmlspecialchars($c['eligibility']); ?></td>
                        <td><?php echo htmlspecialchars($c['fees'] ?? 'On Request'); ?></td>
                        <td>
                            <a href="courses.php?delete=<?php echo $c['id']; ?>" class="admin-btn admin-btn-danger admin-btn-sm" onclick="return confirm('Delete this course?');" title="Delete Course">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
