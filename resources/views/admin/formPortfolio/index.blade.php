<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Danh sách liên hệ</h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="active">
                <strong>Liên hệ</strong>
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
                    <h3>Danh sách thông tin liên hệ</h3>
                </div>

                <div class="ibox-content border-bottom">
                    <form method="GET" class="form-inline">
                        <div class="form-group">
                            <select name="status" class="form-control input-sm"
                                onchange="this.form.submit()">
                                <option value="">-- Tất cả trạng thái --</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>
                                    Chưa xem
                                </option>
                                <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>
                                    Đã xem
                                </option>
                                <option value="2" {{ request('status') == 2 ? 'selected' : '' }}>
                                    Đã xử lý
                                </option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="ibox-content p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 form-table">
                            <thead class="table-light">
                                <tr>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Đối tượng</th>
                                    <th>Nội dung</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày gửi</th>
                                    <th width="120px" class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($information as $info)
                                    <tr class="{{ $info->status == 0 ? 'bg-warning-subtle' : '' }}">
                                        <td class="fw-semibold">{{ $info->name }}</td>
                                        <td>{{ $info->email }}</td>
                                        <td>{{ $info->objects }}</td>
                                        <td class="text-truncate" style="max-width: 250px;">
                                            {{ Str::limit($info->content, 80) }}
                                        </td>
                                        <td>
                                            @if($info->status == 0)
                                                <span class="label label-warning">Chưa xem</span>
                                            @elseif($info->status == 1)
                                                <span class="label label-primary">Đã xem</span>
                                            @else
                                                <span class="label label-success">Đã xử lý</span>
                                            @endif
                                        </td>
                                        
                                        <td>{{ $info->created_at->format('d/m/Y H:i') }}</td>

                                        <td class="flex-row gap-1 justify-content-center">
                                            <a href="{{ route('admin.formPortfolio.show', $info->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

                                            <form action="{{ route('admin.formPortfolio.done', $info->id) }}"
                                                method="POST"
                                                style="display:inline">
                                                @csrf
                                                <button class="btn btn-success btn-sm"
                                                    title="Đánh dấu đã xử lý"
                                                    {{ $info->status == 2 ? 'disabled' : '' }}>
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            </form>
                                            

                                            <form action="{{ route('admin.formPortfolio.destroy', $info->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    onclick="return confirm('Bạn có chắc muốn xoá không?')"
                                                    class="btn btn-danger btn-sm">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
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
                    {{ $information->links('vendor.pagination.bootstrap-4') }}
                </div>

            </div>
        </div>
    </div>
</div>
