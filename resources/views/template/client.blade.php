@extends('template.general')

@section('navbar')
    <div class="nav">
        <div class="nav__group content">
            <a href="{{ route('home') }}">
                <img src="{{ url('assets/img/logo-nlt.png') }}" alt="" class="nav__brand" id="nav__brand">
            </a>

            <div class="nav__items">
                <a href="{{ route('dashboard') }}" class="nav__item" id="nav__item--dashboard">DASHBOARD
                    <span></span></a>
                <a href="{{ route('peserta') }}" class="nav__item" id="nav__item--peserta">LIST PESERTA
                    <span></span></a>
                <a href="{{ route('absensi') }}" class="nav__item" id="nav__item--absensi">ABSENSI <span></span></a>
                <a href="{{ route('sertif') }}" class="nav__item" id="nav__item--sertif">SERTIFIKAT
                    <span></span></a>
            </div>
            <h4 class="nav__profile">Halo, {{ Auth::user()->akronim }} </h4>
            <div class="nav__dropdown">
                <a href="{{ route('logout') }}" class="nav__item logout">LOGOUT</a>
            </div>
        </div>
    </div>
@endsection
