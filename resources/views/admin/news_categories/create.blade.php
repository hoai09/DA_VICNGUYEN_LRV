@extends('admin.layouts.home')

@section('header')
<h3 class="mb-4">Thêm Loại Tin Tức</h3>
@endsection

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <div class="card shadow-sm rounded-4">
                <div class="card-body">

                    <form method="POST" action="{{ route('admin.news_categories.store') }}" enctype="multipart/form-data">
                        @csrf

                    
                        <div class="mb-3">
                            <label class="form-label">Tên loại tin</label>
                            <input type="text" 
                                name="name" 
                                value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" 
                                required
                                placeholder="Nhập tên loại tin">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea name="description" 
                                    class="form-control @error('description') is-invalid @enderror"
                                    rows="3"
                                    placeholder="Mô tả ngắn về loại tin">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Danh mục cha
                        <div class="mb-3">
                            <label class="form-label">Danh mục cha</label>
                            <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                                <option value="">-- Không có --</option>
                                @foreach($categories as $parent)
                                    <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        {{-- Ảnh --}}
                        <div class="mb-3">
                            <label class="form-label">Ảnh</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Thứ tự --}}
                        <div class="mb-3">
                            <label class="form-label">Thứ tự</label>
                            <input type="number" name="order" value="{{ old('order', 0) }}" class="form-control @error('order') is-invalid @enderror" min="0">
                            <small class="text-muted">Số càng nhỏ sẽ hiển thị lên đầu</small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Trạng thái --}}
                        <div class="mb-3">
                            <label class="form-label">Trạng thái</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title') }}" class="form-control" placeholder="Tiêu đề SEO">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="2" placeholder="Mô tả SEO">{{ old('meta_description') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Keywords</label>
                            <input type="text" name="meta_keywords" value="{{ old('meta_keywords') }}" class="form-control" placeholder="Từ khóa SEO, cách nhau bởi dấu phẩy">
                        </div>

                        
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success btn-gradient">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Lưu
                            </button>
                            <a href="{{ route('admin.news_categories.index') }}" class="btn btn-secondary">
                                <i class="fa-solid fa-arrow-left me-1"></i> Quay lại
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
