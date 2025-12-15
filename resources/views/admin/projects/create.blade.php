{{-- @extends('admin.layouts.home') --}}

{{-- @section('header') --}}
{{-- @endsection

@section('content') --}}

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ config('apps.project.title1') }}</h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li>{{ config('apps.project.title') }}</li>
            <li class="active"><strong>{{ config('apps.project.title1') }}</strong></li>
        </ol>
    </div>
</div>


<div class="wrapper wrapper-content animated fadeInRight">
    
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
        
                <div class="ibox-title">
                    <h3 class="fw-bold">Thêm dự án mới</h3>
                </div>
                    <div class="ibox-content">
        
                    <form action="{{ route('admin.projects.store') }}" method="POST">
                        @csrf
        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Tiêu đề dự án <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control form-control-lg" required>
        
                            <small class="text-muted d-block mt-1">Slug tự tạo dựa trên tiêu đề</small>
                            <input type="text" name="slug" id="slug" class="form-control mt-1">
                        </div>
        
                    
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Thể loại</label>
                                    <div class="input-group">
                                        <select name="category_id" id="categorySelect" class="form-select">
                                            <option value="">-- Chọn loại dự án --</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
        
                                        <button type="button" class="btn btn-outline-primary" 
                                            data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>
                                    </div>
                                    
                            </div>
        
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Địa chỉ</label>
                                <input type="text" name="address" class="form-control">
                            </div>
        
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Diện tích (㎡)</label>
                                <input type="text" name="acreage" class="form-control">
                            </div>
                        </div>
        
                    
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Mô tả</label>
                            <textarea name="description" class="form-control" rows="4"></textarea>
                        </div>
        
                        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Trạng thái</label>

                                <div class="input-group">
                                    <select name="status" class="form-select">
                                        <option value="">-- Chọn trạng thái --</option>
                                        <option value="Đang triển khai">Đang triển khai</option>
                                        <option value="Hoàn thành">Hoàn thành</option>
                                        <option value="Hoàn thành">Tạm dừng</option>
                                    </select>
                                </div>
                            </div>
        
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Năm bắt đầu</label>
                                <input type="number" name="start_year" class="form-control">
                            </div>
        
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-semibold">Năm kết thúc</label>
                                <input type="number" name="end_year" class="form-control">
                            </div>
                        </div>
        
                        
                        <div class="mt-4 mb-3">
                            <label class="form-label fw-semibold fs-5">Thành viên dự án</label>
        
                            <div class="member-list">
                                @foreach($members as $member)
                                <div class="member-item d-flex align-items-center p-2 rounded mb-2 shadow-sm bg-white border">
        
                                    <input class="form-check-input me-3" type="checkbox" 
                                        name="members[]" value="{{ $member->id }}">
        
                                    <div class="flex-grow-1">
                                        <strong>{{ $member->name }}</strong>
                                        <div class="small text-muted">Nhập vai trò nếu chọn</div>
                                    </div>
        
                                    <input type="text"
                                        name="roles[{{ $member->id }}]"
                                        placeholder="Vai trò"
                                        class="form-control ms-3"
                                        style="max-width: 200px;">
                                </div>
                                @endforeach
                            </div>
                        </div>
        
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary px-4">
                                <i class="bi bi-arrow-left"></i> Quay lại
                            </a>
        
                            <button class="btn btn-outline-info px-4">
                                <i class="fa-solid fa-floppy-disk me-2"></i> Lưu dự án
                            </button>
                        </div>
        
                    </form>
        
                    </div>
            </div>
        </div>
    </div>

</div>

{{-- =========================== --}}

<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm loại dựa án </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Tên loại dự án</label>
                    <input type="text" id="newCategoryName" class="form-control">
                </div>

                <button class="btn btn-primary w-100" id="saveCategoryBtn">
                    <i class="fa fa-save me-1"></i> Lưu
                </button>
            </div>
            <hr>
                <h6 class="fw-bold">Danh mục hiện có</h6>
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

{{-- 
@endsection --}}

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    const CATEGORYPRJ_STORE_URL = "{{ route('admin.categories_project.store.ajax') }}";
    const CATEGORYPRJ_DELETE_URL = "{{ url('admin/categories_project/delete') }}/";
    const CSRF = "{{ csrf_token() }}";
</script>
<script src="{{ asset('assets/admin/js/projects.js') }}"></script>
@endsection
