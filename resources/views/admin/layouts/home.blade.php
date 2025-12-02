<!DOCTYPE html>   
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin|VICNGUYEN</title>

    <base target='_self'/><link rel="shortcut icon" type="text/css" href="{{ asset('assets/frontend/favicon.ico') }}" />

    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

    <link rel="stylesheet" href="{{ asset('assets/admin/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/news.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/project_image.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/contact-info.css') }}">
    @stack('styles')
</head>


<body>

    <div class="navigation">
        <ul>
            <li class="nav-logo">
                <a href="#">
                    <span class="icon me-1">
                        <img src="{{ asset('assets/img/logo1.svg') }}" alt="logo" class="logo-admin">
                    </span>
                    <span class="title fw-bold fs-4 site-name"></span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.dashboard') }}">
                <span class="icon">
                    <i class="fa-solid fa-house-user"></i>
                </span>
                <span class="title">Dashboard</span></a>
            </li>

            <li>
                <a href="{{ route('admin.projects.index') }}">
                    <span class="icon">
                        <i class="fa-solid fa-diagram-project"></i>
                    </span>
                    <span class="title">Quản Lí Dự Án</span></a>
            </li>

            <li>
                <a href="{{ route('admin.project_images.index') }}">
                    <span class="icon">
                        <i class="fa-regular fa-image"></i>
                    </span>
                    <span class="title">Quản Lí Ảnh Dự Án</span></a>
            </li>

            <li>
                <a href="{{ route('admin.news.index') }}">
                    <span class="icon">
                        <i class="fa-regular fa-newspaper"></i>
                    </span>
                    <span class="title">Quản Lí Tin Tức</span></a>
            </li>

            <li><a href="{{ route('admin.members.index') }}">
                <span class="icon"><i class="fa-solid fa-users"></i>
                </span>
                <span class="title">Quản Lí Nhân Viên</span></a>
            </li>
            <li><a href="{{ route('admin.form.index') }}">
                <span class="icon">
                    <i class="fa-brands fa-wpforms"></i>
                </span>
                <span class="title">Form</span></a></li>

                <li><a href="{{ route('admin.company_info.contact') }}">
                    <span class="icon">
                        <i class="fa-solid fa-earth-asia"></i>
                    </span>
                    <span class="title">Liên Hệ</span></a></li>
                    
                    <li><a href="{{ route('admin.company_info.studio') }}">
                        <span class="icon">
                            <i class="fa-solid fa-gear"></i>
                        </span>
                        <span class="title">Studio</span></a></li>

                        <li><a href="{{ route('admin.company_info.social') }}">
                            <span class="icon">
                                <i class="fa-solid fa-link"></i></i>
                            </span>
                            <span class="title">Khác</span></a></li>

        </ul>
    </div>

    <div class="main">
        <div class="topbar d-flex justify-content-between align-items-center">
            
            <div class="toggle"><i class="fa-solid fa-bars"></i></div>

            {{-- <!-- Search -->
            <div class="search">
                <label>
                    <input type="text" placeholder="Search here...">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </label>
            </div> --}}

            <div class="d-flex align-items-center gap-3">

                <a href="{{ route('admin.profile.edit') }}" class="user">
                    <img src="{{ asset('assets/img/Thanhvien/VICNGUYEN.png') }}" alt="user">
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="content">

            @yield('header')
            @yield('content')

        </div>
    </div>

    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('assets/admin/js/contact-info.js') }}"></script>
    <script src="{{ asset('assets/admin/js/form.js') }}"></script>
    <script src="{{ asset('assets/admin/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
