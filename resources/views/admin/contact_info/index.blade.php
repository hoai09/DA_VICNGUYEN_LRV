@extends('admin.layouts.home')


@section('content')
<div class="container-fluid px-0 py-3">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">
            <i class="bi bi-people-fill me-2"></i>Thông tin liên hệ
        </h3>

        <a href="{{ route('admin.contact_info.create') }}" 
            class="btn btn-add shadow-sm px-4">
            <i class="fa-solid fa-plus me-1 "></i>Thêm mới
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm d-flex align-items-center" role="alert">
            <i class="fa-solid fa-circle-check me-2 fs-5"></i>
            <span class="fw-semibold">{{ session('success') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
        </div>
    @endif

    
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden ms-3">

        <div class="card-header bg-secondary bg-opacity-10 text-body-secondary fw-bold py-3 d-flex align-items-center">
            <i class="fa-solid fa-address-card me-2"></i>
            Danh sách thông tin liên hệ
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="py-3">ID</th>
                            <th>Địa chỉ</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Ảnh bản đồ</th>
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($contactInfos as $info)
                        <tr class="table-row-hover">
                            <td class="fw-bold">{{ $info->id }}</td>
                            <td class="fw-semibold">{{ $info->address }}</td>
                            <td>{{ $info->email ?? '-' }}</td>
                            <td>{{ $info->phone ?? '-' }}</td>

                            <td>
                                @if($info->map_image)
                                    <img src="{{ asset('storage/' . $info->map_image) }}"
                                        class="rounded shadow-sm border"
                                        style="width: 130px; height: 75px; object-fit: cover;">
                                @else
                                    <span class="text-muted fst-italic">Không có</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('admin.contact_info.show', $info->slug) }}" 
                                    class="btn btn-sm btn-outline-primary">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.contact_info.edit', $info->slug) }}" 
                                    class="btn btn-sm btn-outline-warning">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>

                                    <button class="btn btn-sm btn-outline-danger delete-btn"
                                            data-slug="{{ $info->slug }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteContactInfoModal">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>

                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted fst-italic">
                                Không có dữ liệu
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

        <div class="card-footer bg-white py-3 d-flex justify-content-end">
            {{ $contactInfos->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

{{-- Modal xoá --}}
<div class="modal fade" id="deleteContactInfoModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">

            <div class="modal-header bg-danger text-white border-0 rounded-top-4">
                <h5 class="modal-title fw-bold">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i> Xác nhận xóa
                </h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center py-4">
                <p class="fs-5 fw-semibold">Bạn có chắc chắn muốn xóa mục này?</p>
                <p class="text-muted">Hành động này không thể hoàn tác.</p>
            </div>

            <div class="modal-footer border-0 d-flex justify-content-between px-4 pb-3">
                <button class="btn btn-secondary px-4" data-bs-dismiss="modal">
                    Hủy
                </button>

                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-4 fw-bold">
                        Xóa ngay
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection
