<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>;

ClassicEditor.create(document.querySelector("#editor"), {
    ckfinder: {
        uploadUrl:
            "{{ route('admin.ckeditor.upload') }}?_token={{ csrf_token() }}",
    },
}).catch((error) => console.error(error));

document
    .getElementById("saveCategoryBtn")
    .addEventListener("click", function () {
        let name = document.getElementById("newCategoryName").value.trim();
        if (!name) return alert("Vui lòng nhập tên danh mục");

        fetch("{{ route('admin.categories_news.store.ajax') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
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

                    document.getElementById("newCategoryName").value = "";
                }
            });
    });

document.addEventListener("click", function (e) {
    if (e.target.closest(".deleteCatBtn")) {
        let id = e.target.closest(".deleteCatBtn").dataset.id;

        if (!confirm("Bạn có chắc muốn xoá danh mục này?")) return;

        fetch("{{ url('admin/categories_news/delete') }}/" + id, {
            method: "DELETE",
            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
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

imageInput.addEventListener("change", function (e) {
    previewContainer.innerHTML = ""; // Xoá preview cũ
    const [file] = this.files;
    if (file) {
        // Check định dạng ảnh
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

        // Check dung lượng tối đa 2MB
        const maxSize = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSize) {
            alert("Ảnh quá lớn! Vui lòng chọn ảnh dưới 2MB.");
            this.value = "";
            return;
        }

        const imgPreview = document.createElement("img");
        imgPreview.src = URL.createObjectURL(file);
        imgPreview.style.width = "200px";
        imgPreview.style.marginTop = "10px";
        imgPreview.classList.add("img-thumbnail");
        previewContainer.appendChild(imgPreview);
    }
});

ClassicEditor.create(document.querySelector("#editor"), {
    ckfinder: {
        uploadUrl:
            "{{ route('admin.ckeditor.upload') }}?_token={{ csrf_token() }}",
    },
});
