@extends('layouts.auth')

@section('title', 'Quên mật khẩu')

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown limiter">
    <div class="container-login100">

        <div class="wrap-login100 mx-auto" style="max-width: 420px; min-width: 350px;">

            <h1 class="logo-name">VIC</h1>
            {{-- <img src="{{ asset('assets/img/logo.svg') }}" alt=""> --}}
            <p>Nhập email của bạn để nhận liên kết đặt lại mật khẩu</p>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="m-t" method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- EMAIL -->
                <div class="form-group">
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Email"
                        required
                        autofocus
                    >

                    @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">
                    Gửi liên kết đặt lại mật khẩu
                </button>

                <a href="{{ route('login') }}">
                    <small>Quay lại đăng nhập</small>
                </a>
            </form>

            <p class="m-t">
                <small>Vic_nguyen &copy; {{ date('Y') }}</small>
            </p>

        </div>
    </div>
</div>
@endsection
