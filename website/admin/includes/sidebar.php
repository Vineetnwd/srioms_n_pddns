<?php
$current_admin_page = isset($current_admin_page) ? $current_admin_page : 'dashboard';
?>
<!-- Admin Sidebar -->
<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <img src="../assets/images/logo.png" alt="SRIOMS" class="sidebar-logo" onerror="this.style.display='none'">
        <div>
            <div class="sidebar-title">SRIOMS</div>
            <div class="sidebar-subtitle">Control Panel</div>
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
                <a href="gallery.php" class="<?php echo ($current_admin_page === 'gallery') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-images"></i> Gallery Manager
                </a>
            </li>
            <li>
                <a href="inquiries.php" class="<?php echo ($current_admin_page === 'inquiries') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-user-graduate"></i> Inquiries & Admissions
                </a>
            </li>
        </ul>

        <div class="nav-heading">Website Content</div>
        <ul>
            <li>
                <a href="courses.php" class="<?php echo ($current_admin_page === 'courses') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-graduation-cap"></i> Paramedical Courses
                </a>
            </li>
            <li>
                <a href="staff.php" class="<?php echo ($current_admin_page === 'staff') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-users"></i> Staff Directory
                </a>
            </li>
            <li>
                <a href="pages.php" class="<?php echo ($current_admin_page === 'pages') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-file-alt"></i> Website Pages
                </a>
            </li>
            <li>
                <a href="our-services.php" class="<?php echo ($current_admin_page === 'services') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-x-ray"></i> Diagnostic Services
                </a>
            </li>
            <li>
                <a href="users.php" class="<?php echo ($current_admin_page === 'users') ? 'active' : ''; ?>">
                    <i class="fa-solid fa-users-cog"></i> Admin Users
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
                    <i class="fa-solid fa-globe"></i> Visit Public Site
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

    <div class="sidebar-footer">
        <a href="logout.php" class="admin-btn admin-btn-danger admin-btn-sm btn-block" style="justify-content: center;">
            <i class="fa-solid fa-right-from-bracket"></i> Sign Out
        </a>
    </div>
</aside>