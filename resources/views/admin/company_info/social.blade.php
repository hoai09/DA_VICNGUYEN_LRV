{{-- @extends('admin.layouts.home')       

@section('content') --}}
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>{{ config('apps.headtitle.title2') }}</h2>
        <ol class="breadcrumb" style="margin-bottom:10px;">
            <li>
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="active"><strong>{{ config('apps.headtitle.title2') }}</strong></li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h2 class="mb-4 text-black">Cập nhật Social Links</h2>
                
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                </div>
                <div class="ibox-content">
                    <form action="{{ route('admin.company_info.social') }}" method="POST">
                        @csrf
                        @method('PUT')
                
                        <div class="mb-3">
                            <label class="form-label fw-bold">Facebook Link</label>
                            <input type="url" name="facebook" class="form-control"
                                value="{{ $social->social_links['facebook'] ?? '' }}" placeholder="">
                        </div>
                
                        <div class="mb-3">
                            <label class="form-label fw-bold">Instagram Link</label>
                            <input type="url" name="instagram" class="form-control"
                                value="{{ $social->social_links['instagram'] ?? '' }}" placeholder="">
                        </div>
                
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email_social" class="form-control"
                                value="{{ $social->social_links['email_social'] ?? '' }}" placeholder="">
                        </div>
                    </form>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary mt-4">Cập nhật</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}
