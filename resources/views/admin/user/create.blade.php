
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>{{ config('apps.headtitle.title6') }}</h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li>{{ config('apps.headtitle.title5') }}</li>
            <li class="active"><strong>{{ config('apps.headtitle.title6') }}</strong></li>
        </ol>
    </div>
</div>
<form method="POST" action="{{ route('admin.user.store') }}">
    @csrf

    <div class="form-group">
        <label>Tên</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Mật khẩu</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Quyền</label>
        <select name="role" class="form-control">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <a href="{{ route('admin.user.index') }}"
                                class="btn btn-white">
                                Quay lại
                            </a>
    <button class="btn btn-primary"><i class="fa fa-save"></i> Tạo tài khoản</button>
</form>
