@extends('admin.layouts.home')

@section('header')
<h3 class="fw-bold">Chỉnh sửa dự án: {{ $project->title }}</h3>
@endsection

@section('content')
<div class="container mt-4">

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <form action="{{ route('admin.projects.update', $project->slug) }}" method="POST">
                @csrf
                @method('PUT')

                
                <div class="mb-4">
                    <label class="form-label fw-semibold">Tiêu đề dự án <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control form-control-lg" value="{{ $project->title }}" required>
                    
                    <small class="text-muted d-block mt-1">Slug tự tạo dựa trên tiêu đề</small>
                    <input type="text" name="slug" id="slug" class="form-control mt-1" value="{{ $project->slug }}">
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Thể loại</label>
                        <input type="text" name="category" class="form-control" value="{{ $project->category }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Địa chỉ</label>
                        <input type="text" name="address" class="form-control" value="{{ $project->address }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Diện tích (㎡)</label>
                        <input type="text" name="acreage" class="form-control" value="{{ $project->acreage }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Mô tả</label>
                    <textarea name="description" class="form-control" rows="4">{{ $project->description }}</textarea>
                </div>

        
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="Đang triển khai" {{ $project->status=='Đang triển khai' ? 'selected' : '' }}>Đang triển khai</option>
                            <option value="Hoàn thành" {{ $project->status=='Hoàn thành' ? 'selected' : '' }}>Hoàn thành</option>
                            <option value="Tạm dừng" {{ $project->status=='Tạm dừng' ? 'selected' : '' }}>Tạm dừng</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Năm bắt đầu</label>
                        <input type="number" name="start_year" class="form-control" value="{{ $project->start_year }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Năm kết thúc</label>
                        <input type="number" name="end_year" class="form-control" value="{{ $project->end_year }}">
                    </div>
                </div>

            
                <div class="mt-4 mb-3">
                    <label class="form-label fw-semibold fs-5">Thành viên dự án</label>

                    <div class="member-list">
                        @foreach($members as $member)
                        <div class="member-item d-flex align-items-center p-2 rounded mb-2 shadow-sm bg-white border">
                            <input class="form-check-input me-3 member-checkbox" type="checkbox" 
                                name="members[]" value="{{ $member->id }}"
                                {{ $project->members->contains($member->id) ? 'checked' : '' }}>

                            <div class="flex-grow-1">
                                <strong>{{ $member->name }}</strong>
                            </div>

                            <input type="text"
                                name="roles[{{ $member->id }}]"
                                placeholder="Vai trò"
                                class="form-control ms-3 role-input"
                                style="max-width: 200px; display: {{ $project->members->contains($member->id) ? 'block' : 'none' }};"
                                value="{{ $project->members->find($member->id)?->pivot->role ?? '' }}">
                        </div>
                        @endforeach
                    </div>
                </div>

            
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary px-4">
                        <i class="bi bi-arrow-left"></i> Quay lại
                    </a>

                    <button class="btn btn-success px-4">
                        <i class="bi bi-save me-1"></i> Cập nhật
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    
    document.getElementById('title').addEventListener('input', function () {
        let text = this.value.toLowerCase()
            .replace(/ /g, '-')
            .replace(/[^\w-]+/g, '');
        document.getElementById('slug').value = text;
    });

    document.querySelectorAll('.member-checkbox').forEach(cb => {
        cb.addEventListener('change', function() {
            const roleInput = this.closest('.member-item').querySelector('.role-input');
            roleInput.style.display = this.checked ? 'block' : 'none';
        });
    });
</script>
@endsection
