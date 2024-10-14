@extends('template.general')

{{-- head --}}
@section('title', 'Registrasi Universitas')


{{-- SEO -> kalo butuh aj --}}
{{-- @section('seo-desc', 'deskripsi buat seo')
@section('seo-img', 'link img seo') --}}

{{-- body --}}
@section('bodyclass', '') {{-- kalo butuh aj --}}
@section('contentclass', 'login')

@section('content')
    {{-- konten disini --}}
    <div class="ornament">
        <h1 class="ornament__text">Login</h1>
        <hr class="ornament__line">
    </div>

    <h2 class="red-important">Let's go to</h2>
    <img src="{{ url('assets/img/mahavira.png') }}" alt="">
    <form action="{{ route('login') }}" method="post" class="login__form">
        @csrf
        <div class="login__top">
            <div class="input-field @if ($errors->has('email')) has-error @endif">
                <input type="text" class="validate" id="email" name="email" placeholder="Email"
                    value="{{ Session::has('email') ? Session::get('email') : '' }}">
                <label for="email">Email</label>
                @if ($errors->has('email'))
                    <h6 class="helper-text red-important">{{ $errors->first('email') }}</h6>
                @endif
            </div>
            <div class="input-field @if ($errors->has('password')) has-error @endif">
                <input type="password" class="validate" id="password" name="password" placeholder="Password">
                <label for="password">Password</label>
                @if (Session::has('error'))
                    <h6 class="helper-text red-important">{{ Session::get('error') }}</h6>
                @endif
            </div>
        </div>

        <div class="login__bottom">
            <p class="login__to-registrasi">Anda belum memiliki akun? <a href="{{ route('register') }}">Registrasi</a></p>
            <button type="submit" class="btn-primary login__submit">MASUK</button>
        </div>
    </form>
@endsection

@section('other')
    {{-- it can be modal, alert, etc. --}}
@endsection

@section('extrajs')
    {{-- buat linked js nya yaw --}}
    <script>
        $(document).ready(function() {
            $('select').formSelect();
        });
    </script>
@endsection
