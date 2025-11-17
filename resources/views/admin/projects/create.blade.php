@extends('admin.layouts.app')

@section('header')
<h3>Danh sách ảnh dự án</h3>
@endsection

@section('content')
<div class="container mt-4">
    <h2>Thêm dự án mới</h2>

    <form action="{{ route('admin.projects.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Tiêu đề (*)</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Thể loại</label>
            <input type="text" name="category" class="form-control">
        </div>

        <div class="mb-3">
            <label>Địa chỉ</label>
            <input type="text" name="address" class="form-control">
        </div>

        <div class="mb-3">
            <label>Diện tích (㎡)</label>
            <input type="text" name="acreage" class="form-control">
        </div>

        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="">-- Chọn trạng thái --</option>
                    <option value="Đang triển khai">Đang triển khai</option>
                    <option value="Hoàn thành">Hoàn thành</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label>Năm bắt đầu</label>
                <input type="number" name="start_year" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Năm kết thúc</label>
                <input type="number" name="end_year" class="form-control">
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
    
</div>
        <button class="btn btn-success">Lưu</button>
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
    