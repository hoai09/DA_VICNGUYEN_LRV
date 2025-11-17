@extends('admin.layouts.app')

@section('header')
<h3>Chỉnh sửa loại tin tức</h3>
@endsection

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card bg-light text-black mt-4">
                <div class="card-body border border-dark rounded">

                    <form method="POST" action="{{ route('admin.news_categories.update', $categories->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Tên loại tin</label>
                            <input type="text" 
                                name="name" 
                                value="{{ old('name', $categories->name) }}"
                                class="form-control @error('name') is-invalid @enderror" 
                                required>
                            
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mô tả</label>
                            <textarea name="description" 
                                    class="form-control @error('description') is-invalid @enderror" 
                                    rows="3">{{ old('description', $categories->description) }}</textarea>
                            
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{ route('admin.news_categories.index') }}" class="btn btn-secondary">Quay lại</a>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
