<?php
/**
 * Pt. Deen Dayal Nursing School (PDDNS) - Database & Data Layer
 * Supports Procedural MySQLi Query Engine with Automatic JSON Fallback
 */

if (!defined('PDDNS_SITE')) {
    define('PDDNS_SITE', true);
}

// Database Configuration Constants (Configure for MySQL/phpMyAdmin)
define('DB_HOST', defined('PDDNS_DB_HOST') ? PDDNS_DB_HOST : 'localhost');
define('DB_USER', defined('PDDNS_DB_USER') ? PDDNS_DB_USER : 'root');
define('DB_PASS', defined('PDDNS_DB_PASS') ? PDDNS_DB_PASS : '');
define('DB_NAME', defined('PDDNS_DB_NAME') ? PDDNS_DB_NAME : 'pddns');
define('DB_PORT', defined('PDDNS_DB_PORT') ? PDDNS_DB_PORT : 3306);

define('PDDNS_DATA_DIR', __DIR__ . '/../data');

/**
 * Procedural MySQLi Connection
 * Returns mysqli link on success, or null if MySQL is not available.
 */
function pddns_db_connect() {
    static $conn = null;
    if ($conn !== null) {
        return $conn;
    }
    
    // Attempt procedural mysqli connection without throwing fatal errors
    mysqli_report(MYSQLI_REPORT_OFF);
    $link = @mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
    
    if ($link && !mysqli_connect_errno()) {
        mysqli_set_charset($link, 'utf8mb4');
        $conn = $link;
        return $conn;
    }
    
    $conn = false;
    return false;
}

// JSON Helper Functions (Fallback & Standalone Mode)
function pddns_load_json($filename, $default = []) {
    $path = PDDNS_DATA_DIR . '/' . $filename;
    if (!file_exists($path)) {
        return $default;
    }
    $content = file_get_contents($path);
    $data = json_decode($content, true);
    return is_array($data) ? $data : $default;
}

function pddns_save_json($filename, $data) {
    if (!is_dir(PDDNS_DATA_DIR)) {
        mkdir(PDDNS_DATA_DIR, 0755, true);
    }
    $path = PDDNS_DATA_DIR . '/' . $filename;
    return file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
}

// Helper to resolve images from both assets/images/gallery and uploads folders
function resolve_gallery_image_src($img_url, $is_admin = false) {
    $clean = ltrim((string)$img_url, '/');
    $prefix = $is_admin ? '../' : '';
    $root_dir = $is_admin ? (__DIR__ . '/../../') : (__DIR__ . '/../');
    $filename = basename($clean);

    if (empty($clean)) {
        return $prefix . 'assets/images/slider-1.jpg';
    }
    if (strpos($clean, 'http://') === 0 || strpos($clean, 'https://') === 0) {
        return $clean;
    }

    // 1. Direct path check
    if (file_exists($root_dir . $clean)) {
        return $prefix . $clean;
    }
    // 2. assets/images/gallery/
    if (file_exists($root_dir . 'assets/images/gallery/' . $filename)) {
        return $prefix . 'assets/images/gallery/' . $filename;
    }
    // 3. uploads/
    if (file_exists($root_dir . 'uploads/' . $filename)) {
        return $prefix . 'uploads/' . $filename;
    }
    // 4. assets/images/uploads/
    if (file_exists($root_dir . 'assets/images/uploads/' . $filename)) {
        return $prefix . 'assets/images/uploads/' . $filename;
    }
    // 5. assets/images/
    if (file_exists($root_dir . 'assets/images/' . $filename)) {
        return $prefix . 'assets/images/' . $filename;
    }

    return $prefix . $clean;
}

// =========================================================================
// 1. GALLERY PROCEDURAL QUERIES (Table: `gallery`)
// =========================================================================

