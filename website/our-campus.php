<?php
$page_title = "Our Campuses";
$page_description = "Explore the various campuses and centers of Shri Ram Institute of Medical Sciences (SRIOMS).";
$current_page = "our-campus";

require_once __DIR__ . '/includes/header.php';

// Connect to the separate OPEX database
$host = 'localhost'; // Assuming the database is on the same server
$db_name = 'u305984835_srioms_opex';
$db_user = 'u305984835_srioms_opex';
$db_password = '@User!2001';

$centers = [];
try {
    $pdo_centers = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8mb4", $db_user, $db_password);
    $pdo_centers->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Fetch active centers
    $stmt = $pdo_centers->query("SELECT * FROM centers WHERE status = 'ACTIVE' ORDER BY id ASC");
    $centers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // If connection fails, $centers remains empty
    $db_error = true;
}
?>

<!-- Page Hero -->
<section class="page-hero">
    <div class="container page-hero-content">
        <div>
            <h1>Our Campuses & Centers</h1>
            <p>Find a Shri Ram Institute of Medical Sciences (SRIOMS) campus near you.</p>
        </div>
        <div class="breadcrumbs">
            <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            <span>/</span>
            <span class="current">Our Campus</span>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="section-py" style="background: #f8fafc;">
    <div class="container">
        
        <!-- Main Campus Section -->
        <div style="background: #ffffff; border-radius: 12px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 50px; display: flex; flex-direction: column;">
            <div style="background: var(--primary); color: white; padding: 20px 30px;">
                <h2 style="margin: 0; font-size: 1.5rem; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-building-columns"></i> Main Campus
                </h2>
            </div>
            <div class="main-campus-grid" style="padding: 30px;">
                <div style="display: flex; flex-direction: column; gap: 16px; justify-content: center;">
                    <h3 style="color: var(--primary-900); font-size: 1.3rem; margin: 0;">Shri Ram Institute of Medical Sciences (SRIOMS)</h3>
                    <p style="color: #475569; font-size: 1.05rem; line-height: 1.6; margin: 0;">
                        Our state-of-the-art main campus is equipped with modern laboratories, spacious classrooms, and a comprehensive library. It serves as the central hub for all our academic and practical training programs in paramedical sciences.
                    </p>
                    
                    <div style="display: flex; flex-direction: column; gap: 12px; margin-top: 10px;">
                        <div style="display: flex; align-items: flex-start; gap: 12px;">
                            <i class="fa-solid fa-location-dot" style="color: var(--primary); margin-top: 4px; font-size: 1.1rem;"></i>
                            <span style="color: #334155; font-weight: 500;">Fatehpur Bypass Rd, Naya Bazar, Pal Nagar, Pakri Bangali, Bihar 841226</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <i class="fa-solid fa-phone" style="color: var(--primary); font-size: 1.1rem;"></i>
                            <a href="tel:+918405903501" style="color: #334155; text-decoration: none; font-weight: 500;">+91 8405903501</a>
                        </div>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <i class="fa-solid fa-envelope" style="color: var(--primary); font-size: 1.1rem;"></i>
                            <a href="mailto:ask@srioms.co.in" style="color: #334155; text-decoration: none; font-weight: 500;">ask@srioms.co.in</a>
                        </div>
                    </div>
                </div>
                
                <!-- Google Map Embed -->
                <div style="width: 100%; height: 300px; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e2e8f0;">
                    <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=Shri%20Ram%20Institute%20of%20Medical%20Science,%20Paramedical%20college,%20Siwan&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
                </div>
            </div>
        </div>

        <?php if (isset($db_error)): ?>
            <div style="background: #fef2f2; color: #b91c1c; padding: 20px; border-radius: 8px; border: 1px solid #fecaca; text-align: center;">
                <i class="fa-solid fa-triangle-exclamation" style="font-size: 1.5rem; margin-bottom: 10px;"></i>
                <p style="margin: 0; font-weight: 600;">Unable to connect to the campus database at this time.</p>
            </div>
        <?php elseif (empty($centers)): ?>
            <div style="text-align: center; padding: 60px 20px;">
                <i class="fa-solid fa-building" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 20px;"></i>
                <h3 style="color: #64748b; font-weight: 500;">No active campuses found.</h3>
            </div>
        <?php else: ?>
            
            <!-- Centers Headline -->
            <div style="text-align: center; margin-bottom: 30px;">
                <h2 style="color: var(--primary-900); font-size: 2rem; margin-bottom: 10px;">Our Information & Admission Centers</h2>
                <div style="height: 4px; width: 60px; background: var(--primary); margin: 0 auto; border-radius: 2px;"></div>
                <p style="color: #64748b; font-size: 1.1rem; margin-top: 15px;">Visit any of our regional centers for counseling, information, and admission support.</p>
            </div>

            <div class="cards-grid-3">
                <?php foreach ($centers as $center): ?>
                    <div style="background: #ffffff; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #e2e8f0; overflow: hidden; display: flex; flex-direction: column; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 10px 15px -3px rgba(0, 0, 0, 0.1)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0, 0, 0, 0.05)';">
                        
                        <!-- Top Accent Bar -->
                        <div style="height: 4px; background: var(--primary);"></div>
                        
                        <div style="padding: 24px; flex-grow: 1; display: flex; flex-direction: column; gap: 16px;">
                            
                            <!-- Header -->
                            <div>
                                <h3 style="color: var(--primary-900); font-size: 1.25rem; margin-bottom: 4px; line-height: 1.3;">
                                    <?php echo htmlspecialchars($center['center_name'] ?? 'SRIOMS Campus'); ?>
                                </h3>
                                <p style="color: var(--primary-600); font-weight: 600; font-size: 0.9rem; margin: 0; display: flex; align-items: flex-start; gap: 6px;">
                                    <i class="fa-solid fa-location-dot" style="margin-top: 3px;"></i>
                                    <?php echo htmlspecialchars($center['location_name'] ?? 'Location not specified'); ?>
                                </p>
                            </div>
                            
                            <!-- Divider -->
                            <div style="height: 1px; background: #e2e8f0; margin: 4px 0;"></div>
                            
                            <!-- Contact Info -->
                            <div style="display: flex; flex-direction: column; gap: 12px; font-size: 0.9rem; color: #475569;">
                                
                                <?php if (!empty($center['mobile'])): ?>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 28px; height: 28px; border-radius: 50%; background: #eff6ff; color: #3b82f6; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <a href="tel:<?php echo htmlspecialchars($center['mobile']); ?>" style="color: #475569; text-decoration: none; font-weight: 500;">
                                        <?php echo htmlspecialchars($center['mobile']); ?>
                                    </a>
                                </div>
                                <?php endif; ?>

                                <?php if (!empty($center['email'])): ?>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <div style="width: 28px; height: 28px; border-radius: 50%; background: #eff6ff; color: #3b82f6; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="fa-solid fa-envelope"></i>
                                    </div>
                                    <a href="mailto:<?php echo htmlspecialchars($center['email']); ?>" style="color: #475569; text-decoration: none; font-weight: 500;">
                                        <?php echo htmlspecialchars($center['email']); ?>
                                    </a>
                                </div>
                                <?php endif; ?>

                                <?php if (!empty($center['timing'])): ?>
                                <div style="display: flex; align-items: flex-start; gap: 10px;">
                                    <div style="width: 28px; height: 28px; border-radius: 50%; background: #fefce8; color: #eab308; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <i class="fa-regular fa-clock"></i>
                                    </div>
                                    <div style="line-height: 1.5;">
                                        <span style="display: block; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; font-weight: 600; margin-bottom: 2px;">Working Hours</span>
                                        <span style="font-weight: 500;"><?php echo htmlspecialchars($center['timing']); ?></span>
                                    </div>
                                </div>
                                <?php endif; ?>

                            </div>
                        </div>

                        <!-- Action Footer -->
                        <?php if (!empty($center['map_url'])): ?>
                        <div style="background: #f8fafc; border-top: 1px solid #e2e8f0; padding: 16px; text-align: center;">
                            <a href="<?php echo htmlspecialchars($center['map_url']); ?>" target="_blank" style="display: inline-flex; align-items: center; gap: 8px; color: var(--primary); font-weight: 600; text-decoration: none; font-size: 0.95rem; transition: color 0.2s;" onmouseover="this.style.color='var(--primary-700)'" onmouseout="this.style.color='var(--primary)'">
                                <i class="fa-solid fa-map-location-dot"></i> Get Directions
                            </a>
                        </div>
                        <?php endif; ?>

                    </div>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>

    </div>
</section>

<style>
    .main-campus-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
    }
    @media (min-width: 992px) {
        .main-campus-grid {
            grid-template-columns: 1.2fr 1fr;
        }
    }
    .cards-grid-3 {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
    }
    @media (min-width: 768px) {
        .cards-grid-3 {
            grid-template-columns: 1fr 1fr;
        }
    }
    @media (min-width: 1024px) {
        .cards-grid-3 {
            grid-template-columns: 1fr 1fr 1fr;
        }
    }
</style>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
