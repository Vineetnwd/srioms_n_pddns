<?php
$page_title = "Nursing Gallery Manager";
$page_heading = "PDDNS Gallery Management";
$current_admin_page = "gallery";

require_once __DIR__ . '/includes/header.php';

$message = '';
$error = '';

$category_names = [
    'labs'        => 'Nursing Labs & Practical',
    'diagnostics' => 'Hospital Clinical Postings',
    'events'      => 'Lamp Lighting & Events',
    'campus'      => 'Campus Infrastructure'
];

// Handle Image Upload / Add
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_photo') {
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? 'labs');
    $category_name = $category_names[$category] ?? ucfirst($category);
    $image_url = '';

    // Handle File Upload
    if (isset($_FILES['photo_file']) && $_FILES['photo_file']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = __DIR__ . '/../assets/images/gallery';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $file_tmp = $_FILES['photo_file']['tmp_name'];
        $file_name = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $_FILES['photo_file']['name']);
        $new_file_name = time() . '_' . $file_name;
        $target_file = $upload_dir . '/' . $new_file_name;

        if (move_uploaded_file($file_tmp, $target_file)) {
            $image_url = 'assets/images/gallery/' . $new_file_name;
        } else {
            $error = 'Failed to upload image file to server.';
        }
    } elseif (!empty($_POST['image_url'])) {
        $image_url = ltrim(trim($_POST['image_url']), '/');
    }

    if (empty($title)) {
        $error = 'Please enter a title for the photo.';
    } elseif (empty($image_url)) {
        $error = $error ?: 'Please choose an image file or provide an image URL/path.';
    } else {
        save_pddns_gallery_item([
            'id'            => time(),
            'title'         => $title,
            'category'      => $category,
            'category_name' => $category_name,
            'image_url'     => $image_url,
            'created_at'    => date('Y-m-d H:i:s')
        ]);
        $message = 'Photo added to nursing gallery and updated in gallery.json successfully!';
    }
}

// Handle Photo Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit_photo') {
    $edit_id   = intval($_POST['edit_id'] ?? 0);
    $title     = trim($_POST['title'] ?? '');
    $category  = trim($_POST['category'] ?? 'labs');
    $category_name = $category_names[$category] ?? ucfirst($category);
    $image_url = trim($_POST['existing_image_url'] ?? '');

    // Optional replacement image upload
    if (isset($_FILES['edit_photo_file']) && $_FILES['edit_photo_file']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = __DIR__ . '/../assets/images/gallery';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $file_tmp = $_FILES['edit_photo_file']['tmp_name'];
        $file_name = preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $_FILES['edit_photo_file']['name']);
        $new_file_name = time() . '_' . $file_name;
        $target_file = $upload_dir . '/' . $new_file_name;

        if (move_uploaded_file($file_tmp, $target_file)) {
            $image_url = 'assets/images/gallery/' . $new_file_name;
        }
    } elseif (!empty($_POST['new_image_url'])) {
        $image_url = ltrim(trim($_POST['new_image_url']), '/');
    }

    if ($edit_id > 0 && !empty($title)) {
        save_pddns_gallery_item([
            'id'            => $edit_id,
            'title'         => $title,
            'category'      => $category,
            'category_name' => $category_name,
            'image_url'     => $image_url
        ]);
        $message = 'Photo #' . $edit_id . ' updated in gallery.json successfully!';
    } else {
        $error = 'Failed to update photo. Invalid title or ID.';
    }
}

// Handle Delete Photo
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    delete_pddns_gallery_item($delete_id);
    $message = 'Photo #' . $delete_id . ' removed from gallery and gallery.json successfully.';
}

$gallery_items = get_pddns_gallery_items('all');
$total_count = count($gallery_items);
?>

