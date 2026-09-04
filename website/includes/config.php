<?php
/**
 * SRIOMS Website Configuration
 * SHRI RAM Institute of Medical Sciences
 */

if (!defined('SRIOMS_SITE')) {
    define('SRIOMS_SITE', true);
}

// Load dynamic settings from data/settings.json if available
$dyn_settings_file = __DIR__ . '/../data/settings.json';
$dyn_settings = file_exists($dyn_settings_file) ? json_decode(file_get_contents($dyn_settings_file), true) : [];

$site_name       = $dyn_settings['site_name'] ?? "SHRI RAM Institute of Medical Sciences";
$site_short_name = $dyn_settings['site_short_name'] ?? "SRIOMS";
$site_tagline    = $dyn_settings['site_tagline'] ?? "Centre for Paramedical Education & Advanced Diagnostics";
$site_email      = $dyn_settings['site_email'] ?? "info@srioms.co.in";
$site_phone      = $dyn_settings['site_phone'] ?? "+91 9934402822";
$site_phone_alt  = $dyn_settings['site_phone_alt'] ?? "+91 9431426600";
$site_emergency  = $dyn_settings['site_emergency'] ?? "+91 9934402822";
$site_address    = $dyn_settings['site_address'] ?? "Shri Ram MRI Scan Center, Fatehpur Bypass Road, Siwan - 841226 (Bihar)";
$site_city       = "Siwan, Bihar";
$site_timings    = $dyn_settings['site_timings'] ?? "Hospital & MRI: 24x7 Open | OPD / Institute: 8:00 AM - 6:00 PM";
$site_established = "2018";
$app_login_url   = $dyn_settings['app_login_url'] ?? "https://apps.srioms.co.in/login.php";
$webmail_url     = $dyn_settings['webmail_url'] ?? "https://mail.hostinger.com/";
$notice_ticker   = $dyn_settings['notice_ticker'] ?? "🎓 Admissions Open (Session 2026-27): DMLT, BMLT, DMRT, BPT, ANM Nursing & OT Tech. 🏥 Shri Ram MRI Scan Center: 24x7 Emergency & Diagnostic Scanning Available (Helpline: 9934402822) 🔬 Pathology & Biochemistry Lab: Fully automated testing with same-day reports.";

// Social Links
$social_links = [
    'facebook' => 'https://facebook.com/sriomssiwan',
    'twitter' => 'https://twitter.com/sriomssiwan',
    'instagram' => 'https://instagram.com/srioms_siwan',
    'youtube' => 'https://youtube.com',
    'whatsapp' => 'https://wa.me/919934402822?text=' . urlencode('Hello SRIOMS, I have an inquiry regarding admissions/diagnostic services.')
];

// Helper: Active link check
function is_active_nav($page_name, $current_page)
{
    return ($page_name === $current_page) ? 'active' : '';
}

// Navigation structure
$nav_items = [
    'home' => ['label' => 'Home', 'url' => 'index.php'],
    'about' => ['label' => 'About Us', 'url' => 'about.php'],
    'courses' => ['label' => 'Courses & Academics', 'url' => 'courses.php'],
    'services' => ['label' => 'Diagnostic Center', 'url' => 'services.php'],
    'gallery' => ['label' => 'Gallery', 'url' => 'gallery.php'],
    'faculty' => ['label' => 'Faculty & Doctors', 'url' => 'faculty.php'],
    'contact' => ['label' => 'Contact Us', 'url' => 'contact.php']
];
?>