function get_pddns_gallery_items($category = 'all') {
    $conn = pddns_db_connect();
    if ($conn) {
        $sql = "SELECT * FROM `gallery`";
        if ($category !== 'all') {
            $cat_escaped = mysqli_real_escape_string($conn, $category);
            $sql .= " WHERE `category` = '$cat_escaped'";
        }
        $sql .= " ORDER BY `id` ASC";
        $res = mysqli_query($conn, $sql);
        if ($res && mysqli_num_rows($res) > 0) {
            $items = [];
            while ($row = mysqli_fetch_assoc($res)) {
                $items[] = $row;
            }
            return $items;
        }
    }
    
    // JSON Fallback
    $items = pddns_load_json('gallery.json', []);
    if ($category === 'all') {
        return $items;
    }
    return array_values(array_filter($items, function($item) use ($category) {
        return isset($item['category']) && $item['category'] === $category;
    }));
}

function save_pddns_gallery_item($item) {
    $id = !empty($item['id']) ? (int)$item['id'] : time();
    $item['id'] = $id;
    if (empty($item['created_at'])) {
        $item['created_at'] = date('Y-m-d H:i:s');
    }

    $conn = pddns_db_connect();
    if ($conn) {
        $title    = mysqli_real_escape_string($conn, $item['title'] ?? '');
        $category = mysqli_real_escape_string($conn, $item['category'] ?? 'campus');
        $cat_name = mysqli_real_escape_string($conn, $item['category_name'] ?? 'Campus & Classrooms');
        $img_url  = mysqli_real_escape_string($conn, $item['image_url'] ?? '');
        $created  = mysqli_real_escape_string($conn, $item['created_at']);

        $sql = "INSERT INTO `gallery` (`id`, `title`, `category`, `category_name`, `image_url`, `created_at`)
                VALUES ($id, '$title', '$category', '$cat_name', '$img_url', '$created')
                ON DUPLICATE KEY UPDATE 
                `title` = '$title', `category` = '$category', `category_name` = '$cat_name', `image_url` = '$img_url'";
        mysqli_query($conn, $sql);
    }
    
    // Always sync JSON
    $items = pddns_load_json('gallery.json', []);
    $found = false;
    foreach ($items as &$existing) {
        if ((int)($existing['id'] ?? 0) === $id) {
            $existing = array_merge($existing, $item);
            $found = true;
            break;
        }
    }
    unset($existing);

    if (!$found) {
        array_unshift($items, $item);
    }
    return pddns_save_json('gallery.json', $items);
}

function delete_pddns_gallery_item($id) {
    $id_int = (int)$id;
    $conn = pddns_db_connect();
    if ($conn) {
        mysqli_query($conn, "DELETE FROM `gallery` WHERE `id` = $id_int");
    }
    $items = pddns_load_json('gallery.json', []);
    $filtered = array_values(array_filter($items, function($item) use ($id_int) {
        return (int)($item['id'] ?? 0) !== $id_int;
    }));
    return pddns_save_json('gallery.json', $filtered);
}

// =========================================================================
// 2. INQUIRIES PROCEDURAL QUERIES (Table: `inquiries`)
// =========================================================================

function get_pddns_inquiries_list() {
    $conn = pddns_db_connect();
    if ($conn) {
        $sql = "SELECT * FROM `inquiries` ORDER BY `id` DESC";
        $res = mysqli_query($conn, $sql);
        if ($res && mysqli_num_rows($res) > 0) {
            $list = [];
            while ($row = mysqli_fetch_assoc($res)) {
                $list[] = $row;
            }
            return $list;
        }
    }
    return pddns_load_json('inquiries.json', []);
}

