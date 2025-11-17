@extends('admin.layouts.app')

@section('header')
<h3>Danh sách ảnh dự án</h3>
@endsection

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Danh sách dự án</h2>

    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary btn-sm mb-3">Thêm</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Trạng thái</th>
                <th>Năm bắt đầu</th>
                <th>Năm kết thúc</th>
                <th width="160px">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
            <tr>
                <td>{{ $project->title }}</td>
                <td>{{ $project->status }}</td>
                <td>{{ $project->start_year }}</td>
                <td>{{ $project->end_year }}</td>

                <td>
                    
                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Bạn có chắc muốn xoá không?')" class="btn btn-danger btn-sm">Xoá</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $projects->links() }}
</div>
@endsection
