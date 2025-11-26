@extends('admin.layouts.home')       // cập nhật đường dẫn fb inta mailto ở phần footer

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-black">Cập nhật Social Links</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.contact_info.social') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-bold">Facebook Link</label>
            <input type="url" name="facebook" class="form-control"
                value="{{ $social->social_links['facebook'] ?? '' }}" placeholder="">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Instagram Link</label>
            <input type="url" name="instagram" class="form-control"
                value="{{ $social->social_links['instagram'] ?? '' }}" placeholder="">
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Email</label>
            <input type="email" name="email_social" class="form-control"
                value="{{ $social->social_links['email_social'] ?? '' }}" placeholder="">
        </div>

        <button type="submit" class="btn btn-outline-info mt-3">Cập nhật</button>
    </form>
</div>
@endsection
