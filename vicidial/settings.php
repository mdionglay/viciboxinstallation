<?php
require_once __DIR__ . '/includes/app.php';
require_login();
render_shell_start('Settings', 'settings.php');
?>
<form class="settings-form" action="#" method="post">
    <section class="panel form-section">
        <h3>Dialer Settings</h3>
        <div class="form-grid">
            <label>Dial Method<select class="input"><option>Ratio</option><option>Manual</option><option>Preview</option></select></label>
            <label>Dial Level<input class="input" type="number" value="2.0" step="0.1"></label>
            <label>Drop Call Seconds<input class="input" type="number" value="30"></label>
            <label>Auto Pause<input class="input" type="number" value="45"></label>
        </div>
    </section>

    <section class="panel form-section">
        <h3>Agent Permissions</h3>
        <div class="form-grid">
            <label><input type="checkbox" checked> Enable real-time reports</label>
            <label><input type="checkbox" checked> Allow manual dial override</label>
            <label><input type="checkbox"> Allow list export</label>
            <label><input type="checkbox" checked> Enable call recording access</label>
        </div>
    </section>

    <section class="panel form-section">
        <h3>System Profile</h3>
        <div class="form-grid">
            <label>Timezone<select class="input"><option>UTC</option><option selected>America/New_York</option><option>America/Los_Angeles</option></select></label>
            <label>Default Campaign<select class="input"><option selected>OUTBOUND_US_01</option><option>RETENTION_CA</option></select></label>
            <label>Notification Email<input class="input" type="email" value="ops@example.local"></label>
            <label>Maintenance Window<input class="input" type="text" value="Sunday 02:00-03:00"></label>
        </div>
    </section>

    <div class="form-actions">
        <button type="submit" class="btn">Save Changes</button>
        <button type="reset" class="btn btn-alt">Reset</button>
    </div>
</form>
<?php render_shell_end(); ?>
