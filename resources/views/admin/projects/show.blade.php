@extends('admin.layouts.app')

@section('header')
<h3>Danh sách ảnh dự án</h3>
@endsection

<div class="container mt-4">

    <h2>{{ $project->title }}</h2>
    <p><strong>Slug:</strong> {{ $project->slug }}</p>
    <p><strong>Trạng thái:</strong> {{ $project->status }}</p>
    <p><strong>Năm:</strong> {{ $project->start_year }} - {{ $project->end_year }}</p>
    <p>{!! nl2br(e($project->description)) !!}</p>

    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection
