<footer class="main-footer flex-column align-items-center justify-content-center pt-0 pb-4">

    <p class="main-footer__copyright flex-row">
        Copyright © VIC NGUYEN | ARCHITECTS 2018
    </p>

    @php
        $items = [
            'facebook' => 'fab fa-facebook-f',
            'instagram' => 'fab fa-instagram',
            'email_social' => 'fas fa-envelope',
        ];
    @endphp

    <div class="main-footer__socials flex-row mt-3">
        @foreach($items as $key => $icon)
            @if(!empty($social->social_links[$key]))
                <a
                    href="{{ $key === 'email_social' ? 'mailto:' . $social->social_links[$key] : $social->social_links[$key] }}"
                    class="main-footer__social-item gapsocial"
                    target="{{ $key !== 'email_social' ? '_blank' : '' }}"
                >
                    <i class="{{ $icon }} main-footer__social-icon"></i>
                </a>
            @endif
        @endforeach
    </div>

</footer>