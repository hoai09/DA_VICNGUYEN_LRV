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

                    
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Danh mục</label>
                            <div class="input-group">
                                <select id="categorySelect" name="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="">-- Chọn danh mục --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#categoryModal">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                            @error('category_id') 
                            <div class="invalid-feedback">{{ $message }}</div> 
                            @enderror
                        </div>

                
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tiêu đề</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                placeholder="Nhập tiêu đề tin tức" value="{{ old('title') }}" required>
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                    
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Ảnh tin tức</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image') 
                            <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <div id="imagePreviewContainer"></div>
                        </div>

                    
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tóm tắt</label>
                            <textarea name="description" rows="3" class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Tóm tắt ngắn gọn về tin tức">{{ old('description') }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                    
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nội dung chi tiết</label>
                            <textarea id="editor" name="content" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                            @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                    
                        <div class="mb-3 d-flex gap-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold">Nổi bật</label>
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

<div class="modal fade" id="categoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title">Quản lý loại tin</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            
            <div class="modal-body">
                
                <label class="fw-semibold">Thêm loại tin</label>
                <div class="input-group mb-3">
                    <input id="newCategoryName" type="text" class="form-control" placeholder="Nhập tên loại tin tức">
                    <button id="saveCategoryBtn" class="btn btn-info">Lưu</button>
                </div>
                
                <hr>

                <h6 class="fw-bold">Danh sách loại tin</h6>
                <ul id="categoryList" class="list-group">
                    @foreach($categories as $cat)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $cat->name }}
                            <button class="btn btn-sm btn-danger deleteCatBtn" data-id="{{ $cat->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </li>
                    @endforeach
                </ul>
                
            </div>
            
        </div>
    </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('assets/admin/js/news.js') }}"></script>

@endsection