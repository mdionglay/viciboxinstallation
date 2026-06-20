<?php
require_once __DIR__ . '/includes/app.php';
require_login();
render_shell_start('Campaigns', 'campaigns.php');
?>
<section class="panel">
    <div class="panel-header">
        <h3>Campaign Table</h3>
        <button class="btn" type="button">Create Campaign</button>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
            <tr><th>ID</th><th>Name</th><th>List</th><th>Status</th><th>Agents</th><th>Dial Prefix</th><th>Time Window</th></tr>
            </thead>
            <tbody>
            <tr><td>1001</td><td>OUTBOUND_US_01</td><td>US_MAIN</td><td><span class="badge success">Active</span></td><td>18</td><td>1</td><td>08:00-20:00</td></tr>
            <tr><td>1002</td><td>RETENTION_CA</td><td>CA_RET</td><td><span class="badge success">Active</span></td><td>11</td><td>1</td><td>09:00-18:00</td></tr>
            <tr><td>1003</td><td>APPOINTMENT_SETTER</td><td>B2B_APPT</td><td><span class="badge warning">Paused</span></td><td>9</td><td>1</td><td>10:00-17:00</td></tr>
            <tr><td>1004</td><td>WINBACK_Q2</td><td>WINBACK</td><td><span class="badge neutral">Scheduled</span></td><td>0</td><td>1</td><td>11:00-19:00</td></tr>
            </tbody>
        </table>
    </div>
</section>
<?php render_shell_end(); ?>
