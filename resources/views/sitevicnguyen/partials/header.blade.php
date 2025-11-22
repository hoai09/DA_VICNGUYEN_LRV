@php
    use App\Models\Project;

    // Lấy danh sách dự án mới nhất (ví dụ 15 dự án)
    $projects = Project::select('title','slug')
        ->orderBy('created_at', 'desc')
        ->take(15)
        ->get();
@endphp

<header
      class="main-header pb-xs-0 pb-sm-0 pb-md-0 pb-lg-5 navbar navbar-expand-lg bg-white"
    >
      <div class="container main-header__wrapper ">
      
        <div class="d-flex align-items-center">
          <button
            class="navbar-toggler border-0  "
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavbar"
            aria-controls="mainNavbar"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- Logo -->
          <a
          href="{{ route('vicnguyen.home') }}"
          class="main-header__logo-link mb-lg-4 navbar-brand"
        >
          <img
            src="{{ asset('assets/img/logo.svg') }}"
            alt="VICNGUYEN"
            class="main-header__logo"
          />
      </a>
        </div>
        <!-- Nav -->
        <nav
          class="main-header__nav collapse navbar-collapse justify-content-center"
          id="mainNavbar"
        >
          <div class="menu-main d-flex align-items-center">
            <ul
              id="menu__list--pc"
              class="main-header__nav-list navbar-nav flex-lg-row flex-column align-items-lg-center p-0 list-unstyled"
            >
              <li class="nav-item dropdown mx-lg-3">
                <a
                  href="#"
                  class="nav-link dropdown-toggle"
                  id="projectdropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  >Dự án</a
                >
            <ul class="dropdown-menu" aria-labelledby="projectdropdown">
                  @foreach($allProjects as $project)
              <li>
                  <a class="dropdown-item" href="{{ route('vicnguyen.projects.show', $project->slug) }}">
                {{ $project->title }}
                  </a>
              </li>
                  @endforeach
            </ul>
              </li>
              <li class="nav-item dropdown mx-lg-3">
                <a
                  class="nav-link dropdown-toggle"
                  id="vicerDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  >VICer</a
                >
                <ul class="dropdown-menu" aria-labelledby="vicerDropdown">
                  <li>
                    <a class="dropdown-item" href="{{route('vicnguyen.studio') }}">Studio</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('vicnguyen.members.index') }}">Thành viên</a>
                  </li>
                </ul>
              </li>
              <li class="nav-item mx-lg-3">
                <a href="{{route('vicnguyen.news.index')}}" class="nav-link">Tin tức</a>
              </li>
              <li class="nav-item dropdown mx-lg-3">
                <a
                  class="nav-link dropdown-toggle"
                  id="contactDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  >Liên hệ</a
                >
                <ul class="dropdown-menu" aria-labelledby="contactDropdown">
                  <li>
                    <a class="dropdown-item" href="{{ route('vicnguyen.address.index') }}">Địa chỉ</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('vicnguyen.infomation') }}"
                      >Phiếu thông tin</a
                    >
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
