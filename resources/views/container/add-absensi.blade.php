@extends('template.client')

@section('title', 'Absensi')
@section('seo-desc')
@section('seo-img')

@section('contentclass', 'add-absensi')

@section('content')
    @if ($absen)
        <form action="{{ route('absensi') }}" method="post" enctype="multipart/form-data">
            <div class="add-absensi__top">
                <div class="add-absensi__title-div">
                    <h1 class="add-absensi__title">Absensi Peserta</h1>
                    <h3 class="add-absensi__day-session">{{ $day }}</h3>
                </div>
                <div class="add-absensi__form">
                    @csrf
                    <input type="hidden" name="uid" value="{{ $user->uid }}">
                    <div class="input-field @if ($errors->has('nama')) has-error @endif">
                        <input type="text" class="validate" id="nama" name="nama"
                            placeholder="Nama (Terisi otomatis)" value="{{ $user->nama }}" disabled>
                        <label for="nama">Nama (Terisi otomatis)</label>
                        @if ($errors->has('nama'))
                            <h6 class="helper-text red-important">{{ $errors->first('nama') }}</h6>
                        @endif
                    </div>
                    <div class="input-field @if ($errors->has('univ')) has-error @endif">
                        <input type="text" class="validate" id="univ" name="univ"
                            placeholder="Asal Universitas (Terisi otomatis)" value="{{ $user->univ->univ }}" disabled>
                        <label for="univ">Asal Universitas (Terisi otomatis)</label>
                        @if ($errors->has('univ'))
                            <h6 class="helper-text red-important">{{ $errors->first('univ') }}</h6>
                        @endif
                    </div>
                    <div class="file-field input-field @if ($errors->has('bukti')) has-error @endif">
                        <div class="btn">
                            <span>File</span>
                            <input type="file" accept="image/png, image/jpeg" id="bukti" name="bukti">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="bukti Kehadiran (JPG atau PNG)">
                        </div>
                        <h6 class="helper-text">
                            *Berupa screenshot yang menampilkan nama partisipan pada Zoom Meeting saat pelaksanaan
                            acara.
                        </h6>
                        @if ($errors->has('bukti'))
                            <h6 class="helper-text red-important">{{ $errors->first('bukti') }}</h6>
                        @endif
                    </div>
                </div>
            </div>
            <div class="add-absensi__bottom">
                <button type="submit" class="btn-primary">SUBMIT ABSEN</button>
                <a href="" class="add-absensi__batal">Batalkan</a>
            </div>
        </form>
    @else
        <div class="add-absensi__title-div">
            <h1 class="add-absensi__title">Absensi Peserta</h1>
            <h3 class="add-absensi__day-session">{{ $day }}</h3>
        </div>
        <div class="add-absensi__sorry">
            <h3>Maaf, absensi pada sesi ini telah ditutup.</h3>
            <a href="{{ route('absensi', ['mode' => 'list']) }}">Kembali ke list absensi</a>
        </div>
    @endif
@endsection

@section('other')
    <div class="add-absensi__dialog dialog">
        <h3 class="dialog__title">Batalkan Absen?</h3>
        <h4 class="dialog__message">Apakah anda ingin membatalkan absensi?Informasi yang anda masukkan tidak akan tersimpan.
        </h4>
        <div class="dialog__btn">
            <span class="button btn-primary dialog__btn-yes list-peserta__batal">Tidak</span>
            <a href="{{ route('absensi', ['mode' => 'list']) }}" class="button dialog__btn-no">Ya, Batalkan</a>
        </div>
    </div>
    <div class="dialog__bg"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $('.add-absensi__batal').click(e => {
            e.preventDefault();
            $('.add-absensi__dialog')[0].classList.add('active')
        })

        // CLOSE ADS
        $('.floating-ads__close').click(e => {
            e.target.parentElement.style.display = 'none';
        })
    </script>
@endsection
