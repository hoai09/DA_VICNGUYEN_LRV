
    @extends('sitevicnguyen.layouts.main')  
    @section('title','home')
    @section('content')
    <section id="mainscreen" class="splash container-fluid">
      <div class="splash__content">
        <p class="splash__text">
          WE AIM TO, AT ALL TIMES, PROVIDE OUR CUSTOMERS WITH THE MOST BEAUTIFUL
          3D IMAGES, ATTRACTIVE, POWERFUL & AS CLOSE TO REALITY AS POSSIBLE,
          THROUGH DIGITAL ART.
        </p>
      </div>

      <div class="splash__logo-block">
        <img
          src="{{asset('assets/img/logo1.svg')}}"
          alt="VC Architect Logo"
          class="splash__logo-img container-sm"
        />
      </div>

      <div class="splash__btn">
        <a
        href="{{ route('vicnguyen.trangchu') }}"
          class="btn btn-outline-light splash__start-link"
        >
          START
        </a>
      </div>
      <footer
    class="splash__footer d-flex justify-content-center align-items-center"
  >
    <a href="https://www.facebook.com/Vicnguyendesign" class="splash__social-item mt-10">
      <i class="fab fa-facebook-f splash__social-icon "></i>
    </a>

    <a href="https://www.instagram.com/vicnguyendesign/" class="splash__social-item mt-10">
      <i class="fab fa-instagram splash__social-icon "></i>
    </a>

    <a href="#!" class="splash__social-item mt-10">
      <i class="fas fa-envelope splash__social-icon "></i>
    </a>
  </footer>
    </section>
    @endsection
  
      