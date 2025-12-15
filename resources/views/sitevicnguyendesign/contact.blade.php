@extends('sitevicnguyendesign.layout.maindesign')
    @section('title','contact')
    @section('content')
    <div class="page bg_contact" >
    <section id="main">
        <div class="container">
          <div class="contact">
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
            <form id="appForm" method="POST" action="{{ route('vicdesign.contact.store') }}" enctype="multipart/form-data">
                @csrf 
                  <label>Your name</label> 
                  <input name="name" id="fullname" type="input" placeholder="" ></br>
                  <label>Email</label>
                  <input name="email" id="from_email" type="input" placeholder="" ></br>
                  <label for="other">Object</label>
                  <input name="objects" id="Objects" type="input" placeholder="" ></br>
                  <label for="other">Your message</label>
                  <textarea name="content" id="content" rows="30" placeholder="" ></textarea>
                  <input type="submit" value="Send " name="subscribe" class="button submit" id="subscribe">
                  
                <div id="loading"><img src="{{ asset('assets/frontend/images/loading.gif') }}" /></div>
                  <div class="notice success">Send Succesfull!</div>
                  <div class="notice error">Fail! Send unsuccesfull!</div>
            </form>
          </div>
        </div>
        
      </section>
    </div>
    @endsection
    