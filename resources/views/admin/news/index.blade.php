@extends('admin.layouts.home')  // hiển thị danh sách tin tức

@section('header')  
@endsection

@section('content')
<div class="news-page container-fluid">

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title">Danh sách tin tức</h2>
        <a href="{{ route('admin.news.create') }}" class="btn btn-add">
            <i class="fa-solid fa-plus"></i> Thêm tin tức
        </a>
    </div>

    
    <div class="filter-bar d-flex gap-2 mb-4">
        <a href="{{ route('admin.news.index') }}"
        class="filter-chip {{ request('status') == null ? 'active' : '' }}">
            <i class="fa-solid fa-list"></i>
            <span>Tất cả</span>
        </a>

        <a href="{{ route('admin.news.index', ['status' => 'published']) }}"
        class="filter-chip {{ request('status') == 'published' ? 'active' : '' }}">
            <i class="fa-solid fa-circle-check text-success"></i>
            <span>Đã đăng</span>
        </a>

        <a href="{{ route('admin.news.index', ['status' => 'draft']) }}"
        class="filter-chip {{ request('status') == 'draft' ? 'active' : '' }}">
            <i class="fa-solid fa-circle-xmark text-secondary"></i>
            <span>Chưa đăng</span>
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
            <table class="table table-hover news-table align-middle mb-0">
                <thead class="form-label fw-semibold">
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        {{-- <th>Danh mục</th> --}}
                        <th>Tác giả</th>
                        <th>Ảnh</th>
                        <th>Trạng thái</th>
                        <th>Nổi bật</th>
                        <th>Lượt xem</th>
                        <th>Ngày đăng</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($news as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><strong>{{ $item->title }}</strong></td>
                        {{-- <td>{{ $item->category->name ?? '-' }}</td> --}}
                        <td>{{ $item->author->name ?? '-' }}</td>
                        <td>
                            @if($item->feature_image)
                                <img src="{{ asset('storage/' . $item->feature_image) }}" class="news-thumb" alt="{{ $item->title }}">
                            @else
                                <span class="text-muted">Không có</span>
                            @endif
                        </td>
                        <td>
                            @if($item->is_published)
                                <span class="badge status-published">Đã đăng</span>
                            @else
                                <span class="badge status-draft">Chưa đăng</span>
                            @endif
                        </td>
                        <td>
                            @if($item->featured_news)
                                <span class="badge badge-feature">Nổi bật</span>
                            @endif
                            @if($item->latest_news)
                                <span class="badge badge-latest">Mới</span>
                            @endif
                        </td>
                        <td>{{ $item->view_count }}</td>
                        <td>{{ $item->published_at?->format('d/m/Y H:i') ?? '-' }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.news.show', $item) }}"
                                    class="btn btn-outline-info action-btn" title="Xem">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.news.edit', $item) }}"
                                    class="btn btn-outline-primary action-btn" title="Sửa">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <button type="button" class="btn btn-outline-danger btn-sm delete-btn action-btn" 
                        data-slug="{{ $item->slug }}"
                        data-bs-toggle="modal" 
                        data-bs-target="#deleteNewsModal">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center p-4 text-muted">
                            Không có tin tức nào!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <div class="d-flex justify-content-end mt-4">
        {{ $news->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>


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
            const newsId = this.dataset.slug;
        
            deleteForm.action = `/admin/news/${newsId}`;
        });
    });
});
</script>
@endsection
