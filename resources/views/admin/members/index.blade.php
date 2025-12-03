@extends('admin.layouts.home')   
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
                <table class="table table-hover align-middle mb-0 member-table">
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
                            <img src="{{ $member->image ? asset('storage/' . $member->image) : asset('assets/img/Thanhvien/default.png') }}"
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
                            {{ $member->main_role }}
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

                        <form action="{{ route('admin.members.destroy', $member->slug) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm action-btn btn-delete">
                                <i class="fa-solid fa-trash "></i>
                            </button>
                        </form>
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

@endsection



