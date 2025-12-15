{{-- @extends('admin.layouts.home')   

@section('header')
<h3 class="text-primary">Thêm ảnh dự án</h3>
@endsection

@section('content') --}}

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ config('apps.project.title_image1') }}</h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li>{{ config('apps.project.title_image') }}</li>
            <li class="active"><strong>{{ config('apps.project.title_image1') }}</strong></li>
        </ol>
    </div>
</div>

<div class="row">

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Có lỗi xảy ra!</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h3 class="fw-bold">Thêm ảnh dự án</h3>
            </div>
            <div class="ibox-content">
                <form action="{{ route('admin.project_images.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Chọn dự án</label>
                        <select name="project_id" class="form-select" required>
                            <option value="">-- Chọn dự án --</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->title }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Chọn ảnh (nhiều ảnh)</label>
                        <input type="file" name="images[]" class="form-control" multiple accept="image/*" id="imageInput" required>
                        <small class="text-muted">Bạn có thể chọn nhiều ảnh cùng lúc.</small>
                    </div>
    
            
                    <div class="mb-4" id="previewContainer" style="display:none;">
                        <label class="form-label fw-bold">Xem trước ảnh</label>
                        <div class="row" id="previewRow"></div>
                    </div>
    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-info mt-3">Tải lên</button>
                        <a href="{{ route('admin.project_images.index') }}" class="btn btn-outline-secondary mt-3">Quay lại</a>
                    </div>
                </form>
            </div>
        </div>
    </div class="col-lg-12">

</div>

{{-- @endsection --}}

@section('scripts')
<script src="{{ asset('assets/admin/js/projectImg/create-img.js') }}"></script>
@endsection
