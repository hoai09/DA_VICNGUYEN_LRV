@extends('admin.layouts.app')

@section('header')
<h3>Danh sách ảnh dự án</h3>
@endsection

@section('content')
<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.project-images.create') }}" class="btn btn-primary mb-3">+ Thêm ảnh dự án</a>

    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Ảnh</th>
                <th>Dự án</th>
                <th>Đường dẫn</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($images as $img)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <img src="{{ asset('storage/'.$img->image_path) }}" width="120" class="rounded">
                    </td>
                    <td>{{ $img->project->title ?? 'Không có' }}</td>
                    <td>{{ $img->image_path }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.project-images.destroy', $img) }}"
                            onsubmit="return confirm('Xóa ảnh này?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Chưa có ảnh nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $images->links() }}

</div>
@endsection
