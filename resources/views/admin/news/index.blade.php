@extends('admin.layouts.app')

@section('header')
<h3>News Admin</h3>
@endsection

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-black">Danh sách tin tức</h2>
    <a href="{{ route('admin.news.create') }}" class="btn btn-outline-info mb-3">Thêm tin tức</a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-bordered table-light table-striped">
        <thead>
            <tr>
                <th>STT</th>
                <th>Tiêu đề</th>
                <th>Danh mục</th>
                <th>Ảnh đại diện</th>
                <th>Trạng thái</th>
                <th>Ngày đăng</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($news as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->category->name ?? '-' }}</td>
                <td>
                    @if($item->feature_image)
                        <img src="{{ asset('storage/' . $item->feature_image) }}" alt="Feature Image" width="80">
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if($item->published_at)
                        <span class="badge bg-success">Đã đăng</span>
                    @else
                        <span class="badge bg-secondary">Chưa đăng</span>
                    @endif
                </td>
                <td>{{ $item->published_at?->format('d/m/Y H:i') ?? '-' }}</td>
                <td>
                    <a href="{{ route('admin.news.show', $item->id) }}" class="btn btn-outline-warning btn-sm">Xem</a>
                    <a href="{{ route('admin.news.edit', $item->id) }}" class="btn btn-outline-primary btn-sm">Sửa</a>

                    <button type="button" class="btn btn-outline-danger btn-sm delete-btn" 
                        data-id="{{ $item->id }}"
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteNewsModal">
                        Xoá
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Không có tin tức nào</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-end mt-4">
        {{ $news->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>

{{-- Modal xác nhận xóa --}}
<div class="modal fade" id="deleteNewsModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-light text-black">
            <div class="modal-header border-0">
                <h5 class="modal-title">Xoá tin tức?</h5>
                <button class="btn-close btn-close-black" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xoá tin tức này không?</p>
                <p>Sau khi xoá không thể khôi phục.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xoá tin tức</button>
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
            const newsId = this.dataset.id;
            deleteForm.action = `/admin/news/${newsId}`;
        });
    });
});
</script>
@endsection
