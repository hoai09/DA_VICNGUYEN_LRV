<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Login')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{asset('css/animate.css') }}" >
    <link rel="stylesheet" href="{{asset('css/style.css') }}" >
</head>
<body>

    @yield('content')

    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>