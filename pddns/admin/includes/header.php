<?php
require_once __DIR__ . '/auth.php';
require_pddns_admin_auth();

$admin_title = isset($page_title) ? $page_title . " | PDDNS Admin" : "PDDNS Admin Dashboard";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($admin_title); ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../assets/images/logo.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Admin CSS -->
    <link rel="stylesheet" href="assets/css/admin.css?v=<?php echo time(); ?>">
</head>
<body>
<div class="admin-wrapper">
    <?php require_once __DIR__ . '/sidebar.php'; ?>

    <div class="admin-main">
        <!-- Admin Topbar -->
        <header class="admin-topbar">
            <div class="topbar-left-side">
                <button class="sidebar-toggle-btn" id="sidebarToggle" aria-label="Toggle Sidebar"><i class="fa-solid fa-bars"></i></button>
                <h1 class="admin-page-title"><?php echo isset($page_heading) ? htmlspecialchars($page_heading) : 'PDDNS Dashboard'; ?></h1>
            </div>
            <div class="topbar-user">
                <a href="../index.php" target="_blank" class="admin-btn admin-btn-outline admin-btn-sm"><i class="fa-solid fa-arrow-up-right-from-square"></i> Visit Website</a>
                <div class="user-badge">
                    <div class="user-avatar-circle" style="background: var(--admin-teal);"><i class="fa-solid fa-user-nurse"></i></div>
                    <span><?php echo htmlspecialchars($_SESSION['pddns_admin_user'] ?? 'Admin'); ?></span>
                </div>
                <a href="logout.php" class="admin-btn admin-btn-danger admin-btn-sm" title="Sign out"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </div>
        </header>

        <main class="admin-content">
