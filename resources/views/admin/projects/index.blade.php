{{-- @extends('admin.layouts.home')    --}}

{{-- @section('styles')
<link rel="stylesheet" href="{{ asset('assets/admin/css/member.css') }}">
@endsection --}}
{{-- 
@section('header')
@endsection --}}

{{-- @section('content') --}}

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ config('apps.project.title') }}</h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="active"><strong>{{ config('apps.project.title') }}</strong></li>
        </ol>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
        
            <div class="ibox-title d-flex justify-content-between align-items-center">
                <h3 class="fw-semibold m-0">Danh sách dự án</h3>

                <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Thêm dự án
                </a>
            </div>
        
            @if(session('success'))
                <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
            @endif
        
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 project-table">
                            <thead class="table-light">
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Trạng thái</th>
                                    <th>Năm bắt đầu</th>
                                    <th>Người tạo</th>
                                    <th width="200px" class="text-center">Thao tác</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                @foreach ($projects as $project)
                                <tr>
                                    <td class="fw-semibold">{{ $project->title }}</td>
        
                                    <td>
                                        @switch($project->status)
                                            @case('Đang triển khai')
                                                <span class="badge bg-success">Đang triển khai</span>
                                                @break
                                            @case('Hoàn thành')
                                                <span class="badge bg-primary">Hoàn thành</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">Ẩn</span>
                                        @endswitch
                                    </td>
        
                                    <td>{{ $project->start_year }}</td>
        
                                    <td>
                                        <span class="text-dark fw-medium">
                                            {{ $project->user->name ?? 'Không xác định' }}
                                        </span>
                                    </td>
        
                                    <td>
                                        <div class="d-flex justify-content-center gap-2 text-center">
        
                            
                                            {{-- <a href="{{ route('admin.projects.show', $project->slug) }}" 
                                            class="btn btn-info btn-sm action-btn">
                                            <i class="fa-solid fa-eye"></i>
                                            </a> --}}
        
                                            <a href="{{ route('admin.projects.edit', $project->slug) }}" 
                                            class="btn btn-warning btn-sm action-btn">
                                            <i class="fa-solid fa-pen"></i>
                                            </a>
        
                                    
                                            <form action="{{ route('admin.projects.destroy', $project->slug) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-danger btn-sm action-btn btn-delete">
                                                    <i class="fa-solid fa-trash "></i>
                                                </button>
                                            </form>
        
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
        
                        </table>
                    </div>
                </div>
            </div>
        
            <div class="mt-3">
                {{ $projects->links('vendor.pagination.bootstrap-4') }}
            </div>
        
        </div>
    </div>
</div>
{{-- @endsection --}}
