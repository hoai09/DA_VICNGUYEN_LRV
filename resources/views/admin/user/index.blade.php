<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Danh sách tài khoản</h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Tài khoản</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">

                @if(session('success'))
                    <div class="alert alert-success shadow-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="ibox-title">
                    <h3>Danh sách tài khoản người dùng</h3>

                    <div class="text-right">
                        <a href="{{ route('admin.user.create') }}"
                                            class="btn btn-primary btn-sm ">
                                            <i class="fa fa-plus "></i> Thêm account
                        </a>
                    </div>
                </div>

                <div class="ibox-content p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 form-table">
                            <thead class="table-light">
                                <tr>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Vai trò</th>
                                    <th>Ngày tạo</th>
                                    {{-- <th width="120px" class="text-center">Thao tác</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($account as $acc)
                                    <tr>
                                        <td class="fw-semibold">{{ $acc->name }}</td>
                                        <td>{{ $acc->email }}</td>
                                        <td >{{ $acc->role}}</td>
                                        <td>{{ $acc->created_at->format('d/m/Y H:i') }}</td>

                                        <td class="d-flex gap-1 justify-content-center">
                                            {{-- <a href="{{ route('admin.user.edit', $acc->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fa-solid fa-eye"></i>
                                            </a> --}}

                                            @if(auth()->id() !== $acc->id)
                                                <form action="{{ route('admin.user.destroy', $acc->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        onclick="return confirm('Bạn có chắc muốn xoá tài khoản này không?')"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                                @else
                                                <span class="text-muted fst-italic"><button class="btn btn-gray btn-sm">
                                                    <i class="fa fa-trash"></i> </button>
                                                </span>
                                            @endif

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">
                                            Không có dữ liệu
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-3 px-3">
                    {{ $account->links('vendor.pagination.bootstrap-4') }}
                </div>

            </div>
        </div>
    </div>
</div>
