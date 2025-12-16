<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="{{ asset('assets/img/admin_3093042.png') }}"
                        width="42" height="42"
                        style="object-fit: cover; background-color:rgb(240, 255, 240);" />
                        </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{ auth()->user()->name }}</strong>
                        </span> <span class="text-muted text-xs block">{{ ucfirst(auth()->user()->role) }} <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('admin.profile.edit') }}">Profile</a></li>

                        @if(auth()->user()->role === 'admin')
                        <li><a href="{{ route('admin.user.index') }}">Quản lý tài khoản</a></li>
                        @endif
                        
                        <li><a href="{{ route('admin.form.index') }}">Form liên hệ</a></li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Log out
                            </a>
                        
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="logo-element">
                    VIC
                </div>
            </li>
            <li class="active">
                <a href="{{ route('admin.members.index') }}"><i class="fa-solid fa-users"></i> <span class="nav-label">QL Thành Viên</span></a>
                {{-- <ul class="nav nav-second-level">
                    <li><a href="#">QL Nhóm Thành Viên</a></li>
                    <li><a href="">QL Thành Viên</a></li>
                    
                </ul> --}}
            </li>

            <li >
                <a href="#"><i class="fa-solid fa-diagram-project"></i> <span class="nav-label">Dự Án</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('admin.projects.index') }}">QL Dự Án</a></li>
                    <li ><a href="{{ route('admin.project_images.index') }}">QL Ảnh Dự Án</a></li>
                    
                </ul>
            </li>
            
            <li>
                <a href="{{ route('admin.news.index') }}">
                    
                    <i class="fa-regular fa-newspaper"></i>
                    
                    <span class="title">Quản Lí Tin Tức</span></a>
            </li>

            <li >
                <a href="#"><i class="fa-brands fa-wpforms"></i> <span class="nav-label">Quản Lý thông tin KH</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="{{ route('admin.form.index') }}">Liên hệ tư vấn KH</a></li>
                    <li ><a href="{{ route('admin.formPortfolio.index') }}">Thông tin KH</a></li>
                </ul>
            </li>

            <li >
                <a href="#"><i class="fa-solid fa-gear"></i> <span class="nav-label">Khác</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li > <a href="{{ route('admin.company_info.contact') }}">Địa chỉ liên hệ</a></li>
                    <li ><a href="{{ route('admin.company_info.studio') }}">Studio</a></li>
                    <li ><a href="{{ route('admin.company_info.social') }}">Link social</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>