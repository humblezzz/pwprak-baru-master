@extends('template.general')

{{-- head --}}
@section('title', 'Registrasi Universitas')


{{-- SEO -> kalo butuh aj --}}
{{-- @section('seo-desc', 'deskripsi buat seo')
@section('seo-img', 'link img seo') --}}

{{-- body --}}
@section('bodyclass', '') {{-- kalo butuh aj --}}
@section('contentclass', 'registrasi')

@section('content')
    {{-- konten disini --}}
    <div class="ornament">
        <h1 class="ornament__text">Registasi</h1>
        <hr class="ornament__line">
    </div>

    <form action="{{ route('register') }}" method="post" enctype="multipart/form-data" class="registrasi__form">
        @csrf
        <div class="registrasi__form-input">
            <div class="registrasi__form-input--left">
                <div class="input-field @if ($errors->has('email')) has-error @endif">
                    <input type="text" class="validate" id="email" name="email" placeholder="Email Ketua"
                        value="{{ old('email') ? old('email') : '' }}">
                    <label for="email">Email Ketua</label>
                    @if ($errors->has('email'))
                        <h6 class="helper-text red-important">{{ $errors->first('email') }}</h6>
                    @endif
                </div>
                <div class="input-field @if ($errors->has('nama')) has-error @endif">
                    <input type="text" class="validate" id="nama" name="nama" placeholder="Nama Ketua"
                        value="{{ old('nama') ? old('nama') : '' }}">
                    <label for="nama">Nama Ketua</label>
                    @if ($errors->has('nama'))
                        <h6 class="helper-text red-important">{{ $errors->first('nama') }}</h6>
                    @endif
                </div>
                <div class="input-field @if ($errors->has('handphone')) has-error @endif">
                    <input type="text" class="validate" id="handphone" name="handphone" placeholder="Nomor Telepon Ketua"
                        value="{{ old('handphone') ? old('handphone') : '' }}">
                    <label for="handphone">Nomor Telepon Ketua</label>
                    @if ($errors->has('handphone'))
                        <h6 class="helper-text red-important">{{ $errors->first('handphone') }}</h6>
                    @endif
                </div>
                <div class="input-field @if ($errors->has('line')) has-error @endif">
                    <input type="text" class="validate" id="line" name="line" placeholder="ID Line Ketua"
                        value="{{ old('line') ? old('line') : '' }}">
                    <label for="line">ID Line Ketua</label>
                    @if ($errors->has('line'))
                        <h6 class="helper-text red-important">{{ $errors->first('line') }}</h6>
                    @endif
                </div>
                <div class="registrasi__form-password">
                    <div class="input-field @if ($errors->has('password')) has-error @endif">
                        <input type="password" class="validate" id="password" name="password" placeholder="Password"
                            value="{{ old('password') ? old('password') : '' }}">
                        <label for="password">Password</label>
                        @if ($errors->has('password'))
                            <h6 class="helper-text red-important">{{ $errors->first('password') }}</h6>
                        @endif
                    </div>
                    <div class="input-field @if ($errors->has('password_confirmation')) has-error @endif">
                        <input type="password" class="validate" id="password_confirmation" name="password_confirmation"
                            placeholder="Konfirmasi Password"
                            value="{{ old('password_confirmation') ? old('password_confirmation') : '' }}">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        @if ($errors->has('password_confirmation'))
                            <h6 class="helper-text red-important">{{ $errors->first('password_confirmation') }}</h6>
                        @endif
                    </div>
                </div>
            </div>
            <div class="registrasi__form-input--right">
                <div class="input-field @if ($errors->has('univ')) has-error @endif">
                    <select id="univ" name="univ">
                        <option value="" disabled selected>Pilih universitas</option>
                        <option value="Universitas Sriwijaya">Universitas Sriwijaya</option>
                        <option value="Universitas Jambi">Universitas Jambi</option>
                        <option value="Universitas Syiah Kuala">Universitas Syiah Kuala</option>
                        <option value="Universitas Batam">Universitas Batam</option>
                        <option value="Universitas Muhammadiyah Palembang">Universitas Muhammadiyah Palembang</option>
                        <option value="Universitas Indonesia">Universitas Indonesia</option>
                        <option value="Universitas Katolik Indonesia Atma Jaya">Universitas Katolik Indonesia Atma Jaya
                        </option>
                        <option value="Universitas Kristen Krida Wacana">Universitas Kristen Krida Wacana</option>
                        <option value="Universitas Tarumanagara">Universitas Tarumanagara</option>
                        <option value="Universitas Trisakti">Universitas Trisakti</option>
                        <option value="Universitas Pelita Harapan">Universitas Pelita Harapan</option>
                        <option value="Universitas Kristen Indonesia">Universitas Kristen Indonesia</option>
                        <option value="Universitas Pembangunan Nasional Veteran Jakarta">Universitas Pembangunan Nasional
                            Veteran Jakarta</option>
                        <option value="Universitas Padjadjaran">Universitas Padjadjaran</option>
                        <option value="Universitas Jenderal Achmad Yani">Universitas Jenderal Achmad Yani</option>
                        <option value="Maranatha Christian University">Maranatha Christian University</option>
                        <option value="Universitas Swadaya Gunung Jati">Universitas Swadaya Gunung Jati</option>
                        <option value="Universitas Gadjah Mada">Universitas Gadjah Mada</option>
                        <option value="Universitas Sebelas Maret">Universitas Sebelas Maret</option>
                        <option value="Universitas Diponegoro">Universitas Diponegoro</option>
                        <option value="Universitas Palangka Raya">Universitas Palangka Raya</option>
                        <option value="Universitas Brawijaya">Universitas Brawijaya</option>
                        <option value="Universitas Airlangga">Universitas Airlangga</option>
                        <option value="Universitas Hang Tuah">Universitas Hang Tuah</option>
                        <option value="Universitas Muhammadiyah Malang">Universitas Muhammadiyah Malang</option>
                        <option value="Universitas Jember">Universitas Jember</option>
                        <option value="Universitas Hasanuddin">Universitas Hasanuddin</option>
                        <option value="Universitas Muslim Indonesia">Universitas Muslim Indonesia</option>
                        <option value="Universitas Sam Ratulangi">Universitas Sam Ratulangi</option>
                        <option value="Universitas Alkhairaat">Universitas Alkhairaat</option>
                        <option value="Universitas Tadulako">Universitas Tadulako</option>
                        <option value="Universitas Pattimura">Universitas Pattimura</option>
                        <option value="Universitas Muhammadiyah Makassar">Universitas Muhammadiyah Makassar</option>
                        <option value="Universitas Halu Oleo">Universitas Halu Oleo</option>
                        <option value="Universitas Bosowa">Universitas Bosowa</option>
                        <option value="Universitas Khairun">Universitas Khairun</option>
                        <option value="Universitas Mataram">Universitas Mataram</option>
                        <option value="Universitas Islam Negeri Maulana Malik Ibrahim Malang">Universitas Islam Negeri
                            Maulana Malik Ibrahim Malang</option>
                    </select>
                    <label for="univ">Universitas</label>
                    @if ($errors->has('univ'))
                        <h6 class="helper-text red-important">{{ $errors->first('univ') }}</h6>
                    @endif
                </div>
                <div class="input-field @if ($errors->has('email-univ')) has-error @endif">
                    <input readonly type="text" class="validate" id="email-univ" name="email-univ"
                        placeholder="Email Unik Universitas (Auto-fill ketika memilih universitas)"
                        value="{{ old('email-univ') ? old('email-univ') : '' }}">
                    <label for="email-univ">Email Unik Universitas (Auto-fill ketika memilih universitas)</label>
                    @if ($errors->has('email-univ'))
                        <h6 class="helper-text red-important">{{ $errors->first('email-univ') }}</h6>
                    @endif
                </div>
                <input readonly type="text" class="hidden" id="akronim" name="akronim"
                    value="{{ old('akronim') ? old('akronim') : '' }}">
                <div class="input-field @if ($errors->has('jabatan')) has-error @endif">
                    <input readonly type="text" class="validate" id="jabatan" name="jabatan"
                        value="Representative AMSA Universitas">
                    <label for="Jabatan">Jabatan</label>
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

        <div class="registrasi__form-bottom">
            <p class="registrasi__to-masuk">Anda sudah memiliki akun? <a href="{{ route('login') }}">Masuk</a></p>
            <button type="submit" class="btn-primary registrasi__submit">REGISTRASI</button>
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

        // set email-univ & akronim
        const dataUniv = {
            0: {
                univ: 'Universitas Sriwijaya',
                akronim: 'UNSRI',
                email: 'universitas_sriwijaya@nlt2022.com'
            },
            1: {
                univ: 'Universitas Jambi',
                akronim: 'UNJA',
                email: 'universitas_jambi@nlt2022.com'
            },
            2: {
                univ: 'Universitas Syiah Kuala',
                akronim: 'USK',
                email: 'universitas_syiah@nlt2022.com'
            },
            3: {
                univ: 'Universitas Batam',
                akronim: 'UNIBA',
                email: 'universitas_batam@nlt2022.com'
            },
            4: {
                univ: 'Universitas Muhammadiyah Palembang',
                akronim: 'UMP',
                email: 'muhammadiyah_palembang@nlt2022.com'
            },
            5: {
                univ: 'Universitas Indonesia',
                akronim: 'UI',
                email: 'universitas_indonesia@nlt2022.com'
            },
            6: {
                univ: 'Universitas Katolik Indonesia Atma Jaya',
                akronim: 'UAJ',
                email: 'atma_jaya@nlt2022.com'
            },
            7: {
                univ: 'Universitas Kristen Krida Wacana',
                akronim: 'UKRIDA',
                email: 'krida_wacana@nlt2022.com'
            },
            8: {
                univ: 'Universitas Tarumanagara',
                akronim: 'UNTAR',
                email: 'universitas_tarumanagara@nlt2022.com'
            },
            9: {
                univ: 'Universitas Trisakti',
                akronim: 'USAKTI',
                email: 'universitas_trisakti@nlt2022.com'
            },
            10: {
                univ: 'Universitas Pelita Harapan',
                akronim: 'UPH',
                email: 'pelita_harapan@nlt2022.com'
            },
            11: {
                univ: 'Universitas Kristen Indonesia',
                akronim: 'UKI',
                email: 'universitas_kristen@nlt2022.com'
            },
            12: {
                univ: 'Universitas Pembangunan Nasional Veteran Jakarta',
                akronim: 'UPN',
                email: 'upn_vj@nlt2022.com'
            },
            13: {
                univ: 'Universitas Padjadjaran',
                akronim: 'UNPAD',
                email: 'universitas_padjadjaran@nlt2022.com'
            },
            14: {
                univ: 'Universitas Jenderal Achmad Yani',
                akronim: 'UNJANI',
                email: 'unjani@nlt2022.com'
            },
            15: {
                univ: 'Maranatha Christian University',
                akronim: 'MCU',
                email: 'mcu@nlt2022.com'
            },
            16: {
                univ: 'Universitas Swadaya Gunung Jati',
                akronim: 'UGJ',
                email: 'swadaya_gunung_jati@nlt2022.com'
            },
            17: {
                univ: 'Universitas Gadjah Mada',
                akronim: 'UGM',
                email: 'gadjah_mada@nlt2022.com'
            },
            18: {
                univ: 'Universitas Sebelas Maret',
                akronim: 'UNS',
                email: 'sebelas_maret@nlt2022.com'
            },
            19: {
                univ: 'Universitas Diponegoro',
                akronim: 'UNDIP',
                email: 'universitas_diponegoro@nlt2022.com'
            },
            20: {
                univ: 'Universitas Palangka Raya',
                akronim: 'UPR',
                email: 'palangka_raya@nlt2022.com'
            },
            21: {
                univ: 'Universitas Brawijaya',
                akronim: 'UB',
                email: 'universitas_brawijaya@nlt2022.com'
            },
            22: {
                univ: 'Universitas Airlangga',
                akronim: 'UNAIR',
                email: 'universitas_airlangga@nlt2022.com'
            },
            23: {
                univ: 'Universitas Hang Tuah',
                akronim: 'UHT',
                email: 'hang_tuah@nlt2022.com'
            },
            24: {
                univ: 'Universitas Muhammadiyah Malang',
                akronim: 'UMM',
                email: 'muhammadiyah_malang@nlt2022.com'
            },
            25: {
                univ: 'Universitas Jember',
                akronim: 'JEMBER',
                email: 'universitas_jember@nlt2022.com'
            },
            26: {
                univ: 'Universitas Hasanuddin',
                akronim: 'UNHAS',
                email: 'universitas_hasanuddin@nlt2022.com'
            },
            27: {
                univ: 'Universitas Muslim Indonesia',
                akronim: 'UMI',
                email: 'muslim_indonesia@nlt2022.com'
            },
            28: {
                univ: 'Universitas Sam Ratulangi',
                akronim: 'UNSRAT',
                email: 'sam_ratulangi@nlt2022.com'
            },
            29: {
                univ: 'Universitas Alkhairaat',
                akronim: 'UNISA',
                email: 'universitas_alkhairaat@nlt2022.com'
            },
            30: {
                univ: 'Universitas Tadulako',
                akronim: 'UNTAD',
                email: 'universitas_tadulako@nlt2022.com'
            },
            31: {
                univ: 'Universitas Pattimura',
                akronim: 'UNPATTI',
                email: 'universitas_pattimura@nlt2022.com'
            },
            32: {
                univ: 'Universitas Muhammadiyah Makassar',
                akronim: 'UNISMUH',
                email: 'muhammadiya_makassar@nlt2022.com'
            },
            33: {
                univ: 'Universitas Halu Oleo',
                akronim: 'UHO',
                email: 'halu_oleo@nlt2022.com'
            },
            34: {
                univ: 'Universitas Bosowa',
                akronim: 'UNIBOS',
                email: 'universitas_bosowa@nlt2022.com'
            },
            35: {
                univ: 'Universitas Khairun',
                akronim: 'UNKHAIR',
                email: 'universitas_khairun@nlt2022.com'
            },
            36: {
                univ: 'Universitas Mataram',
                akronim: 'UNRAM',
                email: 'universitas_mataram@nlt2022.com'
            },
            37: {
                univ: 'Universitas Islam Negeri Maulana Malik Ibrahim Malang',
                akronim: 'UINMA',
                email: 'uinma@nlt2022.com'
            }
        }

        $('#univ').change(() => {
            let univ = $('#univ')[0].value;
            let akronim, email;
            for (let i = 0; i < 38; i++) {
                if (univ == dataUniv[i].univ) {
                    akronim = dataUniv[i].akronim;
                    email = dataUniv[i].email;
                    break;
                }
            }
            $('#email-univ')[0].value = email;
            $('#akronim')[0].value = akronim;
        })
    </script>
@endsection
