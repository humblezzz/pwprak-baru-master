@extends('template.general')

@section('navbar')
    <div class="nav">
        <div class="nav__group content admin">
            <a href="{{ route('home') }}">
                <img src="{{ url('assets/img/logo-nlt.png') }}" alt="" class="nav__brand" id="nav__brand">
            </a>

            <div class="nav__items">
                <a href="
                {{ route('a.peserta', ['univ' => 'list']) }}
                " class="nav__item"
                    id="nav__item--a-univ">DASHBOARD <span></span></a>
                <a href="
                {{ route('a.peserta', [
                    'object' => 'peserta',
                ]) }}
                "
                    class="nav__item" id="nav__item--a-peserta">LIST PESERTA <span></span></a>
                <a href="
                {{ route('a.absensi') }}
                " class="nav__item"
                    id="nav__item--a-absensi">ABSENSI
                    <span></span></a>
            </div>
            <a href="{{ route('a.logout') }}" class="button btn-primary nav__item logout">LOGOUT</a>
        </div>
    </div>
@endsection
