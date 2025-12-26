@extends('layouts.auth')

@section('title', 'Đăng ký')

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown limiter">
    <div class="container-login100">
        <div class="wrap-login100 mx-auto" style="max-width: 420px; min-width: 350px;">

            <h1 class="logo-name">VIC</h1>
            {{-- <img src="{{ asset('assets/img/logo.svg') }}" alt=""> --}}

            <p>Đăng ký tài khoản mới</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="m-t" method="POST" action="{{ route('register') }}">
                @csrf

                <!-- NAME -->
                <div class="form-group">
                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="form-control @error('name') is-invalid @enderror"
                        placeholder="Họ tên"
                        required
                        autofocus
                        autocomplete="name"
                    >
                    @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- EMAIL -->
                <div class="form-group">
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Email"
                        required
                        autocomplete="username"
                    >
                    @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- PASSWORD -->
                <div class="form-group">
                    <input
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Mật khẩu"
                        required
                        autocomplete="new-password"
                    >
                    @error('password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- CONFIRM PASSWORD -->
                <div class="form-group">
                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        placeholder="Nhập lại mật khẩu"
                        required
                        autocomplete="new-password"
                    >
                    @error('password_confirmation')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">
                    Đăng ký
                </button>

                <a href="{{ route('login') }}">
                    <small>Đã có tài khoản? Đăng nhập</small>
                </a>
            </form>

            <p class="m-t">
                <small>Vic_nguyen &copy; {{ date('Y') }}</small>
            </p>
        </div>
    </div>
</div>
@endsection
