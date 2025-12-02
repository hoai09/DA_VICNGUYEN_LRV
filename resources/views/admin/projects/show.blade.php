@extends('admin.layouts.home')  

@section('header')
<h3 class="fw-bold">Chi tiết dự án</h3>
@endsection

@section('content')
<div class="container mt-4">

    <div class="card shadow-sm rounded-4 border-0">
        <div class="card-body p-4">

            <h2 class="fw-bold mb-3">{{ $project->title }}</h2>

            <div class="row mb-3">
                <div class="col-md-6 mb-2">
                    <span class="text-muted fw-semibold">Slug:</span>
                    <span class="ms-2">{{ $project->slug }}</span>
                </div>
                <div class="col-md-6 mb-2">
                    <span class="text-muted fw-semibold">Trạng thái:</span>
                    <span class="ms-2">{{ $project->status }}</span>
                </div>
                <div class="col-md-6 mb-2">
                    <span class="text-muted fw-semibold">Năm:</span>
                    <span class="ms-2">{{ $project->start_year }} - {{ $project->end_year }}</span>
                </div>
                <div class="col-md-6 mb-2">
                    <span class="text-muted fw-semibold">Diện tích:</span>
                    <span class="ms-2">{{ $project->acreage ?? '-' }} ㎡</span>
                </div>
                <div class="col-md-6 mb-2">
                    <span class="text-muted fw-semibold">Địa chỉ:</span>
                    <span class="ms-2">{{ $project->address ?? '-' }}</span>
                </div>
                <div class="col-md-6 mb-2">
                    <span class="text-muted fw-semibold">Thể loại:</span>
                    <span class="ms-2">{{ $project->category->name ?? ' ' }}
                    </span>
                </div>
            </div>

        
            <div class="mb-3">
                <h5 class="fw-semibold text-muted">Mô tả:</h5>
                <p class="border p-3 rounded-3 bg-light">{!! nl2br(e($project->description)) !!}</p>
            </div>

        
            @if($project->members->count())
            <div class="mb-3">
                <h5 class="fw-semibold text-muted">Thành viên dự án:</h5>
                <ul class="list-group list-group-flush">
                    @foreach($project->members as $member)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $member->name }}
                            <span class="badge bg-primary rounded-pill">{{ $member->pivot->role ?? 'Chưa có vai trò' }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif

        
            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary mt-3">
                <i class="bi bi-arrow-left me-1"></i> Quay lại
            </a>

        </div>
    </div>
</div>
@endsection
