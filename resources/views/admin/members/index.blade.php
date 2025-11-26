@extends('admin.layouts.home')   // trang hiển thị danh sách nhân viên
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/admin/css/member.css') }}">
@endsection

@section('header')
@endsection

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">
            <i class="bi bi-people-fill me-2"></i>Danh sách thành viên
        </h3>

        <a href="{{ route('admin.members.create') }}" 
            class="btn btn-add shadow-sm px-4">
            <i class="fa-solid fa-plus me-1 "></i>Thêm thành viên
        </a>
    </div>


    @session('success')
    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
        <strong>Thành công!</strong> {{ $value }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endsession

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 project-table">
                <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Thông tin</th>
                    <th>Năm tốt nghiệp</th>
                    <th>Vicer từ</th>
                    <th>Dự án tham gia</th>
                    <th>Giải thưởng</th>
                    <th>Chức vụ</th>
                    <th class="text-center">Thao tác</th>
                </tr>
                </thead>

                <tbody>
                @forelse ($members as $member)
                <tr>
                    <td class="text-muted">{{ $member->id }}</td>

                
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('storage/' . $member->image) }}"
                                class="rounded-circle me-3" 
                                width="48" height="48"
                                style="object-fit: cover;">
                            <div>
                                <div class="fw-semibold">{{ $member->name }}</div>
                                <small class="text-muted">{{ $member->slug }}</small>
                            </div>
                        </div>
                    </td>

                    <td>{{ $member->graduation_year }}</td>

                    <td>
                        <span class="badge bg-info text-dark">
                            {{ $member->join_year }}
                        </span>
                    </td>

                    <td>
                        <span class="text-secondary small">
                            {{ $member->projects->pluck('title')->join(', ') }}
                        </span>
                    </td>

                    <td>
                        <span class="text-muted small">{{ $member->awards }}</span>
                    </td>

                    <td>
                        <span class="badge bg-secondary">
                            {{ $member->projects->pluck('pivot.role')->join(', ') }}
                        </span>
                    </td>

        
                    <td class="text-center">
                        {{-- @dd($member) --}}
                        <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.members.show', ['member'=>$member->slug])}}" 
                            class="btn btn-sm btn-outline-primary me-1 action-btn">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        
                        <a href="{{ route('admin.members.edit', ['member'=>$member->slug]) }}" 
                        class="btn btn-sm btn-outline-warning me-1 action-btn">
                        <i class="fa-solid fa-pen"></i>
                        </a>

                        <button type="button" 
                            class="btn btn-sm btn-outline-danger delete-btn action-btn"
                            data-slug="{{ $member->slug }}"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteMemberModal">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        </div>
                    </td>
                </tr>

                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                            <i class="bi bi-inboxes fs-2"></i>
                            <div class="mt-2">Không có thành viên nào</div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mt-3">
        {{ $members->links('vendor.pagination.bootstrap-5') }}
    </div>
</div>

<div class="modal fade" id="deleteMemberModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            
            <div class="modal-header bg-danger text-white border-0">
                <h5 class="modal-title">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    Xác nhận xoá
                </h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p class="fw-semibold">Bạn có chắc chắn muốn xoá thành viên này?</p>
                <p class="text-muted small mb-0">* Hành động này không thể hoàn tác.</p>
            </div>

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                    Huỷ
                </button>

                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Xoá ngay
                    </button>
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
            const id = this.dataset.slug;
            deleteForm.action = `/admin/members/${id}`;
        });
    });
});
</script>
@endsection
