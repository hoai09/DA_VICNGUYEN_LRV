
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ config('apps.member.title1') }}</h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li>{{ config('apps.member.title') }}</li>
            <li class="active"><strong>{{ config('apps.member.title1') }}</strong></li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">

            <div class="ibox">
                <div class="ibox-title">
                    <h3>Thông tin thành viên</h3>
                </div>

                <div class="ibox-content">
                    <form action="{{ route('admin.members.store') }}"
                        method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Tên thành viên</label>
                            <input type="text"
                                    name="name"
                                    value="{{ old('name') }}"
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
                            <img class="img-preview mt-3 rounded"
                                    style="display:none; max-width:120px;">
                        </div>

                        <div class="form-group">
                            <label>Chức vụ</label>
                            <input type="text"
                                    name="main_role"
                                    value="{{ old('main_role') }}"
                                    class="form-control">
                        </div>

                        {{-- Tốt nghiệp --}}
                        <div class="form-group">
                            <label>Năm tốt nghiệp</label>
                            <input type="number"
                                    name="graduation_year"
                                    value="{{ old('graduation_year') }}"
                                    class="form-control">
                        </div>

                        {{-- Trở thành Vicer --}}
                        <div class="form-group">
                            <label>Trở thành Vicer từ năm</label>
                            <input type="number"
                                    name="join_year"
                                    value="{{ old('join_year') }}"
                                    class="form-control">
                        </div>

                        {{-- Giải thưởng --}}
                        <div class="form-group">
                            <label>Giải thưởng</label>
                            <input type="text"
                                    name="awards"
                                    value="{{ old('awards') }}"
                                    class="form-control">
                        </div>

                        {{-- Button --}}
                        <div class="form-group text-right">
                            <a href="{{ route('admin.members.index') }}"
                                class="btn btn-white">
                                Quay lại
                            </a>

                            <button type="submit"
                                    class="btn btn-primary">
                                <i class="fa fa-save"></i> Lưu Member
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@section('scripts')
<script src="{{ asset('assets/admin/js/member.js') }}"></script>
@endsection
