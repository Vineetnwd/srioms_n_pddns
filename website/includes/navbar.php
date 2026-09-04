<?php
if (!defined('SRIOMS_SITE')) {
    require_once __DIR__ . '/config.php';
}
$current_page = isset($current_page) ? $current_page : 'home';
?>
<!-- Main Navigation Header -->
<nav class="site-navbar" id="siteNavbar">
    <div class="container navbar-container">
        <!-- Brand / Logo -->
        <a href="index.php" class="navbar-brand" aria-label="SRIOMS Home">
            <img src="assets/images/logo.png" alt="SHRI RAM Institute of Medical Sciences Logo" class="brand-logo" onerror="this.style.display='none'">
            <div class="brand-text">
                <span class="brand-title"><?php echo $site_short_name; ?></span>
                <span class="brand-subtitle">SHRI RAM INSTITUTE OF MEDICAL SCIENCES</span>
                <span class="brand-tagline">Paramedical Education & Diagnostic Center</span>
            </div>
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
                    <a href="courses.php" class="nav-link <?php echo is_active_nav('courses', $current_page); ?>">Courses</a>
                </li>
                <li class="nav-item">
                    <a href="services.php" class="nav-link <?php echo is_active_nav('services', $current_page); ?>">Diagnostics</a>
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
                <img src="assets/images/logo.png" alt="SHRI RAM Institute of Medical Sciences Logo" class="drawer-logo" onerror="this.style.display='none'">
                <div class="drawer-brand-text">
                    <span class="drawer-brand-title"><?php echo $site_short_name; ?></span>
                    <span class="drawer-brand-subtitle">Shri Ram Institute</span>
                </div>
            </div>
            <button class="drawer-close" id="drawerClose" aria-label="Close Navigation">&times;</button>
        </div>
        <ul class="mobile-nav-list">
            <li><a href="index.php" class="<?php echo is_active_nav('home', $current_page); ?>"><i class="fa-solid fa-house"></i> Home</a></li>
            <li><a href="about.php" class="<?php echo is_active_nav('about', $current_page); ?>"><i class="fa-solid fa-hospital"></i> About Us</a></li>
            <li><a href="courses.php" class="<?php echo is_active_nav('courses', $current_page); ?>"><i class="fa-solid fa-graduation-cap"></i> Paramedical Courses</a></li>
            <li><a href="services.php" class="<?php echo is_active_nav('services', $current_page); ?>"><i class="fa-solid fa-x-ray"></i> Diagnostic Center (MRI/CT)</a></li>
            <li><a href="gallery.php" class="<?php echo is_active_nav('gallery', $current_page); ?>"><i class="fa-solid fa-images"></i> Photo Gallery</a></li>
            <li><a href="faculty.php" class="<?php echo is_active_nav('faculty', $current_page); ?>"><i class="fa-solid fa-user-doctor"></i> Faculty & Doctors</a></li>
            <li><a href="contact.php" class="<?php echo is_active_nav('contact', $current_page); ?>"><i class="fa-solid fa-address-book"></i> Contact & Appointments</a></li>
        </ul>
        <div class="mobile-drawer-footer">
            <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $site_emergency); ?>" class="btn btn-emergency btn-block mb-2">
                <i class="fa-solid fa-phone"></i> Emergency: <?php echo $site_emergency; ?>
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
