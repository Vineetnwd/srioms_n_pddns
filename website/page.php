<?php
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/db.php';

$slug = $_GET['slug'] ?? '';
$page = get_page_by_slug($slug);

if (!$page) {
    header("HTTP/1.0 404 Not Found");
    $page_title = "Page Not Found";
    require_once __DIR__ . '/includes/header.php';
    echo '<div class="container section-py"><h1 style="color:var(--primary-900);">404 - Page Not Found</h1><p>The page you are looking for does not exist.</p></div>';
    require_once __DIR__ . '/includes/footer.php';
    exit;
}

$page_title = $page['title'];
$page_description = mb_substr(strip_tags($page['content']), 0, 150) . '...';
$current_page = $slug;

require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <div>
            <h1><?php echo htmlspecialchars($page['title']); ?></h1>
        </div>
        <div class="breadcrumbs">
            <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            <span>/</span>
            <span class="current"><?php echo htmlspecialchars($page['title']); ?></span>
        </div>
    </div>
</section>

<!-- Page Content -->
<section class="section-py">
    <div class="container">
        <?php if (!empty($page['image'])): ?>
            <img src="<?php echo htmlspecialchars($page['image']); ?>" alt="<?php echo htmlspecialchars($page['title']); ?>" style="max-width:100%; height:auto; border-radius:8px; margin-bottom:30px;">
        <?php endif; ?>
        
        <div class="page-content" style="line-height: 1.7; color: var(--text-body);">
            <?php 
                // Basic HTML rendering for content
                echo $page['content']; 
            ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
