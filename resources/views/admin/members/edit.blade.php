
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
        <div class="col-lg-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h5>Cập nhật thành viên: {{ $member->name }}</h5>
                </div>

                <div class="ibox-content">

                    <form action="{{ route('admin.members.update', $member->slug) }}"
                            method="POST"
                            enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>Tên thành viên</label>
                            <input type="text"
                                    name="name"
                                    value="{{ old('name', $member->name) }}"
                                    class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                                <div class="invalid-feedback d-block">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Ảnh đại diện</label>
                            <input type="file"
                                    name="image"
                                    class="form-control"
                                    id="imageInput">

                            @if($member->image)
                                <img id="previewImg"
                                        src="{{ asset('storage/' . $member->image) }}"
                                        class="img-preview"
                                        style="max-width:120px;
                                                border-radius:8px;
                                                margin-top:12px;
                                                border:1px solid #e5e7eb;">
                            @else
                                <img id="previewImg"
                                        class="img-preview d-none">
                            @endif
                        </div>

                
                        <div class="form-group">
                            <label>Chức vụ</label>
                            <input type="text"
                                    name="main_role"
                                    value="{{ old('main_role', $member->main_role) }}"
                                    class="form-control">
                        </div>

                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Năm tốt nghiệp</label>
                                    <input type="number"
                                            name="graduation_year"
                                            value="{{ old('graduation_year', $member->graduation_year) }}"
                                            class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Trở thành Vicer từ năm</label>
                                    <input type="number"
                                            name="join_year"
                                            value="{{ old('join_year', $member->join_year) }}"
                                            class="form-control">
                                </div>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label>Giải thưởng</label>
                            <input type="text"
                                    name="awards"
                                    value="{{ old('awards', $member->awards) }}"
                                    class="form-control">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Site hiển thị</label>
                            <select name="site" class="form-select" required>
                                <option value="">---Chọn---</option>
                                <option value="design" {{ $member->site == 'design' ? 'selected' : '' }}>
                                    VicNguyen_Design
                                </option>
                                <option value="VicNguyen" {{ $member->site == 'VicNguyen' ? 'selected' : '' }}>
                                    VicNguyen
                                </option>
                            </select>
                        </div>


                        <div class="form-group text-right">
                            <a href="{{ route('admin.members.index') }}"
                                class="btn btn-white">
                                Quay lại
                            </a>

                            <button type="submit"
                                    class="btn btn-primary">
                                <i class="fa fa-save"></i> Cập nhật
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