<?php
require_once __DIR__ . '/includes/app.php';
require_login();
render_shell_start('Leads', 'leads.php');
?>
<section class="panel">
    <div class="panel-header">
        <h3>Lead Inventory</h3>
        <div class="inline-controls">
            <select class="input" aria-label="Lead list">
                <option>All Lists</option>
                <option>US_MAIN</option>
                <option>CA_RET</option>
                <option>B2B_APPT</option>
            </select>
            <input class="input" id="leadFilter" data-filter-target="leadsTable" type="search" placeholder="Search lead name, phone, status">
        </div>
    </div>
    <div class="table-wrap">
        <table id="leadsTable">
            <thead>
            <tr><th>Lead ID</th><th>Name</th><th>Phone</th><th>List</th><th>Status</th><th>Last Agent</th><th>Updated</th></tr>
            </thead>
            <tbody>
            <tr><td>50001</td><td>Jordan Smith</td><td>+1-415-555-0132</td><td>US_MAIN</td><td><span class="badge neutral">NEW</span></td><td>—</td><td>2026-06-20 11:10</td></tr>
            <tr><td>50002</td><td>Mia Santos</td><td>+1-604-555-0144</td><td>CA_RET</td><td><span class="badge success">CALLBK</span></td><td>A1002</td><td>2026-06-20 10:48</td></tr>
            <tr><td>50003</td><td>Alex Brown</td><td>+1-212-555-0178</td><td>US_MAIN</td><td><span class="badge warning">NOCONTACT</span></td><td>A1001</td><td>2026-06-20 10:30</td></tr>
            <tr><td>50004</td><td>Sophia Chen</td><td>+1-312-555-0105</td><td>B2B_APPT</td><td><span class="badge danger">DNC</span></td><td>A1004</td><td>2026-06-20 09:52</td></tr>
            <tr><td>50005</td><td>Noah Wilson</td><td>+1-917-555-0189</td><td>WINBACK</td><td><span class="badge neutral">NEW</span></td><td>—</td><td>2026-06-20 09:10</td></tr>
            </tbody>
        </table>
    </div>
</section>
<?php render_shell_end(); ?>
