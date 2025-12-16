
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Thông tin cá nhân</h5>
            </div>
            <div class="ibox-content">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>
    </div>   
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Đổi mật khẩu</h5>
            </div>
            <div class="ibox-content">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div> 

        @if(auth()->user()->role === 'admin')
        <div class="ibox">
            <div class="ibox-title">
                <h5>Xóa tài khoản</h5>
            </div>
            <div class="ibox-content">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
        @endif

    
</div>
