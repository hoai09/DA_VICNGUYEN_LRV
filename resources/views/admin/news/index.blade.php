{{-- @extends('admin.layouts.home')  

@section('header')  
@endsection

@section('content') --}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ config('apps.news.title') }}</h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="active"><strong>{{ config('apps.news.title') }}</strong></li>
        </ol>
    </div>
</div>

<div class="ibox-title d-flex justify-content-between align-items-center ">
        <h3 class="title mt-4">Danh sách tin tức</h3>

    <div class="d-flex justify-content-between align-items-center mt-4 ">
    <div class="filter-bar d-flex gap-2 mb-4">
        <a href="{{ route('admin.news.index') }}"
        class="filter-chip btn {{ request('status') == null ? 'active' : '' }}">
            <i class="fa-solid fa-list"></i>
            <span>Tất cả</span>
        </a>

        <a href="{{ route('admin.news.index', ['status' => 'published']) }}"
        class="filter-chip btn {{ request('status') == 'published' ? 'active' : '' }}">
            <i class="fa-solid fa-circle-check text-success"></i>
            <span>Đã đăng</span>
        </a>

        <a href="{{ route('admin.news.index', ['status' => 'draft']) }}"
        class="filter-chip btn {{ request('status') == 'draft' ? 'active' : '' }}">
            <i class="fa-solid fa-circle-xmark text-secondary"></i>
            <span>Chưa đăng</span>
        </a>
        
    </div>

    <div class="text-right">
        <a href="{{ route('admin.news.create') }}"
                            class="btn btn-primary btn-sm ">
                            <i class="fa fa-plus "></i> Thêm tin tức
        </a>
    </div>
</div>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <strong>Thành công!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    
    <div class="ibox-content p-0">
        <div class="table-responsive">
            <table class="table table-hover news-table align-middle mb-0">
                <thead class="form-label fw-semibold">
                    <tr>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Loại tin</th>
                        <th>Tác giả</th>
                        <th>Ảnh</th>
                        <th>Trạng thái</th>
                        <th>Chú ý</th>
                        <th>Lượt xem</th>
                        <th>Ngày đăng</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($news as $key=>$item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td><strong>{{ $item->title }}</strong></td>
                        <td>{{ $item->categoriesNews->name ?? '-' }}</td>
                        <td>{{ $item->author->name ?? '-' }}</td>
                        <td>
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="news-thumb" alt="{{ $item->title }}"
                                width="42" height="42"
                                style="object-fit: cover">
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
                            @if($item->is_featured)
                                <span class="badge badge-feature">Nổi bật</span>
                            @endif
                            @if($key === 0)
                                <span class="badge badge-latest">Mới</span>
                            @endif
                        </td>
                        <td>{{ $item->view_count }}</td>
                        <td>{{ $item->published_at?->format('d/m/Y H:i') ?? '-' }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                {{-- <a href="{{ route('admin.news.show', $item) }}"
                                    class="btn btn-outline-info action-btn" title="Xem">
                                    <i class="fa-solid fa-eye"></i>
                                </a> --}}
                                <a href="{{ route('admin.news.edit', $item) }}"
                                    class="btn btn-warning btn-sm" title="Sửa">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <form action="{{ route('admin.news.destroy', $item->slug) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash "></i>
                                    </button>
                                </form>
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
        {{ $news->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
{{-- @endsection --}}


