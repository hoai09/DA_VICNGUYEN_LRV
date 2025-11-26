@extends('admin.layouts.home')

@section('header')
<h3 class="text-primary">Thêm ảnh dự án</h3>
@endsection

@section('content')
<div class="container py-4">

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Có lỗi xảy ra!</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.project_images.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <label class="form-label fw-bold">Chọn dự án</label>
                    <select name="project_id" class="form-select" required>
                        <option value="">-- Chọn dự án --</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Chọn ảnh (nhiều ảnh)</label>
                    <input type="file" name="images[]" class="form-control" multiple accept="image/*" id="imageInput" required>
                    <small class="text-muted">Bạn có thể chọn nhiều ảnh cùng lúc.</small>
                </div>

        
                <div class="mb-4" id="previewContainer" style="display:none;">
                    <label class="form-label fw-bold">Xem trước ảnh</label>
                    <div class="row" id="previewRow"></div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-outline-info mt-3">Tải lên</button>
                    <a href="{{ route('admin.project_images.index') }}" class="btn btn-outline-secondary mt-3">Quay lại</a>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
    const imageInput = document.getElementById('imageInput');
    const previewContainer = document.getElementById('previewContainer');
    const previewRow = document.getElementById('previewRow');

    imageInput.addEventListener('change', function() {
        previewRow.innerHTML = '';
        const files = imageInput.files;
        if (files.length > 0) {
            previewContainer.style.display = 'block';
        } else {
            previewContainer.style.display = 'none';
        }

        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-3 mb-3';
                col.innerHTML = `
                    <div class="border rounded p-1">
                        <img src="${e.target.result}" class="img-fluid rounded" alt="Preview">
                    </div>
                `;
                previewRow.appendChild(col);
            }
            reader.readAsDataURL(file);
        });
    });
</script>
@endsection
