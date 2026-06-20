<?php
require_once __DIR__ . '/includes/app.php';
require_login();
render_shell_start('Agents', 'agents.php');
?>
<section class="stats-grid compact">
    <article class="stat-card"><h3>Ready</h3><p class="stat-value">13</p></article>
    <article class="stat-card"><h3>In Call</h3><p class="stat-value">28</p></article>
    <article class="stat-card"><h3>Paused</h3><p class="stat-value">5</p></article>
    <article class="stat-card"><h3>Offline</h3><p class="stat-value">9</p></article>
</section>

<section class="panel">
    <div class="panel-header">
        <h3>Agent Live Status</h3>
        <input class="input" id="tableFilter" data-filter-target="agentsTable" type="search" placeholder="Filter by agent, extension, status">
    </div>
    <div class="table-wrap">
        <table id="agentsTable">
            <thead>
            <tr><th>Agent</th><th>Extension</th><th>Campaign</th><th>Status</th><th>Talk Time</th><th>Calls</th></tr>
            </thead>
            <tbody>
            <tr><td>A1001</td><td>860005</td><td>OUTBOUND_US_01</td><td><span class="badge success">INCALL</span></td><td>02:12:34</td><td>41</td></tr>
            <tr><td>A1002</td><td>860006</td><td>RETENTION_CA</td><td><span class="badge neutral">READY</span></td><td>01:17:02</td><td>27</td></tr>
            <tr><td>A1003</td><td>860007</td><td>OUTBOUND_US_01</td><td><span class="badge warning">PAUSED</span></td><td>00:42:19</td><td>19</td></tr>
            <tr><td>A1004</td><td>860008</td><td>APPOINTMENT_SETTER</td><td><span class="badge neutral">READY</span></td><td>01:01:10</td><td>22</td></tr>
            <tr><td>A1005</td><td>860009</td><td>RETENTION_CA</td><td><span class="badge danger">OFFLINE</span></td><td>00:00:00</td><td>0</td></tr>
            </tbody>
        </table>
    </div>
</section>
<?php render_shell_end(); ?>
