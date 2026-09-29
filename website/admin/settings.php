<?php
$page_title = "Site Settings";
$page_heading = "Website Configuration & Notice Ticker";
$current_admin_page = "settings";

require_once __DIR__ . '/includes/header.php';

$message = '';
$error = '';

$settings = get_site_settings();

// Handle Settings Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save_settings') {
    $updated_settings = [
        'site_name'       => trim($_POST['site_name'] ?? $settings['site_name']),
        'site_short_name' => trim($_POST['site_short_name'] ?? $settings['site_short_name']),
        'site_tagline'    => trim($_POST['site_tagline'] ?? $settings['site_tagline']),
        'site_email'      => trim($_POST['site_email'] ?? $settings['site_email']),
        'site_phone'      => trim($_POST['site_phone'] ?? $settings['site_phone']),
        'site_phone_alt'  => trim($_POST['site_phone_alt'] ?? $settings['site_phone_alt']),
        'site_emergency'  => trim($_POST['site_emergency'] ?? $settings['site_emergency']),
        'site_address'    => trim($_POST['site_address'] ?? $settings['site_address']),
        'site_timings'    => trim($_POST['site_timings'] ?? $settings['site_timings']),
        'app_login_url'   => trim($_POST['app_login_url'] ?? $settings['app_login_url']),
        'webmail_url'     => trim($_POST['webmail_url'] ?? $settings['webmail_url']),
        'notice_ticker'   => trim($_POST['notice_ticker'] ?? $settings['notice_ticker'])
    ];

    save_site_settings($updated_settings);
    $settings = get_site_settings();
    $message = 'Site settings and notice ticker updated successfully!';
}
?>

<?php if ($message): ?>
    <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> <?php echo htmlspecialchars($message); ?></div>
<?php endif; ?>

<div class="admin-card">
    <div class="admin-card-header">
        <h2 class="admin-card-title"><i class="fa-solid fa-sliders text-primary"></i> General Settings & Contact Information</h2>
    </div>
    <div class="admin-card-body">
        <form method="POST" action="">
            <input type="hidden" name="action" value="save_settings">

            <!-- Notice Ticker -->
            <div class="form-group mb-4" style="background: rgba(2, 132, 199, 0.05); padding: 16px; border-radius: 8px; border: 1px solid var(--admin-border);">
                <label class="form-label" style="color: var(--admin-accent); font-size: 0.9rem;">
                    <i class="fa-solid fa-bullhorn"></i> Live Notice Bar & Marquee Ticker (Top of Homepage)
                </label>
                <textarea name="notice_ticker" class="form-input" rows="3"><?php echo htmlspecialchars($settings['notice_ticker'] ?? ''); ?></textarea>
                <span style="font-size: 0.74rem; color: var(--admin-text-muted);">This text rotates continuously across the top of the homepage for urgent admissions & scanner notices.</span>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Full Institute Name *</label>
                    <input type="text" name="site_name" class="form-input" value="<?php echo htmlspecialchars($settings['site_name'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Short Acronym</label>
                    <input type="text" name="site_short_name" class="form-input" value="<?php echo htmlspecialchars($settings['site_short_name'] ?? 'SRIOMS'); ?>">
                </div>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">Helpline Phone Number *</label>
                    <input type="text" name="site_phone" class="form-input" value="<?php echo htmlspecialchars($settings['site_phone'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Secondary / Admissions Phone</label>
                    <input type="text" name="site_phone_alt" class="form-input" value="<?php echo htmlspecialchars($settings['site_phone_alt'] ?? ''); ?>">
                </div>
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">24x7 Emergency Scanner Hotline</label>
                    <input type="text" name="site_emergency" class="form-input" value="<?php echo htmlspecialchars($settings['site_emergency'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Official Email Address</label>
                    <input type="email" name="site_email" class="form-input" value="<?php echo htmlspecialchars($settings['site_email'] ?? ''); ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Full Physical Address</label>
                <input type="text" name="site_address" class="form-input" value="<?php echo htmlspecialchars($settings['site_address'] ?? ''); ?>">
            </div>

            <div class="form-grid-2">
                <div class="form-group">
                    <label class="form-label">App Login URL</label>
                    <input type="url" name="app_login_url" class="form-input" value="<?php echo htmlspecialchars($settings['app_login_url'] ?? 'https://apps.srioms.co.in/login.php'); ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Hostinger Webmail URL</label>
                    <input type="url" name="webmail_url" class="form-input" value="<?php echo htmlspecialchars($settings['webmail_url'] ?? 'https://mail.hostinger.com/'); ?>">
                </div>
            </div>

            <!-- Admin Account Credentials moved to users.php -->

            <button type="submit" class="admin-btn admin-btn-accent mt-3"><i class="fa-solid fa-floppy-disk"></i> Save Settings & Notice</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
