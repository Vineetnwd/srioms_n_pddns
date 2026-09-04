<?php
/**
 * Pt. Deen Dayal Nursing School (PDDNS) - Configuration
 * Website: https://pddns.in/
 */

if (!defined('PDDNS_SITE')) {
    define('PDDNS_SITE', true);
}

// Load dynamic settings from data/settings.json if available
$dyn_settings_file = __DIR__ . '/../data/settings.json';
$dyn_settings = file_exists($dyn_settings_file) ? json_decode(file_get_contents($dyn_settings_file), true) : [];

$site_name        = $dyn_settings['site_name'] ?? "Pt. Deen Dayal Nursing School";
$site_short_name  = $dyn_settings['site_short_name'] ?? "PDDNS";
$site_tagline     = $dyn_settings['site_tagline'] ?? "Premier Institute for Nursing Education & Healthcare Training";
$site_email       = $dyn_settings['site_email'] ?? "info@pddns.in";
$site_email_alt   = $dyn_settings['site_email_alt'] ?? "pddnssiwan@gmail.com";
$site_phone       = $dyn_settings['site_phone'] ?? "+91 9934402822";
$site_phone_alt   = $dyn_settings['site_phone_alt'] ?? "+91 9431426600";
$site_emergency   = $dyn_settings['site_emergency'] ?? "+91 9934402822";
$site_address     = $dyn_settings['site_address'] ?? "Panchmukhi Bypass Road, Pal Nagar / Fatehpur, Siwan - 841226 (Bihar)";
$site_city        = "Siwan, Bihar";
$site_timings     = $dyn_settings['site_timings'] ?? "College Office: 8:00 AM - 5:00 PM | Clinical Rotations: 24x7";
$site_established = "2018";
$app_login_url    = $dyn_settings['app_login_url'] ?? "https://apps.srioms.co.in/login.php";
$webmail_url      = $dyn_settings['webmail_url'] ?? "https://mail.hostinger.com/";
$notice_ticker    = $dyn_settings['notice_ticker'] ?? "🌟 Admissions Open (Session 2026-27): ANM, GNM & B.Sc Nursing. 🏥 100% Practical Hospital Clinical Training & Rotations. 📞 Admissions Helpline: +91 9934402822 / 9431426600. 📜 Approved by Health Dept., Govt. of Bihar & Bihar Nurses Registration Council (BNRC).";

// Social Links
$social_links = [
    'facebook'  => 'https://facebook.com/sriomssiwan',
    'twitter'   => 'https://twitter.com/sriomssiwan',
    'instagram' => 'https://instagram.com/srioms_siwan',
    'youtube'   => 'https://youtube.com',
    'whatsapp'  => 'https://wa.me/919934402822?text=' . urlencode('Hello Pt. Deen Dayal Nursing School (PDDNS), I have an inquiry regarding Nursing Admissions 2026.')
];

// Helper: Active link check
function is_active_nav($page_name, $current_page)
{
    return ($page_name === $current_page) ? 'active' : '';
}

// Navigation structure
$nav_items = [
    'home'       => ['label' => 'Home', 'url' => 'index.php'],
    'about'      => ['label' => 'About Us', 'url' => 'about.php'],
    'courses'    => ['label' => 'Nursing Programs', 'url' => 'courses.php'],
    'facilities' => ['label' => 'Labs & Hospital', 'url' => 'facilities.php'],
    'gallery'    => ['label' => 'Gallery', 'url' => 'gallery.php'],
    'faculty'    => ['label' => 'Faculty', 'url' => 'faculty.php'],
    'admissions' => ['label' => 'Admissions', 'url' => 'admissions.php'],
    'contact'    => ['label' => 'Contact Us', 'url' => 'contact.php']
];
?>
