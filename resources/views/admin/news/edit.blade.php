@extends('admin.layouts.app')

@section('header')
<h3>Chỉnh sửa tin tức</h3>
@endsection

@section('content')
<div class="container py-4">
    <h3>Chỉnh sửa tin tức: {{ $news->title }}</h3>

    <form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Danh mục</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ $news->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Ảnh đại diện</label><br>
            @if($news->feature_image)
                <img src="{{ asset('storage/'.$news->feature_image) }}" width="120" class="mb-2"><br>
            @endif
            <input type="file" name="feature_image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tóm tắt</label>
            <textarea name="summary" class="form-control">{{ old('summary', $news->summary) }}</textarea>
        </div>

        <div class="mb-3">
            <label>Nội dung</label>
            <textarea id="editor" name="content" rows="6" class="form-control">
                {{ old('content', $news->content) }}
            </textarea>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_published" class="form-check-input" {{ $news->is_published ? 'checked' : '' }}>
            <label class="form-check-label">Đăng</label>
        </div>

        <button class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>

    {{-- CKEDITOR --}}
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
@endsection
