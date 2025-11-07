@extends('sitevicnguyendesign.layout.maindesign')
    @section('title','about')
    @section('video1')
    <div id="slides">
        <video autoplay loop id="video-background" poster="frontend/images/bg1.jpg">
          <source src="frontend/images/clip.mp4" type="video/mp4">
        </video>
    </div>
    @endsection