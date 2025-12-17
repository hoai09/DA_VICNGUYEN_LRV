<base href="{{ env('APP_URL') }}">
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin|VICNGUYEN</title>
    <base target='_self'/><link rel="shortcut icon" type="text/css" href="{{ asset('assets/frontend/favicon.ico') }}" />

    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

    {{--  --}}

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{asset('css/animate.css') }}" >
    <link rel="stylesheet" href="{{asset('css/style.css') }}" >
    <link rel="stylesheet" href="{{asset('css/member.css') }}" >
    @if(isset($template) && $template === 'admin.projects.create')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/project.css') }}">
@endif
    
    {{-- <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script> --}}