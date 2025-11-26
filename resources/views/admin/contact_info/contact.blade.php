@extends('admin.layouts.home')           //quản lí trang address

@section('title', 'Cập nhật thông tin liên hệ')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">
            <i class="bi bi-geo-alt-fill me-2"></i> Quản lý Thông tin Liên hệ
        </h3>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Có lỗi xảy ra!</strong>
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('admin.contact_info.contact') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Địa chỉ</label>
                    <input type="text" name="address"
                        class="form-control @error('address') is-invalid @enderror"
                        placeholder="Nhập địa chỉ..."
                        value="{{ old('address', $contact->address) }}">

                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="example@gmail.com"
                        value="{{ old('email', $contact->email) }}">

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Số điện thoại</label>
                    <input type="text" name="phone"
                        class="form-control @error('phone') is-invalid @enderror"
                        placeholder="09xx xxx xxx"
                        value="{{ old('phone', $contact->phone) }}">

                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label class="form-label fw-bold">Hình bản đồ</label>
                    <input type="file" name="map_image"
                        class="form-control @error('map_image') is-invalid @enderror"
                        accept="image/*">
                    
                    @error('map_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if($contact->map_image)
                        <div class="mt-3">
                            <img src="{{ asset('storage/' . $contact->map_image) }}" 
                                class="img-fluid border rounded shadow-sm"
                                style="max-height: 200px;">
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-outline-info mt-3">
                    <i class="bi bi-save2 me-1"></i> Lưu thay đổi
                </button>

            </form>
        </div>
    </div>
</div>
@endsection
