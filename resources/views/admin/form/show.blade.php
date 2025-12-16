<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ config('apps.headtitle.title1') }}</h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li>{{ config('apps.headtitle.title') }}</li>
            <li class="active"><strong>{{ config('apps.headtitle.title1') }}</strong></li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h3>Chi tiết thông tin dự án khách hàng</h3>
                </div>

                <div class="ibox-content">

                    <h4>{{ $information->full_name }}</h4>

                    <p><strong>Email:</strong> {{ $information->email }}</p>
                    <p><strong>Điện thoại:</strong> {{ $information->phone }}</p>
                    <p><strong>Nghề nghiệp:</strong> {{ $information->job }}</p>
                    <p><strong>Tuổi:</strong> {{ $information->age }}</p>

                    <p><strong>Loại dự án:</strong> {{ $information->category->name ?? '-' }}</p>
                    <p><strong>Diện tích:</strong> {{ $information->area }}</p>
                    <p><strong>Quy mô:</strong> {{ $information->project_scale }}</p>
                    <p><strong>Địa điểm:</strong> {{ $information->address }}</p>

                    <p><strong>Mô tả chức năng:</strong>
                        {!! nl2br(e($information->description)) !!}
                    </p>

                    <p><strong>Sở thích/Thói quen:</strong>
                        {!! nl2br(e($information->hobbies)) !!}
                    </p>

                    <p><strong>Lý do biết VIC:</strong>
                        {!! nl2br(e($information->referral)) !!}
                    </p>

                    <div class="text-right">
                        <a href="{{ route('admin.form.index') }}" class="btn btn-white mt-4">
                            <i class="fa-solid fa-arrow-left"></i> Quay lại
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>