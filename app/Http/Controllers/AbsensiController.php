<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        $data['title'] = 'Absensi Siswa';
        $data['siswa'] = Siswa::orderBy('nama_siswa')->where('kelas', 0)->search()->get();
        $data['mapel'] = Mapel::orderBy('mata_pelajaran')->get();
        $data['kelas'] = Kelas::orderBy('sub_kelas')->get();

        $data['cek_absensi'] = Absensi::where('tgl_absensi', date('Y-m-d'))->groupBy('id_mapel')->orderByDesc('id')->first();
        $absensi = Absensi::join('siswas', 'absensis.id_siswa', '=', 'siswas.id');
        if (empty($tanggal)) {
            $absensi->where('tgl_absensi', date('Y-m-d'));
            if ($data['cek_absensi']) {
                $absensi->where('id_mapel', $data['cek_absensi']->id_mapel);
            }
        }
        $absensi->select('absensis.*', 'siswas.nama_siswa', 'siswas.jenis_kelamin', 'siswas.nis');
        $absensi->orderBy('absensis.tgl_absensi')->get();
        $data['absensi'] = $absensi->get();
        $data['jumlah_all'] = count($data['absensi']);

        return view('backend.absensi', $data);
    }

    public function store(Request $request)
    {
        $cek_absensi = Absensi::where('tgl_absensi', date('Y-m-d'))->where('id_mapel', $request->id_mapel)->where('kelas', $request->kelas)->orderByDesc('id')->first();


        for ($i = 0; $i < count($request->id_siswa); $i++) {

            if ($cek_absensi) {

                // jika sudah absen akan terupdate
                $insert = Absensi::where('id_siswa', $request->id_siswa[$i])
                    ->where('id_mapel', $request->id_mapel)
                    ->where('tgl_absensi', $request->tgl_absensi)
                    ->where('kelas', $request->kelas)
                    ->update([
                        'id_siswa' => $request->id_siswa[$i],
                        'kelas' => $request->kelas,
                        'id_mapel' => $request->id_mapel,
                        'tgl_absensi' => $request->tgl_absensi,
                        'absensi' => $request->absensi[$i],
                        'keterangan' => $request->keterangan[$i],
                        'user' => Auth::id(),
                    ]);

                // dd($insert);
            } else {
                // jika belum absen akan insert data baru
                $insert = Absensi::create([
                    'id_siswa' => $request->id_siswa[$i],
                    'kelas' => $request->kelas,
                    'id_mapel' => $request->id_mapel,
                    'tgl_absensi' => $request->tgl_absensi,
                    'absensi' => $request->absensi[$i],
                    'keterangan' => $request->keterangan[$i],
                    'user' => Auth::id(),
                ]);
            }
        }

        if ($insert) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }

    public function update(Request $request, Absensi $absensi)
    {
        for ($i = 0; $i < count($request->id_siswa); $i++) {
            $update = Absensi::where('id', $request->id_absensi[$i])
                ->update([
                    'id_siswa' => $request->id_siswa[$i],
                    'kelas' => $request->kelas,
                    'id_mapel' => $request->id_mapel,
                    'tgl_absensi' => $request->tgl_absensi,
                    'absensi' => $request->absensi[$i],
                    'keterangan' => $request->keterangan[$i],
                    'user' => Auth::id(),
                ]);
        }

        if ($update) {
            return back()->with('success', 'Success! Data saved successfully');
        } else {
            return back()->with('failed', 'Alert! Data failed to save');
        }
    }
}