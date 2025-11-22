@extends('admin.layouts.home')

@section('header')
<h3 class="mb-4">Danh sách loại tin tức</h3>
@endsection

@section('content')
<div class="container mt-4">

    <div class="mb-3 d-flex justify-content-end">
        <a href="{{ route('admin.news_categories.create') }}" class="btn btn-add ">
            <i class="fa-solid fa-plus me-1"></i> Thêm loại tin
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <strong>Thành công!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">

            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>STT</th>
                        <th>Tên loại tin</th>
                        <th>Mô tả</th>
                        <th>Ảnh</th>
                        <th>Trạng thái</th>
                        <th>Meta Title</th>
                        <th>Meta Description</th>
                        <th>Meta Keywords</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ Str::limit($category->description, 50) }}</td>
                        <td>
                            @if($category->image)
                                <img src="{{ asset('storage/' . $category->image) }}" width="50" class="rounded shadow-sm">
                            @else
                                <span class="text-muted">Không có</span>
                            @endif
                        </td>
                        <td>
                            @if($category->status)
                                <span class="badge bg-success">Hiển thị</span>
                            @else
                                <span class="badge bg-secondary">Ẩn</span>
                            @endif
                        </td>
                        <td>{{ Str::limit($category->meta_title, 30) }}</td>
                        <td>{{ Str::limit($category->meta_description, 30) }}</td>
                        <td>{{ Str::limit($category->meta_keywords, 30) }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.news_categories.edit', $category->slug) }}" class="btn btn-sm btn-warning me-1">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="{{ $category->slug }}" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center p-4 text-muted">Không có dữ liệu</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

    
    <div class="d-flex justify-content-end mt-3">
        {{ $categories->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>

{{-- Modal xóa --}}
<div class="modal fade" id="deleteCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-light text-black rounded-4 shadow-sm">
            <div class="modal-header border-0">
                <h5 class="modal-title">Xoá loại tin?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xoá danh mục này không?</p>
                <p class="text-danger small">Sau khi xoá không thể khôi phục.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Huỷ</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xoá loại tin</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const deleteForm = document.getElementById('deleteForm');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            deleteForm.action = `/admin/news_categories/${this.dataset.id}`;
        });
    });
});
</script>
@endsection
