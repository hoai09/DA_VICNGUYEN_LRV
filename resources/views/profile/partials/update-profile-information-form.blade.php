

        <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="POST" action="{{ route('admin.profile.update') }}" class="form-horizontal">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label class=" control-label">Tên:</label>
                <div class="col-sm-12">
                    <input type="text"
                            name="name"
                            class="form-control @error('name') has-error @enderror"
                            value="{{ old('name', $user->name) }}"
                            required autofocus>

                    @error('name')
                        <span class="help-block text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label class=" control-label">Email:</label>
                <div class="col-sm-12">
                    <input type="email"
                            name="email"
                            class="form-control @error('email') has-error @enderror"
                            value="{{ old('email', $user->email) }}"
                            required>

                    @error('email')
                        <span class="help-block text-danger">{{ $message }}</span>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <p class="help-block text-warning m-t-xs">
                            Email chưa được xác thực.

                            <button type="submit"
                                    form="send-verification"
                                    class="btn btn-link p-0 m-l-xs">
                                Gửi lại email xác thực
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="text-success m-t-xs">
                                Email xác thực đã được gửi lại.
                            </p>
                        @endif
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-12 ">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Lưu thay đổi
                    </button>

                    @if (session('status') === 'profile-updated')
                        <span class="text-success m-l-sm">
                            <i class="fa fa-check"></i> Đã lưu
                        </span>
                    @endif
                </div>
            </div>

        </form>

