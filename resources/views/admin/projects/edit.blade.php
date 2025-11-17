@extends('admin.layouts.app')

@section('header')
<h3>Danh sách ảnh dự án</h3>
@endsection

@section('content')
<div class="container mt-4">
    <h2>Chỉnh sửa dự án: {{ $project->title }}</h2>

    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Tiêu đề (*)</label>
            <input type="text" name="title" value="{{ $project->title }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Thể loại</label>
            <input type="text" name="category" value="{{ $project->category }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Địa chỉ</label>
            <input type="text" name="address" value="{{ $project->address }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Diện tích (㎡)</label>
            <input type="text" name="acreage" value="{{ $project->acreage }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="description" class="form-control" rows="4">{{ $project->description }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="Đang triển khai" {{ $project->status == 'Đang triển khai' ? 'selected' : '' }}>Đang triển khai</option>
                    <option value="Hoàn thành" {{ $project->status == 'Hoàn thành' ? 'selected' : '' }}>Hoàn thành</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>Năm bắt đầu</label>
                <input type="number" name="start_year" value="{{ $project->start_year }}" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Năm kết thúc</label>
                <input type="number" name="end_year" value="{{ $project->end_year }}" class="form-control">
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <label>Thành viên dự án</label>
    
        @foreach($members as $member)
    <div class="mb-2">
        <input type="checkbox" name="members[]" value="{{ $member->id }}"
            {{ isset($project) && $project->members->contains($member->id) ? 'checked' : '' }}>
        {{ $member->name }}
        <input type="text" name="roles[{{ $member->id }}]" placeholder="Vai trò"
            value="{{ isset($project) ? $project->members->find($member->id)->pivot->role ?? '' : '' }}">
    </div>
@endforeach
    <
</div>
        <button class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
<script>
    $(document).ready(function() {
        $('#members').select2({
            placeholder: "Chọn thành viên dự án",
            allowClear: true
        });
    });
    </script>
    