<?php if ($message): ?>
    <div class="alert alert-success" style="display:flex; align-items:center; gap:10px; margin-bottom:20px;">
        <i class="fa-solid fa-circle-check"></i>
        <span><?php echo htmlspecialchars($message); ?></span>
    </div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert alert-danger" style="display:flex; align-items:center; gap:10px; margin-bottom:20px;">
        <i class="fa-solid fa-circle-exclamation"></i>
        <span><?php echo htmlspecialchars($error); ?></span>
    </div>
<?php endif; ?>

<!-- Upload New Photo Card -->
<div class="admin-card mb-4" id="addPhoto">
    <div class="admin-card-header">
        <h2 class="admin-card-title"><i class="fa-solid fa-cloud-arrow-up text-primary"></i> Upload New Nursing Gallery Photo</h2>
    </div>
    <div class="admin-card-body">
        <form method="POST" action="gallery.php" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add_photo">

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Photo Title / Caption *</label>
                    <input type="text" name="title" class="form-input" placeholder="e.g. Nursing Clinical Practical Training" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Category *</label>
                    <select name="category" class="form-input" required>
                        <option value="labs">Nursing Labs & Practical</option>
                        <option value="diagnostics">Hospital Clinical Postings</option>
                        <option value="events">Lamp Lighting & Events</option>
                        <option value="campus">Campus & Infrastructure</option>
                    </select>
                </div>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Choose Image File (JPG, PNG, WebP)</label>
                    <input type="file" name="photo_file" class="form-input" id="imageUploadInput" accept="image/*">
                </div>

                <div class="form-group">
                    <label class="form-label">Or Image Relative Path / URL</label>
                    <input type="text" name="image_url" class="form-input" placeholder="assets/images/gallery/photo.jpg or uploads/2024/01/photo.jpg">
                </div>
            </div>

            <div class="form-group">
                <img id="imageUploadPreview" src="" alt="Preview" style="display: none; height: 120px; border-radius: 6px; border: 1px solid var(--admin-border); object-fit: cover; margin-bottom: 12px;">
            </div>

            <button type="submit" class="admin-btn admin-btn-accent"><i class="fa-solid fa-upload"></i> Save Photo</button>
        </form>
    </div>
</div>

