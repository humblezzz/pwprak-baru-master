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
        <h1 class="ornament__text">Detail Peserta</h1>
        <hr class="ornament__line">
    </div>

    <img src="{{ url('storage') . '/' . $data->foto_url }}" alt="" class="detail__image">
    <div class="detail__right">
        <div class="detail__keterangan">
            <div class="detail__keterangan--data">
                <h4>Nama</h4>
                <h4>Email</h4>
                <h4>Jabatan</h4>
                <h4>Nomor Telepon</h4>
                <h4>ID Line</h4>
            </div>
            <div class="detail__keterangan--isian">
                <h4>{{ $data->nama }}</h4>
                <h4>{{ $data->email }}</h4>
                <h4>{{ $data->jabatan }}</h4>
                <h4>{{ $data->handphone }}</h4>
                <h4>{{ $data->line }}</h4>
            </div>
        </div>
        <div class="detail__bottom">
            <button class="detail__delete">Hapus</button>
            <a href="{{ route('peserta', [
                'mode' => 'edit',
                'object' => 'peserta',
                'uid' => $data->uid,
            ]) }}"
                class="button btn-primary">Edit Peserta</a>
        </div>
    </div>
@endsection

@section('other')
    <form class="detail__delete-dialog dialog"
        action="{{ route('peserta', [
            'mode' => 'delete',
            'object' => 'peserta',
            'uid' => $data->uid,
        ]) }}"
        method="post">
        @method('delete')
        @csrf

        <h3 class="dialog__title">Hapus Peserta?</h3>
        <p class="dialog__message">Apakah anda yakin ingin menghapus peserta
            {{ $data->nama }}?</p>
        <div class="dialog__btn">
            <span class="button btn-primary dialog__btn-yes dialog__batal">Batal</span>
            <button type="submit" class="dialog__btn-no">Hapus</button>
        </div>
    </form>
    <div class="dialog__bg"></div>
@endsection

@section('extrajs')
    <script src="{{ url('assets/js/detail-peserta.js') }}"></script>
@endsection
