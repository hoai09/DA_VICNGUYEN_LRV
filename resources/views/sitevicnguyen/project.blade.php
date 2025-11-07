<!-- main -->
@extends('sitevicnguyen.layouts.main')
    @section('title','project')
    @section('content')
<main class="project-page">
    <header class="project-header container">
      <h1 class="project-header__title">NGUYET HOUSE</h1>
    </header>

    <section class="project-intro container">
      <div class="project-p1 row g-4">
        <div class="project-intro__details col-12 col-lg-4">
          <div class="info-block">
            <div class="info-block__item d-flex justify-content-between">
              <span class="info-block__label">Thể loại</span>
              <span class="info-block__value">Nhà ở</span>
            </div>

            <div class="info-block__item d-flex justify-content-between">
              <span class="info-block__label">Địa chỉ</span>
              <span class="info-block__value">Đồng Bằng - Thái Nguyên</span>
            </div>

            <div class="info-block__item d-flex justify-content-between">
              <span class="info-block__label">Thời gian</span>
              <span class="info-block__value">2022</span>
            </div>

            <div class="info-block__item d-flex justify-content-between">
              <span class="info-block__label">Diện tích</span>
              <span class="info-block__value">400m2</span>
            </div>

            <div class="info-block__item d-flex justify-content-between">
              <span class="info-block__label">Trạng thái</span>
              <span class="info-block__value info-block__value--completed"
                >Hoàn thành</span
              >
            </div>

            <div
              class="info-block__item info-block__item--design d-flex justify-content-between mt-4 pt-3"
            >
              <span class="info-block__label">Nhóm thiết kế</span>
              <div class="info-block__designers text-end">
                <p class="info-block__value mb-0">Hưng Đào</p>
                <p class="info-block__value mb-0">Ngọc Hoàng</p>
                <p class="info-block__value mb-0">Cường Vũ</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-2"></div>

        <div class="project-intro__description-sm col-12 col-lg-6">
          <p class="description__text">
            Luu house là công trình nhà ở cho gia đình 3 thế hệ được xây dựng
            với diện tích khiêm tốn. Khách hàng của chúng tôi là một cán bộ về
            hưu với mong muốn ngôi nhà là nơi khang trang, tươm tất để chứa
            đựng những niềm vui sum vầy cùng con cháu khi về già. Khối chức
            năng sinh hoạt chung và đảm bảo số lượng phòng ngủ là những yêu
            cầu cơ bản. Chúng tôi tạo ra một giếng trời lớn ở giữa nhà và sử
            dụng giải pháp lệch tầng cho các khối chức năng rồi liên kết lại
            bằng các hệ cầu thang, trục giao thông hình thành và biến đổi tự
            nhiên theo hướng phát triển không gian chức năng. Một khoảng rỗng
            lớn được thiết lập để duy trì tính cân bằng cho không gian, giúp
            lưu thông không khí và điều tiết ánh sáng tự nhiên. Các phòng chức
            năng vẫn đảm bảo trang thái riêng tư và mở khi cần, gợi mở hơn về
            một không gian sẽ kết nối thật nhiều tình yêu
          </p>
        </div>
      </div>
    </section>

    <section class="project-gallery mt-5">
      <div class="container">
        <div class="gallery__grid prj__bt align-items-center row g-4">
          <div class="gallery__item col-xs-6 col-sm-6 col-md-3">
            <img
              src="{{ asset('assets/img/page2/project1-1.png') }}"
              alt="Anh project01"
              class="gallery__image img-fluid"
            />
          </div>
          <div class="gallery__item col-sm-6 col-md-3">
            <img
              src="{{ asset('assets/img/page2/project1-2.png') }}"
              alt="Ảnh project02"
              class="gallery__image img-fluid"
            />
          </div>
          <div class="gallery__item col-sm-6 col-md-3">
            <img
              src="{{ asset('assets/img/page2/project1-3.png') }}"
              alt="ảnh project03"
              class="gallery__image img-fluid"
            />
          </div>
          <div class="gallery__item col-sm-6 col-md-3">
            <img
              src="{{ asset('assets/img/page2/proeject1-4.png') }}"
              alt="ảnh project04"
              class="gallery__image img-fluid"
            />
          </div>
          <div class="gallery__item col-sm-6 col-md-3">
            <img
              src="{{ asset('assets/img/page2/project2-1.png') }}"
              alt="ảnh prj05"
              class="gallery__image img-fluid"
            />
          </div>
          <div class="gallery__item col-sm-6 col-md-3">
            <img
              src="{{ asset('assets/img/page2/project2-2.png') }}"
              alt="anh prj06"
              class="gallery__image img-fluid"
            />
          </div>
          <div class="gallery__item col-sm-6 col-md-3">
            <img
              src="{{ asset('assets/img/page2/Project2-4.png') }}"
              alt="anh prj07"
              class="gallery__image img-fluid"
            />
          </div>
          <div class="gallery__item col-sm-6 col-md-3">
            <img
              src="{{ asset('assets/img/page2/project3-4.png') }}"
              alt="anh prj08"
              class="gallery__image img-fluid"
            />
          </div>
          <div class="gallery__item col-sm-6 col-md-3">
            <img
              src="{{ asset('assets/img/page2/project3-1.png') }}"
              alt="anh prj09"
              class="gallery__image img-fluid"
            />
          </div>
          <div class="gallery__item col-sm-6 col-md-3">
            <img
              src="{{ asset('assets/img/page2/project3-2.png') }}"
              alt="anh prj10"
              class="gallery__image img-fluid"
            />
          </div>
          <div class="gallery__item col-sm-6 col-md-3">
            <img
              src="{{ asset('assets/img/page2/project3-3.png') }}"
              alt="anh prj11"
              class="gallery__image img-fluid"
            />
          </div>
          <div class="gallery__item col-sm-6 col-md-3">
            <img
              src="{{ asset('assets/img/page2/project1-3.png') }}"
              alt="anh prj12"
              class="gallery__image img-fluid"
            />
          </div>
          <div class="gallery__item col-sm-6 col-md-3">
            <img
              src="{{ asset('assets/img/page2/project4-1.png') }}"
              alt="anh prj13"
              class="gallery__image img-fluid"
            />
          </div>
          <div class="gallery__item col-sm-6 col-md-3">
            <img
              src="{{ asset('assets/img/page2/project4-2.png') }}"
              alt="anh prj14"
              class="gallery__image img-fluid"
            />
          </div>
        </div>
      </div>
    </section>
  </main>
  @endsection