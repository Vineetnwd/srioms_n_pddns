<?php
$page_title = "Photo Gallery";
$page_description = "Photo gallery of Shri Ram Institute of Medical Sciences (SRIOMS) - 1.5T MRI Suite, Helical CT, Automated Labs, Student Practical Sessions, and Campus Life.";
$current_page = "gallery";

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/db.php';

$gallery_items = get_gallery_items('all');
$total_count = count($gallery_items);
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <div>
            <h1>Campus & Diagnostic Photo Gallery</h1>
            <p>Explore authentic photographs of our practical training laboratories, diagnostic imaging centers, and student campus activities.</p>
        </div>
        <div class="breadcrumbs">
            <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            <span>/</span>
            <span class="current">Gallery</span>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="section-py">
    <div class="container">
        <!-- Filter Tabs -->
        <div class="gallery-filter-wrap">
            <button class="filter-btn active" data-filter="all">All Photos (<?php echo $total_count; ?>)</button>
            <button class="filter-btn" data-filter="diagnostics"><i class="fa-solid fa-x-ray"></i> Diagnostic Scans</button>
            <button class="filter-btn" data-filter="labs"><i class="fa-solid fa-flask-vial"></i> Practical Labs</button>
            <button class="filter-btn" data-filter="campus"><i class="fa-solid fa-building-columns"></i> Campus & Classrooms</button>
            <button class="filter-btn" data-filter="events"><i class="fa-solid fa-calendar-check"></i> Events & Celebrations</button>
        </div>

        <!-- Gallery Grid -->
        <div class="gallery-grid" id="galleryContainer">
            <?php foreach ($gallery_items as $item): 
                $img_src = resolve_gallery_image_src($item['image_url'] ?? '');
                $title   = htmlspecialchars($item['title'] ?? 'Gallery Photo');
                $cat     = htmlspecialchars($item['category'] ?? 'campus');
                $cat_lbl = htmlspecialchars($item['category_name'] ?? ucfirst($cat));
            ?>
            <div class="gallery-item" data-category="<?php echo $cat; ?>" data-title="<?php echo $title; ?>">
                <img src="<?php echo htmlspecialchars($img_src); ?>" alt="<?php echo $title; ?>" loading="lazy" onerror="this.src='assets/images/slider-1.jpg'">
                <div class="gallery-overlay">
                    <h5 class="gallery-title"><?php echo $title; ?></h5>
                    <span class="gallery-cat"><?php echo $cat_lbl; ?></span>
                </div>
                <div class="gallery-zoom-icon"><i class="fa-solid fa-expand"></i></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>