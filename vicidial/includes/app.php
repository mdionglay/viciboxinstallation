<?php
session_start();

function is_logged_in(): bool
{
    return isset($_SESSION['user_id']);
}

function require_login(): void
{
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

function current_user_name(): string
{
    return $_SESSION['user_name'] ?? 'Agent Supervisor';
}

function nav_items(): array
{
    return [
        'index.php' => ['Dashboard', '📊'],
        'campaigns.php' => ['Campaigns', '📞'],
        'agents.php' => ['Agents', '👥'],
        'leads.php' => ['Leads', '🧾'],
        'reports.php' => ['Reports', '📈'],
        'settings.php' => ['Settings', '⚙️'],
    ];
}

function render_shell_start(string $title, string $activePage): void
{
    $userName = htmlspecialchars(current_user_name(), ENT_QUOTES, 'UTF-8');
    $escapedTitle = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');
    $items = nav_items();

    echo '<!DOCTYPE html>';
    echo '<html lang="en">';
    echo '<head>';
    echo '  <meta charset="UTF-8">';
    echo '  <meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '  <title>ViciDial Admin - ' . $escapedTitle . '</title>';
    echo '  <link rel="stylesheet" href="assets/css/style.css">';
    echo '  <link rel="stylesheet" href="assets/css/responsive.css">';
    echo '</head>';
    echo '<body>';
    echo '<div class="app-shell">';

    echo '  <header class="top-header">';
    echo '    <div class="header-left">';
    echo '      <button class="menu-toggle" id="menuToggle" type="button" aria-label="Toggle menu"><span aria-hidden="true">☰</span><span class="sr-only">Menu</span></button>';
    echo '      <div>';
    echo '        <h1 class="brand">ViciDial Admin</h1>';
    echo '        <p class="brand-subtitle">Call Center Operations Console</p>';
    echo '      </div>';
    echo '    </div>';
    echo '    <div class="header-right">';
    echo '      <span class="header-clock">Updated: <span id="time"></span></span>';
    echo '      <span class="header-user">' . $userName . '</span>';
    echo '      <a class="btn btn-danger" href="logout.php">Logout</a>';
    echo '    </div>';
    echo '  </header>';

    echo '  <aside class="sidebar" id="sidebar">';
    echo '    <div class="sidebar-profile">';
    echo '      <div class="avatar">👤</div>';
    echo '      <div>';
    echo '        <p class="profile-name">' . $userName . '</p>';
    echo '        <p class="profile-status">Online</p>';
    echo '      </div>';
    echo '    </div>';
    echo '    <nav class="sidebar-nav"><ul>';

    foreach ($items as $href => [$label, $icon]) {
        $activeClass = $activePage === $href ? ' class="active"' : '';
        echo '<li><a href="' . $href . '"' . $activeClass . '><span class="nav-icon">' . $icon . '</span><span>' . $label . '</span></a></li>';
    }

    echo '    </ul></nav>';
    echo '  </aside>';

    echo '  <main class="content">';
    echo '    <div class="content-header">';
    echo '      <h2>' . $escapedTitle . '</h2>';
    echo '      <p>Sample ViciDial-style admin view (placeholder data)</p>';
    echo '    </div>';
}

function render_shell_end(): void
{
    echo '  </main>';
    echo '</div>';
    echo '<script src="assets/js/script.js"></script>';
    echo '</body>';
    echo '</html>';
}
