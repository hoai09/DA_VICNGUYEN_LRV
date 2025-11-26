@extends('admin.layouts.home')

@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-4">Quản lý Studio</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.contact_info.studio') }}" method="POST" enctype="multipart/form-data">
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
            <input type="file" name="studio_image" class="form-control @error('studio_image') is-invalid @enderror">
            @error('studio_image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Giới thiệu Studio</label>
            <textarea name="studio_content" class="form-control @error('studio_content') is-invalid @enderror"
                    rows="6" placeholder="Nhập nội dung giới thiệu...">{{ old('studio_content', $studio->studio_content) }}</textarea>
            @error('studio_content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
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

        <button type="submit" class="btn btn-outline-info mt-3 px-4">Lưu thay đổi</button>
    </form>
</div>
@endsection
