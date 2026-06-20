document.addEventListener('DOMContentLoaded', function () {
    const clock = document.getElementById('time');
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');

    function updateClock() {
        if (!clock) return;
        clock.textContent = new Date().toLocaleString();
    }

    updateClock();
    setInterval(updateClock, 1000);

    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', function () {
            sidebar.classList.toggle('open');
        });
    }

    document.querySelectorAll('input[data-filter-target]').forEach(function (input) {
        input.addEventListener('input', function () {
            const targetId = input.getAttribute('data-filter-target');
            const table = document.getElementById(targetId);
            if (!table) return;

            const query = input.value.toLowerCase();
            table.querySelectorAll('tbody tr').forEach(function (row) {
                row.style.display = row.textContent.toLowerCase().includes(query) ? '' : 'none';
            });
        });
    });
});
