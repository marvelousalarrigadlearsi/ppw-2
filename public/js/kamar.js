document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach(function (row, index) {
        row.style.opacity = '0';
        row.style.transform = 'translateY(8px)';

        setTimeout(function () {
            row.style.transition = 'opacity .35s ease, transform .35s ease';
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, index * 50);
    });
});