const saveBtn = document.getElementById("saveCategoryBtn");

if (saveBtn) {
    saveBtn.addEventListener("click", function () {
        let name = document.getElementById("newCategoryName").value.trim();
        if (!name) return alert("Vui lòng nhập tên danh mục");

        fetch(CATEGORY_STORE_URL, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": CSRF,
            },
            body: JSON.stringify({ name }),
        })
            .then((res) => res.json())
            .then((data) => {
                if (!data.success) return alert(data.message);

                let select = document.getElementById("categorySelect");
                if (select) {
                    let option = new Option(
                        data.category.name,
                        data.category.id,
                        true,
                        true
                    );
                    select.add(option);
                }

                let list = document.getElementById("categoryList");
                if (list) {
                    list.innerHTML += `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            ${data.category.name}
                            <button class="btn btn-sm btn-danger deleteCatBtn" data-id="${data.category.id}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </li>`;
                }

                document.getElementById("newCategoryName").value = "";
                $("#categoryModal").modal("hide");
            });
    });
}

document.addEventListener("click", function (e) {
    const btn = e.target.closest(".deleteCatBtn");
    if (!btn) return;

    let id = btn.dataset.id;
    if (!confirm("Bạn có chắc muốn xoá danh mục này?")) return;

    fetch(CATEGORY_DELETE_URL + id, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": CSRF,
        },
    })
        .then((res) => res.json())
        .then((data) => {
            if (data.success) btn.closest("li").remove();
            else alert(data.message);
        });
});

const editorEl = document.querySelector("#editor");
if (editorEl) {
    ClassicEditor.create(editorEl, {
        ckfinder: {
            uploadUrl: CKEDITOR_UPLOAD_URL,
        },
    }).catch((error) => console.error(error));
}

const imageInput = document.querySelector('input[name="image"]');
const previewContainer = document.getElementById("imagePreviewContainer");

if (imageInput && previewContainer) {
    imageInput.addEventListener("change", function () {
        previewContainer.innerHTML = "";
        const file = this.files[0];

        if (!file) return;

        const validTypes = [
            "image/jpeg",
            "image/png",
            "image/gif",
            "image/webp",
        ];
        if (!validTypes.includes(file.type)) {
            alert("Vui lòng chọn file ảnh hợp lệ (jpg, png, gif, webp)");
            this.value = "";
            return;
        }

        if (file.size > 2 * 1024 * 1024) {
            alert("Ảnh quá lớn! Vui lòng chọn ảnh dưới 2MB.");
            this.value = "";
            return;
        }

        const img = document.createElement("img");
        img.src = URL.createObjectURL(file);
        img.className = "img-thumbnail mt-2";
        img.style.width = "200px";
        previewContainer.appendChild(img);
    });
}
