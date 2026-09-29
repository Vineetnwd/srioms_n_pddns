<?php
$page_title = "Admin Users Management";
$page_heading = "Manage Admin Accounts";
$current_admin_page = "users";

require_once __DIR__ . '/includes/header.php';

$message = '';
$error = '';
$pdo = srioms_db_connect();

if (!$pdo) {
    die('<div class="alert alert-danger">Database connection failed.</div>');
}

// Handle Add / Edit User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save_user') {
    $user_id = intval($_POST['user_id'] ?? 0);
    $username = trim($_POST['username'] ?? '');
    $display_name = trim($_POST['display_name'] ?? '');
    $user_email = trim($_POST['user_email'] ?? '');
    $user_nicename = trim($_POST['user_nicename'] ?? '');
    if (empty($user_nicename))
        $user_nicename = strtolower(str_replace(' ', '-', $username));
    $user_url = trim($_POST['user_url'] ?? '');
    $user_status = intval($_POST['user_status'] ?? 0);
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($display_name)) {
        $error = 'Username and Display Name are required.';
    } elseif ($user_id == 0 && empty($password)) {
        $error = 'Password is required for new users.';
    } else {
        if ($user_id > 0) {
            // Update existing
            if (!empty($password)) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE `wp_users` SET user_login = ?, display_name = ?, user_email = ?, user_nicename = ?, user_url = ?, user_status = ?, user_pass = ? WHERE ID = ?");
                $stmt->execute([$username, $display_name, $user_email, $user_nicename, $user_url, $user_status, $hash, $user_id]);
                $message = 'User updated successfully with new password.';
            } else {
                $stmt = $pdo->prepare("UPDATE `wp_users` SET user_login = ?, display_name = ?, user_email = ?, user_nicename = ?, user_url = ?, user_status = ? WHERE ID = ?");
                $stmt->execute([$username, $display_name, $user_email, $user_nicename, $user_url, $user_status, $user_id]);
                $message = 'User updated successfully.';
            }
        } else {
            // Check if username exists
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM `wp_users` WHERE user_login = ?");
            $stmt->execute([$username]);
            if ($stmt->fetchColumn() > 0) {
                $error = 'Username already exists.';
            } else {
                // Insert new
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO `wp_users` (user_login, display_name, user_email, user_nicename, user_url, user_status, user_pass, user_registered, user_activation_key) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), '')");
                $stmt->execute([$username, $display_name, $user_email, $user_nicename, $user_url, $user_status, $hash]);
                $message = 'New admin user created successfully in wp_users.';
            }
        }
    }
}

// Handle Delete User
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);

    // Prevent deleting currently logged in user
    $stmt = $pdo->prepare("SELECT user_login FROM `wp_users` WHERE ID = ?");
    $stmt->execute([$delete_id]);
    $u = $stmt->fetchColumn();

    if ($u === $_SESSION['srioms_admin_user']) {
        $error = "You cannot delete your own account while logged in.";
    } else {
        $stmt = $pdo->prepare("DELETE FROM `wp_users` WHERE ID = ?");
        $stmt->execute([$delete_id]);
        $message = 'User deleted successfully.';
    }
}

