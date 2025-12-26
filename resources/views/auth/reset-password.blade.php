@extends('layouts.auth')

@section('title', 'Đặt lại mật khẩu')

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown limiter">
    <div class="container-login100">
        <div class="wrap-login100 mx-auto" style="max-width: 420px; min-width: 350px;">
            <h1 class="logo-name">VIC</h1>
            {{-- <img src="{{ asset('assets/img/logo.svg') }}" alt=""> --}}
            <p>Đặt lại mật khẩu cho tài khoản của bạn</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="m-t" method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ request()->route('token') }}">

                <!-- EMAIL -->
                <div class="form-group">
                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', request()->input('email')) }}"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Email"
                        required
                        autofocus
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
                        placeholder="Mật khẩu mới"
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
                        placeholder="Nhập lại mật khẩu mới"
                        required
                        autocomplete="new-password"
                    >
                    @error('password_confirmation')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">
                    Đặt lại mật khẩu
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
