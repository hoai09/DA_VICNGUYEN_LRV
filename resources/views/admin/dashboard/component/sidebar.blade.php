<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="" />
                        </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Pham Xuan Ha</strong>
                        </span> <span class="text-muted text-xs block">Art <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="{{ route('admin.profile.edit') }}">Profile</a></li>
                        <li><a href="#">Quản lý tài khoản</a></li>
                        <li><a href="#">Mailbox</a></li>
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
                <a href="#"><i class="fa-solid fa-users"></i> <span class="nav-label">QL Thành Viên</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="#">QL Nhóm Thành Viên</a></li>
                    <li><a href="{{ route('admin.members.index') }}">QL Thành Viên</a></li>
                    
                </ul>
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
                    <li ><a href="{{ route('admin.form.index') }}">Thông tin KH</a></li>
                </ul>
            </li>

            <li >
                <a href="#"><i class="fa-solid fa-gear"></i> <span class="nav-label">Khác</span> <span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li > <a href="{{ route('admin.company_info.contact') }}">Thông tin liên hệ</a></li>
                    <li ><a href="{{ route('admin.company_info.studio') }}">Studio</a></li>
                    <li ><a href="{{ route('admin.company_info.social') }}">Link social</a></li>
                </ul>
            </li>
        </ul>

    </div>
</nav>