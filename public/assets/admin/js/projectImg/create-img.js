const imageInput = document.getElementById("imageInput");
const previewContainer = document.getElementById("previewContainer");
const previewRow = document.getElementById("previewRow");

imageInput.addEventListener("change", function () {
    previewRow.innerHTML = "";
    const files = imageInput.files;
    if (files.length > 0) {
        previewContainer.style.display = "block";
    } else {
        previewContainer.style.display = "none";
    }

    Array.from(files).forEach((file) => {
        const reader = new FileReader();
        reader.onload = function (e) {
            const col = document.createElement("div");
            col.className = "col-3 mb-3";
            col.innerHTML = `
                    <div class="border rounded p-1">
                        <img src="${e.target.result}" class="img-fluid rounded" alt="Preview">
                    </div>
                `;
            previewRow.appendChild(col);
        };
        reader.readAsDataURL(file);
    });
});
