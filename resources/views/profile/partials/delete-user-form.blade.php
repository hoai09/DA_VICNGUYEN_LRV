
    <header class="m-b-md">
        <p class="text-muted">
            Hành động này không thể hoàn tác. Vui lòng cân nhắc trước khi thực hiện.
        </p>
    </header>

    <button
        type="button"
        class="btn btn-danger"
        x-data
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        <i class="fa fa-trash"></i> Xóa tài khoản
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="POST"
                action="{{ route('admin.profile.destroy') }}"
                class="form-horizontal p-md">
            @csrf
            @method('DELETE')

            <h4 class="m-b-sm text-danger">
                <i class="fa fa-warning"></i> Xác nhận xóa tài khoản
            </h4>

            <p class="text-muted m-b-md">
                Sau khi xóa, toàn bộ dữ liệu sẽ bị xóa vĩnh viễn.
                Vui lòng nhập mật khẩu để xác nhận.
            </p>

            <div class="form-group">
                <label class="control-label">
                    Mật khẩu:
                </label>
                <div class="col-sm-12">
                    <input type="password"
                            name="password"
                            class="form-control @error('password','userDeletion') has-error @enderror"
                            placeholder="Nhập mật khẩu xác nhận">

                    @error('password','userDeletion')
                        <span class="help-block m-b-none text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group m-t-md">
                <div class="col-sm-12 text-right">
                    <button type="button"
                            class="btn btn-default"
                            x-on:click="$dispatch('close')">
                        Hủy
                    </button>

                    <button type="submit" class="btn btn-danger m-l-sm">
                        <i class="fa fa-trash"></i> Xóa tài khoản
                    </button>
                </div>
            </div>
        </form>
    </x-modal>
