@extends('admin.layouts.home')

@section('header')
<div class="d-flex justify-content-between align-items-center mb-4 mt-5">
    <div>
        <h3 class="fw-bold text-uppercase text-body-secondary mb-1">
                Thêm thông tin liên hệ</h3>
        <p class="text-muted small mb-0">Nhập địa chỉ – email – số điện thoại – bản đồ</p>
    </div>
</div>
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-secondary bg-opacity-10 text-body-secondary fw-bold py-3">
                    Nhập thông tin liên hệ
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('admin.contact_info.store') }}" 
                        method="POST"
                        enctype="multipart/form-data">

                        @csrf

                    
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Địa chỉ <span class="text-danger">*</span></label>
                            <input type="text" 
                                name="address"
                                value="{{ old('address') }}"
                                class="form-control form-control-lg rounded-3 shadow-sm @error('address') is-invalid @enderror">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" 
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control rounded-3 shadow-sm @error('email') is-invalid @enderror">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Số điện thoại</label>
                            <input type="tel" 
                                name="phone"
                                value="{{ old('phone') }}"
                                class="form-control rounded-3 shadow-sm @error('phone') is-invalid @enderror">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ảnh bản đồ</label>
                            <input type="file" 
                                name="map_image"
                                id="mapInput"
                                class="form-control rounded-3 shadow-sm">

                        
                            <div class="mt-3 d-none" id="previewWrapper">
                                <p class="fw-semibold mb-2">Xem trước ảnh:</p>
                                <div class="border rounded-4 shadow-sm overflow-hidden" style="height: 200px;">
                                    <img id="previewImage" 
                                        class="w-100 h-100"
                                        style="object-fit: cover;">
                                </div>
                            </div>
                        </div>

                        <button type="submit" 
                            class="btn bg-info bg-gradient text-white py-2 fw-bold mt-2 rounded-3 shadow-sm">
                            <i class="fa-solid fa-floppy-disk"></i> Lưu thông tin
                        </button>
                        <a href="{{ route('admin.contact_info.index') }}" class="btn btn-secondary shadow-sm px-3 mt-2">
                            <i class="fa-solid fa-arrow-left me-1"></i> Quay lại
                        </a>

                    </form>
                    

                </div>
            
            </div>

        </div>
    </div>
</div>
@endsection
