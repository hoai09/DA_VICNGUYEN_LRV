@extends('admin.layouts.home')

@section('header')
<h3 class="mb-4">Thêm tin tức</h3>
@endsection

@section('content')
<div class="container mt-4">

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">

                    <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
                        @csrf

                    
                        {{-- <div class="mb-3">
                            <label class="form-label fw-semibold">Danh mục</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div> --}}

                
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tiêu đề</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                placeholder="Nhập tiêu đề tin tức" value="{{ old('title') }}" required>
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                    
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ảnh tin tức</label>
                            <input type="file" name="feature_image" class="form-control @error('feature_image') is-invalid @enderror">
                            @error('feature_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                    
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tóm tắt</label>
                            <textarea name="summary" rows="3" class="form-control @error('summary') is-invalid @enderror"
                                    placeholder="Tóm tắt ngắn gọn về tin tức">{{ old('summary') }}</textarea>
                            @error('summary') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                    
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nội dung chi tiết</label>
                            <textarea id="editor" name="content" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                            @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                    
                        <div class="mb-3 d-flex gap-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="featured_news" value="1" {{ old('featured_news') ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold">Tin nổi bật</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="latest_news" value="1" {{ old('latest_news') ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold">Tin mới</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold">Đăng ngay</label>
                            </div>
                        </div>

                    
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Meta Title (SEO)</label>
                            <input type="text" name="meta_title" class="form-control" placeholder="Meta title SEO" value="{{ old('meta_title') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Meta Description (SEO)</label>
                            <textarea name="meta_description" rows="2" class="form-control" placeholder="Meta description SEO">{{ old('meta_description') }}</textarea>
                        </div>

                    
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-outline-info mt-3">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Lưu
                            </button>
                            <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary mt-3">
                                <i class="fa-solid fa-arrow-left me-1"></i> Quay lại
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
ClassicEditor.create(document.querySelector('#editor'), {
    ckfinder: {
        uploadUrl: "{{ route('admin.ckeditor.upload') }}?_token={{ csrf_token() }}"
    }
}).catch(error => console.error(error));
</script>

@endsection
