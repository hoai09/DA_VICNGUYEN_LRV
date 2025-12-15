{{-- @extends('admin.layouts.home')  
@section('header')
@endsection

@section('content') --}}

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ config('apps.project.title_image') }}</h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="active"><strong>{{ config('apps.project.title_image') }}</strong></li>
        </ol>
    </div>
</div>


<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">

            <div class="ibox">
                <div class="ibox-title d-flex justify-content-between align-items-center">
                    <h3 class="fw-semibold m-0">Danh sách ảnh dự án</h3>
    
                    <a href="{{ route('admin.project_images.create') }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Thêm ảnh dự án
                    </a>
                </div>
                
                <div class="search-wrapper mb-4 d-flex justify-content-end">
                    <div class="input-group search-box shadow-sm d-flex">
                        <input type="text"
                                id="searchInput"
                                class="form-control border-start-0"
                                placeholder="Tìm kiếm dự án..." >
                    </div>
                </div>
                <div class="container-fluid project-image-page">
                
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                            <strong>Thành công!</strong> {{ session('success') }}
                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                
                
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0 project-table">
                                    <thead>
                                        <tr>
                                            <th>Ảnh</th>
                                            <th>Dự án</th>
                                            <th>Trạng thái</th>
                                            <th>Bắt đầu</th>
                                            <th>Kết thúc</th>
                                            <th class="text-center">Thao tác</th>
                                        </tr>
                                    </thead>
                
                                    <tbody id="tableBody">
                                        @foreach ($images as $img)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('storage/'.$img->image_path) }}" 
                                                class="project-thumb" alt=""
                                                width="42" height="42"
                                                style="object-fit: cover">
                                            </td>
                
                                            <td class="fw-semibold">{{ $img->project->title ?? '-' }}</td>
                
                                            <td>
                                                @php
                                                    $status = strtolower($img->project->status ?? 'unknown');
                                                    $color = match($status) {
                                                        'đang thực hiện', 'doing' => 'warning',
                                                        'hoàn thành', 'done' => 'success',
                                                        'tạm dừng', 'pause' => 'secondary',
                                                        default => 'dark',
                                                    };
                                                @endphp
                
                                                <span class="badge status-badge bg-{{ $color }}">
                                                    {{ $img->project->status ?? '-' }}
                                                </span>
                                            </td>
                
                                            <td>{{ $img->project->start_year ?? '-' }}</td>
                                            <td>{{ $img->project->end_year ?? '-' }}</td>
                
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-2">
                
                                                    <a href="{{ asset('storage/'.$img->image_path) }}" 
                                                        target="_blank"
                                                        class="btn btn-info btn-xs" title="Xem ảnh">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                
                                                    <form action="{{ route('admin.project_images.destroy', $img) }}" 
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-danger btn-xs"
                                                                title="Xoá">
                                                            <i class="fa-solid fa-trash"></i>
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
                
                    <div class="d-flex justify-content-end mt-4">
                        {{ $images->links('vendor.pagination.bootstrap-4') }}
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}


@section('scripts')
<script src="{{ asset('assets/admin/js/projectImg/seach-img.js') }}"></script>
@endsection
