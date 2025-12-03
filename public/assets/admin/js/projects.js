document.getElementById('title').addEventListener('input', function () {
    let text = this.value.toLowerCase()
        .replace(/ /g, '-')
        .replace(/[^\w-]+/g, '');
    document.getElementById('slug').value = text;
});

// ===========================

document.getElementById('saveCategoryBtn').addEventListener('click', function() {
    let name = document.getElementById('newCategoryName').value;

    if (!name.trim()) return alert("Vui lòng nhập tên thể loại");

    fetch("{{ route('admin.categories_project.store.ajax') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ name })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            let select = document.getElementById('categorySelect');
            let option = new Option(data.category.name, data.category.id, true, true);
            select.add(option);

            document.getElementById('newCategoryName').value = "";
            bootstrap.Modal.getInstance(document.getElementById('addCategoryModal')).hide();
        }
    });
});

document.addEventListener('click',function(e){
    if (e.target.closest('.deleteCatBtn')) {
        let id = e.target.closest('.deleteCatBtn').dataset.id;

        if (!confirm("Bạn có chắc muốn xoá danh mục này?")) return;
        fetch("{{ url('admin/categories_project/delete') }}/" + id, {
    method: "DELETE",
    headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" }
    })

        .then(res => res.json())
        .then(data => {
            if (data.success) location.reload();
            else alert(data.message);
        });
    }
});

document.querySelectorAll('.member-checkbox').forEach(cb => {
cb.addEventListener('change', function() {
    const roleInput = this.closest('.member-item').querySelector('.role-input');
    roleInput.style.display = this.checked ? 'block' : 'none';
});
});