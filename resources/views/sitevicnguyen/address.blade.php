@extends('sitevicnguyen.layouts.main')
    @section('title','address')
    @section('content')
    <main class="contact-main">
        <div class="container-sm address-page">
          <div class="row g-5 address-mobile-sm">
            <div class="col-md-12 col-lg-6 address__information">
              <section class="address__street address__intro d-flex">
                <img
                  src="{{ asset('assets/img/iconaddress/diachi.svg') }}"
                  alt="Địa chỉ"
                  class="address__icon"
                />
                <p class="address__content">
                  Bui Duong Lich 36, Son Tra district, Da Nang city, Vietnam
                  country
                </p>
              </section>
  
              <section class="address__mail address__intro d-flex">
                <img
                  src="{{ asset('assets/img/iconaddress/mail.svg') }}"
                  alt="Email"
                  class="address__icon"
                />
                <p class="address__content">vicnguyendesign@gmail.com</p>
              </section>
  
              <section class="address__phone address__intro d-flex">
                <img
                  src="{{asset ('assets/img/iconaddress/phone.svg') }}"
                  alt="Số điện thoại"
                  class="address__icon"
                />
                <p class="address__content">+84 369 753 758</p>
              </section>
            </div>
  
            <div class="col-md-12 col-lg-6 address__image">
              <img
                src="{{asset ('assets/img/address.png') }}"
                alt="Bản đồ địa chỉ"
                class="img-fluid img-address"
              />
            </div>
          </div>
        </div>
      </main>
    @endsection