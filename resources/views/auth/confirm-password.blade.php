@extends('layouts.auth')

@section('title', __('Xác nhận mật khẩu'))

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown limiter">
    <div class="container-login100">
        <div class="wrap-login100 mx-auto" style="max-width: 420px; min-width: 350px;">

            <h1 class="logo-name">VIC</h1>
            {{-- <img src="{{ asset('assets/img/logo.svg') }}" alt=""> --}}

            <p>{{ __('Xác nhận mật khẩu trước khi tiếp tục') }}</p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="m-t" method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <!-- PASSWORD -->
                <div class="form-group">
                    <input
                        type="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="{{ __('Mật khẩu') }}"
                        required
                        autofocus
                        autocomplete="current-password"
                    >
                    @error('password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">
                    {{ __('Xác nhận') }}
                </button>
            </form>

            <p class="m-t">
                <small>Vic_nguyen &copy; {{ date('Y') }}</small>
            </p>
        </div>
    </div>
</div>
@endsection
