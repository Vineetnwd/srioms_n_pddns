<?php
/**
 * SRIOMS Website Data & Database Layer
 * Supports JSON / SQLite / PDO MySQL
 */

if (!defined('SRIOMS_SITE')) {
    define('SRIOMS_SITE', true);
}

define('SRIOMS_DATA_DIR', __DIR__ . '/../data');

// Data loader helper
function srioms_load_json($filename, $default = []) {
    $path = SRIOMS_DATA_DIR . '/' . $filename;
    if (!file_exists($path)) {
        return $default;
    }
    $content = file_get_contents($path);
    $data = json_decode($content, true);
    return is_array($data) ? $data : $default;
}

// Data saver helper
function srioms_save_json($filename, $data) {
    if (!is_dir(SRIOMS_DATA_DIR)) {
        mkdir(SRIOMS_DATA_DIR, 0755, true);
    }
    $path = SRIOMS_DATA_DIR . '/' . $filename;
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

// Gallery Functions
function get_gallery_items($category = 'all') {
    $items = srioms_load_json('gallery.json', []);
    if ($category === 'all') {
        return $items;
    }
    return array_values(array_filter($items, function($item) use ($category) {
        return isset($item['category']) && $item['category'] === $category;
    }));
}

function save_gallery_item($item) {
    $items = srioms_load_json('gallery.json', []);
    $id = !empty($item['id']) ? (int)$item['id'] : time();
    $item['id'] = $id;
    if (empty($item['created_at'])) {
        $item['created_at'] = date('Y-m-d H:i:s');
    }

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

    srioms_save_json('gallery.json', $items);
    return $id;
}

function delete_gallery_item($id) {
    $id_int = (int)$id;
    $items = srioms_load_json('gallery.json', []);
    $filtered = array_values(array_filter($items, function($item) use ($id_int) {
        return (int)($item['id'] ?? 0) !== $id_int;
    }));
    return srioms_save_json('gallery.json', $filtered);
}

// Inquiries & Admissions Functions
function get_inquiries_list() {
    return srioms_load_json('inquiries.json', []);
}

function save_inquiry($data) {
    $inquiries = srioms_load_json('inquiries.json', []);
    $new_inquiry = [
        'id'            => time(),
        'name'          => htmlspecialchars($data['name'] ?? ''),
        'phone'         => htmlspecialchars($data['phone'] ?? ''),
        'email'         => htmlspecialchars($data['email'] ?? ''),
        'type'          => htmlspecialchars($data['type'] ?? $data['subject'] ?? 'General Inquiry'),
        'course'        => htmlspecialchars($data['course'] ?? ''),
        'guardian_name' => htmlspecialchars($data['guardian_name'] ?? ''),
        'qualification' => htmlspecialchars($data['qualification'] ?? ''),
        'address'       => htmlspecialchars($data['address'] ?? ''),
        'message'       => htmlspecialchars($data['message'] ?? $data['notes'] ?? ''),
        'status'        => 'New',
        'date'          => date('Y-m-d H:i:s')
    ];
    array_unshift($inquiries, $new_inquiry);
    srioms_save_json('inquiries.json', $inquiries);
    return $new_inquiry;
}

function update_inquiry_status($id, $status) {
    $inquiries = srioms_load_json('inquiries.json', []);
    foreach ($inquiries as &$inquiry) {
        if ($inquiry['id'] == $id) {
            $inquiry['status'] = $status;
            break;
        }
    }
    return srioms_save_json('inquiries.json', $inquiries);
}

function delete_inquiry($id) {
    $inquiries = srioms_load_json('inquiries.json', []);
    $filtered = array_values(array_filter($inquiries, function($inquiry) use ($id) {
        return $inquiry['id'] != $id;
    }));
    return srioms_save_json('inquiries.json', $filtered);
}

// Courses Functions
function get_courses_list() {
    return srioms_load_json('courses.json', []);
}

function save_course_item($course) {
    $courses = srioms_load_json('courses.json', []);
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
    return srioms_save_json('courses.json', $courses);
}

function delete_course_item($id) {
    $courses = srioms_load_json('courses.json', []);
    $filtered = array_values(array_filter($courses, function($c) use ($id) {
        return $c['id'] != $id;
    }));
    return srioms_save_json('courses.json', $filtered);
}

// Services Functions
function get_services_list() {
    return srioms_load_json('services.json', []);
}

function save_service_item($service) {
    $services = srioms_load_json('services.json', []);
    if (empty($service['id'])) {
        $service['id'] = time();
        $services[] = $service;
    } else {
        foreach ($services as &$s) {
            if ($s['id'] == $service['id']) {
                $s = array_merge($s, $service);
                break;
            }
        }
    }
    return srioms_save_json('services.json', $services);
}

function delete_service_item($id) {
    $services = srioms_load_json('services.json', []);
    $filtered = array_values(array_filter($services, function($s) use ($id) {
        return $s['id'] != $id;
    }));
    return srioms_save_json('services.json', $filtered);
}

// Settings Functions
function get_site_settings() {
    return srioms_load_json('settings.json', [
        'site_name'       => 'SHRI RAM Institute of Medical Sciences',
        'site_short_name' => 'SRIOMS',
        'site_tagline'    => 'Centre for Paramedical Education & Advanced Diagnostics',
        'site_email'      => 'info@srioms.co.in',
        'site_phone'      => '+91 9934402822',
        'site_phone_alt'  => '+91 9431426600',
        'site_emergency'  => '+91 9934402822',
        'site_address'    => 'Shri Ram MRI Scan Center, Fatehpur Bypass Road, Siwan - 841226 (Bihar)',
        'app_login_url'   => 'https://apps.srioms.co.in/login.php',
        'webmail_url'     => 'https://mail.hostinger.com/',
        'admin_user'      => 'admin',
        'admin_email'     => 'info@srioms.co.in'
    ]);
}

function save_site_settings($data) {
    $current = get_site_settings();
    $updated = array_merge($current, $data);
    return srioms_save_json('settings.json', $updated);
}
