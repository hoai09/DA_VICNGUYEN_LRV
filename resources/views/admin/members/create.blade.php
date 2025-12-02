@extends('admin.layouts.home')     
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/admin/css/member.css') }}">
@endsection

@section('header')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0">Thêm Member Mới</h3>
    <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
</div>
@endsection

@section('content')
<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <form action="{{ route('admin.members.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="name" >Tên</label>
                    <input id="name" type="text" name="name" autocomplete="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for= "imageInput">Ảnh</label>
                    <input type="file" name="image" class="form-control" id="imageInput">
                    <img class="img-preview mt-2" style="display:none;">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="mainrole">Chức vụ</label>
                    <input id="mainrole" type="text" name="main_role" autocomplete="role" class="form-control" value="{{ old('main_role') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="yeartn">Tốt nghiệp</label>
                    <input id="yeartn" type="number" name="graduation_year" class="form-control" value="{{ old('graduation_year') }}">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="yeartg">Trở thành Vicer</label>
                    <input id="yeartg" type="number" name="join_year"  class="form-control" value="{{ old('join_year') }}">
                </div>

                {{-- <div class="mb-3">
                    <label class="form-label">Dự án tham gia</label>
                    <select name="project_id[]" class="form-select" multiple>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" 
                            @if(collect(old('project_id'))->contains($project->id)) selected @endif>
                            {{ $project->title }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}

                <div class="mb-3">
                    <label class="form-label" for="giai">Giải thưởng</label>
                    <input id="giai" type="text" name="awards" autocomplete="awards" class="form-control" value="{{ old('awards') }}">
                </div>

                <button type="submit" class="btn btn-outline-info mt-3">Lưu Member</button>
            </form>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const input = document.getElementById('imageInput');
    const preview = document.querySelector('.img-preview');

    input.addEventListener('change', function(){
        const file = this.files[0];
        if(file){
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    });
});
</script>
@endsection
