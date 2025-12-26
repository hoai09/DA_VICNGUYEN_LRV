
<div class="wrapper wrapper-content animated fadeInRight">

    @session('success')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Thành công!</strong> {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endsession

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox shadow-sm">
                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-lg-8">
                        <h2>{{ config('apps.member.title') }}</h2>
                            <ol class="breadcrumb" style="margin-bottom:10px;">
                                <li>
                                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="active"><strong>{{ config('apps.member.title') }}</strong></li>
                            </ol>
                    </div>
                </div>
                <div class="ibox-title">
                    <div class="wrapper wrapper-content animated fadeInRight">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Thành công!</strong> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
    
                        <div class="member-toolbar mb-3 d-flex flex-wrap align-items-center gap-2">
                            <a href="{{ route('admin.members.create') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-plus"></i> Thêm thành viên</a>
                            <div class="ms-auto d-flex align-items-center gap-2 mb-2">
                                <input type="text" class="form-control form-control-sm member-search-box" id="searchInput" placeholder="Tìm kiếm thành viên...">
                            </div>
                        </div>
    
                        <div class="ibox-content member-table-box p-2">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped member-table mb-0">
                                    <thead class="table-light align-middle text-center">
                                        <tr>
                                            <th width="60"><input type="checkbox" value="" id="checkAll" class="input-checkbox"></th>
                                            <th>Thông tin</th>
                                            <th>Năm tốt nghiệp</th>
                                            <th>Vicer từ</th>
                                            <th>Dự án tham gia</th>
                                            <th>Giải thưởng</th>
                                            <th>Chức vụ</th>
                                            <th>Site</th>
                                            <th class="text-center">Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                    @forelse ($members as $member)
                                        <tr>
                                            <td class="align-middle text-center"><input type="checkbox" value="" class="input-checkbox checkBoxItem"></td>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <img
                                                    src="{{ $member->image
                                                        ? asset('storage/' . $member->image)
                                                        : asset('assets/img/Thanhvien/default.png') }}"
                                                    class="img-circle me-3 member-avatar"
                                                    width="42" height="42"
                                                    style="object-fit: cover">
                                                    <div>
                                                        <strong>{{ $member->name }}</strong><br>
                                                        <small class="text-muted">{{ $member->slug }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">{{ $member->graduation_year }}</td>
                                            <td class="align-middle text-center">
                                                <span class="label label-info">
                                                    {{ $member->join_year }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <small class="text-muted">
                                                    {{ $member->projects->pluck('title')->join(', ') }}
                                                </small>
                                            </td>
                                            <td class="align-middle">
                                                <small>{{ $member->awards }}</small>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="label label-default">
                                                    {{ $member->main_role }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="badge bg-info text-dark">
                                                    {{ strtoupper($member->site) }}
                                                </span>
                                            </td>
                                            <td class="align-middle text-center flex-row ">
                                                <a href="{{ route('admin.members.edit', $member->slug) }}"
                                                    class="btn btn-warning btn-xs me-1" title="Sửa">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.members.destroy', $member->slug) }}"
                                                    method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                    onclick="return confirm('Xóa thành viên này?')"
                                                    class="btn btn-danger btn-xs"
                                                    title="Xoá"
                                                    >
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted py-4">
                                                Không có thành viên nào
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="ibox-footer text-end bg-light py-2 px-3 border-top">
                            {{ $members->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@push('scripts')
<script src="{{ asset('assets/admin/js/seach-member.js') }}"></script>
@endpush



