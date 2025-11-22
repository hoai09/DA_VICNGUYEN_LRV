document.addEventListener("DOMContentLoaded", function () {
    /* -------------------------
    XỬ LÝ NÚT XÓA
    ------------------------- */
    const deleteButtons = document.querySelectorAll(".delete-btn");
    const deleteForm = document.getElementById("deleteForm");

    deleteButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            const slug = this.dataset.slug;
            deleteForm.action = `/admin/contact_info/${slug}`;
        });
    });

    /* -------------------------
    PREVIEW ẢNH
    ------------------------- */
    const mapInput = document.getElementById("mapInput");
    const previewWrapper = document.getElementById("previewWrapper");
    const previewImage = document.getElementById("previewImage");

    if (mapInput) {
        mapInput.addEventListener("change", function () {
            const file = this.files[0];

            if (file) {
                previewWrapper.classList.remove("d-none");
                previewImage.src = URL.createObjectURL(file);
            } else {
                previewWrapper.classList.add("d-none");
                previewImage.src = "";
            }
        });
    }
});
