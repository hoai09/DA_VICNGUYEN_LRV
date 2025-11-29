@extends('admin.layouts.home')     

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/admin/css/form.css') }}">
@endpush

@section('header')
<h3 class="fw-bold mt-5 ms-2">Danh sách thông tin dự án khách hàng</h3>
@endsection

@section('content')
<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0 form-table">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 form-table">
                <thead class="table-light">
                    <tr>
                        <th>Họ và tên</th>
                        <th>Email</th>
                        <th>Điện thoại</th>
                        <th>Loại dự án</th>
                        <th>Diện tích</th>
                        <th>Ngày gửi</th>
                        <th width="140px" class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($information as $info)
                    <tr>
                        <td class="fw-semibold">{{ $info->full_name }}</td>
                        <td>{{ $info->email }}</td>
                        <td>{{ $info->phone }}</td>
                        <td>
                            <span class="badge-type">
                                {{ $info->type }}
                            </span>
                        </td>
                        <td>{{ $info->acreage }}</td>
                        <td>{{ $info->created_at->format('d/m/Y H:i') }}</td>
                        <td class="d-flex gap-1">

                            <a href="{{ route('admin.form.show', $info->id) }}" 
                            class="btn btn-info btn-sm action-btn">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <form action="{{ route('admin.form.destroy', $info->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button 
                                    onclick="return confirm('Bạn có chắc muốn xoá không?')" 
                                    class="btn btn-danger btn-sm action-btn">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3">
        {{ $information->links('vendor.pagination.bootstrap-5') }}
    </div>

</div>
@endsection

@push('scripts')
<script src="{{ asset('assets/admin/js/form.js') }}"></script>
@endpush
