<?php
require_once __DIR__ . '/config.php';

$page_title_full = isset($page_title)
    ? $page_title . " | " . $site_name . " (PDDNS Siwan)"
    : $site_name . " | ANM, GNM & B.Sc Nursing College in Siwan, Bihar";

$meta_desc = isset($page_description)
    ? $page_description
    : "Pt. Deen Dayal Nursing School (PDDNS) - Premier institute for ANM Nursing, GNM Nursing, and B.Sc Nursing in Siwan, Bihar. Approved by BNRC, Indian Nursing Council and Govt. of Bihar.";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($meta_desc); ?>">
    <title><?php echo htmlspecialchars($page_title_full); ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/images/logo.png">

    <!-- Google Fonts (Outfit & Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- PDDNS Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Top Emergency & Info Bar -->
    <header class="site-topbar">
        <div class="container topbar-container">
            <div class="topbar-left">
                <span class="topbar-item"><i class="fa-solid fa-location-dot"></i> Panchmukhi Bypass Road, Siwan
                    (Bihar)</span>
                <span class="topbar-item hide-mobile"><i class="fa-solid fa-stamp"></i> Approved by BNRC & Govt. of
                    Bihar</span>
            </div>
            <div class="topbar-right">
                <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $site_phone); ?>" class="topbar-emergency">
                    <i class="fa-solid fa-phone-volume fa-shake"></i> Helpline: <span><?php echo $site_phone; ?></span>
                </a>
                <div class="topbar-socials hide-mobile">
                    <a href="<?php echo $social_links['whatsapp']; ?>" target="_blank" title="WhatsApp Us"
                        aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="<?php echo $social_links['facebook']; ?>" target="_blank" title="Facebook"
                        aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="<?php echo $social_links['instagram']; ?>" target="_blank" title="Instagram"
                        aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                </div>
                <a href="<?php echo $webmail_url; ?>" target="_blank" class="topbar-btn"><i
                        class="fa-solid fa-envelope"></i> Webmail</a>
                <a href="admin/login.php" target="_blank" class="topbar-btn hide-mobile"><i
                        class="fa-solid fa-user-shield"></i> Admin</a>
            </div>
        </div>
    </header>

    <?php require_once __DIR__ . '/navbar.php'; ?>