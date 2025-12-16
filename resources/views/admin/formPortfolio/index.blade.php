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

                <div class="ibox-content p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 form-table">
                            <thead class="table-light">
                                <tr>
                                    <th>Họ và tên</th>
                                    <th>Email</th>
                                    <th>Đối tượng</th>
                                    <th>Nội dung</th>
                                    <th>Ngày gửi</th>
                                    <th width="120px" class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($information as $info)
                                    <tr>
                                        <td class="fw-semibold">{{ $info->name }}</td>
                                        <td>{{ $info->email }}</td>
                                        <td>{{ $info->objects }}</td>
                                        <td class="text-truncate" style="max-width: 250px;">
                                            {{ Str::limit($info->content, 80) }}
                                        </td>
                                        <td>{{ $info->created_at->format('d/m/Y H:i') }}</td>

                                        <td class="d-flex gap-1 justify-content-center">
                                            <a href="{{ route('admin.formPortfolio.show', $info->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

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
