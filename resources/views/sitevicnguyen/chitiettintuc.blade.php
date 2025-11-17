@extends('sitevicnguyen.layouts.main')
    @section('title','chitiettintuc')
    @section('content')

<main class="single-news-page container">
    <div class="row g-5">
    <div class="col-12 col-lg-8 single-news__content prj__bt">
        <header class="single-news__header mb-4">
        <p class="single-news__title">ANPHA OFFICE / AD9 ARCHITECTS</p>
        </header>

        <figure class="single-news__feature-figure mb-4">
        <img
            src="{{ asset('assets/img/TinTuc/chitiettin1.png') }}"
            alt="chitiettin1"
            class="single-news__feature-image img-fluid"
        />
        </figure>

        <div class="single-news__text-block mb-4">
        <p>
            Text description provided by the architects. Anpha office was
            formed after some big changes regarding its function from the
            investor. At first, we were tasked with creating a house for 5
            family members, including a grandmother, a married couple and
            their two children. We are getting more accustomed to Saigon
            housing projects, however this construction has a big length, and
            we want to utilize that feature to create spaces that are
            interactive and connective for family members. We reserved a large
            portion of the length for the skylight, which is the main space to
            connect the rest of the spaces in the house, the activities, the
            balance between static and non-static, air movement, light and
            nature.
        </p>
        </div>

        <div class="row g-1 mb-5">
        <div class="col-5">
            <img
            src="{{asset ('/assets/img/TinTuc/chitiettin2-1.png') }}"
            alt="anh001"
            class="img"
            />
        </div>
        <div class="col-7">
            <img
            src="{{asset ('assets/img/TinTuc/chitiettin2-2.png') }}"
            alt="anh002"
            class="img"
            />
        </div>
        </div>

        <div class="single-news__text-block mb-4">
        <p>
            When the base of the construction was done, the investor shared
            with us his wish to convert the construction’s function to serve
            the purpose of running a mid-size family business, specializing in
            Medicine and Medical Equipment. This was the most difficult part
            for us during the whole project, since the construction base was
            done for a family housing. Fortunately, each office of Anpha
            company has only 5-8 employees, that makes utilizing the existing
            rooms feasible. We used glass walls to maximize the use of nature
            spaces from the skylight, so almost all of the working spaces are
            surrounded with two layers of nature, the company’s daily life is
            also more interesting since the employees can always see each
            other, they can indulge in the natural atmosphere, the freshness
            of the trees. This is a feature that we are sure offices in
            skyscrapers cannot benefit from.
        </p>
        </div>

        <figure class="single-news__feature-figure mb-4">
        <img
            src="{{asset ('assets/img/TinTuc/chitiettin3.png') }}"
            alt="anh003"
            class="single-news__feature-image img-fluid"
        />
        </figure>

        <div class="single-news__text-block mb-4">
        <p>
            We’ve recordeded photos of Anpha company after 2 operation years,
            in order to fully understand that what we created were going in
            the right direction, and to serve as inspiration for our future
            projects.
        </p>
        </div>
    </div>
        
        <div class="col-lg-4 d-none d-lg-block single-news__sidebar">
            <div class="sidebar-box">
                <h5 class="sidebar-box__title mb-4">BÀI VIẾT KHÁC</h5>

                @forelse($relatedNews as $item)
                <a href="{{ route('vicnguyen.news.detail', $item->id) }}" class="sidebar-news-item d-flex mb-3">
                    <div class="sidebar-news-item__thumb me-3">
                        <img src="{{ asset($item->feature_image) }}" 
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
