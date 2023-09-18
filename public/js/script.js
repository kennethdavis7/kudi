(() => {
    "use strict";
    const tooltipTriggerList = Array.from(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    tooltipTriggerList.forEach((tooltipTriggerEl) => {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
})();

function convertDuration(totalSeconds) {
    const hours = Math.floor(totalSeconds / 60 / 60);
    const minutes = Math.floor((totalSeconds % (60 * 60)) / 60);
    const seconds = Math.floor((totalSeconds % (60 * 60)) % 60);

    const text = [
        hours > 0 && `${hours} jam`,
        minutes > 0 && `${minutes} menit`,
        seconds > 0 && `${seconds} detik`,
    ]
        .filter(Boolean)
        .join(" ");

    return text;
}
