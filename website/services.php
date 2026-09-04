<?php
$page_title = "24x7 Diagnostic Center & MRI Services";
$page_description = "24x7 Advanced Diagnostic Services at Shri Ram MRI & Diagnostic Scan Center, Siwan - 1.5 Tesla MRI, Multi-Slice CT Scan, 3D/4D Ultrasound, Digital X-Ray, and Automated Pathology.";
$current_page = "services";

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/db.php';

$services = get_services_list();
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <div>
            <h1>24x7 Shri Ram MRI & Diagnostic Center</h1>
            <p>State-of-the-art medical imaging and automated diagnostic testing with 24x7 emergency scan availability in Siwan, Bihar.</p>
        </div>
        <div class="breadcrumbs">
            <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            <span>/</span>
            <span class="current">Diagnostic Services</span>
        </div>
    </div>
</section>

<!-- Diagnostic Services List -->
<section class="section-py">
    <div class="container">
        <div class="cards-grid-3">
            <?php foreach ($services as $s): 
                $img_src = htmlspecialchars($s['image_url'] ?? 'assets/images/mri-scan.jpg');
            ?>
            <div class="diag-card" id="<?php echo strtolower(preg_replace('/[^a-z0-9]/', '', $s['name'])); ?>">
                <img src="<?php echo $img_src; ?>" alt="<?php echo htmlspecialchars($s['name']); ?>" class="diag-card-thumb" onerror="this.src='assets/images/campus-building.jpg'">
                <div class="diag-card-body">
                    <span class="med-card-badge" style="background: var(--primary-50); color: var(--primary-600);"><?php echo htmlspecialchars($s['category'] ?? 'Radiology'); ?></span>
                    <h3 style="font-size: 1.3rem; color: var(--primary-900); margin-bottom: 8px;"><?php echo htmlspecialchars($s['name']); ?></h3>
                    <p style="font-size: 0.88rem; color: var(--text-muted); flex: 1; margin-bottom: 14px;"><?php echo htmlspecialchars($s['description']); ?></p>

                    <div style="margin-top: 14px; padding-top: 14px; border-top: 1px solid var(--border-subtle); display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.82rem; font-weight: 700; color: var(--emerald-600);"><i class="fa-solid fa-clock"></i> 24x7 Available</span>
                        <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $site_emergency); ?>" class="btn btn-primary btn-compact">
                            <i class="fa-solid fa-phone"></i> Book Scan
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
