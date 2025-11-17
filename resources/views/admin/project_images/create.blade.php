@extends('admin.layouts.app')

@section('header')
<h3>Thêm ảnh dự án</h3>
@endsection

@section('content')
<div class="container py-4">

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Có lỗi xảy ra!</strong><br>
            <ul>
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.project-images.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Chọn dự án</label>
            <select name="project_id" class="form-control" required>
                <option value="">-- Chọn dự án --</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Chọn ảnh (nhiều ảnh)</label>
            <input type="file" name="images[]" class="form-control" multiple required>
            <small class="text-muted">Có thể chọn nhiều ảnh.</small>
        </div>

        <button type="submit" class="btn btn-success">Tải lên</button>
        <a href="{{ route('admin.project-images.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>

</div>
@endsection
