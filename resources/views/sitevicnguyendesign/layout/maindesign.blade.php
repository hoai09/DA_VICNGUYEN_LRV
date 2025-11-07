<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Vic Nguyen Design</title>
		<meta property="og:type" content="website" />
		<meta property="og:title" content="Vic Nguyen Design | vicnguyendesign.org" />
		<meta property="og:url" content="https://vicnguyendesign.org" />
		<meta property="og:image:url" content="https://vicnguyendesign.org" />
		<meta property="og:image" content="https://vicnguyendesign.org" />
		<meta property="og:site_name" content="Vic Nguyen Design | vicnguyendesign.org" />
		<meta property="og:description" content="We aim to, at all times, provide our customers with the most Beautiful 3D Images, Attractive, Powerful & as close to Reality as possible, through Digital Art." />
		<meta name="keywords" content="vic nguyen design, vicnguyen design, vicnguyendesign"></meta>
		<meta name="robots" content="index,follow" />
		<meta name="description" content="We aim to, at all times, provide our customers with the most Beautiful 3D Images, Attractive, Powerful & as close to Reality as possible, through Digital Art."></meta>
		<meta name="alexa" content="100">
		<meta name="google-site-verification" content="" />
		<meta name="revisit" content="2 days">
		<meta name="revisit-after" content="2 days">
		<meta name="copyright" content="Vic Nguyen Design" />
		<meta name="author" content="Vic Nguyen Design" />
		<base target='_self'/><link rel="shortcut icon" type="text/css" href="{{ asset('assets/frontend/favicon.ico') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/library/fancybox/jquery.fancybox.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/component.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/library/fancybox/helpers/jquery.fancybox-thumbs.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('assets/frontend/css/style.css') }}" />
<script type="text/javascript">var url = "https://vicnguyendesign.org') }}";</script>
<script type="text/javascript" src="{{ asset('assets/library/jQuery/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/library/fancybox/jquery.mousewheel-3.0.6.pack.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/library/fancybox/jquery.fancybox.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/library/fancybox/jquery.fancybox.pack.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/library/fancybox/helpers/jquery.fancybox-thumbs.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/js/modernizr.custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/js/masonry.pkgd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/js/imagesloaded.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/js/classie.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/frontend/js/AnimOnScroll.js') }}"></script>
	</head>
	<div class="page @yield('title')">

    <body>
        @include('sitevicnguyendesign.partial.header')
		
		@include('sitevicnguyendesign.partial.top')
		@yield('video1')
		
		@yield('content')
        @include('sitevicnguyendesign.partial.footer')
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script data-cfasync="false" src="{{asset('cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>
		<script type="text/javascript">
        $(document).ready(function() {
            $('button.rd-mobilepanel_toggle').click(function(event) {
                $(this).toggleClass("active");
                $( ".rd-mobilemenu" ).toggleClass('active', $(this).hasClass('active'));
            });
        });
        </script>
		
		
        @yield('scripts')
    </body>
    </html>