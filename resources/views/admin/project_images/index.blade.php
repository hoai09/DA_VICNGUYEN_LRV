@extends('admin.layouts.home')  
@section('header')
<div class="d-flex justify-content-between align-items-center mb-4 mt-4">
    <h2 class="title">Danh sách ảnh dự án</h2>
    <a href="{{ route('admin.project_images.create') }}" class="btn btn-add">
        <i class="fa-solid fa-plus"></i> Thêm ảnh dự án
    </a>
</div>
@endsection

@section('content')

<div class="search-wrapper mb-4 d-flex justify-content-end">
    <div class="input-group search-box shadow-sm">
        <span class="input-group-text bg-white border-end-0">
            <i class="fa-solid fa-magnifying-glass text-secondary"></i>
        </span>
        <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Tìm kiếm dự án...">
    </div>
</div>
<div class="container-fluid project-image-page">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <strong>Thành công!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 project-table">
                    <thead>
                        <tr>
                            <th>Ảnh</th>
                            <th>Dự án</th>
                            <th>Trạng thái</th>
                            <th>Bắt đầu</th>
                            <th>Kết thúc</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody id="tableBody">
                        @foreach ($images as $img)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/'.$img->image_path) }}" class="project-thumb" alt="">
                            </td>

                            <td class="fw-semibold">{{ $img->project->title ?? '-' }}</td>

                            <td>
                                @php
                                    $status = strtolower($img->project->status ?? 'unknown');
                                    $color = match($status) {
                                        'đang thực hiện', 'doing' => 'warning',
                                        'hoàn thành', 'done' => 'success',
                                        'tạm dừng', 'pause' => 'secondary',
                                        default => 'dark',
                                    };
                                @endphp

                                <span class="badge status-badge bg-{{ $color }}">
                                    {{ $img->project->status ?? '-' }}
                                </span>
                            </td>

                            <td>{{ $img->project->start_year ?? '-' }}</td>
                            <td>{{ $img->project->end_year ?? '-' }}</td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ asset('storage/'.$img->image_path) }}" 
                                        target="_blank"
                                        class="btn btn-outline-info action-btn" title="Xem ảnh">
                                        <i class="fa-solid fa-image"></i>
                                    </a>

                                    <form action="{{ route('admin.project_images.destroy', $img->slug) }}" 
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Bạn có chắc muốn xoá ảnh này không?')"
                                                class="btn btn-outline-danger action-btn"
                                                title="Xoá">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mt-4">
        {{ $images->links('vendor.pagination.bootstrap-5') }}
    </div>

</div>
@endsection


@section('scripts')
<script>
    const searchInput = document.getElementById("searchInput");

    searchInput.addEventListener("keyup", function () {
        const value = this.value.toLowerCase();
        document.querySelectorAll("#tableBody tr").forEach(function (row) {
            row.style.display = row.textContent.toLowerCase().includes(value)
                ? ""
                : "none";
        });
    });
</script>
@endsection
