
@extends('layouts.auth')

@section('title', 'Đăng nhập')

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown limiter">
    <div class="container-login100">

    <div class="wrap-login100 mx-auto" style="max-width: 420px; min-width: 350px;">

        <h1 class="logo-name">VIC</h1>
        {{-- <img src="{{ asset('assets/img/logo.svg') }}" alt=""> --}}

        <p>Login to continue</p>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form class="m-t" method="POST" action="{{ route('login') }}">
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

            <!-- PASSWORD -->
            <div class="form-group">
                <input
                    type="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Password"
                    required
                >

                @error('password')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <!-- REMEMBER -->
            <div class="form-group text-left">
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
            </div>

            <button type="submit" class="btn btn-primary block full-width m-b">
                Login
            </button>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    <small>Quên mật khẩu?</small>
                </a>
            @endif

        </form>

        <p class="m-t">
            <small>Vic_nguyen &copy; {{ date('Y') }}</small>
        </p>

    </div>
</div>
</div>

@endsection