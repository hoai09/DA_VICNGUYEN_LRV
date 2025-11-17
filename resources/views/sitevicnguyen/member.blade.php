@extends('sitevicnguyen.layouts.main')
@section('title', 'member')

@section('content')
<main class="members-page container py-5">
    <div class="member-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 prj__bt">
        @foreach ($members as $index => $member)
            <div class="col">
                <div
                    class="member-card"
                    data-index="{{ $index }}"
                    data-name="{{ $member->name }}"
                    @foreach($member->projects as $project)
                    data-role="{{ $member->projects->pluck('pivot.role')->join(', ')  }}"
                    data-image="{{ asset('storage/' . $member->image) }}"
                    data-graduation="{{ $member->graduation_year ?? '—' }}"
                    data-join="{{ $member->join_year ?? '—' }}"
                    data-projects="{{ $member->projects->pluck('title')->join(', ')  }}"
                    @endforeach
                    data-awards="{{ $member->awards ?? '—' }}"
                    data-bs-toggle="modal"
                    data-bs-target="#memberModal"
                >
                    <figure class="member-card__figure">
                        <img
                            src="{{ asset('storage/' . $member->image) }}"
                            alt="{{ $member->name }}"
                            class="member-card__image img-fluid"
                        />
                    </figure>
                    <div class="member-card__info text-center">
                        <p class="member-card__name">{{ $member->name }}</p>
                        <p class="member-card__role">{{ $member->role }}</p>
                    </div>
                </div>
            </div>
        @endforeach
        
    </div>
</main>

<div class="modal fade" id="memberModal" tabindex="-1" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered member-modal__dialog">
        <div class="modal-content member-modal__content ms-5 me-5">
            <button type="button" class="btn-close member-modal__close" data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="modal-body member-modal__body p-0">
                <div class="modal-mobile row g-0 justify-content-center">
                    <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
                        <img id="modalImage" src="" alt="Thành viên" class="member-modal__image img-fluid" />
                    </div>

                    <div class="col-12 col-md-6 member-modal__info-col p-4 p-md-5 d-flex flex-column justify-content-center">
                        <div class="contentchitiet">
                            <h2 class="member-modal__name mb-0" id="modalName"></h2>
                            <div class="member-modal__divider divider-mobile"></div>
                            <div class="member-modal__details mt-4" id="modalDetails"></div>
                        </div>

                        <div class="member-modal__nav d-flex justify-content-end mt-4">
                            <a href="#!" class="member-modal__nav-arrow me-3" id="prevMember">&lt;</a>
                            <a href="#!" class="member-modal__nav-arrow" id="nextMember">&gt;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const membersData = @json($members);
    const cards = document.querySelectorAll(".member-card");
    const modalImage = document.querySelector("#modalImage");
    const modalName = document.querySelector("#modalName");
    const modalDetails = document.querySelector("#modalDetails");
    const prevBtn = document.querySelector("#prevMember");
    const nextBtn = document.querySelector("#nextMember");

    let currentIndex = 0;

    function updateModal(member, index) {
        currentIndex = index;
        const roles = member.projects.map(p => p.pivot.role).join(', ');
        const projectTitles = member.projects.map(p => p.title).join(', ');
        const imageUrl = member.image
            ? `/assets/img/Thanhvien/${member.image}`
            : `/assets/img/Thanhvien/default.png`;

        modalImage.src = imageUrl;
        modalName.textContent = member.name;
        modalDetails.innerHTML = `
            <p><strong>Chức vụ:</strong> ${roles || '—'}</p>
            <p><strong>Tốt nghiệp:</strong> ${member.graduation_year || '—'}</p>
            <p><strong>Trở thành VICer:</strong> ${member.join_year || '—'}</p>
            <p><strong>Dự án:</strong> ${projectTitles || '—'}</p>
            <p><strong>Giải thưởng:</strong> ${member.awards || '—'}</p>
        `;
    }

    cards.forEach((card, index) => {
        card.addEventListener("click", function () {
            const member = membersData[index];
            updateModal(member, index);
        });
    });

    if (prevBtn) {
        prevBtn.addEventListener("click", function (e) {
            e.preventDefault();
            currentIndex = (currentIndex - 1 + membersData.length) % membersData.length;
            updateModal(membersData[currentIndex], currentIndex);
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener("click", function (e) {
            e.preventDefault();
            currentIndex = (currentIndex + 1) % membersData.length;
            updateModal(membersData[currentIndex], currentIndex);
        });
    }
});
</script>
@endsection
