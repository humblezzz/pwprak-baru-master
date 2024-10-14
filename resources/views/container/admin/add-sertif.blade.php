@extends('template.admin')

@section('title', 'Upload Sertifikat')
@section('seo-desc')

@section('contentclass', 'add-sertif')

@section('content')
    <form action="{{ route('a.peserta', ['mode' => 'upload-sertif']) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="add-sertif__top">
            <h2 class="add-sertif__title">Upload Sertifikat</h2>
            <div class="input-field @if ($errors->has('email')) has-error @endif">
                <input type="text" class="validate" id="email" name="email" placeholder="Universitas (Terisi otomatis)"
                    value="{{ $univ->email }}" readonly>
                <label for="email">Universitas (Terisi otomatis)</label>
                @if ($errors->has('email'))
                    <h6 class="helper-text red-important">{{ $errors->first('email') }}</h6>
                @endif
            </div>
            <div class="file-field input-field @if ($errors->has('image')) has-error @endif">
                <div class="btn">
                    <span>File</span>
                    <input type="file" accept="image/png, image/jpeg" id="image" name="image[]" multiple required>
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Pilih Sertifikat">
                </div>
                <h6 class="helper-text">* Dapat memilih banyak sertifikat sekaligus</h6>
                @if ($errors->has('image'))
                    <h6 class="helper-text red-important">{{ $errors->first('image') }}</h6>
                @endif
            </div>
        </div>

        <div class="add-sertif__bottom">
            <button type="submit" class="btn-primary add-sertif__submit">UPLOAD SERTIFIKAT</button>
            <a href="{{ route('a.peserta', [
                'object' => 'peserta',
                'univ' => $univ->email,
            ]) }}"
                class="add-sertif__batal">Batalkan</a>
        </div>
    </form>
@endsection

@section('other')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $('#image').change(e => {
            $("span.form-group__filename")[0].innerHTML = e.target.files.length + ' files';
            if (e.target.files.length > 0) {
                $("span.form-group__filename")[0].parentElement.nextElementSibling.classList.add('has-value')
            }
        })
    </script>
@endsection
