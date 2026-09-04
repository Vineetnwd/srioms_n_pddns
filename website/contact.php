<?php
$page_title = "Contact Us & Diagnostic Booking";
$page_description = "Contact Shri Ram Institute of Medical Sciences (SRIOMS) - Location Address, Emergency Scanner Hotline, Admission Helpdesk, and Google Map in Siwan, Bihar.";
$current_page = "contact";

require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <div>
            <h1>Contact Us & Diagnostic Helpline</h1>
            <p>Reach out for course admissions, prospectus details, or urgent 24x7 MRI & CT scan bookings.</p>
        </div>
        <div class="breadcrumbs">
            <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            <span>/</span>
            <span class="current">Contact Us</span>
        </div>
    </div>
</section>

<!-- Contact Info Cards & Form -->
<section class="section-py">
    <div class="container">
        <!-- Contact Cards Grid -->
        <div class="cards-grid-3 mb-4" style="margin-bottom: 40px;">
            <div class="med-card">
                <div class="med-card-body" style="text-align: center; align-items: center;">
                    <div style="width: 52px; height: 52px; border-radius: 50%; background: var(--primary-50); color: var(--primary-600); display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 14px; border: 1px solid var(--primary-100);">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <h3 style="font-size: 1.15rem; color: var(--primary-900); margin-bottom: 6px;">Campus Location</h3>
                    <p style="font-size: 0.88rem; color: var(--text-muted);"><?php echo $site_address; ?></p>
                </div>
            </div>

            <div class="med-card">
                <div class="med-card-body" style="text-align: center; align-items: center;">
                    <div style="width: 52px; height: 52px; border-radius: 50%; background: var(--primary-50); color: var(--primary-600); display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 14px; border: 1px solid var(--primary-100);">
                        <i class="fa-solid fa-phone-volume"></i>
                    </div>
                    <h3 style="font-size: 1.15rem; color: var(--primary-900); margin-bottom: 6px;">Admissions & Diagnostic Helpline</h3>
                    <p style="font-size: 1rem; font-weight: 700; color: var(--primary-700);">
                        <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $site_phone); ?>"><?php echo $site_phone; ?></a>
                    </p>
                    <p style="font-size: 0.85rem; color: var(--text-muted);"><?php echo $site_phone_alt; ?></p>
                </div>
            </div>

            <div class="med-card">
                <div class="med-card-body" style="text-align: center; align-items: center;">
                    <div style="width: 52px; height: 52px; border-radius: 50%; background: var(--primary-50); color: var(--primary-600); display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 14px; border: 1px solid var(--primary-100);">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <h3 style="font-size: 1.15rem; color: var(--primary-900); margin-bottom: 6px;">Official Email</h3>
                    <p style="font-size: 0.88rem; color: var(--text-muted);"><a href="mailto:<?php echo $site_email; ?>"><?php echo $site_email; ?></a></p>
                    <p style="font-size: 0.85rem; color: var(--text-muted);"><?php echo $site_email_alt; ?></p>
                </div>
            </div>
        </div>

        <!-- Contact Form & Map -->
        <div class="contact-layout-grid">
            <div class="form-card">
                <h3 style="font-size: 1.35rem; color: var(--primary-900); margin-bottom: 6px;">Send Us an Inquiry</h3>
                <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 20px;">Have a question about admissions or diagnostic services? Submit the form below.</p>

                <form class="ajax-inquiry-form" method="POST">
                    <input type="hidden" name="type" value="Contact Form Inquiry">
                    
                    <div class="form-group">
                        <label class="form-label">Your Full Name *</label>
                        <input type="text" name="name" class="form-input" placeholder="Full name" required>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Phone Number *</label>
                            <input type="tel" name="phone" class="form-input" placeholder="10-digit phone" required pattern="[0-9]{10}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-input" placeholder="name@email.com">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Topic / Course of Interest</label>
                        <input type="text" name="course" class="form-input" placeholder="e.g. DMLT Course / MRI Brain Scan" value="<?php echo htmlspecialchars($_GET['course'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Message / Details *</label>
                        <textarea name="message" class="form-input" rows="4" placeholder="How can we help you?" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" style="padding: 12px; font-size: 1rem;">
                        <i class="fa-solid fa-paper-plane"></i> Send Inquiry
                    </button>
                </form>
            </div>

            <!-- Google Map -->
            <div>
                <div style="border-radius: var(--radius-md); overflow: hidden; box-shadow: var(--shadow-md); border: 1px solid var(--border-subtle); height: 450px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d114674.34380721248!2d84.28292837335688!3d26.226760599999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3992fc1eb59b5757%3A0xe54e1ce06e2ce543!2sSiwan%2C%20Bihar!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
