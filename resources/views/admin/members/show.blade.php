<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ config('apps.headtitle.title1') }}</h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="active"><strong>{{ config('apps.headtitle.title1') }}</strong></li>
        </ol>
    </div>
</div>


<div class="container mt-4 member-detail">

    <div class="row justify-content-center">
        <div class="col-lg-8">

        
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header text-dack rounded-top-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thông tin nhân viên : {{ $member->name }}</h5>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold text-secondary">Ảnh</div>
                        <div class="col-md-8">
                            @if($member->image)
                                <img src="{{ asset('storage/' . $member->image) }}" alt="Ảnh tin" class="img-fluid rounded" style="max-width:200px;">
                            @else
                                -
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold text-secondary">Chức vụ</div>
                        <div class="col-md-8">{{ $member->main_role }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold text-secondary">Tốt nghiệp</div>
                        <div class="col-md-8">{{  $member->graduation_year }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold text-secondary">Trở thành Vicer</div>
                        <div class="col-md-8">{{ $member->join_year }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold text-secondary">Dự án tham gia</div>
                        <div class="col-md-8">{{ $member->projects->pluck('title')->join(', ') }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold text-secondary">Giải thưởng</div>
                        <div class="col-md-8">{{ $member->awards }}</div>
                    </div>

                    <div class="d-flex justify-content-end mt-4 text-right">
                        <a href="{{ route('admin.members.index') }}" class="btn btn-primary mt-3">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


