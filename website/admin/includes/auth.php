<?php
/**
 * SRIOMS Admin Authentication Guard
 */
if (isset($_GET['test'])) {
    var_dump($_SESSION);
    die();
}
if (session_status() === PHP_SESSION_NONE) {
    if (!headers_sent()) {
        ini_set('session.cookie_httponly', 1);
        ini_set('session.use_only_cookies', 1);
        session_set_cookie_params(86400 * 30, '/');
    }
    @session_start();
}

require_once __DIR__ . '/db.php';

function srioms_auth_secret_token($username = 'admin')
{
    $pdo = srioms_db_connect();
    if ($pdo) {
        $stmt = $pdo->prepare("SELECT user_pass FROM `wp_users` WHERE user_login = ? LIMIT 1");
        $stmt->execute([$username]);
        $hash = $stmt->fetchColumn();
        if ($hash) {
            return hash('sha256', $username . $hash . 'srioms_secure_token_salt_2026');
        }
    }
    return hash('sha256', 'fallback_salt_2026');
}

function is_admin_logged_in()
{
    if (!empty($_SESSION['srioms_admin_logged_in']) && $_SESSION['srioms_admin_logged_in'] === true) {
        return true;
    }

    // Cookie token fallback for robust persistence on shared hosting
    if (!empty($_COOKIE['srioms_admin_token']) && !empty($_COOKIE['srioms_admin_user'])) {
        $u = $_COOKIE['srioms_admin_user'];
        if (hash_equals(srioms_auth_secret_token($u), $_COOKIE['srioms_admin_token'])) {
            $_SESSION['srioms_admin_logged_in'] = true;
            $_SESSION['srioms_admin_user'] = $u;
            $_SESSION['srioms_admin_name'] = 'Administrator';
            return true;
        }
    }

    return false;
}

function require_admin_auth()
{
    if (!is_admin_logged_in()) {
        header('Location: login.php?session_test=1');
        exit;
    }
}

function verify_admin_login($username, $password, &$error_message = null)
{
    $u = trim($username);
    $p = trim($password);

    $pdo = srioms_db_connect();
    if (!$pdo) {
        if ($error_message !== null) $error_message = 'Database connection failed. Check your DB config.';
        return false;
    }

    // 1. (Removed auto-create since wp_users already exists)
    
    // 2. Query the user from wp_users
    $stmt = $pdo->prepare("SELECT user_login as username, user_pass as password_hash, display_name FROM `wp_users` WHERE user_login = ? OR user_email = ? LIMIT 1");
    $stmt->execute([$u, $u]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        if ($error_message !== null) $error_message = 'Account not found. Please verify your username.';
        return false;
    }
    
    // 4. Verify password using standard PHP Bcrypt or Plain-Text Fallback
    $is_valid = false;
    if (password_verify($p, $user['password_hash'])) {
        $is_valid = true;
    } 
    // Fallback: If you manually changed it to plain-text inside phpMyAdmin
    elseif ($user['password_hash'] === $p) {
        $is_valid = true;
        
        // Auto-upgrade the plain text password back to a secure hash in the database
        $new_hash = password_hash($p, PASSWORD_DEFAULT);
        $update = $pdo->prepare("UPDATE `wp_users` SET user_pass = ? WHERE user_login = ?");
        $update->execute([$new_hash, $u]);
    }

    if (!$is_valid) {
        if ($error_message !== null) $error_message = 'Incorrect password. Please try again.';
        return false;
    }

    // 5. Authorize Session (Login Success)
    $_SESSION['srioms_admin_logged_in'] = true;
    $_SESSION['srioms_admin_user'] = $user['username'];
    $_SESSION['srioms_admin_name'] = $user['display_name'];

    // Set persistent authentication cookie
    setcookie('srioms_admin_token', srioms_auth_secret_token($user['username']), time() + (86400 * 30), '/');
    setcookie('srioms_admin_user', $user['username'], time() + (86400 * 30), '/');
    return true;
}
