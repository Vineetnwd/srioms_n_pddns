<?php
$page_title = "Secretary's Message";
$page_description = "Message from the Secretary of Shri Ram Institute of Medical Sciences (SRIOMS).";
$current_page = "secretary-message";

require_once __DIR__ . '/includes/header.php';
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <div>
            <h1>Secretary's Message</h1>
            <p>Welcome to Shri Ram Institute of Medical Sciences (SRIOMS).</p>
        </div>
        <div class="breadcrumbs">
            <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            <span>/</span>
            <span class="current">Secretary's Message</span>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="section-py">
    <div class="container" style="max-width: 900px; margin: 0 auto; line-height: 1.8;">
        
        <div style="background: #ffffff; padding: 40px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); border: 1px solid #e2e8f0; display: flex; flex-direction: column; gap: 30px;">
            
            <div style="display: flex; gap: 30px; flex-direction: column; align-items: center; border-bottom: 1px solid #e2e8f0; padding-bottom: 30px;">
                <!-- Placeholder Image (User can replace later) -->
                <div style="width: 200px; height: 200px; border-radius: 50%; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">
                    <img src="assets/images/doctor-faculty.jpg" alt="Secretary" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='assets/images/doctor-faculty.jpg'">
                </div>
                
                <div style="text-align: center;">
                    <h2 style="color: var(--primary-900); margin-bottom: 8px;">Honorable Secretary</h2>
                    <p style="color: var(--primary-600); font-weight: 600; font-size: 1.1rem; margin-bottom: 0;">Shri Ram Institute of Medical Sciences (SRIOMS)</p>
                </div>
            </div>

            <div style="font-size: 1.05rem; color: #334155;">
                <p style="margin-bottom: 20px;">
                    Dear Students and Parents,
                </p>
                <p style="margin-bottom: 20px;">
                    It is my great pleasure to welcome you to the Shri Ram Institute of Medical Sciences (SRIOMS). Our institution was founded with a profound vision: to provide exceptional paramedical education that bridges the gap between healthcare needs and skilled professionals.
                </p>
                <p style="margin-bottom: 20px;">
                    In today's rapidly evolving medical landscape, paramedical staff form the backbone of the healthcare industry. We are dedicated to nurturing compassionate, highly skilled, and ethical professionals who will lead the future of patient care. 
                </p>
                <p style="margin-bottom: 20px;">
                    At SRIOMS, we offer state-of-the-art facilities, experienced faculty, and hands-on clinical training to ensure that our students are industry-ready from day one. We believe in holistic development, fostering not just academic excellence but also the core human values essential for the medical profession.
                </p>
                <p style="margin-bottom: 20px;">
                    I invite you to join us on this incredible journey of learning, growth, and service to humanity. Together, we can make a meaningful difference in the world of healthcare.
                </p>
                <p style="font-weight: 700; color: var(--primary-900); margin-top: 40px;">
                    Warm Regards,<br>
                    <span style="font-weight: 500; color: #475569;">Secretary, SRIOMS</span>
                </p>
            </div>
            
        </div>

    </div>
</section>

<style>
    @media (min-width: 768px) {
        .section-py .container > div > div:first-child {
            flex-direction: row !important;
            align-items: flex-start !important;
            text-align: left !important;
        }
        .section-py .container > div > div:first-child > div:last-child {
            text-align: left !important;
            padding-top: 20px;
        }
    }
</style>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
