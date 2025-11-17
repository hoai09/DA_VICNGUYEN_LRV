@extends('admin.layouts.app')
@section('header')
<h3>Create member</h3>
@endsection
@section('content')
<div class="container mt4">
    <div clas="row">
        <div class="col-md-6 offset-3">
            <h1>Member Detail</h1>
            <div class="card bg-light text-black mt-4">
                <div class="card-body border border-success rounded">
                    <h5 class="card-title"><strong>Loại tin:</strong>{{ $news->category_id }}</h5>
                    <p class="card-text"><strong>Tiêu đề:</strong>{{ $news->title }}</p>
                    <p class="card-text"><strong>Ảnh :</strong>{{ $news->feature_image }}</p>
                    <p class="card-text"><strong>Tóm tắt:</strong>{{ $news->summary  }}</p>
                    <p class="card-text"><strong>Ngày đăng:</strong>{{ $news->published_at }}</p>
                    <a href="{{route('admin.news.index')}}" class="btn btn-secondary">Back to list</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
