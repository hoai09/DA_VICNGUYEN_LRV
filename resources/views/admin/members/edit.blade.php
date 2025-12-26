
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ config('apps.member.title2') }}</h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li>{{ config('apps.member.title') }}</li>
            <li class="active"><strong>{{ config('apps.member.title2') }}</strong></li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-md-12 mx-auto">

            <div class="card shadow-sm rounded-lg border-0">
                <div class="card-header bg-white border-bottom-0">
                    <h5 class="mb-0 font-weight-bold">Cập nhật thành viên: <span class="text-primary">{{ $member->name }}</span></h5>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.members.update', $member->slug) }}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Tên thành viên <span class="text-danger">*</span></label>
                            <input type="text"
                                name="name"
                                id="name"
                                value="{{ old('name', $member->name) }}"
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Nhập tên thành viên"
                                required>
                            @error('name')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="imageInput" class="form-label fw-semibold">Ảnh đại diện</label>
                            <input type="file"
                                name="image"
                                class="form-control"
                                id="imageInput"
                                accept="image/*">

                            <div class="mt-2">
                                @if($member->image)
                                    <img id="previewImg"
                                        src="{{ asset('storage/' . $member->image) }}"
                                        class="img-thumbnail"
                                        style="max-width:120px; border-radius:8px;">
                                @else
                                    <img id="previewImg"
                                        class="img-thumbnail d-none"
                                        style="max-width:120px; border-radius:8px;">
                                @endif
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="main_role" class="form-label fw-semibold">Chức vụ</label>
                            <input type="text"
                                name="main_role"
                                id="main_role"
                                value="{{ old('main_role', $member->main_role) }}"
                                class="form-control"
                                placeholder="Nhập chức vụ">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="graduation_year" class="form-label fw-semibold">Năm tốt nghiệp</label>
                                <input type="number"
                                    name="graduation_year"
                                    id="graduation_year"
                                    value="{{ old('graduation_year', $member->graduation_year) }}"
                                    class="form-control"
                                    min="1900" max="{{ date('Y') + 10 }}"
                                    placeholder="VD: 2024">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="join_year" class="form-label fw-semibold">Trở thành Vicer từ năm</label>
                                <input type="number"
                                    name="join_year"
                                    id="join_year"
                                    value="{{ old('join_year', $member->join_year) }}"
                                    class="form-control"
                                    min="1900" max="{{ date('Y') + 10 }}"
                                    placeholder="VD: 2021">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="awards" class="form-label fw-semibold">Giải thưởng</label>
                            <input type="text"
                                name="awards"
                                id="awards"
                                value="{{ old('awards', $member->awards) }}"
                                class="form-control"
                                placeholder="Nhập giải thưởng (nếu có)">
                        </div>

                        <div class="mb-4">
                            <label for="site" class="form-label fw-semibold">Site hiển thị <span class="text-danger">*</span></label>
                            <select name="site" class="form-select" id="site" required>
                                <option value="">---Chọn---</option>
                                <option value="design" {{ $member->site == 'design' ? 'selected' : '' }}>
                                    VicNguyen_Design
                                </option>
                                <option value="VicNguyen" {{ $member->site == 'VicNguyen' ? 'selected' : '' }}>
                                    VicNguyen
                                </option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-4">
                            <a href="{{ route('admin.members.index') }}"
                               class="btn btn-white">
                                <i class="fa fa-arrow-left me-1"></i> Quay lại
                            </a>

                            <button type="submit"
                                    class="btn btn-primary px-4">
                                <i class="fa fa-save me-1"></i> Cập nhật
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/admin/js/member.js') }}"></script>
@endpush