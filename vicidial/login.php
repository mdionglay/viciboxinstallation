<?php
require_once __DIR__ . '/includes/app.php';

if (is_logged_in()) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username !== '' && $password !== '') {
        try {
            $_SESSION['user_id'] = bin2hex(random_bytes(16));
        } catch (Throwable $e) {
            $_SESSION['user_id'] = hash('sha256', uniqid($username, true));
        }
        $_SESSION['user_name'] = $username;
        header('Location: index.php');
        exit;
    }

    $error = 'Please provide a username and password.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ViciDial Admin - Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body class="login-body">
<div class="login-card">
    <h1>ViciDial Admin</h1>
    <p class="login-subtitle">Sign in to view campaigns, agents, leads, and reports.</p>

    <?php if ($error !== ''): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>

    <form class="login-form" method="post" action="login.php">
        <label for="username">Username</label>
        <input id="username" name="username" class="input" type="text" required>

        <label for="password">Password</label>
        <input id="password" name="password" class="input" type="password" required>

        <button class="btn btn-block" type="submit">Sign In</button>
    </form>

    <p class="login-hint">Demo: any non-empty username/password is accepted.</p>
</div>
<script src="assets/js/login.js"></script>
</body>
</html>
