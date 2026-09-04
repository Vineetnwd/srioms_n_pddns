<?php
if (!defined('SRIOMS_SITE')) {
    require_once __DIR__ . '/config.php';
}

$page_title_full = isset($page_title) ? $page_title . " | " . $site_name : $site_name . " - " . $site_tagline;
$page_desc = isset($page_description) ? $page_description : "SHRI RAM Institute of Medical Sciences (SRIOMS) in Siwan, Bihar - Leading Paramedical Institute and Advanced Diagnostic Center offering DMLT, BMLT, DMRT, BPT, ANM Nursing, MRI, CT-Scan, and 24x7 emergency healthcare.";
$current_page = isset($current_page) ? $current_page : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?php echo htmlspecialchars($page_desc); ?>">
    <meta name="keywords" content="SRIOMS, Shri Ram Institute of Medical Sciences, Paramedical Siwan, MRI Siwan, DMLT Siwan, BMLT Bihar, CT Scan Siwan, ANM Nursing, Medical College Siwan">
    <meta name="author" content="SHRI RAM Institute of Medical Sciences">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($page_title_full); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($page_desc); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://srioms.co.in">
    <meta property="og:image" content="assets/images/logo.png">

    <title><?php echo htmlspecialchars($page_title_full); ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/images/logo.png">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Custom Theme CSS with auto cache-busting -->
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo file_exists(__DIR__ . '/../assets/css/style.css') ? filemtime(__DIR__ . '/../assets/css/style.css') : time(); ?>">
</head>
<body>
    <!-- Top Emergency & Info Bar -->
    <header class="site-topbar">
        <div class="container topbar-container">
            <div class="topbar-left">
                <span class="topbar-item"><i class="fa-solid fa-location-dot"></i> Fatehpur Bypass Road, Siwan (Bihar)</span>
                <span class="topbar-item hide-mobile"><i class="fa-solid fa-clock"></i> 24x7 Diagnostic & Emergency Services</span>
            </div>
            <div class="topbar-right">
                <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $site_emergency); ?>" class="topbar-emergency">
                    <i class="fa-solid fa-phone-volume fa-shake"></i> Helpline: <span><?php echo $site_phone; ?></span>
                </a>
                <div class="topbar-socials hide-mobile">
                    <a href="<?php echo $social_links['whatsapp']; ?>" target="_blank" title="WhatsApp Us" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="<?php echo $social_links['facebook']; ?>" target="_blank" title="Facebook" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="<?php echo $social_links['instagram']; ?>" target="_blank" title="Instagram" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                </div>
                <a href="<?php echo $webmail_url; ?>" target="_blank" class="topbar-btn"><i class="fa-solid fa-envelope"></i> Webmail</a>
                <a href="admin/login.php" target="_blank" class="topbar-btn hide-mobile"><i class="fa-solid fa-user-shield"></i> Admin</a>
            </div>
        </div>
    </header>

    <?php require_once __DIR__ . '/navbar.php'; ?>