<!-- Manage Existing Gallery Photos -->
<div class="admin-card">
    <div class="admin-card-header">
        <h2 class="admin-card-title">Gallery Photos (<?php echo $total_count; ?> Total)</h2>
        <div style="display: flex; gap: 10px; align-items: center;">
            <input type="text" id="adminSearchInput" class="form-input" placeholder="Search photos by title..." style="width: 240px; padding: 6px 10px;">
            <a href="../gallery.php" target="_blank" class="admin-btn admin-btn-outline admin-btn-sm"><i class="fa-solid fa-eye"></i> View Gallery</a>
        </div>
    </div>
    <div class="admin-card-body">
        <div class="admin-gallery-grid" id="adminGalleryGrid">
            <?php foreach ($gallery_items as $item): 
                $title   = htmlspecialchars($item['title'] ?? 'Photo');
                $raw_cat = htmlspecialchars($item['category'] ?? 'labs');
                $cat     = htmlspecialchars($item['category_name'] ?? ucfirst($raw_cat));
                $id      = intval($item['id'] ?? 0);
                $raw_img = htmlspecialchars($item['image_url'] ?? '');
                $thumb_src = resolve_gallery_image_src($item['image_url'] ?? '', true);
            ?>
            <div class="admin-gallery-card searchable-card" data-title="<?php echo strtolower($title); ?>" data-cat="<?php echo strtolower($raw_cat); ?>">
                <img src="<?php echo htmlspecialchars($thumb_src); ?>" alt="<?php echo $title; ?>" class="admin-gallery-thumb" onerror="this.src='../assets/images/slider-1.jpg'">
                <div class="admin-gallery-body">
                    <div class="admin-gallery-title"><?php echo $title; ?></div>
                    <div class="admin-gallery-meta">
                        <span class="badge badge-active"><?php echo $cat; ?></span>
                    </div>
                    <div class="admin-gallery-actions" style="display:flex; justify-content:space-between; align-items:center; margin-top:8px;">
                        <button type="button" class="admin-btn admin-btn-outline admin-btn-sm" onclick="openEditModal(<?php echo $id; ?>, '<?php echo addslashes($title); ?>', '<?php echo addslashes($raw_cat); ?>', '<?php echo addslashes($raw_img); ?>', '<?php echo addslashes($thumb_src); ?>')" title="Edit Photo">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </button>
                        <a href="gallery.php?delete=<?php echo $id; ?>" class="admin-btn admin-btn-danger admin-btn-sm" onclick="return confirm('Delete photo #<?php echo $id; ?>?');" title="Delete">
                            <i class="fa-solid fa-trash"></i> Delete
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Edit Photo Modal -->
<div id="editPhotoModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.6); z-index:9999; align-items:center; justify-content:center; backdrop-filter:blur(3px);">
    <div class="admin-card" style="width:100%; max-width:540px; margin:20px; box-shadow:0 10px 30px rgba(0,0,0,0.3); border:1px solid var(--admin-border);">
        <div class="admin-card-header" style="display:flex; justify-content:space-between; align-items:center;">
            <h3 class="admin-card-title"><i class="fa-solid fa-pen-to-square text-primary"></i> Edit Nursing Gallery Photo</h3>
            <button type="button" onclick="closeEditModal()" style="background:none; border:none; font-size:1.4rem; color:var(--admin-text-muted); cursor:pointer;">&times;</button>
        </div>
        <div class="admin-card-body">
            <form method="POST" action="gallery.php" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit_photo">
                <input type="hidden" name="edit_id" id="edit_id">
                <input type="hidden" name="existing_image_url" id="existing_image_url">

                <div class="form-group mb-3">
                    <label class="form-label">Photo Title *</label>
                    <input type="text" name="title" id="edit_title" class="form-input" required>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Category *</label>
                    <select name="category" id="edit_category" class="form-input" required>
                        <option value="labs">Nursing Labs & Practical</option>
                        <option value="diagnostics">Hospital Clinical Postings</option>
                        <option value="events">Lamp Lighting & Events</option>
                        <option value="campus">Campus & Infrastructure</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Replace Image (Optional)</label>
                    <input type="file" name="edit_photo_file" class="form-input" accept="image/*">
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Or Update Image Path / URL</label>
                    <input type="text" name="new_image_url" id="edit_image_url" class="form-input" placeholder="assets/images/gallery/photo.jpg">
                </div>

                <div style="display:flex; gap:10px; justify-content:flex-end; margin-top:20px;">
                    <button type="button" onclick="closeEditModal()" class="admin-btn admin-btn-outline">Cancel</button>
                    <button type="submit" class="admin-btn admin-btn-accent"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Search Filter
document.getElementById('adminSearchInput')?.addEventListener('input', function (e) {
    const q = e.target.value.toLowerCase().trim();
    const cards = document.querySelectorAll('#adminGalleryGrid .admin-gallery-card');
    cards.forEach(card => {
        const title = card.getAttribute('data-title') || '';
        const cat = card.getAttribute('data-cat') || '';
        if (title.includes(q) || cat.includes(q)) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
});

// Image Upload Preview
document.getElementById('imageUploadInput')?.addEventListener('change', function (e) {
    const file = e.target.files[0];
    const preview = document.getElementById('imageUploadPreview');
    if (file) {
        const reader = new FileReader();
        reader.onload = function (ev) {
            preview.src = ev.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
});

// Edit Modal Functions
function openEditModal(id, title, category, imgUrl, thumbSrc) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_title').value = title;
    document.getElementById('edit_category').value = category;
    document.getElementById('existing_image_url').value = imgUrl;
    document.getElementById('edit_image_url').value = imgUrl;
    const modal = document.getElementById('editPhotoModal');
    modal.style.display = 'flex';
}

function closeEditModal() {
    const modal = document.getElementById('editPhotoModal');
    modal.style.display = 'none';
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>