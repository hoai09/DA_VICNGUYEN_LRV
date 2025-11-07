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
                  href="{{ route('vicnguyen.project') }}"
                  class="nav-link dropdown-toggle"
                  id="projectdropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  >Dự án</a
                >
                <ul class="dropdown-menu" aria-labelledby="projectdropdown">
                  <li>
                    <a class="dropdown-item" href="{{ route('vicnguyen.project') }}">TON PROJECT</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('vicnguyen.project') }}"
                      >DA NANG VILLA</a
                    >
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('vicnguyen.project') }}">LUU HOUSE</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('vicnguyen.project') }}"
                      >BEN TRE HOTEL</a
                    >
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('vicnguyen.project') }}">TDR HOUSE</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('vicnguyen.project') }}">MEY.VINH</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('vicnguyen.project') }}">LVS.HOUSE</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('vicnguyen.project') }}">KOMOREBI 2</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('vicnguyen.project') }}">KA HOUSE</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('vicnguyen.project') }}">SUSHI HARU</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('vicnguyen.project') }}">D8 HOUSE</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('vicnguyen.project') }}"
                      >LONG AN HOUSE</a
                    >
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('vicnguyen.project') }}"
                      >ALPHA OFFICE</a
                    >
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('vicnguyen.project') }}">KSS HOUSE</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('vicnguyen.project') }}">YEN THO</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{ route('vicnguyen.project') }}"
                      >OCEAN RESORT</a
                    >
                  </li>
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
                <a href="{{route('vicnguyen.news')}}" class="nav-link">Tin tức</a>
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
                    <a class="dropdown-item" href="{{ route('vicnguyen.address') }}">Địa chỉ</a>
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
