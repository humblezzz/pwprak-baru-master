@extends('template.client')

{{-- head --}}
@section('title')
    Dashboard {{ Auth::user()->akronim }}
@endsection


{{-- SEO -> kalo butuh aj --}}
{{-- @section('seo-desc', 'deskripsi buat seo')
@section('seo-img', 'link img seo') --}}

{{-- body --}}
@section('bodyclass', '') {{-- kalo butuh aj --}}
@section('contentclass', 'dashboard')

@section('content')
    {{-- konten disini --}}
    <div class="ornament">
        <h1 class="ornament__text">Dashboard</h1>
        <hr class="ornament__line">
    </div>

    <div class="dashboard__title">
        <h2>Selamat Datang</h2>
        <img src="{{ url('assets/img/mahavira.png') }}" alt="">
    </div>
    <div class="dashboard__card-container">
        <div class="dashboard__card">
            <h3 class="dashboard__card-title">Peserta</h3>
            <img src="{{ url('assets/img/logo-mahavira.png') }}" alt="">
            <a href="{{ route('peserta') }}" class="button btn-secondary dashboard__card-btn">Detail</a>
        </div>
        <div class="dashboard__card">
            <h3 class="dashboard__card-title">Absensi</h3>
            <img src="{{ url('assets/img/logo-mahavira.png') }}" alt="">
            <a href="{{ route('absensi') }}" class="button btn-secondary dashboard__card-btn">Detail</a>
        </div>
    </div>

    <span></span>
@endsection

@section('other')
    {{-- it can be modal, alert, etc. --}}
@endsection

@section('extrajs')
    {{-- buat linked js nya yaw --}}
@endsection
