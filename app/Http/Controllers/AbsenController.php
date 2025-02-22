<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiExport;
use App\Models\Absen;
use App\Models\Peserta;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class AbsenController extends Controller
{
    public $jadwal = [
        ['2022-07-01 18:15', '2022-07-01 18:20'],
        ['2022-07-01 18:20', '2022-07-01 18:26'],
        ['2022-07-01 18:30', '2022-07-01 18:45'],
        ['2022-07-01 12:30', '2022-07-01 12:45'],
        ['2022-07-01 08:00', '2022-07-01 09:00'],
        ['2022-07-01 12:30', '2022-07-01 13:15'],
    ];

    public function viewAbsen(Request $request)
    {
        $now = DateTime::createFromFormat('Y-m-d H:i', date('Y-m-d H:i'));
        $target = DateTime::createFromFormat('Y-m-d H:i', '2022-04-03 07:00');
        if ($now < $target) {
            return view('container.souvenir-soon');
        }
        $mode = $request->query('mode');
        $uid = $request->query('peserta');
        switch ($mode) {
            case 'list':
                return $this->list($uid);
                break;

            case 'do':
                return $this->absen($uid);
                break;

            default:
                return $this->list();
                break;
        }
    }

    protected function list($uid = null)
    {
        $p = null;
        if ($uid != null) {
            $p = Peserta::where('uid', $uid)->first();
        }
        // Year-Month-Day Hour:Minute

        // return view('be.d.absensi.list', [
        return view('container.list-absensi', [
            'jadwal' => $this->jadwal,
            'peserta' => $p
        ]);
    }

    protected function absen($uid)
    {
        $u = Peserta::where('uid', $uid)->first();
        $absen = false;
        $d = 1;
        $s = 1;
        foreach ($this->jadwal as $sesi) {
            $current_time = date("Y-m-d H:i");
            $sunrise = $sesi[0];
            $sunset = $sesi[1];
            $date1 = DateTime::createFromFormat('Y-m-d H:i', $current_time);
            $date2 = DateTime::createFromFormat('Y-m-d H:i', $sunrise);
            $date3 = DateTime::createFromFormat('Y-m-d H:i', $sunset);
            if (
                $date1 > $date2
                && $date1 < $date3
            ) {
                $absen = !$absen;
                break;
            }
            if ($s == 2) {
                $d++;
                $s = 1;
            } else {
                $s++;
            }
        }
        // return view('be.d.absensi.do', [
        return view('container.add-absensi', [
            'user' => $u,
            'day' => 'Day ' . $d . ', Sesi ' . $s,
            'absen' => $absen
        ]);
    }

    public function doAbsen(Request $request)
    {
        $rules = [
            'bukti' => 'required|file|mimes:png,jpg,jpeg'
        ];

        Validator::make($request->all(), $rules, $this->msg)->validate();

        $p = Peserta::where('uid', $request->uid)->first();

        if ($request->hasFile('bukti')) {
            $foto_url = join(
                '_',
                [
                    time(),
                    join('-', explode(' ', $p->nama)),
                    'bukti_absen'
                ]
            ) . "." . $request->bukti->extension();
            $request->bukti->storeAs('public', $foto_url);
        }


        Absen::create([
            'peserta_id' => $p->id,
            'bukti' => $foto_url
        ]);

        return redirect()->route('absensi');
    }

    public function admin()
    {
        $p = Peserta::get();
        // return view('be.a.absensi', [
        return view('container.admin.absensi', [
            'peserta' => $p,
            'jadwal' => $this->jadwal
        ]);
    }

    public function excel()
    {
        return Excel::download(new AbsensiExport($this->jadwal), 'all-data_Absensi_' . date('H-i_d-M') . '.xlsx');
    }
}
