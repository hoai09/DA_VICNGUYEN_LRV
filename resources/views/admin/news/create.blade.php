{{-- @extends('admin.layouts.home')   

@section('header')
<h3 class="mb-4">Thêm tin tức</h3>
@endsection

@section('content') --}}

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>{{ config('apps.news.title1') }}</h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li>{{ config('apps.news.title') }}</li>
            <li class="active"><strong>{{ config('apps.news.title1') }}</strong></li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h3>Thêm tin tức</h3>
                </div>
                <div class="ibox-content">
                    <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
                        @csrf

                    
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Danh mục</label>
                            <div class="input-group ">
                                <div class="flex-row">
                                    <select id="categorySelect" name="category_id"
                                            class="form-select @error('category_id') is-invalid @enderror" required>
                                        <option value="">-- Chọn danh mục --</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                

                                <div class="ms-2">
                                    <button type="button" class="btn btn-primary"
                                            data-toggle="modal" data-target="#addCategorynewsModal">
                                            <i class="fa fa-plus"></i>
                                            </button>
                                </div>
                            </div>
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

                    
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn btn-primary ">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Lưu
                            </button>
                            <a href="{{ route('admin.news.index') }}" class="btn btn-white ">
                                <i class="fa-solid fa-arrow-left me-1"></i> Quay lại
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addCategorynewsModal" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-centered" role="document"> <div class="modal-content border-0 shadow-lg"> <div class="modal-header bg-light border-bottom-0 pt-4 px-4">
                <h5 class="modal-title font-weight-bold text-dark" style="letter-spacing: -0.5px;">
                    <i class="fa fa-folder-plus mr-2 text-primary"></i>Quản lý loại tin
                </h5>
                <button type="button" class="close outline-none" data-dismiss="modal" aria-label="Close">
                    <span  style="font-size: 1.5rem;">&times;</span>
                </button>
            </div>

            <div class="modal-body px-4 pb-4">
                <div class="form-group mb-4">
                    <label class="small font-weight-bold text-uppercase text-muted mb-2">Tên danh mục</label>
                    <div class="input-group ">
                        <div class="flex-row">
                            <input type="text" 
                                    id="newCategoryName" 
                                    class="form-control form-control-lg bg-light border-0" 
                                    placeholder="vd:technology" 
                                    style="font-size: 1.5rem;">
                        
                        <div class="input-group-append ms-2">
                            <button class="btn btn-primary px-4" id="saveCategoryBtn">
                                <i class="fa fa-save mr-1"></i> Lưu
                            </button>
                        </div>
                    </div>
                    </div>
                </div>
            
                <hr class="my-4">
            
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="font-weight-bold mb-0">Danh mục hiện có</h6>
                    <span class="badge badge-pill badge-secondary">{{ count($categories) }} mục</span>
                </div>

                <div class="custom-scroll" style="max-height: 300px; overflow-y: auto;">
                    <ul id="categoryList" class="list-group list-group-flush">
                        @foreach($categories as $cat)
                            <li class="list-group-item flex px-0 py-3 border-bottom">
                                
                                    <div class=" align-items-center">
                                        <span class="text-dark font-weight-medium">{{ $cat->name }}</span>
                                    </div>
                                    <div class="ge">
                                        <button class="btn btn-sm btn-danger border-0 rounded-circle deleteCatBtn" data-id="{{ $cat->id }}" title="Xóa">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                            
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    const CKEDITOR_UPLOAD_URL = "{{ route('admin.ckeditor.upload') }}?&_token={{ csrf_token() }}";
    const CATEGORY_STORE_URL = "{{ route('admin.categories_news.store.ajax') }}";
    const CATEGORY_DELETE_URL = "{{ url('admin/categories_news/delete') }}/";
    const CSRF = "{{ csrf_token() }}";
</script>
<script src="{{ asset('assets/admin/js/news.js') }}"></script>
@endpush