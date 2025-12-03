document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("imageInput");
    const preview = document.querySelector(".img-preview");

    input.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = "block";
        }
    });
});

document
    .getElementById("imageInput")
    .addEventListener("change", function (event) {
        const [file] = event.target.files;
        const preview = document.getElementById("previewImg");
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove("d-none");
        }
    });
