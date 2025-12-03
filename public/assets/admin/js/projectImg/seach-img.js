const searchInput = document.getElementById("searchInput");

searchInput.addEventListener("keyup", function () {
    const value = this.value.toLowerCase();
    document.querySelectorAll("#tableBody tr").forEach(function (row) {
        row.style.display = row.textContent.toLowerCase().includes(value)
            ? ""
            : "none";
    });
});
