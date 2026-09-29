<?php
$page_title = "Website Pages";
$page_heading = "Manage Custom Pages";
$current_admin_page = "pages";

require_once __DIR__ . '/includes/header.php';

$message = '';
$error = '';

// Handle Add Page
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save_page') {
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $image = trim($_POST['image'] ?? '');

    if (empty($title) || empty($slug)) {
        $error = 'Page title and slug are required.';
    } else {
        save_page_item([
            'id'      => intval($_POST['page_id'] ?? 0),
            'title'   => $title,
            'slug'    => $slug,
            'content' => $content,
            'image'   => $image,
            'status'  => 'Active'
        ]);
        $message = 'Page saved successfully!';
    }
}

// Handle Delete Page
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    delete_page_item($delete_id);
    $message = 'Page deleted successfully.';
}

$pages = get_pages_list();
?>

<?php if ($message): ?>
    <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> <?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert alert-danger"><i class="fa-solid fa-circle-exclamation"></i> <?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<!-- Add Page Form -->
<div class="admin-card mb-4">
    <div class="admin-card-header">
        <h2 class="admin-card-title"><i class="fa-solid fa-plus-circle text-primary"></i> Add New Page</h2>
    </div>
    <div class="admin-card-body">
        <form method="POST" action="pages.php">
            <input type="hidden" name="action" value="save_page">
            
            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Page Title *</label>
                    <input type="text" name="title" class="form-input" placeholder="e.g. Teaching Staff" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Page Slug / URL path *</label>
                    <input type="text" name="slug" class="form-input" placeholder="e.g. teaching-staff" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Banner Image URL</label>
                <input type="text" name="image" class="form-input" placeholder="e.g. /assets/images/teaching.jpg">
            </div>

            <div class="form-group">
                <label class="form-label">Page Content</label>
                <textarea name="content" class="form-input" rows="5" placeholder="Enter page text/HTML here..."></textarea>
            </div>

            <button type="submit" class="admin-btn admin-btn-accent"><i class="fa-solid fa-save"></i> Save Page</button>
        </form>
    </div>
</div>

<!-- Pages List -->
<div class="admin-card">
    <div class="admin-card-header">
        <h2 class="admin-card-title">Existing Pages (<?php echo count($pages); ?> Total)</h2>
    </div>
    <div class="admin-card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Page Title</th>
                        <th>Slug / URL</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pages as $p): ?>
                    <tr>
                        <td><strong><?php echo htmlspecialchars($p['title']); ?></strong></td>
                        <td><a href="../page.php?slug=<?php echo htmlspecialchars($p['slug']); ?>" target="_blank"><?php echo htmlspecialchars($p['slug']); ?></a></td>
                        <td>
                            <a href="pages.php?delete=<?php echo $p['id']; ?>" class="admin-btn admin-btn-danger admin-btn-sm" onclick="return confirm('Delete this page?');" title="Delete Page">
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