function save_pddns_inquiry($data) {
    $id       = (int)($data['id'] ?? time());
    $name     = htmlspecialchars($data['name'] ?? '');
    $phone    = htmlspecialchars($data['phone'] ?? '');
    $email    = htmlspecialchars($data['email'] ?? '');
    $type     = htmlspecialchars($data['type'] ?? 'Nursing Admission');
    $course   = htmlspecialchars($data['course'] ?? '');
    $guardian = htmlspecialchars($data['guardian_name'] ?? '');
    $qual     = htmlspecialchars($data['qualification'] ?? '');
    $address  = htmlspecialchars($data['address'] ?? '');
    $message  = htmlspecialchars($data['message'] ?? '');
    $status   = htmlspecialchars($data['status'] ?? 'New');
    $date     = date('Y-m-d H:i:s');

    $conn = pddns_db_connect();
    if ($conn) {
        $s_name     = mysqli_real_escape_string($conn, $name);
        $s_phone    = mysqli_real_escape_string($conn, $phone);
        $s_email    = mysqli_real_escape_string($conn, $email);
        $s_type     = mysqli_real_escape_string($conn, $type);
        $s_course   = mysqli_real_escape_string($conn, $course);
        $s_guardian = mysqli_real_escape_string($conn, $guardian);
        $s_qual     = mysqli_real_escape_string($conn, $qual);
        $s_address  = mysqli_real_escape_string($conn, $address);
        $s_message  = mysqli_real_escape_string($conn, $message);
        $s_status   = mysqli_real_escape_string($conn, $status);

        $sql = "INSERT INTO `inquiries` (`id`, `name`, `phone`, `email`, `type`, `course`, `guardian_name`, `qualification`, `address`, `message`, `status`, `created_at`)
                VALUES ($id, '$s_name', '$s_phone', '$s_email', '$s_type', '$s_course', '$s_guardian', '$s_qual', '$s_address', '$s_message', '$s_status', '$date')";
        mysqli_query($conn, $sql);
    }

    // Also persist into JSON
    $new_inquiry = [
        'id'            => $id,
        'name'          => $name,
        'phone'         => $phone,
        'email'         => $email,
        'type'          => $type,
        'course'        => $course,
        'guardian_name' => $guardian,
        'qualification' => $qual,
        'address'       => $address,
        'message'       => $message,
        'status'        => $status,
        'date'          => $date
    ];
    $inquiries = pddns_load_json('inquiries.json', []);
    array_unshift($inquiries, $new_inquiry);
    pddns_save_json('inquiries.json', $inquiries);
    return $new_inquiry;
}

function update_pddns_inquiry_status($id, $status) {
    $conn = pddns_db_connect();
    if ($conn) {
        $id_int   = (int)$id;
        $s_status = mysqli_real_escape_string($conn, $status);
        mysqli_query($conn, "UPDATE `inquiries` SET `status` = '$s_status' WHERE `id` = $id_int");
    }
    $inquiries = pddns_load_json('inquiries.json', []);
    foreach ($inquiries as &$inquiry) {
        if ($inquiry['id'] == $id) {
            $inquiry['status'] = $status;
            break;
        }
    }
    return pddns_save_json('inquiries.json', $inquiries);
}

function delete_pddns_inquiry($id) {
    $conn = pddns_db_connect();
    if ($conn) {
        $id_int = (int)$id;
        mysqli_query($conn, "DELETE FROM `inquiries` WHERE `id` = $id_int");
    }
    $inquiries = pddns_load_json('inquiries.json', []);
    $filtered = array_values(array_filter($inquiries, function($inquiry) use ($id) {
        return $inquiry['id'] != $id;
    }));
    return pddns_save_json('inquiries.json', $filtered);
}

// =========================================================================
// 3. COURSES PROCEDURAL QUERIES (Table: `courses`)
// =========================================================================

function get_pddns_courses_list() {
    $conn = pddns_db_connect();
    if ($conn) {
        $sql = "SELECT * FROM `courses` WHERE `status` = 'Active' ORDER BY `id` ASC";
        $res = mysqli_query($conn, $sql);
        if ($res && mysqli_num_rows($res) > 0) {
            $courses = [];
            while ($row = mysqli_fetch_assoc($res)) {
                $courses[] = $row;
            }
            return $courses;
        }
    }
    return pddns_load_json('courses.json', []);
}

