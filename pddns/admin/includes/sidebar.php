<?php
$current_admin_page = isset($current_admin_page) ? $current_admin_page : 'dashboard';
?>
<!-- Admin Sidebar -->
<aside class="admin-sidebar" id="adminSidebar" style="background: #042f2e;">
    <div class="sidebar-header" style="border-bottom: 1px solid rgba(255, 255, 255, 0.1);">
        <img src="../assets/images/logo.png" alt="PDDNS" class="sidebar-logo" onerror="this.style.display='none'">
        <div>
            <div class="sidebar-title">PDDNS</div>
            <div class="sidebar-subtitle" style="color: #2dd4bf;">Nursing School Admin</div>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-heading">Main Menu</div>
        <ul>
            <li>
                <a href="index.php" class="<?php echo ($current_admin_page === 'dashboard') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-gauge"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="inquiries.php" class="<?php echo ($current_admin_page === 'inquiries') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-user-graduate"></i> Nursing Admissions
                </a>
            </li>
            <li>
                <a href="courses.php" class="<?php echo ($current_admin_page === 'courses') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-graduation-cap"></i> Nursing Programs
                </a>
            </li>
            <li>
                <a href="gallery.php" class="<?php echo ($current_admin_page === 'gallery') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-images"></i> Photo Gallery
                </a>
            </li>
            <li>
                <a href="settings.php" class="<?php echo ($current_admin_page === 'settings') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-sliders"></i> Site Settings & Ticker
                </a>
            </li>
        </ul>

        <div class="nav-heading">Quick Links</div>
        <ul>
            <li>
                <a href="../index.php" target="_blank">
                    <i class="fa-solid fa-globe"></i> View PDDNS Site
                </a>
            </li>
            <li>
                <a href="https://apps.srioms.co.in/login.php" target="_blank">
                    <i class="fa-solid fa-hospital-user"></i> Hospital App
                </a>
            </li>
            <li>
                <a href="https://mail.hostinger.com/" target="_blank">
                    <i class="fa-solid fa-envelope-open-text"></i> Hostinger Webmail
                </a>
            </li>
        </ul>
    </nav>

    <div class="sidebar-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
        <a href="logout.php" class="admin-btn admin-btn-danger admin-btn-sm btn-block" style="justify-content: center;">
            <i class="fa-solid fa-right-from-bracket"></i> Sign Out
        </a>
    </div>
</aside>