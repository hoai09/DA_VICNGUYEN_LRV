@extends('admin.layouts.app')

@section('header')
<h3>Danh sách loại tin tức</h3>
@endsection

@section('content')
<div class="container mt-4">

    <a href="{{ route('admin.news_categories.create') }}" class="btn btn-primary mb-3">
        Thêm loại tin
    </a>

    <div class="card">
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Tên loại tin</th>
                        <th>Mô tả</th>
                        <th width="120">Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>

                        <td class="text-center">
                            <a href="{{ route('admin.news_categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Sửa</a>

                            <form action="{{ route('admin.news_categories.destroy', $category->id) }}"
                                method="POST" class="d-inline-block"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Không có dữ liệu</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $categories->links() }}

        </div>
    </div>
</div>
@endsection
