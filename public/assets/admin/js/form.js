document.addEventListener("DOMContentLoaded", function () {
    let alert = document.querySelector(".alert-success");
    if (alert) {
        setTimeout(() => {
            alert.style.opacity = "0";
            alert.style.transition = "0.5s";
            setTimeout(() => alert.remove(), 500);
        }, 2500);
    }
});
