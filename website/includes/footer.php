<?php
if (!defined('SRIOMS_SITE')) {
    require_once __DIR__ . '/config.php';
}
?>
    <!-- Emergency & Fast Contact Strip -->
    <section class="footer-cta-strip">
        <div class="container footer-cta-container">
            <div class="cta-text">
                <h3><i class="fa-solid fa-hospital-user"></i> Need Medical Diagnosis or Paramedical Career Guidance?</h3>
                <p>Our counselors and diagnostic technicians are available 24x7 to assist you.</p>
            </div>
            <div class="cta-actions">
                <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $site_phone); ?>" class="btn btn-white"><i class="fa-solid fa-phone"></i> Call <?php echo $site_phone; ?></a>
                <a href="<?php echo $social_links['whatsapp']; ?>" target="_blank" class="btn btn-whatsapp"><i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp</a>
            </div>
        </div>
    </section>

    <!-- Main Footer -->
    <footer class="site-footer">
        <div class="container footer-container">
            <!-- Col 1: About Institute -->
            <div class="footer-col footer-col-about">
                <div class="footer-brand">
                    <img src="assets/images/logo.png" alt="SRIOMS Logo" class="footer-logo" style="max-height: 52px; width: auto;" onerror="this.style.display='none'">
                    <div>
                        <h4 class="footer-title"><?php echo $site_short_name; ?></h4>
                        <span class="footer-subtitle">Shri Ram Institute of Medical Sciences</span>
                    </div>
                </div>
                <p class="footer-desc">
                    SRIOMS is a premier medical & paramedical institute and state-of-the-art diagnostic care center located in Siwan, Bihar. Dedicated to delivering industry-standard clinical training and precision diagnostic services.
                </p>
                <div class="footer-badges">
                    <span class="badge-item"><i class="fa-solid fa-shield-halved"></i> Registered Institute</span>
                    <span class="badge-item"><i class="fa-solid fa-award"></i> Advanced Diagnostic Lab</span>
                    <span class="badge-item"><i class="fa-solid fa-clock-rotate-left"></i> 24x7 Emergency & MRI</span>
                </div>
            </div>

            <!-- Col 2: Academic Programs -->
            <div class="footer-col">
                <h4 class="footer-heading">Academic Programs</h4>
                <ul class="footer-links">
                    <li><a href="courses.php#dmlt"><i class="fa-solid fa-angle-right"></i> DMLT (Medical Lab Tech)</a></li>
                    <li><a href="courses.php#bmlt"><i class="fa-solid fa-angle-right"></i> B.Sc MLT (Degree)</a></li>
                    <li><a href="courses.php#dmrt"><i class="fa-solid fa-angle-right"></i> DMRT (Radiography Tech)</a></li>
                    <li><a href="courses.php#bpt"><i class="fa-solid fa-angle-right"></i> BPT (Physiotherapy)</a></li>
                    <li><a href="courses.php#anm"><i class="fa-solid fa-angle-right"></i> ANM Nursing Course</a></li>
                    <li><a href="courses.php#ot"><i class="fa-solid fa-angle-right"></i> OT Technician Diploma</a></li>
                    <li><a href="courses.php#dresser"><i class="fa-solid fa-angle-right"></i> Certified Dresser & CCH</a></li>
                </ul>
            </div>

            <!-- Col 3: Diagnostic Facilities -->
            <div class="footer-col">
                <h4 class="footer-heading">Diagnostic Center</h4>
                <ul class="footer-links">
                    <li><a href="services.php#mri"><i class="fa-solid fa-angle-right"></i> Shri Ram MRI Scan</a></li>
                    <li><a href="services.php#ctscan"><i class="fa-solid fa-angle-right"></i> Multi-Slice CT Scan</a></li>
                    <li><a href="services.php#ultrasound"><i class="fa-solid fa-angle-right"></i> 3D/4D Ultrasound & Doppler</a></li>
                    <li><a href="services.php#pathology"><i class="fa-solid fa-angle-right"></i> Automated Pathology Lab</a></li>
                    <li><a href="services.php#xray"><i class="fa-solid fa-angle-right"></i> High-Frequency Digital X-Ray</a></li>
                    <li><a href="services.php#ecg"><i class="fa-solid fa-angle-right"></i> ECG & Cardiology Tests</a></li>
                    <li><a href="services.php#physio"><i class="fa-solid fa-angle-right"></i> Physiotherapy & Rehab</a></li>
                </ul>
            </div>

            <!-- Col 4: Contact & Location -->
            <div class="footer-col footer-col-contact">
                <h4 class="footer-heading">Contact & Location</h4>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <div>
                        <strong>Address:</strong>
                        <span><?php echo $site_address; ?></span>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-phone"></i>
                    <div>
                        <strong>Helpline / OPD:</strong>
                        <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $site_phone); ?>"><?php echo $site_phone; ?></a>, 
                        <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $site_phone_alt); ?>"><?php echo $site_phone_alt; ?></a>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <i class="fa-solid fa-envelope"></i>
                    <div>
                        <strong>Email Us:</strong>
                        <a href="mailto:<?php echo $site_email; ?>"><?php echo $site_email; ?></a>
                    </div>
                </div>
                <div class="footer-social-box">
                    <span class="social-label">Connect with Us:</span>
                    <div class="social-icons">
                        <a href="<?php echo $social_links['whatsapp']; ?>" target="_blank" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="<?php echo $social_links['facebook']; ?>" target="_blank" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="<?php echo $social_links['instagram']; ?>" target="_blank" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="<?php echo $social_links['youtube']; ?>" target="_blank" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom Copyright Bar -->
        <div class="footer-bottom">
            <div class="container footer-bottom-container">
                <p class="copyright-text">
                    &copy; <?php echo date('Y'); ?> <strong><?php echo $site_name; ?></strong>. All Rights Reserved. | Planted by <a href="https://www.offerplant.com/" target="_blank" rel="noopener noreferrer">OfferPlant</a>
                </p>
                <div class="footer-bottom-links">
                    <a href="admissions.php">Admissions</a>
                    <span class="sep">•</span>
                    <a href="gallery.php">Gallery</a>
                    <span class="sep">•</span>
                    <a href="contact.php">Location Map</a>
                    <span class="sep">•</span>
                    <a href="<?php echo $app_login_url; ?>" target="_blank">App Login</a>
                    <span class="sep">•</span>
                    <a href="<?php echo $webmail_url; ?>" target="_blank">Webmail</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Global Image Lightbox Modal for Gallery & Previews -->
    <div id="imageLightbox" class="lightbox-modal" aria-hidden="true">
        <span class="lightbox-close" id="lightboxClose">&times;</span>
        <div class="lightbox-content">
            <img id="lightboxImg" src="" alt="Enlarged View">
            <div id="lightboxCaption" class="lightbox-caption"></div>
        </div>
        <button class="lightbox-prev" id="lightboxPrev" aria-label="Previous image"><i class="fa-solid fa-chevron-left"></i></button>
        <button class="lightbox-next" id="lightboxNext" aria-label="Next image"><i class="fa-solid fa-chevron-right"></i></button>
    </div>

    <!-- Floating Action Buttons -->
    <div class="floating-actions">
        <a href="<?php echo $social_links['whatsapp']; ?>" target="_blank" class="float-btn float-whatsapp" title="Chat on WhatsApp" aria-label="WhatsApp">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
        <a href="tel:<?php echo preg_replace('/[^0-9]/', '', $site_phone); ?>" class="float-btn float-call" title="Call Emergency Helpline" aria-label="Call Helpline">
            <i class="fa-solid fa-phone"></i>
        </a>
        <button id="backToTop" class="float-btn float-top" title="Back to top" aria-label="Back to top">
            <i class="fa-solid fa-arrow-up"></i>
        </button>
    </div>

    <!-- Main JavaScript -->
    <script src="assets/js/main.js?v=<?php echo time(); ?>"></script>
</body>
</html>
