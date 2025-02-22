<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function view_regist()
    {
        // return view('be.auth.reg');
        // return redirect()->route('closereg');
        return view('container.registrasi');
    }

    public function view_login()
    {
        // return view('be.auth.login');
        return view('container.masuk');
    }

    public function action_regist(Request $request)
    {
        // dd($request->all());
        if (User::where('email', $request['email-univ'])->first()) {
            // bring it to login with message
            return redirect()->route('login')->with([
                'auth.title' => 'Silakan Masuk!',
                'auth.msg' => 'ketua sudah melakukan pendaftaran, silakan masuk.',
                'univ' => $request->email
            ]);
        }

        $rules = [
            'email' => 'required|email|unique:App\Models\Peserta,email',
            'univ' => 'required',
            'email-univ' => 'required',
            'nama' => 'required|string',
            'password' => 'required|min:8|confirmed',
            // 'confirm-password' => 'required|same',
            'handphone' => 'required|min:10',
            // 'ktp' => 'required|file|mimes:png,jpg,jpeg',
            'pas' => 'required|file|mimes:png,jpg,jpeg',
            'line' => 'required'
        ];

        Validator::make($request->all(), $rules, $messages = $this->msg)->validate();

        // please do validate in FrontEnd, 
        // idk how to handle files to keep in touch with input

        if ($request->hasFile('pas')) {
            $foto_url = join("_", [time(), $request->nama, "foto"]) . "." . $request->pas->extension();
            $request->pas->storeAs('public', $foto_url);
        }

        if ($request->hasFile('ktp')) {
            $ktp_url = join("_", [time(), $request->nama, "ktp"])  . "." . $request->pas->extension();
            $request->ktp->storeAs('public', $ktp_url);
        }

        $u = User::create([
            'univ' => $request->univ,
            'email' => $request['email-univ'],
            'akronim' => $request->akronim,
            'ketua' => $request->nama,
            'password' => Hash::make($request->password)
        ]);

        // Auth::login($u);

        Peserta::create([
            'nama' => $request->nama,
            'user_id' => $u->id,
            'jabatan' => 'Representative AMSA Universitas',
            'handphone' => $request->handphone,
            'foto_url' => $foto_url,
            'ktp_url' => '$ktp_url',
            'line' => $request->line,
            'email' => $request->email,
            'uid' => join('-', [
                Str::random(10),
                join('-', explode(" ", $request->nama))
            ])
        ]);

        return redirect()->route('login')->with([
            'email' => $u->email,
            'title' => 'Berhasil Registrasi',
            'success.regis' => 'Gunakan EMAIL UNIK UNIVERSITAS serta password yang telah didaftarkan untuk masuk.
            Email : '
                ]);
        dd(Auth::user());
    }

    public function action_login(Request $request)
    {
        // buat ini hanya untuk 5 kali coba dalam 1 IP kemudian cooldown 10 menit
        if (!User::where('email', $request->email)->first()) {
            // flow baru buat salah masukin email
            return redirect()->back()->with([
                'univ' => $request->univ,
                'auth.
                title' => 'Email Tidak Terdaftar',
                'auth.msg' => 'Harap periksa kembali email yang anda masukkan, atau daftarkan universitas anda.'
            ]);
        }

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('error', 'password salah');
    }

    public function mahavira_view_login()
    {
        if(Auth::user()){
            Auth::logout();
        }
        if (Session::has('admin') && Session::get('admin') == true) {
            return redirect()->route('a.peserta');
        }
        return view('container.admin.masuk');
    }

    public function mahavira_action_login(Request $request)
    {
        // buat ini hanya untuk 5 kali coba dalam 1 IP kemudian cooldown 10 menit
        $rules = [
            'pw' => 'required'
        ];

        Validator::make($request->all(), $rules, $this->msg)->validate();

        if ($request->pw == 'passwordtulisdisini') {
            Session::put('admin', true);
            return redirect()->route('a.peserta');
        } else {
            return redirect()->back()->withErrors(['pw' => 'Password Salah!']);
        }
    }

    public function mahavira_action_logout(Request $request)
    {
        Session::forget('admin');
        return redirect()->route('a.login');
    }
}
