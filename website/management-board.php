<?php
$page_title = "Management Board Directory";
$page_description = "Meet the Management Board at Shri Ram Institute of Medical Sciences (SRIOMS).";
$current_page = "management-board";

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/db.php';

$pdo = srioms_db_connect();
$management_staff = [];
if ($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM `srioms_staff` WHERE type = 'Management' ORDER BY id DESC");
    $stmt->execute();
    $management_staff = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <div>
            <h1>Management Board</h1>
            <p>The visionaries leading our institution toward academic and operational excellence.</p>
        </div>
        <div class="breadcrumbs">
            <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            <span>/</span>
            <span class="current">Management Board</span>
        </div>
    </div>
</section>

<!-- Staff Directory -->
<section class="section-py">
    <div class="container">
        
        <?php if (!empty($management_staff)): ?>
            <div class="cards-grid-4">
                <?php foreach ($management_staff as $staff): ?>
                <div class="med-card" style="text-align: center; overflow: hidden;">
                    <div style="width: 100%; height: 220px; position: relative; background: #f1f5f9; display: flex; align-items: center; justify-content: center;">
                        <?php if (!empty($staff['image'])): ?>
                            <img src="<?php echo htmlspecialchars($staff['image']); ?>" alt="<?php echo htmlspecialchars($staff['name']); ?>" style="width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0;" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <i class="fa-solid fa-user" style="font-size: 80px; color: #94a3b8; display: none; z-index: 1;"></i>
                        <?php else: ?>
                            <i class="fa-solid fa-user" style="font-size: 80px; color: #94a3b8;"></i>
                        <?php endif; ?>
                    </div>
                    <div class="med-card-body" style="padding: 18px;">
                        <h3 style="font-size: 1.15rem; color: var(--primary-900); margin-bottom: 4px;"><?php echo htmlspecialchars($staff['name']); ?></h3>
                        <p style="font-size: 0.9rem; color: var(--primary-600); font-weight: 600; margin-bottom: 8px;"><?php echo htmlspecialchars($staff['designation']); ?></p>
                        <?php if (!empty($staff['details'])): ?>
                            <p style="font-size: 0.82rem; color: var(--text-muted);"><?php echo htmlspecialchars($staff['details']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p style="text-align: center; color: var(--text-muted); font-size: 1.1rem; padding: 40px 0;">No management board members have been added yet.</p>
        <?php endif; ?>

    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
