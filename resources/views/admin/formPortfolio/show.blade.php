<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Chi tiết liên hệ</h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('admin.formPortfolio.index') }}">Liên hệ Portfolio</a>
            </li>
            <li class="active">
                <strong>Chi tiết</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
        

                <div class="ibox-content">
                    <div class="mb-3">
                        <strong>Họ và tên:</strong>
                        <p>{{ $information->name }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Email:</strong>
                        <p>{{ $information->email }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Chủ đề:</strong>
                        <p>{{ $information->objects }}</p>
                    </div>

                    <div class="mb-3">
                        <strong>Nội dung:</strong>
                        <p style="white-space: pre-line;">
                            {{ $information->content }}
                        </p>
                    </div>

                    <div class="mb-3">
                        <strong>Ngày gửi:</strong>
                        <p>{{ $information->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div class="text-right mt-4">
                        <a href="{{ route('admin.formPortfolio.index') }}" class="btn btn-white">
                            <i class="fa-solid fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
