@extends('layouts.auth')

@section('title', 'Xác minh email')

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown limiter">
    <div class="container-login100">
        <div class="wrap-login100 mx-auto" style="max-width: 420px; min-width: 350px;">

            <h1 class="logo-name">VIC</h1>
            {{-- <img src="{{ asset('assets/img/logo.svg') }}" alt=""> --}}

            <p>Vui lòng xác minh địa chỉ email của bạn bằng cách nhấn vào liên kết chúng tôi vừa gửi đến email của bạn. Nếu bạn chưa nhận được email, chúng tôi sẽ gửi lại cho bạn.</p>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success mb-3">
                    Một liên kết xác minh mới đã được gửi đến địa chỉ email của bạn.
                </div>
            @endif

            <form class="m-t mb-2" method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn btn-primary block full-width m-b">
                    Gửi lại email xác minh
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-link text-danger p-0">
                    Đăng xuất
                </button>
            </form>

            <p class="m-t">
                <small>Vic_nguyen &copy; {{ date('Y') }}</small>
            </p>
        </div>
    </div>
</div>
@endsection
