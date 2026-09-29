<?php
require_once __DIR__ . '/admin/includes/db.php';

$pdo = srioms_db_connect();
if (!$pdo) die("DB failed.");

if (isset($_GET['username']) && isset($_GET['password'])) {
    $u = $_GET['username'];
    $p = $_GET['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM wp_users WHERE user_login = ?");
    $stmt->execute([$u]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        die("User not found in DB.");
    }
    
    echo "User found: " . htmlspecialchars($user['user_login']) . "<br>";
    echo "Hash in DB: " . htmlspecialchars($user['user_pass']) . "<br>";
    echo "Length of hash: " . strlen($user['user_pass']) . "<br>";
    
    if (password_verify($p, $user['user_pass'])) {
        echo "Bcrypt Verify: SUCCESS<br>";
    } else {
        echo "Bcrypt Verify: FAILED<br>";
    }
    
    if ($user['user_pass'] === $p) {
        echo "Plain Text Verify: SUCCESS<br>";
    } else {
        echo "Plain Text Verify: FAILED<br>";
    }
} else {
    echo "Usage: ?username=youruser&password=yourpass";
}
?>
