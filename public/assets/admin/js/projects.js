const titleInput = document.getElementById("title");
if (titleInput) {
    titleInput.addEventListener("input", function () {
        let text = this.value
            .toLowerCase()
            .replace(/ /g, "-")
            .replace(/[^\w-]+/g, "");
        document.getElementById("slug").value = text;
    });
}

const saveBtn = document.getElementById("saveCategoryBtn");
if (saveBtn) {
    saveBtn.addEventListener("click", function () {
        let name = document.getElementById("newCategoryName").value;

        if (!name.trim()) {
            alert("Vui lòng nhập tên thể loại");
            return;
        }

        fetch(CATEGORYPRJ_STORE_URL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": CSRF,
            },
            body: JSON.stringify({ name }),
        })
            .then((res) => res.json())
            .then((data) => {
                if (data.success) {
                    let select = document.getElementById("categorySelect");
                    let option = new Option(
                        data.category.name,
                        data.category.id,
                        true,
                        true
                    );
                    select.add(option);

                    document.getElementById("newCategoryName").value = "";

                    $("#addCategoryModal").modal("hide");
                } else {
                    alert(data.message || "Có lỗi xảy ra");
                }
            });
    });
}

document.addEventListener("click", function (e) {
    if (e.target.closest(".deleteCatBtn")) {
        let id = e.target.closest(".deleteCatBtn").dataset.id;

        if (!confirm("Bạn có chắc muốn xoá danh mục này?")) return;
        fetch(CATEGORYPRJ_DELETE_URL + id, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": CSRF,
            },
        })
            .then((res) => res.json())
            .then((data) => {
                if (data.success) location.reload();
                else alert(data.message);
            });
    }
});

document.querySelectorAll(".member-checkbox").forEach((cb) => {
    cb.addEventListener("change", function () {
        const roleInput =
            this.closest(".member-item").querySelector(".role-input");
        roleInput.style.display = this.checked ? "block" : "none";
    });
});

$(document).ready(function () {
    $("#addCategoryModal").on("hidden.bs.modal", function () {
        document.activeElement && document.activeElement.blur();
    });
});
