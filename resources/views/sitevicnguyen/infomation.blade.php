@extends('sitevicnguyen.layouts.main')
@section('title', 'infomation')
@section('content')
<main class="form-page-content-wrapper container d-flex justify-content-center prj__bt">
  @if (session('success'))
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
          icon: 'success',
          title: 'Thành công!',
          text: @json(session('success')),
          showConfirmButton: false,
          timer: 2500
        });
      });
    </script>
  @endif

  @if ($errors->any())
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
          icon: 'error',
          title: 'Đã xảy ra lỗi!',
          html: `{!! implode('<br>', $errors->all()) !!}`,
          confirmButtonText: 'Đóng'
        });
      });
    </script>
  @endif

  <form class="form_stock_information" action="{{ route('vicnguyen.infomation.store') }}" method="POST">
    @csrf
    <div class="infomation-mobile d-flex justify-content-between align-items-center mb-5">
      <h4 class="title_def">THÔNG TIN DỰ ÁN</h4>
      <button class="btn_frm_stock_info" type="submit">Gửi</button>
    </div>

    <div class="frm-all">
      <div class="box-group row mb-4">
        <div class="box box--half-width col-6">
          <div class="title mb-4">1. Thông tin cá nhân</div>
          <div class="frm-group-row mb-3">
            <label for="full_name" class="form-label">Họ và tên</label>
            <input type="text" class="form-control" name="full_name" id="full_name" />
          </div>
          <div class="frm-group-row mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" />
          </div>
          <div class="frm-group-row mb-3">
            <label for="job" class="form-label">Nghề nghiệp</label>
            <input type="text" class="form-control" name="job" id="job" />
          </div>
          <div class="frm-group-row-split d-flex">
            <div class="frm-group-split col">
              <label for="age" class="form-label">Tuổi</label>
              <input type="text" class="form-control" name="age" id="age" />
            </div>
            <div class="frm-group-split col ms-2">
              <label for="phone" class="form-label">Số điện thoại</label>
              <input type="text" class="form-control" name="phone" id="phone" />
            </div>
          </div>
        </div>

        <div class="box box--half-width col-6">
          <div class="title mb-4">2. Thông tin dự án</div>
          <div class="frm-group-row mb-3">
            <label for="type" class="form-label">Loại hình</label>
            <input type="text" class="form-control" name="type" id="type" />
          </div>
          <div class="frm-group-row mb-3">
            <label for="acreage" class="form-label">Diện tích</label>
            <input type="text" class="form-control" name="acreage" id="acreage" />
          </div>
          <div class="frm-group-row mb-3">
            <label for="scale" class="form-label">Quy mô</label>
            <input type="text" class="form-control" name="scale" id="scale" />
          </div>
          <div class="frm-group-row mb-3">
            <label for="address" class="form-label">Địa điểm</label>
            <input type="text" class="form-control" name="address" id="address" />
          </div>
        </div>
      </div>

      <div class="box-group row mb-4">
        <div class="box box--half-width col-6">
          <div class="title mb-4">3. Thông tin chi tiết</div>
          <div class="frm-group-row mb-3">
            <label for="a_cost_estimates" class="form-label">a. Nhà ở - Chi phí dự trù đầu tư</label>
            <input type="text" class="form-control" name="a_cost_estimates" id="a_cost_estimates" />
          </div>
          <div class="frm-group-row mb-3">
            <label for="number_people" class="form-label">a1. Số người sinh hoạt thường xuyên</label>
            <input type="text" class="form-control" name="number_people" id="number_people" />
          </div>
          <div class="frm-group-row mb-3">
            <label for="function_room_number" class="form-label">a2. Số phòng chức năng mong muốn</label>
            <input type="text" class="form-control" name="function_room_number" id="function_room_number" />
          </div>
          <div class="frm-group-row mb-3">
            <label for="b_cost_estimates" class="form-label">b. Công trình khác - Chi phí dự trù đầu tư</label>
            <input type="text" class="form-control" name="b_cost_estimates" id="b_cost_estimates" />
          </div>
          <div class="frm-group-row mb-3">
            <label for="function_description" class="form-label">b1. Mô tả chức năng</label>
            <textarea id="function_description" name="function_description" class="form-control" rows="4"></textarea>
          </div>
        </div>

        <div class="box box--half-width col-6">
          <div class="title mb-4">4. Thông tin khác</div>
          <div class="frm-group-row mb-3">
            <label for="design_progress" class="form-label">Tiến độ mong muốn thiết kế</label>
            <input type="text" class="form-control" name="design_progress" id="design_progress" />
          </div>
          <div class="frm-group-row mb-3">
            <label for="finishing_progress" class="form-label">Tiến độ mong muốn hoàn thiện</label>
            <input type="text" class="form-control" name="finishing_progress" id="finishing_progress" />
          </div>
          <div class="frm-group-row mb-3">
            <label for="hobby_habit" class="form-label">Sở thích, thói quen</label>
            <textarea id="hobby_habit" name="hobby_habit" rows="3" class="form-control"></textarea>
          </div>
          <div class="frm-group-row mb-3">
            <label for="why_do_you_know" class="form-label">Vì sao anh/chị biết tới VIC?</label>
            <textarea id="why_do_you_know" name="why_do_you_know" rows="3" class="form-control"></textarea>
          </div>
        </div>
      </div>
    </div>
  </form>
</main>
@endsection
