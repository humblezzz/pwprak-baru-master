@extends('template.general')

{{-- head --}}
@section('title', 'Selamat Datang - NLT AMSA 2022')


{{-- SEO -> kalo butuh aj --}}
@section('seo-desc', '')
@section('seo-img')
    {{ url('assets/img/logo-nlt.png') }}
@endsection

{{-- body --}}
@section('bodyclass', '') {{-- kalo butuh aj --}}
@section('contentclass', 'landing')

@section('content')
    {{-- konten disini --}}
    <div class="landing--top">
        <div class="landing--top__content">
            <img src="{{ url('assets/img/logo-nlt.png') }}" alt="" class="landing--top__img" />
            @if (Session::has('admin'))
                <a href="{{ route('a.peserta', ['univ' => 'list']) }}" class="button btn-secondary landing--top__btn">
                    Dashboard admin
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="button btn-secondary landing--top__btn">
                    @if (Auth::user())
                        Dashboard
                    @else
                        Login
                    @endif
                </a>
            @endif
        </div>
        <h5 class="landing__ornament landing__ornament--by">by AMSA UNAIR</h5>
        <img src="{{ url('assets/img/mahavira.png') }}" alt=""
            class="landing__ornament landing__ornament--mahavira">
        <img src="{{ url('assets/img/mahavira2.png') }}" alt=""
            class="landing__ornament landing__ornament--mahavira2">
        <img src="{{ url('assets/img/logo-nlt.png') }}" alt="" class="landing__ornament landing__ornament--logo">
    </div>

    <div class="landing--about">
        <div class="landing--about__content">
            <h1 class="landing--about__title">About</h1>
            <img src="{{ url('assets/img/mahavira.png') }}" alt="" class="landing--about__mahavira">
            <p class="landing--about__desc">National Leadership Training (NLT) is a national-level AMSA-Indonesia work
                program that is held annually. This program aims as a means of developing self-ability in organizing
                effectively and efficiently as well as increasing intimacy between AMSA-Indonesia members. At the National
                Leadership Training (NLT) 2022 event, AMSA-UNAIR, as the host university, raised the theme, namely MAHAVIRA
                (Mastering The Art of Heroism and Leadership in Virtuous Generation). In Sanskrit, 'Maha' means great and
                'Vira' means brave. A leader is someone who has the ability to influence others and is responsible for the
                realization of a certain goal. Therefore, MAHAVIRA 2022 was held with the aim of being a lesson material to
                become a quality leader from the struggle of the heroes. The entire series of activities will be held online
                on March 25-27 2022 and will be attended by approximately 304 delegates from 38 universities.</p>
        </div>
        <img src="{{ url('assets/img/mahavira.png') }}" alt="" class="landing__ornament landing__ornament--about">
    </div>

    <div class="landing--guidebook">
        <div class="landing--guidebook__left">
            <div class="landing--guidebook__book">
                <h2 class="landing--guidebook__title">Guide Book</h2>
                <img src="{{ url('assets/img/logo-nlt.png') }}" alt="">
            </div>
            <img src="{{ url('assets/img/guidebook-mahavira.png') }}" alt=""
                class="landing__ornament landing__ornament--guidebook">
        </div>
        <div class="landing--guidebook__right">
            <div class="landing--guidebook__text">
                <h3 class="landing--guidebook__title">Download our Guide Book</h3>
                <p>For more details and requirements of MAHAVIRA 2022, please refer to this guideline!</p>
                <a href="{{ url('assets/file/Event Guideline of NLT 2022.pdf') }}" target="_blank"
                    rel="noopener noreferrer" class="button btn-secondary">Download</a>
            </div>
        </div>
    </div>

    <footer class="landing--footer">
        <div class="landing--footer__left">
            <div class="landing--footer__menu-container">
                <h3 class="landing--footer__title">Visit</h3>
                <div class="landing--footer__menu">
                    <a href="" class="landing--footer__link">Instagram</a>
                    <a href="" class="landing--footer__link">Youtube</a>
                    <a href="" class="landing--footer__link">Facebook</a>
                    <a href="" class="landing--footer__link">Website</a>
                </div>
            </div>
            <div class="landing--footer__menu-container">
                <h3 class="landing--footer__title">Contact Us</h3>
                <div class="landing--footer__menu">
                    <a href="" class="landing--footer__link">WhatsApp</a>
                    <a href="" class="landing--footer__link">Line</a>
                    <a href="" class="landing--footer__link">Email</a>
                </div>
            </div>
        </div>
        <div class="landing--footer__right">
            <img src="{{ url('assets/img/logo-amsa.png') }}" alt="AMSA UNAIR" class="landing--footer__img">
            <img src="{{ url('assets/img/logo-nlt.png') }}" alt="MAHAVIRA NLT AMSA" class="landing--footer__img">
        </div>
    </footer>
@endsection

@section('other')
    {{-- it can be modal, alert, etc. --}}
@endsection

@section('extrajs')
    {{-- buat linked js nya yaw --}}
@endsection
