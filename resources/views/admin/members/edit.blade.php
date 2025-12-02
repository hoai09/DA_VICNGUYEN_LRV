@extends('admin.layouts.home')   

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/admin/css/member.css') }}">
<style>
    .card-header { font-weight: 600; font-size: 1.1rem; }
    .img-preview { max-width: 120px; border-radius: 6px; margin-top: 10px; }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header text-dack">
                    Cập nhật nhân viên : {{ $member->name }}
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.members.update', $member->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Tên</label>
                            <input type="text" name="name" value="{{ old('name', $member->name) }}" class="form-control @error('name') is-invalid @enderror">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ảnh</label>
                            <input type="file" name="image" class="form-control" id="imageInput">
                            @if($member->image)
                                <img id="previewImg" src="{{ asset('storage/'.$member->image) }}" class="img-preview">
                            @else
                                <img id="previewImg" src="#" class="img-preview d-none">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Chức vụ</label>
                            <input type="text" name="main_role" value="{{ old('main_role', $member->main_role) }}" class="form-control">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tốt nghiệp</label>
                                <input type="number" name="graduation_year" value="{{ old('graduation_year', $member->graduation_year) }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Trở thành Vicer</label>
                                <input type="number" name="join_year" value="{{ old('join_year', $member->join_year) }}" class="form-control">
                            </div>
                        </div>

                        {{-- <div class="mb-3">
                            <label class="form-label">Dự án tham gia</label>
                            <select name="project_id[]" class="form-select" multiple>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" 
                                    @if($member->projects->contains($project->id)) selected @endif>
                                    {{ $project->title }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Giữ Ctrl hoặc Cmd để chọn nhiều dự án</small>
                        </div> --}}

                        <div class="mb-3">
                            <label class="form-label">Giải thưởng</label>
                            <input type="text" name="awards" value="{{ old('awards', $member->awards) }}" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-outline-info mt-3">Cập nhật</button>
                        <a href="{{ route('admin.members.index') }}" class="btn btn-outline-secondary mt-3">Quay lại danh sách</a>
                    </form>
                </div>
            </div>

            
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Preview ảnh trước khi upload
    document.getElementById('imageInput').addEventListener('change', function(event){
        const [file] = event.target.files;
        const preview = document.getElementById('previewImg');
        if(file){
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
        }
    });
</script>
@endsection
