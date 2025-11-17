@extends('admin.layouts.app')
@section('header')
<h3>Create member</h3>
@endsection
@section('content')
<div class="container mt4">
    <div clas="row">
        <div class="col-md-6 offset-3">

            <div class="card bg-light text-black mt-4">
                <div class="card-body border border-dark rounded">
                    <form action="{{ route('admin.members.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="from-lable">Tên</label>
                            <input type="text" name="name" class="form-control bg-light text-dark @error('name') is-invalid @enderror">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="from-lable">Ảnh</label>
                            <input type="file" name="image" class="form-control bg-light text-dark">
                        </div>
                        <div class="mb-3">
                            <label class="from-lable">Chức vụ</label>
                            <input type="text" name="role" class="form-control bg-light text-dark">
                        </div>
                        <div class="mb-3">
                            <label class="from-lable">Tốt nghiệp</label>
                            <input type="text" name="graduation_year" class="form-control bg-light text-dark">
                        </div>
                        <div class="mb-3">
                            <label class="from-lable">Trở thành Vicer</label>
                            <input type="text" name="join_year" class="form-control bg-light text-dark">
                        </div>
                        <div class="mb-3">
                            <label class="from-lable">Dự án tham gia</label>
                            <select name="project_id" class="form-control bg-light text-dark">
                            @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->title }}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="mb-3">
                            <label class="from-lable">Giải thưởng</label>
                            <input type="text" name="awards" class="form-control bg-light text-dark">
                        </div>
                        <button type="submit" class="btn btn-outline-success">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
