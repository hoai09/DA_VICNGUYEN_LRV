@extends('admin.layouts.home')

@section('header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-uppercase text-primary mb-0">Chi tiết thông tin liên hệ</h3>

    <a href="{{ route('admin.contact_info.index') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left me-1"></i> Quay lại danh sách
    </a>
</div>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    Thông tin liên hệ
                </div>

                <div class="card-body">
                    <p class="mb-2"><strong>Địa chỉ:</strong> {{ $contactInfo->address }}</p>
                    <p class="mb-2"><strong>Email:</strong> {{ $contactInfo->email ?? '-' }}</p>
                    <p class="mb-2"><strong>Số điện thoại:</strong> {{ $contactInfo->phone ?? '-' }}</p>

                    <div class="mb-3">
                        <strong>Ảnh bản đồ:</strong>
                        @if($contactInfo->map_image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $contactInfo->map_image) }}"
                                    class="img-fluid rounded shadow-sm"
                                    style="max-height: 250px; object-fit: cover; width: 100%;">
                            </div>
                        @else
                            <span class="text-muted">Chưa có ảnh bản đồ</span>
                        @endif
                    </div>
                </div>

                <div class="card-footer bg-light d-flex justify-content-end">
                    <a href="{{ route('admin.contact_info.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left me-1"></i> Quay lại
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
