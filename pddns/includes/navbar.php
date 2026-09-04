<?php
if (!defined('PDDNS_SITE')) {
    require_once __DIR__ . '/config.php';
}
$current_page = isset($current_page) ? $current_page : 'home';
?>
<!-- Main Navigation Header -->
<nav class="site-navbar" id="siteNavbar">
    <div class="container navbar-container">
        <!-- Brand / Logo -->
        <a href="index.php" class="navbar-brand" aria-label="PDDNS Home">
            <img src="assets/images/logo.png" alt="Pt. Deen Dayal Nursing School Logo" class="brand-logo" onerror="this.style.display='none'">
        </a>

        <!-- Desktop Navigation Links -->
        <div class="navbar-menu" id="navbarMenu">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?php echo is_active_nav('home', $current_page); ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a href="about.php" class="nav-link <?php echo is_active_nav('about', $current_page); ?>">About Us</a>
                </li>
                <li class="nav-item">
                    <a href="courses.php" class="nav-link <?php echo is_active_nav('courses', $current_page); ?>">Nursing Programs</a>
                </li>
                <li class="nav-item">
                    <a href="facilities.php" class="nav-link <?php echo is_active_nav('facilities', $current_page); ?>">Labs & Hospital</a>
                </li>
                <li class="nav-item">
                    <a href="gallery.php" class="nav-link <?php echo is_active_nav('gallery', $current_page); ?>">Gallery</a>
                </li>
                <li class="nav-item">
                    <a href="faculty.php" class="nav-link <?php echo is_active_nav('faculty', $current_page); ?>">Faculty</a>
                </li>
                <li class="nav-item">
                    <a href="contact.php" class="nav-link <?php echo is_active_nav('contact', $current_page); ?>">Contact</a>
                </li>
            </ul>
        </div>

        <!-- Header Action CTA -->
        <div class="navbar-actions">
            <a href="<?php echo $app_login_url; ?>" target="_blank" class="btn btn-accent btn-compact">
                <i class="fa-solid fa-hospital-user"></i> App Login
            </a>
            <!-- Mobile Menu Toggle Button -->
            <button class="nav-toggle" id="navToggle" aria-label="Toggle Navigation Menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <!-- Mobile Drawer Navigation -->
    <div class="mobile-drawer" id="mobileDrawer">
        <div class="mobile-drawer-header">
            <div class="mobile-drawer-brand">
                <img src="assets/images/logo.png" alt="Pt. Deen Dayal Nursing School Logo" class="drawer-logo" onerror="this.style.display='none'">
            </div>
            <button class="drawer-close" id="drawerClose" aria-label="Close Navigation">&times;</button>
        </div>
        <ul class="mobile-nav-list">
            <li><a href="index.php" class="<?php echo is_active_nav('home', $current_page); ?>"><i class="fa-solid fa-house"></i> Home</a></li>
            <li><a href="about.php" class="<?php echo is_active_nav('about', $current_page); ?>"><i class="fa-solid fa-hospital-user"></i> About Institute</a></li>
            <li><a href="courses.php" class="<?php echo is_active_nav('courses', $current_page); ?>"><i class="fa-solid fa-user-nurse"></i> Nursing Courses (ANM / GNM)</a></li>
            <li><a href="facilities.php" class="<?php echo is_active_nav('facilities', $current_page); ?>"><i class="fa-solid fa-flask-vial"></i> Clinical Labs & Hospital</a></li>
            <li><a href="gallery.php" class="<?php echo is_active_nav('gallery', $current_page); ?>"><i class="fa-solid fa-images"></i> Photo Gallery</a></li>
            <li><a href="faculty.php" class="<?php echo is_active_nav('faculty', $current_page); ?>"><i class="fa-solid fa-user-doctor"></i> Nursing Faculty</a></li>
            <li><a href="admissions.php" class="<?php echo is_active_nav('admissions', $current_page); ?>"><i class="fa-solid fa-file-signature"></i> Admissions 2026-27</a></li>
            <li><a href="contact.php" class="<?php echo is_active_nav('contact', $current_page); ?>"><i class="fa-solid fa-address-book"></i> Contact & Location</a></li>
        </ul>
        <div class="mobile-drawer-footer">
            <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $site_phone); ?>" class="btn btn-emergency btn-block mb-2">
                <i class="fa-solid fa-phone"></i> Helpline: <?php echo $site_phone; ?>
            </a>
            <a href="<?php echo $app_login_url; ?>" target="_blank" class="btn btn-accent btn-block mb-2">
                <i class="fa-solid fa-right-to-bracket"></i> App Login
            </a>
            <a href="<?php echo $webmail_url; ?>" target="_blank" class="btn btn-outline btn-block">
                <i class="fa-solid fa-envelope-open-text"></i> Webmail Login
            </a>
        </div>
    </div>
    <div class="mobile-overlay" id="mobileOverlay"></div>
</nav>
