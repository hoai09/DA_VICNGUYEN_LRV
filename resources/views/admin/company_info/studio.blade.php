{{-- @extends('admin.layouts.home')      

@section('content') --}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ config('apps.headtitle.title3') }}</h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="active"><strong>{{ config('apps.headtitle.title3') }}</strong></li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
                <div class="ibox-title">
                    <h3 class="fw-bold mb-4">Quản lý Studio</h3>
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                </div>
                <div class="ibox-content">
                    <form action="{{ route('admin.company_info.studio') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                
                        <div class="mb-4">
                            <label class="form-label fw-bold">Ảnh Studio</label>
                            <div class="mb-2">
                                @if($studio->studio_image)
                                    <img src="{{ asset('storage/' . $studio->studio_image) }}" alt="studio image"
                                        class="img-fluid rounded border" style="max-width: 300px;">
                                @else
                                    <p class="text-muted">Chưa có ảnh</p>
                                @endif
                            </div>
                            <input type="file" name="studio_image" class="form-control @error('studio_image') is-invalid @enderror mt-2">
                            @error('studio_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="mb-4 mt-2">
                            <label class="form-label fw-bold">Giới thiệu Studio</label>
                            <textarea name="studio_content" class="form-control @error('studio_content') is-invalid @enderror"
                                    rows="6" placeholder="Nhập nội dung giới thiệu...">{{ old('studio_content', $studio->studio_content) }}</textarea>
                            @error('studio_content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="mb-4 mt-2">
                            <label class="form-label fw-bold">Danh sách Awards</label>
                            <small class="text-muted d-block mb-2"></small>
                
                            <textarea name="awards" rows="10"
                                    class="form-control @error('awards') is-invalid @enderror">
                    @if(is_array($studio->awards))
                    {{ implode("\n", $studio->awards) }}
                    @else
                    {{ $studio->awards }}
                    @endif
                            </textarea>
                
                            @error('awards')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary mt-4 px-4">Lưu thay đổi</button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</div>
</div>
{{-- @endsection --}}
