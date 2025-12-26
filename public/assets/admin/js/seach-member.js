document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const tableBody = document.getElementById("tableBody");

    if (!searchInput || !tableBody) return;

    const rows = tableBody.querySelectorAll("tr");

    searchInput.addEventListener("input", function () {
        const keyword = this.value.toLowerCase().trim();
        let hasResult = false;

        rows.forEach((row) => {
            const emptyCell = row.querySelector("td[colspan]");
            if (emptyCell) {
                row.style.display = "none";
                return;
            }

            const name =
                row.querySelector("strong")?.textContent.toLowerCase() || "";
            const slug =
                row.querySelector("small")?.textContent.toLowerCase() || "";
            const role =
                row
                    .querySelector(".label-default")
                    ?.textContent.toLowerCase() || "";
            const site =
                row.querySelector(".badge")?.textContent.toLowerCase() || "";

            const text = `${name} ${slug} ${role} ${site}`;

            if (!keyword || text.includes(keyword)) {
                row.style.display = "";
                hasResult = true;
            } else {
                row.style.display = "none";
            }
        });

        const emptyRow = tableBody.querySelector("td[colspan]")?.parentElement;
        if (emptyRow) {
            emptyRow.style.display = hasResult || !keyword ? "none" : "";
        }
    });
});
