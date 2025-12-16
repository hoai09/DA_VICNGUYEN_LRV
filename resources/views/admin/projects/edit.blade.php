{{-- @extends('admin.layouts.home')

@section('header')
<h3 class="fw-bold">Chỉnh sửa dự án: {{ $project->title }}</h3>
@endsection

@section('content') --}}

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ config('apps.project.title2') }}</h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li>{{ config('apps.project.title') }}</li>
            <li class="active"><strong>{{ config('apps.project.title2') }}</strong></li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h3 class="fw-bold">Sửa dự án</h3>
                </div>
                <div class="ibox-content">
        
                    <form action="{{ route('admin.projects.update', $project->slug) }}" method="POST">
                        @csrf
                        @method('PUT')
        
                        {{-- Title --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Tiêu đề dự án <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control form-control-lg"
                                value="{{ $project->title }}" required>
        
                            <small class="text-muted d-block mt-1">Slug tự tạo dựa trên tiêu đề</small>
                            <input type="text" name="slug" id="slug" class="form-control mt-1" value="{{ $project->slug }}">
                        </div>
        
                        {{-- Category --}}
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Thể loại</label>
        
                                <div class="input-group">
                                    <select name="category_id" id="categorySelect" class="form-select">
                                        <option value="">-- Chọn thể loại --</option>
        
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" 
                                                {{ $project->category_id == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
        
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Địa chỉ</label>
                                <input type="text" name="address" class="form-control" value="{{ $project->address }}">
                            </div>
        
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Diện tích (㎡)</label>
                                <input type="text" name="acreage" class="form-control" value="{{ $project->acreage }}">
                            </div>
                        </div>
        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Mô tả</label>
                            <textarea name="description" class="form-control" rows="4">{{ $project->description }}</textarea>
                        </div>
        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Trạng thái</label>
                                <div class="input-group">
                                    <select name="status" class="form-select">
                                        <option value="Đang triển khai" {{ $project->status=='Đang triển khai' ? 'selected' : '' }}>Đang triển khai</option>
                                        <option value="Hoàn thành" {{ $project->status=='Hoàn thành' ? 'selected' : '' }}>Hoàn thành</option>
                                        <option value="Tạm dừng" {{ $project->status=='Tạm dừng' ? 'selected' : '' }}>Tạm dừng</option>
                                    </select>
                                </div>
                            </div>
        
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Năm bắt đầu</label>
                                <input type="number" name="start_year" class="form-control" value="{{ $project->start_year }}">
                            </div>
        
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Năm kết thúc</label>
                                <input type="number" name="end_year" class="form-control" value="{{ $project->end_year }}">
                            </div>
                        </div>
        
                        <div class="mt-4 mb-3">
                            <label class="form-label fw-semibold fs-5">Thành viên dự án</label>
        
                            <div class="member-list">
                                @foreach($members as $member)
                                <div class="member-item d-flex align-items-center p-2 rounded mb-2 shadow-sm bg-white border">
                                    <input class="form-check-input me-3 member-checkbox" type="checkbox" 
                                        name="members[]" value="{{ $member->id }}"
                                        {{ $project->members->contains($member->id) ? 'checked' : '' }}>
        
                                    <div class="flex-grow-1">
                                        <strong>{{ $member->name }}</strong>
                                    </div>
        
                                    <input type="text"
                                        name="roles[{{ $member->id }}]"
                                        placeholder="Vai trò"
                                        class="form-control ms-3 role-input"
                                        style="max-width: 200px; display: {{ $project->members->contains($member->id) ? 'block' : 'none' }};"
                                        value="{{ $project->members->find($member->id)?->pivot->role ?? '' }}">
                                </div>
                                @endforeach
                            </div>
                        </div>
        
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-arrow-left"></i> Quay lại
                            </a>
        
                            <button class="btn btn-outline-info px-4">
                                <i class="bi bi-save me-1"></i> Cập nhật
                            </button>
                        </div>
        
                    </form>
        
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}
@push('scripts')
<script src="{{ asset('assets/admin/js/projects.js') }}"></script>
@endpush