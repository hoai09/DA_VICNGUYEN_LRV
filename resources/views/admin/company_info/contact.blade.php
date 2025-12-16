{{-- @extends('admin.layouts.home')           

@section('title', 'Cập nhật thông tin liên hệ')

@section('content') --}}

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ config('apps.headtitle.title4') }}</h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="active"><strong>{{ config('apps.headtitle.title4') }}</strong></li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <h3 class="ibox-title">
                    <i class="bi bi-geo-alt-fill me-2"></i> Quản lý Thông tin Liên hệ
                </h3>
            
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
                <div class="ibox-content">
                    <form action="{{ route('admin.company_info.contact') }}" method="POST" enctype="multipart/form-data">
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
                    </form>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary mt-4">
                            <i class="bi bi-save2 me-1"></i> Lưu thay đổi
                        </button>
                </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}
