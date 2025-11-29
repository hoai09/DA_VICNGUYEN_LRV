@extends('sitevicnguyen.layouts.main') 
    @section('title','trangchu')
    @section('content')
    
    <!-- main -->
    <main class="main-gallery pt-md-5 pt-lg-5 pb-lg-6 pb-md-6 pt-sm-0 pb-sm-3">
      <div class="container">
        <div class="gallery__grid place-item-center">
          <div class="row g-4">
            <div class="col-6 col-xs-6 col-sm-6 col-md-4">
              <div class="gallery__item">
                <img
                  src="{{ asset('assets/img/topbody01.png') }}"
                  alt="Anh 1"
                  class="gallery__image img-fluid"
                />
              </div>
            </div>

            <div class="col-6 col-xs-6 col-sm-6 col-md-4">
              <div class="gallery__item position-relative">
                <img
                  src="{{ asset('assets/img/tobody02.png') }}"
                  alt="NGUYET HOUSE"
                  class="gallery__image img-fluid"
                />
                <div
                  class="overlay__container position-absolute top-0 start-0 d-flex justify-content-center align-items-center w-100 h-100"
                >
                  <p class="gallery__content text-white">NGUYET HOUSE</p>
                </div>
              </div>
            </div>

            <div class="col-6 col-xs-6 col-sm-6 col-md-4">
              <div class="gallery__item">
                <img
                  src="{{ asset('assets/img/tobody03.png') }}"
                  alt="Anh 3"
                  class="gallery__image img-fluid"
                />
              </div>
            </div>

            <div class="col-6 col-xs-6 col-sm-6 col-md-4">
              <div class="gallery__item">
                <img
                  src="{{ asset('assets/img/body1-1.png') }}"
                  alt="Anh 4"
                  class="gallery__image img-fluid"
                />
              </div>
            </div>

            <div class="col-6 col-xs-6 col-sm-6 col-md-4">
              <div class="gallery__item">
                <img
                  src="{{ asset('assets/img/body1-2.png') }}"
                  alt="Anh 5"
                  class="gallery__image img-fluid"
                />
              </div>
            </div>

            <div class="col-6 col-xs-6 col-sm-6 col-md-4">
              <div class="gallery__item">
                <img
                  src="{{ asset('assets/img/body1-3.png') }}"
                  alt="Anh 6"
                  class="gallery__image img-fluid"
                />
              </div>
            </div>

            <div class="col-6 col-xs-6 col-sm-6 col-md-4">
              <div class="gallery__item">
                <img
                  src="{{ asset('assets/img/body2-1.png') }}"
                  alt="Anh 7"
                  class="gallery__image img-fluid"
                />
              </div>
            </div>

            <div class="col-6 col-xs-6 col-sm-6 col-md-4">
              <div class="gallery__item">
                <img
                  src="{{ asset('assets/img/body2-2.png') }}"
                  alt="Anh 8"
                  class="gallery__image img-fluid"
                />
              </div>
            </div>

            <div class="col-6 col-xs-6 col-sm-6 col-md-4">
              <div class="gallery__item">
                <img
                  src="{{ asset('assets/img/body2-3.png') }}"
                  alt="Anh 9"
                  class="gallery__image img-fluid"
                />
              </div>
            </div>

            <div class="col-6 col-xs-6 col-sm-6 col-md-4">
              <div class="gallery__item">
                <img
                  src="{{ asset('assets/img/body3-1.png') }}"
                  alt="Anh 11"
                  class="gallery__image img-fluid"
                />
              </div>
            </div>

            <div class="col-6 col-xs-6 col-sm-6 col-md-4">
              <div class="gallery__item">
                <img
                  src="{{ asset('assets/img/body3-2.png') }}"
                  alt="Anh 12"
                  class="gallery__image img-fluid"
                />
              </div>
            </div>

            <div class="col-6 col-xs-6 col-sm-6 col-md-4">
              <div class="gallery__item">
                <img
                  src="{{ asset('assets/img/body3-3.png') }}"
                  alt="Anh 13"
                  class="gallery__image img-fluid"
                />
              </div>
            </div>

            <div class="col-6 col-xs-6 col-sm-6 col-md-4">
              <div class="gallery__item">
                <img
                  src="{{ asset('assets/img/body4-1.png') }}"
                  alt="Anh 14"
                  class="gallery__image img-fluid"
                />
              </div>
            </div>
            <div class="col-6 col-xs-6 col-sm-6 col-md-4">
              <div class="gallery__item">
                <img
                  src="{{ asset('assets/img/body4-2.png') }}"
                  alt="Anh 15"
                  class="gallery__image img-fluid"
                />
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
@endsection
    