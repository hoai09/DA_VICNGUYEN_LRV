{{-- @extends('admin.dashboard.layout')    --}}
{{-- @section('styles')
<link rel="stylesheet" href="{{ asset('assets/admin/css/member.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/> --}}
{{-- @endsection --}}

{{-- @section('header') --}}
{{-- @endsection --}}



    {{-- <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">
            <i class="bi bi-people-fill me-2"></i>Danh sách thành viên
        </h3>

        
    </div> --}}
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
<div class="wrapper wrapper-content animated fadeInRight">

    @session('success')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Thành công!</strong> {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endsession

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title justify-content-between align-items-center">
                    <h3>Danh sách thành viên</h3>
                    <div class="flexg">
                        <div class="input-group search-box shadow-sm">
                            <input type="text"
                                    id="searchInput"
                                    class="form-control border-start-0"
                                    placeholder="Tìm kiếm thành viên..." >
                        </div>
                        <div class="text right">
                            <a href="{{ route('admin.members.create') }}"
                                class="btn btn-primary btn-sm ">
                                <i class="fa fa-plus "></i> Thêm thành viên
                            </a>
                        </div>
                    </div>
                </div>

                <div class="ibox-content p-0">

                    <div class="table-responsive">
                        <table  class="table table-hover table-striped align-middle mb-0">
                            <thead>
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
                                    {{-- <td class="text-muted">{{ $member->id }}</td> --}}
                                    <td class="text-muted"><input type="checkbox" value="" class="input-checkbox checkBoxItem"></td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img
                                                src="{{ $member->image
                                                    ? asset('storage/' . $member->image)
                                                    : asset('assets/img/Thanhvien/default.png') }}"
                                                class="img-circle me-3"
                                                width="42" height="42"
                                                style="object-fit: cover">

                                            <div>
                                                <strong>{{ $member->name }}</strong><br>
                                                <small class="text-muted">{{ $member->slug }}</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ $member->graduation_year }}</td>

                                    <td>
                                        <span class="label label-info">
                                            {{ $member->join_year }}
                                        </span>
                                    </td>

                                    <td>
                                        <small class="text-muted">
                                            {{ $member->projects->pluck('title')->join(', ') }}
                                        </small>
                                    </td>

                                    <td>
                                        <small>{{ $member->awards }}</small>
                                    </td>

                                    <td>
                                        <span class="label label-default">
                                            {{ $member->main_role }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge bg-info text-dark">
                                            {{ strtoupper($member->site) }}
                                        </span>
                                    </td>

                                    <td class="text-center flex-row ">
                                        {{-- <a href="{{ route('admin.members.show', $member->slug) }}"
                                            class="btn btn-white btn-xs">
                                            <i class="fa fa-eye"></i>
                                        </a> --}}
                                    
                                        <a href="{{ route('admin.members.edit', $member->slug) }}"
                                            class="btn btn-warning btn-xs">
                                            <i class="fa fa-pencil"></i>
                                        </a>

                                        <form action="{{ route('admin.members.destroy', $member->slug) }}"
                                                method="POST"
                                                class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                onclick="return confirm('Xóa thành viên này?')"
                                                class="btn btn-danger btn-xs">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        Không có thành viên nào
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>

                <div class="ibox-footer text-right">
                    {{ $members->links('vendor.pagination.bootstrap-4') }}
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/admin/js/seach-member.js') }}"></script>
@endpush




