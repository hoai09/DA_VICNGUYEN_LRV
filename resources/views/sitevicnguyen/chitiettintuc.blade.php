@extends('sitevicnguyen.layouts.main') 
    @section('title','chitiettintuc')
    @section('content')

<main class="single-news-page container">
    <div class="row g-5">
        <div class="col-12 col-lg-8 single-news__content prj__bt">
            <header class="single-news__header mb-4">
                <p class="single-news__category">
                    {{ $category->title ?? ($newsDetail->category->title ?? $news->category->title ?? '') }}
                </p>
                <h1 class="single-news__title">
                    {{ $newsDetail->title ?? $news->title ?? '-' }}
                </h1>
            </header>

            <div class="single-news__text-block mb-4">
                {!! $newsDetail->content ?? $news->content ?? '' !!}
            </div>
    </div>
        
        <div class="col-lg-4 d-none d-lg-block single-news__sidebar">
            <div class="sidebar-box">
                <h5 class="sidebar-box__title mb-4">BÀI VIẾT KHÁC</h5>

                @forelse($relatedNews as $item)
                <a href="{{ route('vicnguyen.news.detail', $item->slug) }}" class="sidebar-news-item d-flex mb-3">
                    <div class="sidebar-news-item__thumb me-3">
                        <img src="{{ asset('storage/'.$item->image) }}" 
                            alt="{{ $item->title }}"
                            class="img-fluid">
                    </div>
                    <div class="sidebar-news-item__info">
                        <p class="sidebar-news-item__title">{{ $item->title }}</p>
                    </div>
                </a>
                <hr class="my-3">
                @empty
                <p>Không có bài viết liên quan.</p>
                @endforelse
            </div>
        </div>

    </div>
</main>
@endsection
