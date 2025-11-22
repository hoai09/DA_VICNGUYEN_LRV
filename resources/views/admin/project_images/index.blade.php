@extends('admin.layouts.home')

@section('header')
<div class="d-flex justify-content-between align-items-center mb-4 mt-5">
    <h3 class="fw-bold text-uppercase mb-0 text-dack">Danh sách dự án</h3>
    <a href="{{ route('admin.project_images.create') }}" class="btn btn-add shadow-sm">
        <i class="fa-solid fa-plus me-1"></i> Thêm ảnh dự án
    </a>
</div>
@endsection

@section('content')
<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Search box --}}
    <div class="row mb-3">
        <div class="col-md-4 ms-auto">
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-white border-end-0">
                    <i class="fa-solid fa-magnifying-glass text-secondary"></i>
                </span>
                <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Tìm kiếm dự án...">
            </div>
        </div>
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-dark text-white">
                <tr>
                    <th>Tên dự án</th>
                    <th>Trạng thái</th>
                    <th>Bắt đầu</th>
                    <th>Kết thúc</th>
                    <th class="text-center" width="160px">Hành động</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                @foreach ($images as $img)
                <tr class="align-middle">
                    <td class="fw-semibold">{{ $img->project->title ?? '-' }}</td>
                    
                    <td>
                        @php
                            $status = strtolower($img->project->status ?? 'unknown');
                            $color = match ($status) {
                                'đang thực hiện', 'doing' => 'warning',
                                'hoàn thành', 'done' => 'success',
                                'tạm dừng', 'pause' => 'secondary',
                                default => 'dark',
                            };
                        @endphp
                        <span class="badge bg-{{ $color }} px-3 py-2 text-uppercase">
                            {{ $img->project->status ?? '_' }}
                        </span>
                    </td>

                    <td>{{ $img->project->start_year ?? '-' }}</td>
                    <td>{{ $img->project->end_year ?? '-' }}</td>

                    <td class="d-flex justify-content-center gap-2">
                        <div class="btn-group" role="group">
                            <a href="{{ asset('storage/'.$img->image_path) }}" target="_blank" 
                                class="btn btn-sm btn-outline-primary shadow-sm">
                                <i class="fa-solid fa-image"></i> Xem
                            </a>

                        <form action="{{ route('admin.project_images.destroy', $img->slug) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Bạn có chắc muốn xoá không?')" 
                                    class="btn btn-danger btn-sm shadow-sm">
                                    <i class="fa-solid fa-trash "></i> Xoá
                            </button>
                        </form>
                    </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 d-flex justify-content-end">
        {{ $images->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    
    const searchInput = document.getElementById("searchInput");
    searchInput.addEventListener("keyup", function () {
        const value = this.value.toLowerCase();
        document.querySelectorAll("#tableBody tr").forEach(function (row) {
            row.style.display = row.textContent.toLowerCase().includes(value) ? "" : "none";
        });
    });
</script>
@endpush
