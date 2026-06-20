document.addEventListener('DOMContentLoaded', function () {
    const timeElement = document.getElementById('time');
    function updateClock() {
        if (timeElement) timeElement.textContent = new Date().toLocaleString();
    }
    updateClock();
    setInterval(updateClock, 1000);
});
