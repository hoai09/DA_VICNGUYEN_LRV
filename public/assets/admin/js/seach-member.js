document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const tableBody = document.getElementById("tableBody");

    if (!searchInput || !tableBody) return;

    searchInput.addEventListener("keyup", function () {
        const keyword = this.value.toLowerCase().trim();

        tableBody.querySelectorAll("tr").forEach((row) => {
            const nameEl = row.querySelector("strong");
            const name = nameEl ? nameEl.textContent.toLowerCase() : "";

            row.style.display = name.includes(keyword) ? "" : "none";
        });
    });
});
