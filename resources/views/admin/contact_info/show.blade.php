@extends('admin.layouts.app')
@section('header')
<h3>Create ContactInfomation</h3>
@endsection
@section('content')
<div class="container mt4">
    <div clas="row">
        <div class="col-md-6 offset-3">
            <h1>Contact Detail</h1>
            <div class="card bg-light text-black mt-4">
                <div class="card-body border border-success rounded">
                    <h5 class="card-title"><strong>Địa chỉ:</strong>{{ $contactInfos->address }}</h5>
                    <p class="card-text"><strong>Email:</strong>{{ $contactInfos->email }}</p>
                    <p class="card-text"><strong>Số điện thoại:</strong>{{ $contactInfos->phone }}</p>
                    <p class="card-text"><strong>Map</strong>{{ $contactInfos->map_image  }}</p>
                    
                </div>
            </div>
            <a href="{{route('admin.contact_info.index')}}" class="btn btn-secondary my-4">Back to list</a>
        </div>
    </div>
</div>
@endsection
