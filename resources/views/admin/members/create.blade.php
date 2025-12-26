
<div class="container-fluid mt-4">
    <div class="mb-3 border-bottom pb-2 d-flex justify-content-between align-items-end">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-1" style="font-size: 14px;">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">{{ config('apps.member.title') }}</li>
                    <li class="breadcrumb-item active" aria-current="page">{{ config('apps.member.title1') }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card shadow-sm mb-4 rounded-lg" style="max-width:1060px;margin:auto;">
        
       <div class="flex mt-2 mb-2">
            <div class="card-header bg-light border-bottom-0">
                <h5 class="mb-0 fw-bold"><i class="fa fa-user-plus me-2"></i> Thông tin thành viên</h5>
            </div>
            <a href="{{ route('admin.members.index') }}" class="btn btn-success btn-sm px-3 ms-2 ">
                <i class="fa fa-list"></i> Xem danh sách
            </a>
       </div>
        <div class="card-body px-4 py-4">
            <form action="{{ route('admin.members.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="needs-validation"
                  novalidate>
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tên thành viên</label>
                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror"
                               required>
                        @error('name')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Ảnh đại diện</label>
                        <input type="file"
                               name="image"
                               class="form-control"
                               id="imageInput">
                        <img class="img-preview mt-2 rounded d-block"
                             style="display:none; max-width: 90px;">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Chức vụ</label>
                        <input type="text"
                               name="main_role"
                               value="{{ old('main_role') }}"
                               class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Năm tốt nghiệp</label>
                        <input type="number"
                               name="graduation_year"
                               value="{{ old('graduation_year') }}"
                               class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Trở thành Vicer từ năm</label>
                        <input type="number"
                               name="join_year"
                               value="{{ old('join_year') }}"
                               class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Giải thưởng</label>
                        <input type="text"
                               name="awards"
                               value="{{ old('awards') }}"
                               class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Site hiển thị</label>
                        <select name="site" class="form-select" required>
                            <option value="">---Chọn---</option>
                            <option value="design" {{ old('site')=='design' ? 'selected' : '' }}>VicNguyen_Design</option>
                            <option value="VicNguyen" {{ old('site')=='VicNguyen' ? 'selected' : '' }}>VicNguyen</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4 gap-2">
                    <a href="{{ route('admin.members.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left"></i> Quay lại
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Lưu Member
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/admin/js/member.js') }}"></script>
@endpush
