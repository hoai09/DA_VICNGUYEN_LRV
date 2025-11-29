@extends('admin.layouts.home')   

@section('header')
<h3>Chi tiết tin tức</h3>
@endsection

@section('content')
<div class="container mt-4 member-detail">

    <div class="row justify-content-center">
        <div class="col-lg-8">

        
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Chi tiết tin</h5>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-light btn-sm">Quay lại danh sách</a>
                </div>

                <div class="card-body">

                    
                    {{-- <div class="row mb-3">
                        <div class="col-md-4 fw-semibold text-secondary">Danh mục</div>
                        <div class="col-md-8">{{ $news->category?->name ?? '-' }}</div>
                    </div> --}}

                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold text-secondary">Tiêu đề</div>
                        <div class="col-md-8">{{ $news->title }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold text-secondary">Ảnh nổi bật</div>
                        <div class="col-md-8">
                            @if($news->image)
                                <img src="{{ asset('storage/' . $news->image) }}" alt="Ảnh tin" class="img-fluid rounded" style="max-width:200px;">
                            @else
                                -
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold text-secondary">Tóm tắt</div>
                        <div class="col-md-8">{{ $news->description ?? '-' }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold text-secondary">Ngày đăng</div>
                        <div class="col-md-8">
                            {{ $news->published_at?->format('d/m/Y H:i') ?? '-' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 fw-semibold text-secondary">Nội dung chi tiết</div>
                        <div class="col-md-8">
                            {!! $news->content !!}
                        </div>
                    </div>

                    
                    <div class="d-flex justify-content-end mt-4 gap-2">
                        <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary mt-3">Quay lại</a>
                        <a href="{{ route('admin.news.edit', $news->slug) }}" class="btn btn-outline-info mt-3">Chỉnh sửa</a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
