@extends('admin.layouts.app')
@section('header')
<h3>Edit ContactInfomation</h3>
@endsection
@section('content')
<div class="container mt4">
    <div clas="row">
        <div class="col-md-6 offset-3">

            <div class="card bg-light text-black mt-4">
                <div class="card-body border border-dark rounded">
                    <form action="{{ route('admin.contact_info.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="from-lable">Địa chỉ:</label>
                            <input type="text" name="address" value="{{ old('address', $contactInfos->address) }}" class="form-control bg-light text-dark @error('address') is-invalid @enderror">
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="from-lable">Email:</label>
                            <input type="email" name="email" value="{{ old('address', $contactInfos->email) }}"  class="form-control bg-light text-dark @error('email') is-invalid @enderror" value="{{ old('email') }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="from-lable">Số điện thoại:</label>
                            <input type="tel" name="phone" value="{{ old('address', $contactInfos->phone) }}" class="form-control bg-light text-dark @error('phone') is-invalid @enderror" value="{{ old('phone') }} ">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="from-lable">Bản đồ:</label>
                            <input type="file" name="map_image" value="{{ old('address', $contactInfos->map_image) }}" class="form-control bg-light text-dark">
                        </div>
        
                        <button type="submit" class="btn btn-outline-success">Cập nhật</button>
                    </form>
                </div>
            </div>
            <a href="{{route('admin.contact_info.index')}}" class="btn btn-secondary mt-4">Back to list</a>
        </div>
    </div>
</div>
@endsection
