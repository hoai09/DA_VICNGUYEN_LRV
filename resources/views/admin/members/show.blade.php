@extends('admin.layouts.home')
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/admin/css/member.css') }}">
@endsection
@section('header')
@endsection
@section('content')
<div class="container mt4">
    <div clas="row">
        <div class="col-md-6 offset-3">
    
            <div class="card bg-light text-black mt-4">
                <div class="card-body border border-success rounded">
                    <h5 class="card-title"><strong>Tên:</strong>{{ $member->name }}</h5>
                    <p class="card-text"><strong>Ảnh</strong>{{ $member->image }}</p>
                    <p class="card-text"><strong>Chức vụ</strong>{{ $member->projects->pluck('pivot.role')->join(', ') }}</p>
                    <p class="card-text"><strong>Tốt nghiệp</strong>{{ $member->graduation_year  }}</p>
                    <p class="card-text"><strong>Trở thành Vicer</strong>{{ $member->join_year }}</p>
                    <p class="card-text"><strong>Dự án tham gia</strong>{{ $member->projects->pluck('title')->join(', ') }}</p>
                    <p class="card-text"><strong>Giải thưởng</strong>{{ $member->awards }}</p>
                    <a href="{{route('admin.members.index')}}" class="btn btn-secondary">Back to list</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
