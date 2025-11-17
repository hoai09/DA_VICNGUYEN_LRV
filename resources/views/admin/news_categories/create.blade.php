@extends('admin.layouts.app')

@section('header')
<h3>Thêm Loại Tin Tức</h3>
@endsection

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card bg-light text-black mt-4">
                <div class="card-body border border-dark rounded">

                    <form method="POST" action="{{ route('admin.news_categories.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Tên loại tin</label>
                            <input type="text" 
                                name="name" 
                                value="{{ old('name') }}"
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
                                    rows="3">{{ old('description') }}</textarea>
                            
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">Lưu</button>
                        <a href="{{ route('admin.news_categories.index') }}" class="btn btn-secondary">Quay lại</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
