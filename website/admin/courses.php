<?php
$page_title = "Courses Manager";
$page_heading = "Paramedical Courses Management";
$current_admin_page = "courses";

require_once __DIR__ . '/includes/header.php';

$message = '';
$error = '';

// Handle Add / Edit Course
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save_course') {
    $code = trim($_POST['code'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $level = trim($_POST['level'] ?? 'Diploma');
    $duration = trim($_POST['duration'] ?? '');
    $eligibility = trim($_POST['eligibility'] ?? '');
    $fees = trim($_POST['fees'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if (empty($code) || empty($name)) {
        $error = 'Course code and course name are required.';
    } else {
        save_course_item([
            'id'          => intval($_POST['course_id'] ?? 0),
            'code'        => $code,
            'name'        => $name,
            'level'       => $level,
            'duration'    => $duration,
            'eligibility' => $eligibility,
            'fees'        => $fees,
            'description' => $description,
            'status'      => 'Active'
        ]);
        $message = 'Course saved successfully!';
    }
}

// Handle Delete Course
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    delete_course_item($delete_id);
    $message = 'Course deleted successfully.';
}

$courses = get_courses_list();
?>

<?php if ($message): ?>
    <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> <?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert alert-danger"><i class="fa-solid fa-circle-exclamation"></i> <?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<!-- Add / Edit Course Form -->
<div class="admin-card mb-4">
    <div class="admin-card-header">
        <h2 class="admin-card-title"><i class="fa-solid fa-plus-circle text-primary"></i> Add New Paramedical Course</h2>
    </div>
    <div class="admin-card-body">
        <form method="POST" action="courses.php" id="courseForm">
            <input type="hidden" name="action" value="save_course">
            <input type="hidden" name="course_id" id="course_id" value="">
            
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Course Short Code *</label>
                    <input type="text" name="code" class="form-input" placeholder="e.g. DMLT / BPT / ANM" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Full Course Title *</label>
                    <input type="text" name="name" class="form-input" placeholder="e.g. Diploma in Medical Laboratory Technology" required>
                </div>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Course Level *</label>
                    <select name="level" class="form-input" required>
                        <option value="Diploma">Diploma</option>
                        <option value="Degree">Degree / Bachelor</option>
                        <option value="Nursing">Nursing</option>
                        <option value="Certificate">Certificate</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Duration *</label>
                    <input type="text" name="duration" class="form-input" placeholder="e.g. 2 Years (4 Semesters)" required>
                </div>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Eligibility Criteria *</label>
                    <input type="text" name="eligibility" class="form-input" placeholder="e.g. 10+2 Science (PCB/PCM)" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Estimated Fee</label>
                    <input type="text" name="fees" class="form-input" placeholder="e.g. ₹45,000 / Year">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Course Overview / Description</label>
                <textarea name="description" class="form-input" rows="2" placeholder="Brief outline of practical clinical training and subjects..."></textarea>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" id="submitBtn" class="admin-btn admin-btn-accent"><i class="fa-solid fa-save"></i> Save Course</button>
                <button type="button" id="cancelEditBtn" class="admin-btn admin-btn-outline" style="display: none;" onclick="cancelEdit();">Cancel Edit</button>
            </div>
        </form>
    </div>
</div>

<!-- Courses List -->
<div class="admin-card">
    <div class="admin-card-header">
        <h2 class="admin-card-title">Existing Courses (<?php echo count($courses); ?> Total)</h2>
        <a href="../courses.php" target="_blank" class="admin-btn admin-btn-outline admin-btn-sm"><i class="fa-solid fa-eye"></i> View Public Catalog</a>
    </div>
    <div class="admin-card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Course Title</th>
                        <th>Level</th>
                        <th>Duration</th>
                        <th>Eligibility</th>
                        <th>Fee / Year</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courses as $c): ?>
                    <tr style="transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f8fafc';" onmouseout="this.style.backgroundColor='transparent';">
                        <td style="vertical-align: middle;">
                            <span style="background: #e0e7ff; color: #4338ca; padding: 4px 8px; border-radius: 4px; font-weight: 700; font-size: 0.85rem;">
                                <?php echo htmlspecialchars($c['code']); ?>
                            </span>
                        </td>
                        <td>
                            <strong><?php echo htmlspecialchars($c['name']); ?></strong>
                            <p style="font-size: 0.76rem; color: var(--admin-text-muted); margin-top: 2px;"><?php echo htmlspecialchars($c['description'] ?? ''); ?></p>
                        </td>
                        <td><span class="badge badge-active"><?php echo htmlspecialchars($c['level']); ?></span></td>
                        <td><?php echo htmlspecialchars($c['duration']); ?></td>
                        <td><?php echo htmlspecialchars($c['eligibility']); ?></td>
                        <td><?php echo htmlspecialchars($c['fees'] ?? 'On Request'); ?></td>
                        <td style="vertical-align: middle;">
                            <div style="display: flex; gap: 6px;">
                                <button type="button" class="admin-btn admin-btn-primary admin-btn-sm" style="padding: 6px 10px;" onclick='editCourse(<?php echo json_encode($c); ?>)' title="Edit Course">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </button>
                                <a href="courses.php?delete=<?php echo $c['id']; ?>" class="admin-btn admin-btn-danger admin-btn-sm" style="padding: 6px 10px;" onclick="return confirm('Are you sure you want to delete this course?');" title="Delete Course">
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
function editCourse(course) {
    document.getElementById('course_id').value = course.id;
    document.querySelector('input[name="code"]').value = course.code;
    document.querySelector('input[name="name"]').value = course.name;
    document.querySelector('select[name="level"]').value = course.level;
    document.querySelector('input[name="duration"]').value = course.duration;
    document.querySelector('input[name="eligibility"]').value = course.eligibility;
    document.querySelector('input[name="fees"]').value = course.fees || '';
    document.querySelector('textarea[name="description"]').value = course.description || '';
    
    document.querySelector('.admin-card-title').innerHTML = '<i class="fa-solid fa-pen text-primary"></i> Edit Course: ' + course.code;
    document.getElementById('submitBtn').innerHTML = '<i class="fa-solid fa-save"></i> Update Course';
    document.getElementById('cancelEditBtn').style.display = 'inline-block';
    
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function cancelEdit() {
    document.getElementById('courseForm').reset();
    document.getElementById('course_id').value = '';
    
    document.querySelector('.admin-card-title').innerHTML = '<i class="fa-solid fa-plus-circle text-primary"></i> Add New Paramedical Course';
    document.getElementById('submitBtn').innerHTML = '<i class="fa-solid fa-save"></i> Save Course';
    document.getElementById('cancelEditBtn').style.display = 'none';
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
