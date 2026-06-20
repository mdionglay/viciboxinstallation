<?php
require_once __DIR__ . '/includes/app.php';
require_login();
render_shell_start('Dashboard', 'index.php');
?>
<section class="stats-grid">
    <article class="stat-card">
        <h3>Active Campaigns</h3>
        <p class="stat-value">12</p>
        <p class="stat-meta">+2 this week</p>
    </article>
    <article class="stat-card">
        <h3>Logged-in Agents</h3>
        <p class="stat-value">46</p>
        <p class="stat-meta">5 paused</p>
    </article>
    <article class="stat-card">
        <h3>Open Leads</h3>
        <p class="stat-value">3,482</p>
        <p class="stat-meta">154 new today</p>
    </article>
    <article class="stat-card">
        <h3>Calls Today</h3>
        <p class="stat-value">1,927</p>
        <p class="stat-meta">31% connected</p>
    </article>
</section>

<section class="panel">
    <div class="panel-header">
        <h3>Campaign Snapshot</h3>
        <a class="btn" href="campaigns.php">View all campaigns</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
            <tr><th>Campaign</th><th>Status</th><th>Dial Method</th><th>Calls</th><th>Conversion</th></tr>
            </thead>
            <tbody>
            <tr><td>OUTBOUND_US_01</td><td><span class="badge success">Active</span></td><td>Ratio 2.0</td><td>612</td><td>8.3%</td></tr>
            <tr><td>RETENTION_CA</td><td><span class="badge success">Active</span></td><td>Manual</td><td>288</td><td>14.1%</td></tr>
            <tr><td>APPOINTMENT_SETTER</td><td><span class="badge warning">Paused</span></td><td>Ratio 1.5</td><td>121</td><td>6.8%</td></tr>
            <tr><td>WINBACK_Q2</td><td><span class="badge neutral">Scheduled</span></td><td>Preview</td><td>0</td><td>—</td></tr>
            </tbody>
        </table>
    </div>
</section>

<section class="split-grid">
    <article class="panel">
        <h3>Agent Status</h3>
        <ul class="list-metrics">
            <li><span>In Call</span><strong>28</strong></li>
            <li><span>Ready</span><strong>13</strong></li>
            <li><span>Paused</span><strong>5</strong></li>
            <li><span>Offline</span><strong>9</strong></li>
        </ul>
    </article>
    <article class="panel">
        <h3>Lead Buckets</h3>
        <ul class="list-metrics">
            <li><span>New</span><strong>154</strong></li>
            <li><span>Callable</span><strong>2,103</strong></li>
            <li><span>Callback</span><strong>438</strong></li>
            <li><span>DNC</span><strong>787</strong></li>
        </ul>
    </article>
</section>
<?php render_shell_end(); ?>
