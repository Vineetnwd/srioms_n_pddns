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
    echo json_encode(['status' => 'error', 'message' => 'Please provide both name and phone number.']);
    exit;
}

$inquiry = save_inquiry($_POST);

echo json_encode([
    'status' => 'success',
    'message' => 'Thank you, ' . htmlspecialchars($name) . '! Your inquiry has been registered successfully. Our counselor / team will contact you shortly.',
    'id' => $inquiry['id']
]);
exit;
