@extends('admin.layouts.home')

@section('header')
<h3>Chỉnh sửa loại tin tức</h3>
@endsection

@section('content')
<div class="container mt-4 news-category-edit">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4">
                    <h5 class="mb-0">Thông tin loại tin</h5>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('admin.news_categories.update', $category->slug) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tên loại tin</label>
                            <input type="text" 
                                name="name" 
                                value="{{ old('name', $category->name) }}"
                                class="form-control @error('name') is-invalid @enderror" 
                                placeholder="Nhập tên loại tin" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Mô tả</label>
                            <textarea name="description" 
                                class="form-control @error('description') is-invalid @enderror" 
                                rows="3" placeholder="Nhập mô tả">{{ old('description', $category->description) }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Danh mục cha -->
                        {{-- <div class="mb-3">
                            <label class="form-label fw-semibold">Danh mục cha</label>
                            <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                                <option value="">-- Không có --</option>
                                @foreach($categories as $parent)
                                    <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div> --}}

                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ảnh hiện tại</label>
                            @if($category->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="Ảnh hiện tại" class="img-thumbnail" width="150">
                                </div>
                            @endif
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Thứ tự</label>
                            <input type="number" name="order" value="{{ old('order', $category->order) }}" class="form-control @error('order') is-invalid @enderror">
                            @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Trạng thái</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Hiển thị</option>
                                <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Ẩn</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        
                        <h6 class="mt-4 fw-bold text-secondary">SEO</h6>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Meta Title</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title', $category->meta_title) }}" class="form-control @error('meta_title') is-invalid @enderror">
                            @error('meta_title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Meta Description</label>
                            <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" rows="2">{{ old('meta_description', $category->meta_description) }}</textarea>
                            @error('meta_description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Meta Keywords</label>
                            <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $category->meta_keywords) }}" class="form-control @error('meta_keywords') is-invalid @enderror">
                            @error('meta_keywords') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
