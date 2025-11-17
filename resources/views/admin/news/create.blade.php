@extends('admin.layouts.app')

@section('header')
<h3>Thêm tin tức</h3>
@endsection

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card bg-light text-black mt-4">
                <div class="card-body border border-dark rounded">
                    <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Danh mục</label>
                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tiêu đề</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ảnh tin tức</label>
                            <input type="file" name="feature_image" class="form-control @error('feature_image') is-invalid @enderror">
                            @error('feature_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tóm tắt</label>
                            <textarea name="summary" class="form-control @error('summary') is-invalid @enderror"></textarea>
                            @error('summary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nội dung chi tiết</label>
                            <textarea id="editor" name="content" class="form-control @error('content') is-invalid @enderror"></textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input type="checkbox" name="is_published" class="form-check-input" checked>
                            <label class="form-check-label">Đăng ngày</label>
                        </div>

                        <button type="submit" class="btn btn-success">Lưu</button>
                        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Quay lại</a>
                    </form>
                    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

<script>
ClassicEditor.create(document.querySelector('#editor'), {
    ckfinder: {
        uploadUrl: "{{ route('admin.ckeditor.upload') }}?_token={{ csrf_token() }}"
    }
}).catch(error => {
    console.error(error);
});
</script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