// Fetch all users
$stmt = $pdo->query("SELECT ID as id, user_login as username, display_name, user_email, user_nicename, user_url, user_status, user_registered FROM `wp_users` WHERE user_login !='offerplant' ORDER BY ID ASC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if ($message): ?>
    <div class="alert alert-success"><i class="fa-solid fa-circle-check"></i> <?php echo htmlspecialchars($message); ?>
    </div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="alert alert-danger"><i class="fa-solid fa-circle-exclamation"></i> <?php echo htmlspecialchars($error); ?>
    </div>
<?php endif; ?>

<style>
    /* Professional & Compact UI */
    .premium-card {
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
        overflow: hidden;
    }

    .premium-card-header {
        padding: 12px 16px;
        border-bottom: 1px solid #e2e8f0;
        background: #f8fafc;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .premium-card-title {
        font-size: 0.95rem;
        font-weight: 600;
        color: #334155;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .premium-card-body {
        padding: 16px;
    }

    .modern-input {
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        padding: 8px 12px;
        width: 100%;
        font-size: 0.85rem;
        color: #1e293b;
    }

    .modern-input:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        outline: none;
    }

    .modern-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 4px;
        display: block;
    }

    .btn-gradient {
        background: #2563eb;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.85rem;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-gradient:hover {
        background: #1d4ed8;
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 6px;
        background: #e2e8f0;
        color: #475569;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 1rem;
    }

    .table-row-hover:hover {
        background-color: #f1f5f9;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 12px;
    }
    }

    .form-group-compact {
        margin-bottom: 0;
    }

    .password-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
    }

    .password-toggle {
        position: absolute;
        right: 12px;
        color: #94a3b8;
        cursor: pointer;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
        outline: none !important;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    .password-toggle:hover {
        color: #3b82f6;
    }

    .badge-role {
        background: #f1f5f9;
        color: #475569;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
        border: 1px solid #e2e8f0;
    }

    .text-muted {
        color: #64748b;
        font-size: 0.75rem;
    }
</style>

<div class="admin-grid-layout" style="gap: 24px;">
    <!-- Add / Edit Form -->
    <div class="admin-grid-col" style="flex: 1;">
        <div class="premium-card">
            <div class="premium-card-header">
                <div
                    style="color: #3b82f6; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-user-pen"></i>
                </div>
                <h2 class="premium-card-title">Manage Account</h2>
            </div>
            <div class="premium-card-body" style="padding: 16px;">
                <form method="POST" action="">
                    <input type="hidden" name="action" value="save_user">
                    <input type="hidden" name="user_id" id="edit_user_id" value="0">

                    <div class="form-grid">
                        <div class="form-group-compact">
                            <label class="modern-label">Username</label>
                            <input type="text" name="username" id="edit_username" class="modern-input"
                                placeholder="e.g. admin" required>
                        </div>
                        <div class="form-group-compact">
                            <label class="modern-label">Display Name</label>
                            <input type="text" name="display_name" id="edit_display_name" class="modern-input"
                                placeholder="e.g. Master Admin" required>
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group-compact">
                            <label class="modern-label">Email Address</label>
                            <input type="email" name="user_email" id="edit_user_email" class="modern-input"
                                placeholder="e.g. admin@srioms.co.in">
                        </div>
                        <div class="form-group-compact">
                            <label class="modern-label">Nicename (URL Slug)</label>
                            <input type="text" name="user_nicename" id="edit_user_nicename" class="modern-input"
                                placeholder="e.g. master-admin">
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group-compact">
                            <label class="modern-label">Website URL</label>
                            <input type="url" name="user_url" id="edit_user_url" class="modern-input"
                                placeholder="https://...">
                        </div>
                        <div class="form-group-compact">
                            <label class="modern-label">Account Status</label>
                            <select name="user_status" id="edit_user_status" class="modern-input">
                                <option value="0">Active (0)</option>
                                <option value="1">Inactive / Pending (1)</option>
                            </select>
                        </div>
                    </div>

                    <div style="margin-bottom: 12px;">
                        <label class="modern-label">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="user_password_input" name="password" class="modern-input"
                                placeholder="Leave blank to keep unchanged" style="padding-right: 36px;">
                            <button type="button" class="password-toggle" onclick="togglePassword()"
                                title="Toggle visibility">
                                <i class="fa-solid fa-eye" id="toggle_eye_icon"></i>
                            </button>
                        </div>
                        <small style="color: #64748b; display: block; margin-top: 4px; font-size: 0.65rem;">
                            For new users, a password is required.
                        </small>
                    </div>

                    <div style="display: flex; gap: 8px;">
                        <button type="submit" class="btn-gradient" style="flex: 1;"><i
                                class="fa-solid fa-floppy-disk"></i> Save User</button>
                        <button type="button" class="admin-btn admin-btn-outline"
                            style="border-radius: 6px; padding: 0 12px; height: 33px; background: transparent; border: 1px solid #cbd5e1; color: #475569; cursor: pointer;"
                            onclick="resetForm()" title="Cancel Edit">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="admin-grid-col" style="flex: 2;">
        <div class="premium-card">
            <div class="premium-card-header" style="justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 8px;">
                    <div
                        style="color: #10b981; width: 24px; height: 24px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <h2 class="premium-card-title">Registered Accounts</h2>
                </div>
                <span
                    style="background: #e2e8f0; color: #475569; padding: 2px 8px; border-radius: 12px; font-size: 0.7rem; font-weight: 600;">
                    <?php echo count($users); ?> Total
                </span>
            </div>
            <div class="premium-card-body p-0">
                <div class="table-responsive" style="border: none;">
                    <table class="admin-table" style="margin: 0; width: 100%;">
                        <thead>
                            <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                                <th
                                    style="padding: 12px 16px; font-size: 0.7rem; text-transform: uppercase; color: #64748b; text-align: left;">
                                    User Profile</th>
                                <th
                                    style="padding: 12px 16px; font-size: 0.7rem; text-transform: uppercase; color: #64748b; text-align: left;">
                                    Account Details</th>
                                <th
                                    style="padding: 12px 16px; font-size: 0.7rem; text-transform: uppercase; color: #64748b; text-align: right;">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <tr class="table-row-hover" style="border-bottom: 1px solid #f1f5f9;">
                                        <td style="padding: 12px 16px;">
                                            <div style="display: flex; align-items: center; gap: 12px;">
                                                <div class="user-avatar">
                                                    <?php echo strtoupper(substr($user['display_name'] ?: $user['username'], 0, 1)); ?>
                                                </div>
                                                <div>
                                                    <div style="font-weight: 600; color: #1e293b; font-size: 0.85rem;">
                                                        <?php echo htmlspecialchars($user['display_name']); ?>
                                                        <?php if ($user['username'] === $_SESSION['srioms_admin_user']): ?>
                                                            <span
                                                                style="background: #dbeafe; color: #1d4ed8; padding: 1px 4px; border-radius: 4px; font-size: 0.6rem; margin-left: 4px; vertical-align: middle;">YOU</span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="text-muted" style="margin-top: 2px;">
                                                        @<?php echo htmlspecialchars($user['username']); ?> &bull; ID:
                                                        #<?php echo htmlspecialchars($user['id']); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 12px 16px;">
                                            <div style="margin-bottom: 4px;">
                                                <?php if (!empty($user['user_email'])): ?>
                                                    <span style="color: #334155; font-weight: 500; font-size: 0.8rem;"><i
                                                            class="fa-regular fa-envelope"></i>
                                                        <?php echo htmlspecialchars($user['user_email']); ?></span>
                                                <?php else: ?>
                                                    <span class="text-muted"><i>No email</i></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="text-muted" style="margin-bottom: 4px;">
                                                <i class="fa-regular fa-calendar"></i> Joined:
                                                <?php echo !empty($user['user_registered']) ? date('M j, Y', strtotime($user['user_registered'])) : 'Unknown'; ?>
                                            </div>
                                            <div>
                                                <?php if ($user['user_status'] != 0): ?>
                                                    <span
                                                        style="background: #fee2e2; color: #ef4444; padding: 1px 6px; border-radius: 4px; font-size: 0.6rem; font-weight: 700; display: inline-block;">INACTIVE</span>
                                                <?php else: ?>
                                                    <span
                                                        style="background: #dcfce3; color: #16a34a; padding: 1px 6px; border-radius: 4px; font-size: 0.6rem; font-weight: 700; display: inline-block;">ACTIVE</span>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td style="padding: 12px 16px; text-align: right; vertical-align: middle;">
                                            <div style="display: flex; gap: 6px; justify-content: flex-end;">
                                                <button
                                                    onclick="editUser(<?php echo $user['id']; ?>, '<?php echo addslashes($user['username']); ?>', '<?php echo addslashes($user['display_name']); ?>', '<?php echo addslashes($user['user_email'] ?? ''); ?>', '<?php echo addslashes($user['user_nicename'] ?? ''); ?>', '<?php echo addslashes($user['user_url'] ?? ''); ?>', <?php echo (int) ($user['user_status'] ?? 0); ?>)"
                                                    style="background: transparent; color: #3b82f6; border: 1px solid #bfdbfe; width: 28px; height: 28px; border-radius: 6px; cursor: pointer; transition: 0.2s;"
                                                    onmouseover="this.style.background='#eff6ff'"
                                                    onmouseout="this.style.background='transparent'" title="Edit">
                                                    <i class="fa-solid fa-pen-to-square" style="font-size: 0.75rem;"></i>
                                                </button>
                                                <?php if ($user['username'] !== $_SESSION['srioms_admin_user']): ?>
                                                    <a href="?delete=<?php echo $user['id']; ?>"
                                                        style="background: transparent; color: #ef4444; border: 1px solid #fecaca; width: 28px; height: 28px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; text-decoration: none; transition: 0.2s;"
                                                        onmouseover="this.style.background='#fef2f2'"
                                                        onmouseout="this.style.background='transparent'"
                                                        onclick="return confirm('Are you sure you want to delete this admin user?');"
                                                        title="Delete">
                                                        <i class="fa-solid fa-trash-can" style="font-size: 0.75rem;"></i>
                                                    </a>
                                                <?php else: ?>
                                                    <div style="width: 28px; height: 28px;"></div>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center" style="padding: 40px; color: #94a3b8;">
                                        <i class="fa-solid fa-users-slash"
                                            style="font-size: 2rem; margin-bottom: 12px; opacity: 0.5;"></i>
                                        <div style="font-weight: 500;">No users found.</div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('user_password_input');
        const icon = document.getElementById('toggle_eye_icon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    function editUser(id, username, displayName, email, nicename, url, status) {
        document.getElementById('edit_user_id').value = id;
        document.getElementById('edit_username').value = username;
        document.getElementById('edit_display_name').value = displayName;
        document.getElementById('edit_user_email').value = email;
        document.getElementById('edit_user_nicename').value = nicename;
        document.getElementById('edit_user_url').value = url;
        document.getElementById('edit_user_status').value = status;

        document.getElementById('edit_username').focus();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    function resetForm() {
        document.getElementById('edit_user_id').value = '0';
        document.getElementById('edit_username').value = '';
        document.getElementById('edit_display_name').value = '';
        document.getElementById('edit_user_email').value = '';
        document.getElementById('edit_user_nicename').value = '';
        document.getElementById('edit_user_url').value = '';
        document.getElementById('edit_user_status').value = '0';
    }
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>