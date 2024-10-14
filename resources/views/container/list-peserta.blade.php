@extends('template.client')

{{-- head --}}
@section('title')
    List Peserta {{ Auth::user()->akronim }}
@endsection


{{-- SEO -> kalo butuh aj --}}
{{-- @section('seo-desc', 'deskripsi buat seo')
@section('seo-img', 'link img seo') --}}

{{-- body --}}
@section('bodyclass', '') {{-- kalo butuh aj --}}
@section('contentclass', 'list-peserta')

@section('content')
    {{-- konten disini --}}
    <div class="ornament">
        <h1 class="ornament__text">Dashboard</h1>
        <hr class="ornament__line">
    </div>

    <div class="list-peserta__buttons">
        <button class="btn-secondary-blue" onclick="alert('Maaf, fitur belum tersedia')">Sort by</button>
        <a href="{{ route('peserta', [
            'mode' => 'add',
            'object' => 'peserta',
        ]) }}"
            class="button btn-primary">+ Tambah peserta</a>
    </div>

    <table class="list-peserta__tabel list-peserta__tabel--head">
        <colgroup>
            <col span="1" style="width: 5%;">
            <col span="1" style="width: 50%;">
            <col span="1" style="width: 25%;">
            <col span="1" style="width: 10%;">
        </colgroup>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>
    <div class="list-peserta__tabel-container">
        <table class="list-peserta__tabel list-peserta__tabel--body">
            <colgroup>
                <col span="1" style="width: 5%;">
                <col span="1" style="width: 50%;">
                <col span="1" style="width: 25%;">
                <col span="1" style="width: 10%;">
            </colgroup>
            <tbody>
                @foreach ($data as $p)
                    <tr class="list-peserta__row">
                        <td>{{ $loop->iteration }}</td>
                        <td class="list-peserta__nama">{{ $p->nama }}</td>
                        <td class="list-peserta__univ">{{ $p->jabatan }}</td>
                        <td class="list-peserta__aksi">
                            <a class="list-peserta__aksi-btn"
                                href="{{ route('peserta', [
                                    'mode' => 'detail',
                                    'object' => 'peserta',
                                    'uid' => $p->uid,
                                ]) }}">
                                <img src="{{ url('assets/img/view.svg') }}" alt="">
                            </a>
                            <a class="list-peserta__aksi-btn"
                                href="{{ route('peserta', [
                                    'mode' => 'edit',
                                    'object' => 'peserta',
                                    'uid' => $p->uid,
                                ]) }}">
                                <img src="{{ url('assets/img/edit.svg') }}" alt="">
                            </a>
                            @if ($p->jabatan == 'Representative AMSA Universitas')
                                <button class="list-peserta__aksi-btn list-peserta__aksi-btn--delete" disabled>
                                    <img src="{{ url('assets/img/delete.svg') }}" alt="">
                                </button>
                            @else
                                <button class="list-peserta__aksi-btn list-peserta__aksi-btn--delete">
                                    <img src="{{ url('assets/img/delete.svg') }}" alt="">
                                </button>
                            @endif

                            <form class="list-peserta__delete-dialog dialog"
                                action="{{ route('peserta', [
                                    'mode' => 'delete',
                                    'object' => 'peserta',
                                    'uid' => $p->uid,
                                ]) }}"
                                method="post">
                                @method('delete')
                                @csrf

                                <h3 class="dialog__title">Hapus Peserta?</h3>
                                <p class="dialog__message">Apakah anda yakin ingin menghapus peserta
                                    {{ $p->nama }}?</p>
                                <div class="dialog__btn">
                                    <span class="button btn-primary dialog__btn-yes dialog__batal">Batal</span>
                                    <button type="submit" class="dialog__btn-no">Hapus</button>
                                </div>
                            </form>
                            <div class="dialog__bg"></div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('other')
    {{-- it can be modal, alert, etc. --}}
@endsection

@section('extrajs')
    <script src="{{ url('assets/js/list-peserta.js') }}"></script>
@endsection
