<?php
require_once __DIR__ . '/includes/auth.php';

$error = '';

if (is_admin_logged_in()) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $error = 'Please enter both username and password.';
    } else {
        if (verify_admin_login($username, $password)) {
            session_write_close();
            header('Location: index.php');
            exit;
        } else {
            $error = 'Invalid username or password. Please try again.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | SRIOMS Control Panel</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../assets/images/logo.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Self-Contained Bulletproof Login CSS -->
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #07192f;
            background: linear-gradient(135deg, #07192f 0%, #0b2545 50%, #031e3d 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #1e293b;
        }

        .login-wrapper {
            width: 100%;
            max-width: 420px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.1);
            padding: 38px 32px 30px 32px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 24px;
        }

        .login-logo {
            height: 62px;
            width: auto;
            margin: 0 auto 12px auto;
            display: block;
        }

        .login-badge {
            display: inline-block;
            background: #e0f2fe;
            color: #0284c7;
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 10px;
        }

        .login-title {
            font-family: 'Outfit', sans-serif;
            font-size: 1.45rem;
            font-weight: 800;
            color: #0b2545;
            line-height: 1.2;
            margin-bottom: 4px;
        }

        .login-subtitle {
            font-size: 0.78rem;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .alert-error {
            background: #fee2e2;
            border: 1px solid #fca5a5;
            color: #991b1b;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrap i.field-icon {
            position: absolute;
            left: 14px;
            color: #94a3b8;
            font-size: 0.95rem;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            height: 44px;
            padding: 10px 14px 10px 40px;
            font-size: 0.92rem;
            font-family: inherit;
            color: #1e293b;
            background: #f8fafc;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            background: #ffffff;
            border-color: #0284c7;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 6px;
            font-size: 0.95rem;
        }

        .password-toggle:hover {
            color: #0b2545;
        }

        .btn-submit {
            width: 100%;
            height: 46px;
            background: #0284c7;
            background: linear-gradient(135deg, #0284c7 0%, #0b2545 100%);
            color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.35);
            transition: all 0.2s ease;
            margin-top: 22px;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #0369a1 0%, #07192f 100%);
            box-shadow: 0 6px 16px rgba(2, 132, 199, 0.45);
            transform: translateY(-1px);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .login-footer {
            margin-top: 22px;
            padding-top: 16px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.8rem;
            color: #64748b;
        }

        .login-footer a {
            color: #0284c7;
            text-decoration: none;
            font-weight: 600;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <img src="../assets/images/logo.png" alt="SRIOMS Logo" class="login-logo" onerror="this.style.display='none'">
                <div class="login-badge"><i class="fa-solid fa-shield-halved"></i> Control Panel</div>
                <h1 class="login-title">SRIOMS Admin</h1>
                <p class="login-subtitle">Shri Ram Institute of Medical Sciences</p>
            </div>

            <?php if ($error): ?>
                <div class="alert-error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span><?php echo htmlspecialchars($error); ?></span>
                </div>
            <?php endif; ?>

            <form method="POST" action="login.php">
                <div class="form-group">
                    <label class="form-label" for="adminUsername">Username / Email</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-user field-icon"></i>
                        <input type="text" id="adminUsername" name="username" class="form-control" placeholder="admin" required autofocus value="<?php echo htmlspecialchars($_POST['username'] ?? 'admin'); ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="adminPasswordInput">Password</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock field-icon"></i>
                        <input type="password" id="adminPasswordInput" name="password" class="form-control" placeholder="••••••••" style="padding-right: 40px;" required>
                        <button type="button" class="password-toggle" id="togglePasswordBtn" aria-label="Toggle password visibility">
                            <i class="fa-solid fa-eye" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-right-to-bracket"></i> Sign In to Dashboard
                </button>
            </form>

            <div class="login-footer">
                <a href="../index.php"><i class="fa-solid fa-arrow-left"></i> Public Site</a>
                <span><i class="fa-solid fa-lock"></i> SSL Secured</span>
            </div>
        </div>
    </div>

    <script>
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passInput = document.getElementById('adminPasswordInput');
        const passIcon = document.getElementById('togglePasswordIcon');

        if (toggleBtn && passInput && passIcon) {
            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (passInput.type === 'password') {
                    passInput.type = 'text';
                    passIcon.className = 'fa-solid fa-eye-slash';
                } else {
                    passInput.type = 'password';
                    passIcon.className = 'fa-solid fa-eye';
                }
            });
        }
    </script>
</body>
</html>
