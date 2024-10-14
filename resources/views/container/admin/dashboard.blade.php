@extends('template.admin')

@section('title', 'Hai, Admin!')
@section('seo-desc')

@section('contentclass', 'adm-dashboard')

@section('content')
    <div class="adm-dashboard__header">
        <h1 class="adm-dashboard__title">List Universitas</h1>
        <div class="adm-dashboard__filter-div" style="">
            <input type="text" class="adm-dashboard__input-search" id="filter-search" placeholder="Cari Universitas">
            <button class="btn-primary adm-dashboard__btn adm-dashboard__btn-filter">Urutkan Data</button>
            <div class="dialog">
                <h3 class="dialog__title">Urutkan Disini</h3>
                <div class="dialog__filter">
                    <div class="input-field @if ($errors->has('select-column-sorter-column')) has-error @endif">
                        <select id="select-column-sorter-column" name="select-column-sorter-column">
                            <option value="Nama Universitas">Nama Universitas</option>
                            <option value="Jumlah Peserta">Jumlah Peserta</option>
                        </select>
                        <label for="select-column-sorter-column">Urutkan berdasarkan</label>
                        @if ($errors->has('select-column-sorter-column'))
                            <h6 class="helper-text red-important">{{ $errors->first('select-column-sorter-column') }}</h6>
                        @endif
                    </div>
                    <div class="input-field @if ($errors->has('select-column-sorter-ascending')) has-error @endif">
                        <select id="select-column-sorter-ascending" name="select-column-sorter-ascending">
                            <option value="A-Z">A-Z</option>
                            <option value="Z-A">Z-A</option>
                        </select>
                        <label for="select-column-sorter-ascending">A-Z</label>
                        @if ($errors->has('select-column-sorter-ascending'))
                            <h6 class="helper-text red-important">{{ $errors->first('select-column-sorter-ascending') }}
                            </h6>
                        @endif
                    </div>
                </div>
                <div class="dialog__btn">
                    <span class="button dialog__btn-no adm-dashboard__dialog-filter--no">Reset</span>
                    <span class="button dialog__btn-yes adm-dashboard__dialog-filter--yes">Terapkan</span>
                </div>
            </div>
            <div class="dialog__bg"></div>
        </div>
    </div>

    <table class="adm-table__table-head">
        <colgroup>
            <col span="1" style="width: 8%;">
            <col span="1" style="width: 50%;">
            <col span="1" style="width: 25%;">
            <col span="1" style="width: 17%;">
        </colgroup>
        <thead>
            <tr>
                <th><span>
                        No.
                    </span>
                </th>
                <th><span>
                        <span>Nama Universitas | <span class="color-champagne"> Total: {{ sizeof($data) }}</span></span>
                    </span>
                </th>
                <th><span>
                        <span>Jumlah Peserta | <span class="color-champagne"> Total: {{ $jmlPeserta }}</span></span>
                    </span>
                </th>
                <th></th>
            </tr>
        </thead>
    </table>
    <div class="adm-table__table-container">
        <table class="adm-table__table list" id="tableAdmDashboard">
            <colgroup>
                <col span="1" style="width: 8%;">
                <col span="1" style="width: 50%;">
                <col span="1" style="width: 25%;">
                <col span="1" style="width: 17%;">
            </colgroup>
            <tbody>
                @foreach ($data as $univ)
                    <tr class="adm-table__record">
                        <td>{{ $loop->iteration }}</td>
                        <td class="adm-table__univ">{{ $univ->univ }}</td>
                        <td class="adm-table__peserta">{{ $univ->jumlahPeserta() }}</td>
                        <td>
                            <a class="adm-table__btn"
                                href="{{ route('a.peserta', [
                                    'object' => 'peserta',
                                    'univ' => $univ->email,
                                ]) }}">
                                Lihat Peserta
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="adm-footer">
        <div class="adm-footer__totals">
            <h5 class="adm-footer__total">Total Universitas: {{ sizeof($data) }}</h5>
            <hr>
            <h5 class="adm-footer__total">Total Peserta: {{ $jmlPeserta }}</h5>
        </div>
    </div>

@endsection

@section('extrajs')
    <script src="{{ url('assets/js/admin/filter.js') }}"></script>
@endsection
