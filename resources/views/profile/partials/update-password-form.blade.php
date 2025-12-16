
        <form method="POST" action="{{ route('password.update') }}" class="form-horizontal">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="control-label">Mật khẩu hiện tại:</label>
                <div class="col-sm-12">
                    <input type="password"
                            name="current_password"
                            class="form-control @error('current_password','updatePassword') has-error @enderror"
                            autocomplete="current-password">

                    @error('current_password','updatePassword')
                        <span class="help-block m-b-none text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class=" control-label">Mật khẩu mới:</label>
                <div class="col-sm-12">
                    <input type="password"
                            name="password"
                            class="form-control @error('password','updatePassword') has-error @enderror"
                            autocomplete="new-password">

                    @error('password','updatePassword')
                        <span class="help-block m-b-none text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class=" control-label">Xác nhận mật khẩu:</label>
                <div class="col-sm-12">
                    <input type="password"
                            name="password_confirmation"
                            class="form-control"
                            autocomplete="new-password">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12">
                    <button class="btn btn-primary" type="submit">
                        <i class="fa fa-save"></i> Lưu thay đổi
                    </button>

                    @if (session('status') === 'password-updated')
                        <span class="text-success m-l-sm">
                            <i class="fa fa-check"></i> Đã lưu
                        </span>
                    @endif
                </div>
            </div>

        </form>

