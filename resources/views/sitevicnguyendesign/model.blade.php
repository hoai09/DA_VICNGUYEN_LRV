@extends('sitevicnguyendesign.layout.maindesign')
    @section('title','model')
    @section('video1')
    <div id="slides">
        <video autoplay loop id="video-background" poster="{{ asset('assets/frontend/images/bg1.jpg') }}">
          <source src="https://vicnguyendesign.org/frontend/images/clip.mp4" type="video/mp4">
        </video>
    </div>
    @endsection