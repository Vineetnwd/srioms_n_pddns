<?php
$page_title = "Our Staff Directory";
$page_description = "Meet the Teaching and Non-Teaching Staff at Shri Ram Institute of Medical Sciences (SRIOMS).";
$current_page = "staff";

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/db.php';

$pdo = srioms_db_connect();
$staff_list = [];
if ($pdo) {
    $stmt = $pdo->prepare("SELECT * FROM `srioms_staff` ORDER BY id ASC");
    $stmt->execute();
    $staff_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Group staff by type
$grouped_staff = [
    'Management' => [],
    'Teaching' => [],
    'Non-Teaching' => []
];

foreach ($staff_list as $s) {
    $type = $s['type'] ?? 'Non-Teaching';
    if (!isset($grouped_staff[$type])) {
        $grouped_staff[$type] = [];
    }
    $grouped_staff[$type][] = $s;
}
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <div>
            <h1>Our Staff & Faculty</h1>
            <p>Experienced professionals dedicated to excellence in education and administration.</p>
        </div>
        <div class="breadcrumbs">
            <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            <span>/</span>
            <span class="current">Staff Directory</span>
        </div>
    </div>
</section>

<!-- Staff Directory -->
<section class="section-py">
    <div class="container">
        
        <?php foreach (['Management', 'Teaching', 'Non-Teaching'] as $category): ?>
            <?php if (!empty($grouped_staff[$category])): ?>
                
                <div class="section-title-wrap" style="text-align: left; margin-bottom: 25px; margin-top: <?php echo $category !== 'Management' ? '50px' : '0'; ?>;">
                    <h2 class="section-heading" style="font-size: 1.8rem;"><?php echo $category === 'Teaching' ? 'Teaching Faculty' : ($category === 'Non-Teaching' ? 'Administrative & Support Staff' : 'Management Board'); ?></h2>
                    <div style="height: 3px; width: 60px; background: var(--primary-600); margin-top: 10px;"></div>
                </div>

                <div style="background: #ffffff; border-radius: 8px; border: 1px solid #e2e8f0; overflow-x: auto; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
                    <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
                        <thead>
                            <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                                <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #475569; font-size: 0.85rem; width: 60px;">Profile</th>
                                <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #475569; font-size: 0.85rem;">Name</th>
                                <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #475569; font-size: 0.85rem;">Designation</th>
                                <?php if ($category === 'Teaching'): ?>
                                <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #475569; font-size: 0.85rem;">Department</th>
                                <?php endif; ?>
                                <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #475569; font-size: 0.85rem;">Qualifications</th>
                                <th style="padding: 12px 16px; text-align: left; font-weight: 600; color: #475569; font-size: 0.85rem;">Experience</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($grouped_staff[$category] as $staff): ?>
                            <tr style="border-bottom: 1px solid #e2e8f0; transition: background 0.15s;" onmouseover="this.style.backgroundColor='#f1f5f9';" onmouseout="this.style.backgroundColor='transparent';">
                                <td style="padding: 10px 16px;">
                                    <div style="width: 40px; height: 40px; border-radius: 50%; overflow: hidden; background: #e2e8f0; display: flex; align-items: center; justify-content: center;">
                                        <?php if (!empty($staff['image'])): ?>
                                            <img src="<?php echo htmlspecialchars($staff['image']); ?>" alt="<?php echo htmlspecialchars($staff['name']); ?>" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                            <i class="fa-solid fa-user" style="font-size: 18px; color: #94a3b8; display: none;"></i>
                                        <?php else: ?>
                                            <i class="fa-solid fa-user" style="font-size: 18px; color: #94a3b8;"></i>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td style="padding: 10px 16px; font-weight: 600; color: #1e293b; font-size: 0.95rem;">
                                    <?php echo htmlspecialchars($staff['name']); ?>
                                </td>
                                <td style="padding: 10px 16px; color: #3b82f6; font-weight: 500; font-size: 0.9rem;">
                                    <?php echo htmlspecialchars($staff['designation']); ?>
                                </td>
                                <?php if ($category === 'Teaching'): ?>
                                <td style="padding: 10px 16px; color: #64748b; font-size: 0.85rem;">
                                    <?php echo !empty($staff['department']) ? htmlspecialchars($staff['department']) : '-'; ?>
                                </td>
                                <?php endif; ?>
                                <td style="padding: 10px 16px; color: #64748b; font-size: 0.85rem;">
                                    <?php echo !empty($staff['details']) ? htmlspecialchars($staff['details']) : '-'; ?>
                                </td>
                                <td style="padding: 10px 16px; color: #64748b; font-size: 0.85rem;">
                                    <?php echo !empty($staff['experience']) ? htmlspecialchars($staff['experience']) : '-'; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if (empty($staff_list)): ?>
            <p style="text-align: center; color: var(--text-muted); font-size: 1.1rem; padding: 40px 0;">No staff members have been added yet.</p>
        <?php endif; ?>

    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
