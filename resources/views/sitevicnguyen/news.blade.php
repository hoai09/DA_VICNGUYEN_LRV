@extends('sitevicnguyen.layouts.main')
@section('title','Tin tức')
@section('content')
<main class="news-page container py-lg-5 py-md-5 py-sm-2">
    <div class="news-grid row row-cols-sm-1 row-cols-md-2 row-cols-lg-2 g-5 mb-5">

        @foreach($news as $newsdetail)
        <div class="col">
            <a href="{{ route('vicnguyen.news.detail', ['slug' => $newsdetail->slug]) }}">

                <figure class="news-card__figure mb-3">
                    @if($newsdetail->image)
                    <img
                        src="{{ asset('storage/'.$newsdetail->image) }}"
                        alt="{{ $newsdetail->title }}"
                        class="news-card__image img-fluid"
                    />
                    @else
                    <img
                        src="{{ asset('images/default-news.jpg') }}"
                        alt="Default Image"
                        class="news-card__image img-fluid"
                    />
                    @endif
                </figure>
                <div class="news-card__info">
                    <div class="news-card__title d-flex">
                        <h3 class="news-card__title">{{ $newsdetail->title }}</h3>
                        <p class="news-card__date">{{ $newsdetail->published_at ? $newsdetail->published_at->format('d/m/Y') : '' }}</p>
                    </div>
                    <div class="member-modal__divider"></div>
                    <p class="news-card__excerpt">
                        {{ $newsdetail->summary }}
                    </p>
                    <a href="Backyardhouse.vic.vn">Backyardhouse.vic.vn</a>

                </div>
            </a>
        </div>
        @endforeach

    </div>
    <div class="d-flex justify-content-center">
        {{ $news->links('vendor.pagination.bootstrap-5') }}
    </div>
</main>
@endsection
