<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Sertif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PesertaController extends Controller
{
    public function d_view(Request $request)
    {
        $mode = $request->query('mode');
        $object = $request->query('object');
        $uid = $request->query('uid');

        switch ($mode) {
            case 'list':
                switch ($object) {
                    case 'peserta':
                        return $this->d_view_list_peserta();
                        break;

                    default:
                        return $this->d_view_default();
                        break;
                }
                break;
            case 'edit':
                if (!$uid) {
                    return $this->d_view_default();
                } else {
                    switch ($object) {
                        case 'peserta':
                            return $this->d_view_edit_peserta($uid);
                            break;

                        default:
                            return $this->d_view_default();
                            break;
                    }
                }
                break;

            case 'add':
                switch ($object) {
                    case 'peserta':
                        return $this->d_view_add_peserta($uid);
                        break;

                    default:
                        return $this->d_view_default();
                        break;
                }
                break;

            case 'detail':
                switch ($object) {
                    case 'peserta':
                        return $this->d_view_detail_peserta($uid);
                        break;
                    default:
                        return $this->d_view_default();
                        break;
                }
                break;

            default:
                return $this->d_view_default();
                break;
        }
    }

    public function sertif(Request $request)
    {
        if ($request->query('filename')) {
            return Storage::download('public/' . $request->query('filename'));
        }
        return view('container.sertif');
    }

    protected function d_view_default()
    {
        $listPeserta = Auth::user()->peserta;
        return view('container.list-peserta', [
            'data' => $listPeserta,
        ]);
    }

    protected function d_view_list_peserta()
    {
        return $this->d_view_default();
    }

    protected function d_view_add_peserta()
    {
        return view('container.add-peserta');
    }

    protected function d_view_edit_peserta($uid)
    {
        $p = Peserta::where('uid', $uid)->first();
        return view('container.edit-peserta', [
            'data' => $p
        ]);
    }

    public function d_view_add_dokumen($uid)
    {
        $data = Peserta::where('uid', $uid)->first();
        return view('be.d.peserta.add-dokumen', [
            'data' => $data,
        ]);
    }

    public function d_view_detail_peserta($uid)
    {
        $p = Peserta::where('uid', $uid)->first();
        return view('container.detail-peserta', [
            'data' => $p
        ]);
    }
    public function d_action(Request $request)
    {
        $mode = $request->query('mode');
        $object = $request->query('object');
        $uid = $request->query('uid');

        if (!$mode)
            return $this->d_action_default();

        if ($mode == 'edit' | $mode == 'delete')
            if (!$uid)
                return $this->d_action_default();


        switch ($mode) {
            case 'delete':
                switch ($object) {
                    case 'peserta':
                        return $this->d_action_delete_peserta($uid);
                        break;

                    default:
                        return $this->error_page();
                        break;
                }
                break;
            case 'edit':
                switch ($object) {
                    case 'peserta':
                        return $this->d_action_edit_peserta($request, $uid);
                        break;

                    default:
                        return $this->error_page();
                        break;
                }
                break;

            case 'add':
                switch ($object) {
                    case 'peserta':
                        return $this->d_action_add_peserta($request);
                        break;

                    default:
                        return $this->error_page();
                        break;
                }
                break;

            default:
                return $this->error_page();
                break;
        }
    }

    protected function d_action_default()
    {
        return 'list peserta';
    }

    protected function d_action_add_peserta(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'nama' => 'required|string',
            'jabatan' => 'required',
            'handphone' => 'required|min:10',
            'pas' => 'required|file|mimes:png,jpg,jpeg',
            'line' => 'required'
        ];

        Validator::make($request->all(), $rules, $messages = $this->msg)->validate();

        $u = Auth::user();

        if ($request->hasFile('pas')) {
            $foto_url = join(
                "_",
                [
                    time(),
                    join('-', explode(' ', $request->nama)),
                    "foto"
                ]
            )  . "." . $request->pas->extension();
            $request->pas->storeAs('public', $foto_url);
        }

        Peserta::create([
            'nama' => $request->nama,
            'user_id' => $u->id,
            'jabatan' => $request->jabatan,
            'handphone' => $request->handphone,
            'line' => $request->line,
            'email' => $request->email,
            'foto_url' => $foto_url,
            'uid' => join('-', [
                Str::random(10),
                join('-', explode(" ", $request->nama))
            ])
        ]);

        return redirect()->route('peserta', [
            'mode' => 'list',
            'object' => 'peserta'
        ])->with([
            'success' => 'Anda berhasil menambahkan ' . $request->nama,
            'success-title' => 'Berhasil Menambahkan Peserta!'
        ]);
        return 'add peserta';
    }

    protected function d_action_edit_peserta(Request $request, $uid)
    {
        $p = Peserta::where('uid', $uid)->first();

        $rules = [
            'email' => [
                'required',
                'email',
                Rule::unique('pesertas')->ignore($p->id)
            ],
            'nama' => 'required|string|min:5',
            'jabatan' => 'required',
            'handphone' => 'required',
            'line' => 'required',
        ];

        Validator::make($request->all(), $rules, $this->msg)->validate();

        if (!$p) {
            # code...
        }

        if ($p->email != $request->email)
            $p->email = $request->email;

        if ($p->nama != $request->nama) {
            $p->nama = $request->nama;

            if ($p->jabatan == 'Representative AMSA Universitas') {
                User::find(Auth::user()->id)->update([
                    'ketua' => $request->nama
                ]);
            }
        }

        if ($p->jabatan != $request->jabatan)
            $p->jabatan = $request->jabatan;

        if ($p->handphone != $request->handphone)
            $p->handphone = $request->handphone;

        if ($request->pas) {
            $foto_url = join("_", [time(), join('-', explode(' ', $request->nama)), "foto"])  . "." . $request->pas->extension();
            $request->pas->storeAs('public', $foto_url);
            $p->foto_url = $foto_url;
        }

        $p->save();

        return redirect()->route('peserta', [
            'mode' => 'list',
            'object' => 'peserta'
        ])->with([
            'success' => 'Anda berhasil memperbarui data ' . $p->nama,
            'success-title' => 'Berhasil Memperbarui!'
        ]);
    }

    protected function d_action_delete_peserta($uid)
    {
        $p = Peserta::where('uid', $uid)->first();
        if ($p->jabatan != 'Representative AMSA Universitas') {
            $p->delete();
            return redirect()->route('peserta', [
                'mode' => 'list',
                'object' => 'peserta'
            ])->with([
                'success' => 'Anda berhasil menghapus ' . $uid,
                'success-title' => 'Berhasil Menghapus!'
            ]);
        } else {
            return redirect()->route('peserta', [
                'mode' => 'list',
                'object' => 'peserta'
            ])->with([
                'error' => 'Anda tidak menghapus ' . $uid . ', karena Representative AMSA Universitas',
                'error-title' => 'Gagal Menghapus!'
            ]);
        }
    }
    
    protected function error_page()
    {
        return 'error page';
    }
}
