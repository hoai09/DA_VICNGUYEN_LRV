<!-- main -->
@extends('sitevicnguyen.layouts.main') // hiển thị dự án
    @section('title','project')
    @section('content')
    <main class="project-page">
    <header class="project-header container">
        <h1 class="project-header__title">{{ $project->title }}</h1>
    </header>

    <section class="project-intro container">
        <div class="project-p1 row g-4">
            <div class="project-intro__details col-12 col-lg-4">
                <div class="info-block">
                    <div class="info-block__item d-flex justify-content-between">
                        <span class="info-block__label">Thể loại</span>
                        <span class="info-block__value">{{ $project->category ?? '_' }}</span>
                    </div>

                    <div class="info-block__item d-flex justify-content-between">
                        <span class="info-block__label">Địa chỉ</span>
                        <span class="info-block__value">{{ $project->address ?? '_' }}</span>
                    </div>

                    <div class="info-block__item d-flex justify-content-between">
                        <span class="info-block__label">Thời gian</span>
                        <span class="info-block__value">{{ $project->start_year ?? 'N/A' }}</span>
                    </div>

                    <div class="info-block__item d-flex justify-content-between">
                        <span class="info-block__label">Diện tích</span>
                        <span class="info-block__value">{{ $project->acreage ?? '_' }}</span>
                    </div>

                    <div class="info-block__item d-flex justify-content-between">
                        <span class="info-block__label">Trạng thái</span>
                        <span class="info-block__value {{ $project->status === '_' ? 'info-block__value--completed' : '' }}">
                            {{ $project->status ?? '_' }}
                        </span>
                    </div>
                    
                    @if($project->members->count())
                    <div class="info-block__item info-block__item--design d-flex justify-content-between mt-4 pt-3">
                        <span class="info-block__label">Nhóm thiết kế</span>
                        <div class="info-block__designers text-end">
                            @forelse($project->members as $member)
                                <p class="info-block__value mb-0">{{ $member->name }}</p>
                            @empty
                                <p class="text-muted">Chưa có thành viên</p>
                            @endforelse
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-12 col-lg-2"></div>

            <div class="project-intro__description-sm col-12 col-lg-6">
                <p class="description__text lh-base">
                    {{ $project->description }}
                </p>
            </div>
        </div>
    </section> 
    @if($project->images->count())
    <section class="project-gallery mt-5">
        <div class="container">
            <div class="gallery__grid prj__bt align-items-center row g-4">
                @forelse($project->images as $image)
                    <div class="gallery__item col-sm-6 col-md-3">
                        <img
                            src="{{ asset('storage/'.$image->image_path) }}"
                            alt="{{ $project->caption }}"
                            class="gallery__image img-fluid"
                        />
                    </div>
                @empty
                    <p class="text-center text-muted">Chưa có hình ảnh cho dự án này.</p>
                @endforelse
        
        </div>
    </div>
    </section>
    @endif
</main>
@endsection