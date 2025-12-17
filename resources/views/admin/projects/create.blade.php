
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
                                    <div class="input-group flex-row">
                                        <div>
                                            <select name="category_id" id="categorySelect" class="form-select">
                                                <option value="">-- Chọn loại dự án --</option>
                                                @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="ms-2">
                                            <button type="button" class="btn btn-primary"
                                            data-toggle="modal" data-target="#addCategoryModal">
                                            <i class="fa fa-plus"></i>
                                            </button>
                                        </div>

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
                                        <option value="Tạm dừng">Tạm dừng</option>
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
        
                                    <input class="form-check-input me-3 member-checkbox" type="checkbox"
                                    name="members[]" value="{{ $member->id }}">

        
                                    <div class="flex-grow-1">
                                        <strong>{{ $member->name }}</strong>
                                        <div class="small text-muted">Nhập vai trò nếu chọn</div>
                                    </div>
        
                                    <input type="text"
                                    name="roles[{{ $member->id }}]"
                                    placeholder="Vai trò"
                                    class="form-control ms-3 role-input"
                                    style="display:none; max-width: 200px;">
                                </div>
                                @endforeach
                            </div>
                        </div>
        
                        <div class="d-flex justify-content-between mt-2 ">
                            <a href="{{ route('admin.projects.index') }}" class="btn btn-white px-4">
                                <i class="bi bi-arrow-left"></i> Quay lại
                            </a>
        
                            <button class="btn btn-primary px-4">
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

<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-dialog-centered" role="document"> <div class="modal-content border-0 shadow-lg"> <div class="modal-header bg-light border-bottom-0 pt-4 px-4">
                <h5 class="modal-title font-weight-bold text-dark" style="letter-spacing: -0.5px;">
                    <i class="fa fa-folder-plus mr-2 text-primary"></i>Thêm loại dự án
                </h5>
                <button type="button" class="close outline-none" data-dismiss="modal" aria-label="Close">
                    <span  style="font-size: 1.5rem;">&times;</span>
                </button>
            </div>

            <div class="modal-body px-4 pb-4">
                <div class="form-group mb-4">
                    <label class="small font-weight-bold text-uppercase text-muted mb-2">Tên loại dự án</label>
                    <div class="input-group">
                        <input type="text" id="newCategoryName" class="form-control form-control-lg bg-light border-0" placeholder="Ví dụ: Thiết kế nội thất..." style="font-size: 1rem;">
                        <div class="input-group-append mt-2">
                            <button class="btn btn-primary px-4" id="saveCategoryBtn">
                                <i class="fa fa-save mr-1"></i> Lưu
                            </button>
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
                            <li class="list-group-item flex-row justify-content-between align-items-center px-0 py-3 border-bottom">
                                <div class="d-flex align-items-center">
                                    <span class="text-dark font-weight-medium">{{ $cat->name }}</span>
                                </div>
                                <div class="ge">
                                    <button class="btn btn-sm btn-danger border-0 rounded-circle deleteCatBtn " data-id="{{ $cat->id }}" title="Xóa">
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
    const CATEGORYPRJ_STORE_URL = "{{ route('admin.categories_project.store.ajax') }}";
    const CATEGORYPRJ_DELETE_URL = "{{ url('admin/categories_project/delete') }}/";
    const CSRF = "{{ csrf_token() }}";
</script>
<script src="{{ asset('assets/admin/js/projects.js') }}"></script>
@endpush