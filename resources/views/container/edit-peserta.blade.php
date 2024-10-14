@extends('template.client')

{{-- head --}}
@section('title')
    Edit Peserta {{ Auth::user()->akronim }}
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

    <form
        action="{{ route('peserta', [
            'mode' => 'edit',
            'object' => 'peserta',
            'uid' => app('request')->input('uid'),
        ]) }}"
        method="post" enctype="multipart/form-data" class="add-edit-peserta__form">
        <div class="add-edit-peserta__top">
            <div class="add-edit-peserta__side add-edit-peserta__side--left">
                @csrf
                <div class="input-field @if ($errors->has('nama')) has-error @endif">
                    <input type="text" class="validate" id="nama" name="nama" placeholder="Nama Lengkap"
                        value="{{ old('nama') ? old('nama') : $data->nama }}">
                    <label for="nama">Nama Lengkap</label>
                    @if ($errors->has('nama'))
                        <h6 class="helper-text red-important">{{ $errors->first('nama') }}</h6>
                    @endif
                </div>
                <div class="input-field @if ($errors->has('email')) has-error @endif">
                    <input type="text" class="validate" id="email" name="email" placeholder="Email"
                        value="{{ old('email') ? old('email') : $data->email }}">
                    <label for="email">Email</label>
                    @if ($errors->has('email'))
                        <h6 class="helper-text red-important">{{ $errors->first('email') }}</h6>
                    @endif
                </div>
                <div class="input-field @if ($errors->has('handphone')) has-error @endif">
                    <input type="text" class="validate" id="handphone" name="handphone" placeholder="No. Telepon"
                        value="{{ old('handphone') ? old('handphone') : $data->handphone }}">
                    <label for="handphone">No. Telepon</label>
                    @if ($errors->has('handphone'))
                        <h6 class="helper-text red-important">{{ $errors->first('handphone') }}</h6>
                    @endif
                </div>
                <div class="input-field @if ($errors->has('line')) has-error @endif">
                    <input type="text" class="validate" id="line" name="line" placeholder="ID Line"
                        value="{{ old('line') ? old('line') : $data->line }}">
                    <label for="line">ID Line</label>
                    @if ($errors->has('line'))
                        <h6 class="helper-text red-important">{{ $errors->first('line') }}</h6>
                    @endif
                </div>
            </div>
            <div class="add-edit-peserta__side add-edit-peserta__side--right">
                @if ($data->jabatan == 'Representative AMSA Universitas')
                    <div class="input-field @if ($errors->has('jabatan')) has-error @endif">
                        <input readonly type="text" class="validate" id="jabatan" name="jabatan" placeholder="Jabatan"
                            value="{{ $data->jabatan }}">
                        <label for="jabatan">Jabatan</label>
                        @if ($errors->has('jabatan'))
                            <h6 class="helper-text red-important">{{ $errors->first('jabatan') }}</h6>
                        @endif
                    </div>
                @else
                    <div class="input-field @if ($errors->has('jabatan')) has-error @endif">
                        <select id="jabatan" name="jabatan">
                            <option value="" disabled selected>Pilih jabatan</option>
                            <option @if ($data->jabatan == 'EB AMSA-Indonesia') selected @endif value="EB AMSA-Indonesia">EB
                                AMSA-Indonesia</option>
                            <option @if ($data->jabatan == 'Member') selected @endif value="Member">Member</option>
                            <option @if ($data->jabatan == 'AB AMSA-Indonesia') selected @endif value="AB AMSA-Indonesia">AB
                                AMSA-Indonesia</option>
                            <option @if ($data->jabatan == 'National Team') selected @endif value="National Team">National Team
                            </option>
                            <option @if ($data->jabatan == 'APH') selected @endif value="APH">APH</option>
                            <option @if ($data->jabatan == 'Post AMSEP Presentation') selected @endif value="Post AMSEP Presentation">Post
                                AMSEP Presentation</option>
                        </select>
                        <label for="jabatan">Jabatan</label>
                        @if ($errors->has('jabatan'))
                            <h6 class="helper-text red-important">{{ $errors->first('jabatan') }}</h6>
                        @endif
                    </div>
                @endif
                <div class="file-field input-field @if ($errors->has('pas')) has-error @endif">
                    <div class="btn">
                        <span>File</span>
                        <input type="file" accept="image/png, image/jpeg" id="pas" name="pas">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Pas Foto (JPG atau PNG)"
                            value="{{ old('pas') ? old('pas') : $data->foto_url }}">
                    </div>
                    @if ($errors->has('pas'))
                        <h6 class="helper-text red-important">{{ $errors->first('pas') }}</h6>
                    @endif
                </div>
            </div>
        </div>
        <div class="add-edit-peserta__bottom">
            <a href="{{ URL::previous() }}">Batalkan</a>
            <button type="submit" class="btn-primary">Edit Peserta</button>
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
