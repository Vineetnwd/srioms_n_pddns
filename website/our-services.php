<?php
$page_title = "24x7 Diagnostic Center & MRI Services";
$page_description = "24x7 Advanced Diagnostic Services at Shri Ram MRI & Diagnostic Scan Center, Siwan - 1.5 Tesla MRI, Multi-Slice CT Scan, 3D/4D Ultrasound, Digital X-Ray, and Automated Pathology.";
$current_page = "services";

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/db.php';

$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
$all_services = [];

// 1. Fetch from Primary DB (services.json)
$primary_services = get_services_list();
foreach ($primary_services as $s) {
    // Optional: check status if it exists, otherwise include
    if (isset($s['status']) && strtolower($s['status']) !== 'active') {
        continue;
    }
    
    $name = $s['name'] ?? '';
    $badge = $s['category'] ?? '';
    $desc = $s['description'] ?? '';
    
    // Apply search filter for Primary DB
    if (!empty($search_query)) {
        if (stripos($name, $search_query) === false && 
            stripos($badge, $search_query) === false && 
            stripos($desc, $search_query) === false) {
            continue; // Skip if no match
        }
    }
    
    $all_services[] = [
        'display_name' => $name,
        'display_badge' => $badge,
        'display_desc' => $desc,
        'source' => 'primary'
    ];
}

// 2. Connect to the separate OPEX database
$host = 'localhost'; 
$db_name = 'u305984835_srioms_opex';
$db_user = 'u305984835_srioms_opex';
$db_password = '@User!2001';
$db_error = false;

try {
    $pdo_opex = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $db_user, $db_password);
    $pdo_opex->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    if (!empty($search_query)) {
        $stmt = $pdo_opex->prepare("SELECT * FROM services WHERE name LIKE :search OR description LIKE :search ORDER BY id ASC");
        $stmt->execute(['search' => '%' . $search_query . '%']);
    } else {
        $stmt = $pdo_opex->query("SELECT * FROM services ORDER BY id ASC");
    }
    $opex_services = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($opex_services as $s) {
        $all_services[] = [
            'display_name' => $s['name'] ?? '',
            'display_badge' => $s['description'] ?? '', // OPEX 'description' acts as department/category
            'display_desc' => $s['details'] ?? $s['content'] ?? '',
            'source' => 'opex'
        ];
    }
} catch (PDOException $e) {
    $db_error = true;
}

// Pagination logic
$items_per_page = 12; // 12 items per page for a grid
$total_items = count($all_services);
$total_pages = ceil($total_items / $items_per_page);
$current_page_num = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($current_page_num < 1) $current_page_num = 1;
if ($current_page_num > $total_pages && $total_pages > 0) $current_page_num = $total_pages;

