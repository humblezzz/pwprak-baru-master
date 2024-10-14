@extends('template.general')

@section('title', 'Selamat Datang Admin!')
@section('seo-desc')

@section('contentclass', 'adm-login')

@section('content')
    <div class="adm-login__content">
        <h2>Admin</h2>
        <form action="{{ route('a.login') }}" method="post">
            @csrf
            <div class="input-field @if ($errors->has('pw')) has-error @endif">
                <input type="password" class="validate" id="pw" name="pw" placeholder="Password admin"
                    value="{{ old('pw') ? old('pw') : '' }}">
                <label for="pw">Password Admin</label>
                @if ($errors->has('pw'))
                    <h6 class="helper-text red-important">{{ $errors->first('pw') }}</h6>
                @endif
            </div>
            <button type="submit" class="btn-primary">MASUK SEBAGAI ADMIN</button>
        </form>
    </div>
@endsection

@section('other')
    {{-- it can be modal, etc. --}}
@endsection
