@extends('template.client')

{{-- head --}}
@section('title')
    Tambah Peserta {{ Auth::user()->akronim }}
@endsection


{{-- SEO -> kalo butuh aj --}}
{{-- @section('seo-desc', 'deskripsi buat seo')
@section('seo-img', 'link img seo') --}}

{{-- body --}}
@section('bodyclass', '') {{-- kalo butuh aj --}}
@section('contentclass', 'add-edit-peserta')

@section('content')
    {{-- konten disini --}}
    <div class="ornament">
        <h1 class="ornament__text">Tambah Peserta</h1>
        <hr class="ornament__line">
    </div>

    <form action="{{ route('peserta', [
        'mode' => 'add',
        'object' => 'peserta',
    ]) }}" method="post"
        enctype="multipart/form-data" class="add-edit-peserta__form">
        <div class="add-edit-peserta__top">
            <div class="add-edit-peserta__side add-edit-peserta__side--left">
                @csrf
                <div class="input-field @if ($errors->has('nama')) has-error @endif">
                    <input type="text" class="validate" id="nama" name="nama" placeholder="Nama Lengkap"
                        value="{{ old('nama') ? old('nama') : '' }}">
                    <label for="nama">Nama Lengkap</label>
                    @if ($errors->has('nama'))
                        <h6 class="helper-text red-important">{{ $errors->first('nama') }}</h6>
                    @endif
                </div>
                <div class="input-field @if ($errors->has('email')) has-error @endif">
                    <input type="text" class="validate" id="email" name="email" placeholder="Email"
                        value="{{ old('email') ? old('email') : '' }}">
                    <label for="email">Email</label>
                    @if ($errors->has('email'))
                        <h6 class="helper-text red-important">{{ $errors->first('email') }}</h6>
                    @endif
                </div>
                <div class="input-field @if ($errors->has('handphone')) has-error @endif">
                    <input type="text" class="validate" id="handphone" name="handphone" placeholder="No. Telepon"
                        value="{{ old('handphone') ? old('handphone') : '' }}">
                    <label for="handphone">No. Telepon</label>
                    @if ($errors->has('handphone'))
                        <h6 class="helper-text red-important">{{ $errors->first('handphone') }}</h6>
                    @endif
                </div>
                <div class="input-field @if ($errors->has('line')) has-error @endif">
                    <input type="text" class="validate" id="line" name="line" placeholder="ID Line"
                        value="{{ old('line') ? old('line') : '' }}">
                    <label for="line">ID Line</label>
                    @if ($errors->has('line'))
                        <h6 class="helper-text red-important">{{ $errors->first('line') }}</h6>
                    @endif
                </div>
            </div>
            <div class="add-edit-peserta__side add-edit-peserta__side--right">
                <div class="input-field @if ($errors->has('jabatan')) has-error @endif">
                    <select id="jabatan" name="jabatan">
                        <option value="" disabled selected>Pilih jabatan</option>
                        <option value="EB AMSA-Indonesia">EB AMSA-Indonesia</option>
                        <option value="Member">Member</option>
                        <option value="AB AMSA-Indonesia">AB AMSA-Indonesia</option>
                        <option value="National Team">National Team</option>
                        <option value="APH">APH</option>
                        <option value="Post AMSEP Presentation">Post AMSEP Presentation</option>
                    </select>
                    <label for="jabatan">Jabatan</label>
                    @if ($errors->has('jabatan'))
                        <h6 class="helper-text red-important">{{ $errors->first('jabatan') }}</h6>
                    @endif
                </div>
                <div class="file-field input-field @if ($errors->has('pas')) has-error @endif">
                    <div class="btn">
                        <span>File</span>
                        <input type="file" accept="image/png, image/jpeg" id="pas" name="pas">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Pas Foto (JPG atau PNG)">
                    </div>
                    @if ($errors->has('pas'))
                        <h6 class="helper-text red-important">{{ $errors->first('pas') }}</h6>
                    @endif
                </div>
            </div>
        </div>
        <div class="add-edit-peserta__bottom">
            <a href="{{ route('peserta') }}">Batalkan</a>
            <button type="submit" class="btn-primary">Tambahkan Peserta</button>
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