$offset = ($current_page_num - 1) * $items_per_page;
$paged_services = array_slice($all_services, $offset, $items_per_page);
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
        
        <div class="section-title-wrap" style="text-align: left; margin-bottom: 25px;">
            <h2 class="section-heading" style="font-size: 1.8rem;">Available Facilities & Tests</h2>
            <div style="height: 3px; width: 60px; background: var(--primary-600); margin-top: 10px;"></div>
        </div>

        <div style="background: #eef2ff; border-left: 4px solid var(--primary-600); padding: 20px; border-radius: 6px; margin-bottom: 30px;">
            <p style="margin: 0; color: #1e293b; font-weight: 500;">
                <i class="fa-solid fa-circle-info" style="color: var(--primary-600); margin-right: 8px;"></i>
                These Facilities (Check, Test, Scan, etc.) are available in our Branches. To know more visit / contact with our nearest branch.
            </p>
            <p style="margin: 10px 0 0 0; color: var(--emerald-600); font-weight: 700; display: flex; align-items: center;">
                <i class="fa-solid fa-notes-medical" style="margin-right: 8px;"></i> All Insurance Medical Check Up
            </p>
        </div>

        <!-- Search Form -->
        <form method="GET" action="our-services.php" style="margin-bottom: 30px; display: flex; gap: 10px; max-width: 600px;">
            <div style="flex: 1; position: relative;">
                <i class="fa-solid fa-search" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                <input type="text" name="search" placeholder="Search facilities, tests, or scans..." value="<?php echo htmlspecialchars($search_query ?? ''); ?>" style="width: 100%; padding: 12px 15px 12px 40px; border: 1px solid #cbd5e1; border-radius: 6px; outline: none; font-family: inherit;">
            </div>
            <button type="submit" class="btn btn-primary" style="padding: 12px 24px;">Search</button>
            <?php if (!empty($search_query)): ?>
                <a href="our-services.php" class="btn btn-outline" style="padding: 12px 24px; text-decoration: none;">Clear</a>
            <?php endif; ?>
        </form>

        <?php if ($db_error && empty($primary_services)): ?>
            <div style="background: #fef2f2; color: #ef4444; padding: 20px; border-radius: 8px; text-align: center; border: 1px solid #fca5a5;">
                <i class="fa-solid fa-triangle-exclamation" style="font-size: 2rem; margin-bottom: 10px;"></i>
                <h4>Unable to load services</h4>
                <p>We are currently updating our database. Please check back shortly or call our helpline.</p>
            </div>
        <?php elseif (empty($all_services)): ?>
            <div style="text-align: center; padding: 40px; color: #64748b; background: #f8fafc; border-radius: 8px;">
                <i class="fa-solid fa-clipboard-list" style="font-size: 2.5rem; margin-bottom: 15px; opacity: 0.5;"></i>
                <h3>No Services Found</h3>
                <?php if (!empty($search_query)): ?>
                    <p>No results found for "<strong><?php echo htmlspecialchars($search_query); ?></strong>". Try adjusting your search.</p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="cards-grid-3">
                <?php foreach ($paged_services as $s): ?>
                <div class="diag-card" id="<?php echo strtolower(preg_replace('/[^a-z0-9]/', '', $s['display_name'])); ?>">
                    <div class="diag-card-body">
                        <?php if (!empty($s['display_badge'])): ?>
                            <span class="med-card-badge" style="background: var(--primary-50); color: var(--primary-600); margin-bottom: 10px; display: inline-block;"><?php echo htmlspecialchars($s['display_badge']); ?></span>
                        <?php endif; ?>
                        
                        <h3 style="font-size: 1.3rem; color: var(--primary-900); margin-bottom: 8px;"><?php echo htmlspecialchars($s['display_name']); ?></h3>
                        
                        <?php if (!empty($s['display_desc'])): ?>
                        <p style="font-size: 0.88rem; color: var(--text-muted); flex: 1; margin-bottom: 14px;">
                            <?php echo htmlspecialchars($s['display_desc']); ?>
                        </p>
                        <?php else: ?>
                        <div style="flex: 1; margin-bottom: 14px;"></div>
                        <?php endif; ?>
    
                        <div style="margin-top: 14px; padding-top: 14px; border-top: 1px solid var(--border-subtle); display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 0.82rem; font-weight: 700; color: var(--emerald-600);"><i class="fa-solid fa-clock"></i> 24x7 Available</span>
                            <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $site_emergency ?? ''); ?>" class="btn btn-primary btn-compact">
                                <i class="fa-solid fa-phone"></i> Book Scan
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <?php if ($total_pages > 1): ?>
            <div class="pagination" style="display: flex; justify-content: center; gap: 8px; margin-top: 40px;">
                <?php if ($current_page_num > 1): ?>
                    <a href="?page=<?php echo ($current_page_num - 1) . (!empty($search_query) ? '&search=' . urlencode($search_query) : ''); ?>" class="btn btn-outline" style="padding: 8px 16px;">&laquo; Prev</a>
                <?php endif; ?>
                
                <?php 
                $start = max(1, $current_page_num - 2);
                $end = min($total_pages, $current_page_num + 2);
                
                $search_param = !empty($search_query) ? '&search=' . urlencode($search_query) : '';

                if ($start > 1) {
                    echo '<a href="?page=1' . $search_param . '" class="btn btn-outline" style="padding: 8px 16px;">1</a>';
                    if ($start > 2) echo '<span style="padding: 8px 16px; color: #64748b;">...</span>';
                }
                
                for ($i = $start; $i <= $end; $i++): ?>
                    <a href="?page=<?php echo $i . $search_param; ?>" class="btn <?php echo ($i === $current_page_num) ? 'btn-primary' : 'btn-outline'; ?>" style="padding: 8px 16px;"><?php echo $i; ?></a>
                <?php endfor; 
                
                if ($end < $total_pages) {
                    if ($end < $total_pages - 1) echo '<span style="padding: 8px 16px; color: #64748b;">...</span>';
                    echo '<a href="?page=' . $total_pages . $search_param . '" class="btn btn-outline" style="padding: 8px 16px;">' . $total_pages . '</a>';
                }
                ?>
                
                <?php if ($current_page_num < $total_pages): ?>
                    <a href="?page=<?php echo ($current_page_num + 1) . $search_param; ?>" class="btn btn-outline" style="padding: 8px 16px;">Next &raquo;</a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
