<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION = [];
session_destroy();

// Clear cookies
setcookie('srioms_admin_token', '', time() - 3600, '/');
setcookie('srioms_admin_user', '', time() - 3600, '/');

header('Location: login.php');
exit;
