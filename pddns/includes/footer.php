<?php
if (!defined('PDDNS_SITE')) {
    require_once __DIR__ . '/config.php';
}
?>
<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Col 1: Brand & Bio -->
            <div class="footer-col">
                <h4><?php echo $site_short_name; ?> Nursing School</h4>
                <p><strong>Pt. Deen Dayal Nursing School</strong> is a premier nursing institution dedicated to producing compassionate, skilled, and clinically competent nursing professionals in Bihar.</p>
                <p style="font-size: 0.8rem; color: var(--primary-400);">
                    <i class="fa-solid fa-certificate"></i> Approved by Health Dept. Govt. of Bihar & Bihar Nurses Registration Council (BNRC).
                </p>
                <div class="topbar-socials" style="margin-top: 14px;">
                    <a href="<?php echo $social_links['whatsapp']; ?>" target="_blank" title="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="<?php echo $social_links['facebook']; ?>" target="_blank" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="<?php echo $social_links['instagram']; ?>" target="_blank" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="index.php"><i class="fa-solid fa-angle-right"></i> Home</a></li>
                    <li><a href="about.php"><i class="fa-solid fa-angle-right"></i> About Institute</a></li>
                    <li><a href="courses.php"><i class="fa-solid fa-angle-right"></i> Nursing Programs</a></li>
                    <li><a href="facilities.php"><i class="fa-solid fa-angle-right"></i> Clinical Labs</a></li>
                    <li><a href="gallery.php"><i class="fa-solid fa-angle-right"></i> Photo Gallery</a></li>
                    <li><a href="admissions.php"><i class="fa-solid fa-angle-right"></i> Admissions 2026</a></li>
                    <li><a href="contact.php"><i class="fa-solid fa-angle-right"></i> Contact Us</a></li>
                </ul>
            </div>

            <!-- Col 3: Nursing Courses -->
            <div class="footer-col">
                <h4>Nursing Programs</h4>
                <ul class="footer-links">
                    <li><a href="courses.php#anm"><i class="fa-solid fa-angle-right"></i> ANM Nursing (2 Yrs)</a></li>
                    <li><a href="courses.php#gnm"><i class="fa-solid fa-angle-right"></i> GNM Nursing (3 Yrs)</a></li>
                    <li><a href="courses.php#bscnursing"><i class="fa-solid fa-angle-right"></i> B.Sc Nursing (4 Yrs)</a></li>
                    <li><a href="courses.php#pbbsc"><i class="fa-solid fa-angle-right"></i> Post Basic B.Sc Nursing</a></li>
                    <li><a href="courses.php#dmlt"><i class="fa-solid fa-angle-right"></i> DMLT (Lab Tech)</a></li>
                    <li><a href="courses.php#ot"><i class="fa-solid fa-angle-right"></i> OT Technology</a></li>
                </ul>
            </div>

            <!-- Col 4: Contact Info -->
            <div class="footer-col">
                <h4>Contact & Helpdesk</h4>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <span><?php echo $site_address; ?></span>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-phone-volume"></i>
                    <span><a href="tel:<?php echo preg_replace('/[^0-9]/', '', $site_phone); ?>" style="color: inherit; font-weight: 700;"><?php echo $site_phone; ?></a> / <?php echo $site_phone_alt; ?></span>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-envelope"></i>
                    <span><a href="mailto:<?php echo $site_email; ?>" style="color: inherit;"><?php echo $site_email; ?></a></span>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-hospital"></i>
                    <span>Parent Hospital: Shri Ram Multi-Speciality Hospital & MRI Center (Siwan)</span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div>
                &copy; <?php echo date('Y'); ?> <strong><?php echo $site_name; ?> (PDDNS)</strong>. All Rights Reserved. | Planted by <a href="https://www.offerplant.com/" target="_blank" rel="noopener noreferrer" style="color: inherit; text-decoration: underline;">OfferPlant</a>
            </div>
            <div style="display: flex; gap: 16px;">
                <a href="<?php echo $app_login_url; ?>" target="_blank" style="color: inherit;"><i class="fa-solid fa-user-lock"></i> App Login</a>
                <a href="<?php echo $webmail_url; ?>" target="_blank" style="color: inherit;"><i class="fa-solid fa-envelope"></i> Webmail</a>
                <a href="admin/login.php" target="_blank" style="color: inherit;"><i class="fa-solid fa-user-shield"></i> Admin Panel</a>
            </div>
        </div>
    </div>
</footer>

<!-- Lightbox Modal for Gallery -->
<div class="lightbox-modal" id="lightboxModal" aria-hidden="true" role="dialog">
    <button class="lightbox-close" id="lightboxClose" aria-label="Close image">&times;</button>
    <button class="lightbox-prev" id="lightboxPrev" aria-label="Previous image"><i class="fa-solid fa-chevron-left"></i></button>
    <button class="lightbox-next" id="lightboxNext" aria-label="Next image"><i class="fa-solid fa-chevron-right"></i></button>
    <div class="lightbox-content">
        <img src="" alt="Enlarged nursing photo" class="lightbox-img" id="lightboxImg">
        <div class="lightbox-caption" id="lightboxCaption"></div>
    </div>
</div>

<!-- Floating Action Buttons -->
<div class="floating-actions">
    <a href="<?php echo $social_links['whatsapp']; ?>" target="_blank" class="floating-btn floating-whatsapp" title="Chat on WhatsApp" aria-label="WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
    <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $site_phone); ?>" class="floating-btn floating-call" title="Call Admissions Helpline" aria-label="Call Admissions">
        <i class="fa-solid fa-phone"></i>
    </a>
</div>

<!-- Scripts -->
<script src="assets/js/main.js"></script>
</body>
</html>
