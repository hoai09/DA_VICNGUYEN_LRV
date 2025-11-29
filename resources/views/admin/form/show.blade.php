@extends('admin.layouts.home')   

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/admin/css/form.css') }}">
@endpush

@section('header')
<h3 class="fw-bold ms-2 mt-5">Chi tiết thông tin dự án khách hàng</h3>
@endsection

@section('content')
<div class="container mt-4">

    <div class="card shadow-sm border-0 p-4 form-detail-card">
        
        <h4>{{ $information->full_name }}</h4>

        <p><strong>Email:</strong> {{ $information->email }}</p>
        <p><strong>Điện thoại:</strong> {{ $information->phone }}</p>
        <p><strong>Nghề nghiệp:</strong> {{ $information->job }}</p>
        <p><strong>Tuổi:</strong> {{ $information->age }}</p>

        <p><strong>Loại dự án:</strong> {{ $information->type }}</p>
        <p><strong>Diện tích:</strong> {{ $information->acreage }}</p>
        <p><strong>Quy mô:</strong> {{ $information->scale }}</p>
        <p><strong>Địa điểm:</strong> {{ $information->address }}</p>

        <p><strong>Mô tả chức năng:</strong> {!! nl2br(e($information->function_description)) !!}</p>
        <p><strong>Sở thích/Thói quen:</strong> {!! nl2br(e($information->hobby_habit)) !!}</p>
        <p><strong>Lý do biết VIC:</strong> {!! nl2br(e($information->why_do_you_know)) !!}</p>

    </div>
    <a href="{{ route('admin.form.index') }}" class="btn btn-outline-secondary mt-3">
        <i class="fa-solid fa-arrow-left"></i> Quay lại
    </a>

</div>
@endsection


