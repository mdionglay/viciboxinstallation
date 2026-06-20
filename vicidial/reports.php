<?php
require_once __DIR__ . '/includes/app.php';
require_login();
render_shell_start('Reports', 'reports.php');
?>
<section class="stats-grid">
    <article class="stat-card">
        <h3>Answer Rate</h3>
        <p class="stat-value">31.4%</p>
        <p class="stat-meta">Last 24 hours</p>
    </article>
    <article class="stat-card">
        <h3>Conversion</h3>
        <p class="stat-value">9.8%</p>
        <p class="stat-meta">Qualified outcomes</p>
    </article>
    <article class="stat-card">
        <h3>Average Handle Time</h3>
        <p class="stat-value">04:36</p>
        <p class="stat-meta">Talk + wrap</p>
    </article>
    <article class="stat-card">
        <h3>Abandon Rate</h3>
        <p class="stat-value">2.1%</p>
        <p class="stat-meta">Dialer dropped calls</p>
    </article>
</section>

<section class="split-grid">
    <article class="panel">
        <h3>Top Campaign Outcomes</h3>
        <ul class="list-metrics">
            <li><span>OUTBOUND_US_01</span><strong>163 Sales</strong></li>
            <li><span>RETENTION_CA</span><strong>91 Saves</strong></li>
            <li><span>APPOINTMENT_SETTER</span><strong>54 Meetings</strong></li>
            <li><span>WINBACK_Q2</span><strong>22 Reactivations</strong></li>
        </ul>
    </article>
    <article class="panel">
        <h3>Agent Productivity (Today)</h3>
        <ul class="list-metrics">
            <li><span>A1001</span><strong>41 Calls</strong></li>
            <li><span>A1002</span><strong>27 Calls</strong></li>
            <li><span>A1004</span><strong>22 Calls</strong></li>
            <li><span>A1003</span><strong>19 Calls</strong></li>
        </ul>
    </article>
</section>
<?php render_shell_end(); ?>
