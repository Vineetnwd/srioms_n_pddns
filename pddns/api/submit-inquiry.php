<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');

if (empty($name) || empty($phone)) {
    echo json_encode(['status' => 'error', 'message' => 'Please provide both your name and mobile number.']);
    exit;
}

$inquiry = save_pddns_inquiry($_POST);

echo json_encode([
    'status'  => 'success',
    'message' => 'Thank you, ' . htmlspecialchars($name) . '! Your admission inquiry has been registered with Pt. Deen Dayal Nursing School. Our counseling cell will contact you shortly.',
    'id'      => $inquiry['id']
]);
exit;