function save_pddns_course_item($course) {
    $conn = pddns_db_connect();
    if ($conn) {
        $id          = (int)($course['id'] ?? 0);
        $code        = mysqli_real_escape_string($conn, $course['code'] ?? '');
        $name        = mysqli_real_escape_string($conn, $course['name'] ?? '');
        $level       = mysqli_real_escape_string($conn, $course['level'] ?? '');
        $duration    = mysqli_real_escape_string($conn, $course['duration'] ?? '');
        $eligibility = mysqli_real_escape_string($conn, $course['eligibility'] ?? '');
        $seats       = mysqli_real_escape_string($conn, $course['seats'] ?? '60 Seats');
        $fees        = mysqli_real_escape_string($conn, $course['fees'] ?? '');
        $description = mysqli_real_escape_string($conn, $course['description'] ?? '');
        $status      = mysqli_real_escape_string($conn, $course['status'] ?? 'Active');

        if ($id > 0) {
            $sql = "UPDATE `courses` SET `code`='$code', `name`='$name', `level`='$level', `duration`='$duration', `eligibility`='$eligibility', `seats`='$seats', `fees`='$fees', `description`='$description', `status`='$status' WHERE `id`=$id";
        } else {
            $sql = "INSERT INTO `courses` (`code`, `name`, `level`, `duration`, `eligibility`, `seats`, `fees`, `description`, `status`) VALUES ('$code', '$name', '$level', '$duration', '$eligibility', '$seats', '$fees', '$description', '$status')";
        }
        mysqli_query($conn, $sql);
    }
    $courses = pddns_load_json('courses.json', []);
    if (empty($course['id'])) {
        $course['id'] = time();
        $courses[] = $course;
    } else {
        foreach ($courses as &$c) {
            if ($c['id'] == $course['id']) {
                $c = array_merge($c, $course);
                break;
            }
        }
    }
    return pddns_save_json('courses.json', $courses);
}

function delete_pddns_course_item($id) {
    $conn = pddns_db_connect();
    if ($conn) {
        $id_int = (int)$id;
        mysqli_query($conn, "DELETE FROM `courses` WHERE `id` = $id_int");
    }
    $courses = pddns_load_json('courses.json', []);
    $filtered = array_values(array_filter($courses, function($c) use ($id) {
        return $c['id'] != $id;
    }));
    return pddns_save_json('courses.json', $filtered);
}

// =========================================================================
// 4. SETTINGS PROCEDURAL QUERIES (Table: `settings`)
// =========================================================================

function get_pddns_settings() {
    $conn = pddns_db_connect();
    if ($conn) {
        $sql = "SELECT `setting_key`, `setting_value` FROM `settings`";
        $res = mysqli_query($conn, $sql);
        if ($res && mysqli_num_rows($res) > 0) {
            $settings = [];
            while ($row = mysqli_fetch_assoc($res)) {
                $settings[$row['setting_key']] = $row['setting_value'];
            }
            return $settings;
        }
    }
    return pddns_load_json('settings.json', [
        'site_name'       => 'Pt. Deen Dayal Nursing School',
        'site_short_name' => 'PDDNS',
        'site_tagline'    => 'Premier Institute for Nursing Education & Healthcare Training',
        'site_email'      => 'info@pddns.in',
        'site_phone'      => '+91 9934402822',
        'site_phone_alt'  => '+91 9431426600',
        'site_emergency'  => '+91 9934402822',
        'site_address'    => 'Panchmukhi Bypass Road, Pal Nagar / Fatehpur, Siwan - 841226 (Bihar)',
        'app_login_url'   => 'https://apps.srioms.co.in/login.php',
        'webmail_url'     => 'https://mail.hostinger.com/',
        'admin_user'      => 'admin',
        'admin_password'  => 'admin',
        'admin_email'     => 'info@pddns.in'
    ]);
}

function save_pddns_settings($data) {
    $conn = pddns_db_connect();
    if ($conn) {
        foreach ($data as $k => $v) {
            $key_esc = mysqli_real_escape_string($conn, $k);
            $val_esc = mysqli_real_escape_string($conn, $v);
            $sql = "INSERT INTO `settings` (`setting_key`, `setting_value`) VALUES ('$key_esc', '$val_esc')
                    ON DUPLICATE KEY UPDATE `setting_value` = '$val_esc'";
            mysqli_query($conn, $sql);
        }
    }
    $current = get_pddns_settings();
    $updated = array_merge($current, $data);
    return pddns_save_json('settings.json', $updated);
}
