@extends('admin.layouts.home')

@section('header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-primary mb-0">Danh sách ảnh dự án</h3>
    <a href="{{ route('admin.project-images.create') }}" class="btn btn-primary shadow-sm">
        <i class="fa-solid fa-plus me-1"></i> Thêm ảnh dự án
    </a>
</div>
@endsection

@section('content')
<div class="container py-4">

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-hover align-middle mb-0 text-center">
            <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Ảnh</th>
                    <th>Dự án</th>
                    <th>Đường dẫn</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($images as $img)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('storage/'.$img->image_path) }}" width="100" class="rounded shadow-sm">
                    </td>
                    <td class="fw-semibold">{{ $img->project->title ?? 'Không có' }}</td>
                    <td class="text-truncate" style="max-width: 200px;">{{ $img->image_path }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.project-images.destroy', $img) }}"
                            onsubmit="return confirm('Xóa ảnh này?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm shadow-sm">
                                <i class="fa-solid fa-trash me-1"></i> Xóa
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-muted">Chưa có ảnh nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 d-flex justify-content-end">
        {{ $images->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('table.table-hover tbody tr').forEach(row => {
        row.addEventListener('mouseenter', () => row.classList.add('table-primary'));
        row.addEventListener('mouseleave', () => row.classList.remove('table-primary'));
    });
</script>
@endsection
