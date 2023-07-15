<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AbsensiExport;
use Barryvdh\DomPDF\Facade\Pdf;

class AbsensiController extends Controller
{
    public function index()
    {
        // QUERY ABSENSI--------------------------------
        // query untuk menampilkan filter kelas 
        $id_guru = userLogin()->id_guru;
        $kelas = Kelas::select('kelas', 'sub_kelas')->where('id_guru', $id_guru)->get();
        // query ubtuk absensi siswa
        $paramKelas = request('kelas');
        if ($paramKelas) {
            $string = urldecode($paramKelas);
            $array = explode(" ", $string);
            $class = $array[0];
            $subClass = $array[1];
        }
        $murid = Siswa::orderByRaw('kelas asc, sub_kelas asc, nama_siswa asc');
        if ($paramKelas) {
            $murid->where('kelas', $class);
            $murid->where('sub_kelas', $subClass);
        }
        $murid = $murid->get();

        $siswa = [];
        foreach ($murid as $value) {
            $kelasSiswa = $value->kelas;
            $subKelasSiswa = $value->sub_kelas;
            foreach ($kelas as  $val) {
                $kelasKelas = $val->kelas;
                $subKelasKelas = $val->sub_kelas;
                if ($kelasSiswa == $kelasKelas && $subKelasKelas == $subKelasSiswa) {
                    $siswa[] = $value;
                }
            }
        }

        // QUERY DAFTAR ABSENSI--------------------------------
        $cek_absensi = Absensi::where('tgl_absensi', date('Y-m-d'))->groupBy('id_mapel')->orderByDesc('id')->first();
        $tanggal = request('daftar_tanggal');
        $mapel = request('daftar_mapel');
        $kls = request('daftar_kelas');
        $absensi = Absensi::join('siswas', 'absensis.id_siswa', '=', 'siswas.id');
        // filter mata pelajaran 
        if (!empty($mapel)) {
            $absensi->where('absensis.id_mapel', $mapel);
        }
        // filter kelas 
        if (!empty($kls)) {
            $absensi->where('absensis.kelas', $kls);
        }
        // filter tanggal
        if (empty($tanggal)) {
            $absensi->where('tgl_absensi', date('Y-m-d'));
        } else {
            $absensi->where('tgl_absensi', $tanggal);
        }
        $absensi->select('absensis.*', 'siswas.nama_siswa', 'siswas.jenis_kelamin', 'siswas.nis');
        $absensi->orderByRaw('absensis.tgl_absensi, siswas.nama_siswa')->get();
        $absensis = $absensi->get();

        // meghitung jumlah siswa yg absen
        $masuk = 0;
        $izin = 0;
        $sakit = 0;
        $alpha = 0;
        foreach ($absensis as $key => $value) {
            if ($value->absensi == 'yes') {
                $masuk += 1;
            }
            if ($value->keterangan == 'Izin') {
                $izin += 1;
            }
            if ($value->keterangan == 'Sakit') {
                $sakit += 1;
            }
            if ($value->keterangan == 'Alpha') {
                $alpha += 1;
            }
        }

        $data['title'] = 'Absensi Siswa';
        $data['cek_absensi'] = $cek_absensi;
        $data['siswa'] = $siswa;
        $data['kelas'] = $kelas;
        $data['absensi'] = $absensis;
        $data['jumlah_all'] = count($data['absensi']);
        $data['jumlah_siswa'] = ['masuk' => $masuk, 'izin' => $izin, 'sakit' => $sakit, 'alpha' => $alpha];
        $data['mapel'] = Mapel::orderBy('mata_pelajaran')->get();


        return view('backend.absensi', $data);
    }

    public function store(Request $request)
    {
        $cek_absensi = Absensi::where('tgl_absensi', date('Y-m-d'))->where('id_mapel', $request->id_mapel)->where('kelas', $request->kelas)->orderByDesc('id')->first();
        $ajaran_awal = getTahunAjaran()->thn_ajaran_awal;
        $ajaran_akhir = getTahunAjaran()->thn_ajaran_akhir;



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
                        'tahun_ajaran_awal' => $ajaran_awal,
                        'tahun_ajaran_akhir' => $ajaran_akhir,
                        'user' => Auth::id(),
                    ]);
            } else {
                // jika belum absen akan insert data baru
                $insert = Absensi::create([
                    'id_siswa' => $request->id_siswa[$i],
                    'kelas' => $request->kelas,
                    'id_mapel' => $request->id_mapel,
                    'tgl_absensi' => $request->tgl_absensi,
                    'absensi' => $request->absensi[$i],
                    'keterangan' => $request->keterangan[$i],
                    'tahun_ajaran_awal' => $ajaran_awal,
                    'tahun_ajaran_akhir' => $ajaran_akhir,
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

    public function exportExcel()
    {
        $kelas = request('kelas');
        $tipe = request('tipe');

        if ($tipe == 'absensi') {

            $header = ['Kelas', 'Tanggal Absensi', 'Absensi', 'Keterangan', 'Nama Siswa', 'Mata Pelajaran'];
        } else {

            $header = ['Nama Siswa', 'Masuk', 'Tidak Masuk', 'Sakit', 'Izin', 'Alpha'];
        }


        return Excel::download(new AbsensiExport($header, $kelas, $tipe), 'absensi.xlsx');
    }

    public function exportPdf()
    {
        $kelas = request('kelas');
        $tipe = request('tipe');
        $title = 'Daftar Absensi';

        $object = new Absensi();
        if ($tipe == 'absensi') {
            $data = $object->printPDF($kelas);

            $pdf = PDF::loadview('pdf.absensiPdf', ['data' => $data, 'title' => $title]);
        } else {
            $data = $object->printListPDF($kelas);

            $pdf = PDF::loadview('pdf.absensiListPdf', ['data' => $data, 'title' => $title]);
        }


        return $pdf->stream('absensi.pdf');
        // return $pdf->download('Siswa.pdf');
    }
}
