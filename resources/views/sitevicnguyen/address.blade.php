@extends('sitevicnguyen.layouts.main')  
@section('title','VICNGUYEN/address')
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
                  {{ $companyInfo->address }}
                </p>
              </section>
  
              <section class="address__mail address__intro d-flex">
                <img
                  src="{{ asset('assets/img/iconaddress/mail.svg') }}"
                  alt="Email"
                  class="address__icon"
                />
                <p class="address__content">{{ $companyInfo->email }}</p>
              </section>
  
              <section class="address__phone address__intro d-flex">
                <img
                  src="{{asset ('assets/img/iconaddress/phone.svg') }}"
                  alt="Số điện thoại"
                  class="address__icon"
                />
                <p class="address__content">{{ $companyInfo->phone }}</p>
              </section>
            </div>
  
            <div class="col-md-12 col-lg-6 address__image">
              <img
                src="{{asset ('storage/'.$companyInfo->map_image) }}"
                alt="Bản đồ địa chỉ"
                class="img-fluid img-address"
              />
            </div>
            
          </div>
        </div>
      </main>
    @endsection