ClassicEditor.create(document.querySelector("#editor"), {
    ckfinder: {
        uploadUrl: CKEDITOR_UPLOAD_URL,
    },
}).catch((error) => console.error(error));

document
    .getElementById("saveCategoryBtn")
    .addEventListener("click", function () {
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
                if (data.success) {
                    let select = document.getElementById("categorySelect");
                    let option = new Option(
                        data.category.name,
                        data.category.id,
                        true,
                        true
                    );
                    select.add(option);

                    let list = document.getElementById("categoryList");
                    list.innerHTML += `
                    <li class="list-group-item d-flex justify-content-between">
                        ${data.category.name}
                        <button class="btn btn-sm btn-danger deleteCatBtn" data-id="${data.category.id}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </li>`;
                }
            });
    });

document.addEventListener("click", function (e) {
    if (e.target.closest(".deleteCatBtn")) {
        let id = e.target.closest(".deleteCatBtn").dataset.id;

        if (!confirm("Bạn có chắc muốn xoá danh mục này?")) return;

        fetch(CATEGORY_DELETE_URL + id, {
            method: "DELETE",
            headers: { "X-CSRF-TOKEN": CSRF },
        })
            .then((res) => res.json())
            .then((data) => {
                if (data.success) location.reload();
                else alert(data.message);
            });
    }
});

const imageInput = document.querySelector('input[name="image"]');
const previewContainer = document.getElementById("imagePreviewContainer");

imageInput.addEventListener("change", function () {
    previewContainer.innerHTML = "";
    const file = this.files[0];

    if (file) {
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

        const imgPreview = document.createElement("img");
        imgPreview.src = URL.createObjectURL(file);
        imgPreview.style.width = "200px";
        imgPreview.classList.add("img-thumbnail");
        previewContainer.appendChild(imgPreview);
    }
});
