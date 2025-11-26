@extends('sitevicnguyen.layouts.main') // trang studio
@section('title', 'Studio')
@section('content')

<main class="studio-page pt-5">
    <div class="container">

        @if($studio->studio_image)
        <section class="studio-hero-sm row mb-5">
            <div class="col-12 p-1">
                <figure class="studio-hero__figure">
                    <img 
                        src="{{ asset('storage/' . $studio->studio_image) }}" 
                        alt="{{ $studio->slug ?? 'studio' }}" 
                        class="studio-hero__image img-fluid">
                </figure>
            </div>
        </section>
        @endif

        <section class="studio-content-sm row prj__bt">
            <div class="col-12 p-1">

                @if(!empty($studio->studio_content))
                <div class="studio-content__intro mb-5">
                    <p class="studio-content__text">
                        {!! nl2br(e($studio->studio_content)) !!}
                    </p>
                </div>
                @endif

                @if(!empty($studio->awards) && is_array($studio->awards))
                <div class="awards-section">
                    <h2 class="awards-section__title visually-hidden">Awards</h2>
                    <ul class="awards-section__list list-unstyled">
                        @foreach($studio->awards as $award)
                        <li class="awards-section__item">
                            <span class="awards-section__text">{{ $award }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

            </div>
        </section>
    </div>
</main>

@endsection
